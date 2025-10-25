<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartnerRequest;
use App\Http\Requests\UpdatePartnerRequest;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::ordered()->paginate(20);

        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(StorePartnerRequest $request)
    {
        $data = $this->extractData($request);
        $data['sort_order'] = (Partner::max('sort_order') ?? 0) + 1;

        if ($data['media_type'] === 'image') {
            if (!$request->hasFile('image')) {
                throw ValidationException::withMessages([
                    'image' => 'An image file is required when media type is image.',
                ]);
            }
            $data['image_path'] = $this->storeImage($request->file('image'));
        } else {
            if (!$data['video_url']) {
                throw ValidationException::withMessages([
                    'video_url' => 'A video URL is required when media type is video.',
                ]);
            }
        }

        Partner::create($data);

        return redirect()->route('admin.partners.index')->with('ok', 'Partner created');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', ['partner' => $partner]);
    }

    public function update(UpdatePartnerRequest $request, Partner $partner)
    {
        $data = $this->extractData($request);

        if ($data['media_type'] === 'image') {
            if ($request->hasFile('image')) {
                $this->deleteImage($partner->image_path);
                $data['image_path'] = $this->storeImage($request->file('image'));
            } elseif (!$partner->image_path) {
                throw ValidationException::withMessages([
                    'image' => 'An image file is required when media type is image.',
                ]);
            }
            $data['video_url'] = null;
        } else {
            if (!$data['video_url']) {
                throw ValidationException::withMessages([
                    'video_url' => 'A valid video URL is required when media type is video.',
                ]);
            }
            if ($partner->image_path) {
                $this->deleteImage($partner->image_path);
            }
            $data['image_path'] = null;
        }

        $partner->update($data);

        return redirect()->route('admin.partners.index')->with('ok', 'Partner updated');
    }

    public function destroy(Partner $partner)
    {
        $this->deleteImage($partner->image_path);
        $partner->delete();

        return redirect()->route('admin.partners.index')->with('ok', 'Partner deleted');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'orders' => ['required', 'array'],
            'orders.*.id' => ['required', 'integer', 'exists:partners,id'],
            'orders.*.sort_order' => ['required', 'integer', 'min:0'],
        ]);

        foreach ($validated['orders'] as $order) {
            Partner::whereKey($order['id'])->update([
                'sort_order' => $order['sort_order'],
            ]);
        }

        return response()->json(['ok' => true]);
    }

    private function extractData(Request $request): array
    {
        return [
            'name' => [
                'en' => $request->input('name.en'),
                'ar' => $request->input('name.ar'),
            ],
            'media_type' => $request->input('media_type'),
            'video_url' => $this->normaliseVideoUrl($request->input('video_url')),
            'is_published' => $request->boolean('is_published'),
        ];
    }

    private function storeImage($file): string
    {
        $directory = public_path('content-images/partners');

        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $extension = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'png');
        $name = 'partner-' . Str::random(12) . '.' . $extension;
        $file->move($directory, $name);

        return 'content-images/partners/' . $name;
    }

    private function deleteImage(?string $path): void
    {
        if (!$path) {
            return;
        }

        $fullPath = public_path($path);
        if (File::isFile($fullPath)) {
            File::delete($fullPath);
        }
    }

    private function normaliseVideoUrl(?string $url): ?string
    {
        if (!$url) {
            return null;
        }

        $trimmed = trim($url);

        if (preg_match('~https?://(www\.)?youtube\.com/watch\?~i', $trimmed)) {
            parse_str(parse_url($trimmed, PHP_URL_QUERY), $query);
            if (!empty($query['v'])) {
                return 'https://www.youtube.com/embed/' . $query['v'];
            }
        }

        if (preg_match('~https?://youtu\.be/([^?&]+)~i', $trimmed, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        if (preg_match('~https?://(www\.)?youtube\.com/embed/([^?&]+)~i', $trimmed)) {
            return $trimmed;
        }

        return $trimmed;
    }
}
