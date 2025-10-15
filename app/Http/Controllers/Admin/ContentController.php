<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Support\ContentRepository;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function dashboard()
    {
        // Get statistics
        $stats = [
            'total' => Content::count(),
            'text' => Content::where('type', 'text')->count(),
            'image' => Content::where('type', 'image')->count(),
        ];
        
        // Get recent edits (last 10 updated items)
        $recentEdits = Content::orderBy('updated_at', 'desc')
                             ->limit(10)
                             ->get();
        
        // Get all content groups for dynamic links
        $contentGroups = Content::select('group')
                              ->distinct()
                              ->orderBy('group')
                              ->pluck('group')
                              ->map(function($group) {
                                  return [
                                      'name' => $group,
                                      'label' => ucwords(str_replace(['-', '_'], ' ', $group)),
                                      'count' => Content::where('group', $group)->count()
                                  ];
                              });
        
        return view('admin.dashboard', compact('stats', 'recentEdits', 'contentGroups'));
    }
    
    public function page(string $group)
    {
        // Get contents for specific page/group
        $contents = Content::where('group', $group)
                          ->orderBy('key')
                          ->paginate(20);
        
        // Get all available groups and types for filter dropdowns
        $groups = Content::select('group')->distinct()->orderBy('group')->pluck('group');
        $types = Content::select('type')->distinct()->orderBy('type')->pluck('type');
        
        // Set current filter values
        $q = '';
        $currentGroup = $group;
        $type = '';
        $registry = [];
        
        return view('admin.contents.index', [
            'contents' => $contents,
            'groups' => $groups,
            'types' => $types,
            'q' => $q,
            'group' => $currentGroup,
            'type' => $type,
            'registry' => $registry,
            'pageTitle' => ucfirst($group) . ' Content'
        ]);
    }
    
    public function skeleton(string $group)
    {
        // Get all contents for this page/group indexed by key
        $contents = Content::where('group', $group)
                          ->get()
                          ->keyBy('key');
        
        // Check if skeleton view exists for this page
        $skeletonView = "admin.skeletons.{$group}";
        if (!view()->exists($skeletonView)) {
            // Fallback to regular page view if skeleton doesn't exist
            return redirect()->route('admin.contents.page', $group)
                           ->with('error', 'Skeleton view not available for this page. Using standard editor.');
        }
        
        return view($skeletonView, [
            'contents' => $contents,
            'pageGroup' => $group
        ]);
    }
    public function index(Request $request)
    {
        // Get filter parameters from request
        $q = $request->get('q', '');
        $group = $request->get('group', '');
        $type = $request->get('type', '');
        
        // Build the query with filters
        $query = Content::query();
        
        // Apply search filter (search in key and content values)
        if (!empty($q)) {
            $query->where(function($subQuery) use ($q) {
                $subQuery->where('key', 'LIKE', '%' . $q . '%')
                        ->orWhere('value', 'LIKE', '%' . $q . '%');
            });
        }
        
        // Apply group filter
        if (!empty($group)) {
            $query->where('group', $group);
        }
        
        // Apply type filter
        if (!empty($type)) {
            $query->where('type', $type);
        }
        
        // Get filtered contents with pagination
        $contents = $query->orderBy('key')->paginate(20)->withQueryString();
        
        // Get all available groups and types for dropdown options
        $groups = Content::select('group')->distinct()->orderBy('group')->pluck('group');
        $types = Content::select('type')->distinct()->orderBy('type')->pluck('type');
        
        $registry = [];
        
        return view('admin.contents.index', compact('contents','groups','types','q','group','type','registry'));
    }
    public function edit(string $key)
    {
        $content = $this->findOrCreateContent($key);
        $meta = null;
        return view('admin.contents.edit', compact('content','meta'));
    }
    public function update(Request $request, string $key)
    {
        $content = $this->findOrCreateContent($key);
        
        // Handle text content updates
        if ($content->type === 'text') {
            $request->validate([
                'value.en' => 'required|string',
                'value.ar' => 'nullable|string',
            ]);
            
            $value = [];
            $value['en'] = $request->input('value.en');
            if ($request->filled('value.ar')) {
                $value['ar'] = $request->input('value.ar');
            }
            
            $content->value = $value;
            $content->save();
            
            // Clear cache for text content (all locales we have values for)
            $locales = array_keys($content->getTranslations('value') ?? []);
            ContentRepository::forgetText($key, $locales);
        }
        
        // Handle image content updates
        if ($content->type === 'image' && $request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048'
            ]);
            
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $key . '.' . $extension;
            
            // Save the file
            $file->move(public_path('content-images'), $filename);
            
            // Update database
            $content->value = ['path' => $filename];
            $content->save();
            
            // Clear cache for image content
            ContentRepository::forgetImage($key);
        }
        
        return back()->with('status', 'Content updated successfully!');
    }
    
    public function updateAjax(Request $request, string $key)
    {
        try {
            // Determine content type from request if creating new content
            $isNewContent = !Content::where('key', $key)->exists();
            $requestType = $this->determineContentTypeFromRequest($request);
            
            $content = $this->findOrCreateContent($key, $requestType);
            
            // Handle text content updates
            if ($content->type === 'text') {
                $request->validate([
                    'value.en' => 'required|string',
                    'value.ar' => 'nullable|string',
                ]);
                
                $value = [];
                $value['en'] = $request->input('value.en');
                if ($request->filled('value.ar')) {
                    $value['ar'] = $request->input('value.ar');
                }
                
                $content->value = $value;
                $content->save();
                
                // Clear cache for text content
                $locales = array_keys($content->getTranslations('value') ?? []);
                ContentRepository::forgetText($key, $locales);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Content updated successfully',
                    'content' => $content->getTranslations('value')
                ]);
            }
            
            // Handle image content updates
            if ($content->type === 'image' && $request->hasFile('image')) {
                $request->validate([
                    'image' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048'
                ]);
                
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = $key . '.' . $extension;
                
                // Ensure content-images directory exists
                $uploadsPath = public_path('content-images');
                if (!file_exists($uploadsPath)) {
                    mkdir($uploadsPath, 0755, true);
                }
                
                // Save the file
                $file->move($uploadsPath, $filename);
                
                // Update database
                $content->value = ['path' => $filename];
                $content->save();
                
                // Clear cache for image content
                ContentRepository::forgetImage($key);
                $imageUrl = ContentRepository::image($key);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Image updated successfully',
                    'content' => $content->value,
                    'imageUrl' => $imageUrl
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'No valid data provided. Content type: ' . $content->type . ', Has file: ' . ($request->hasFile('image') ? 'yes' : 'no')
            ], 400);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        } catch (\Exception $e) {
            \Log::error('AJAX Update Error: ' . $e->getMessage(), [
                'key' => $key,
                'request' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Return raw content data for skeleton editors.
     */
    public function showData(string $key)
    {
        $content = Content::where('key', $key)->firstOrFail();

        $base = [
            'success' => true,
            'key' => $content->key,
            'type' => $content->type,
            'updated_at' => optional($content->updated_at)->toIso8601String(),
        ];

        if ($content->type === 'text') {
            $translations = $content->getTranslations('value') ?? [];

            return response()->json($base + [
                'content' => $translations,
                'locales' => array_keys($translations),
            ]);
        }

        if ($content->type === 'image') {
            return response()->json($base + [
                'content' => $content->value ?? [],
                'imageUrl' => ContentRepository::image($key),
            ]);
        }

        return response()->json($base + [
            'content' => $content->value,
        ]);
    }
    
    /**
     * Determine content type from request data
     */
    private function determineContentTypeFromRequest($request)
    {
        if ($request->hasFile('image')) {
            return 'image';
        }
        if ($request->has('value')) {
            return 'text';
        }
        return null; // Let findOrCreateContent determine from key
    }
    
    /**
     * Find existing content or create new content record with intelligent defaults
     */
    private function findOrCreateContent(string $key, string $forceType = null)
    {
        $content = Content::where('key', $key)->first();
        
        if (!$content) {
            // Parse the key to determine group and type
            $keyParts = explode('.', $key);
            $group = $keyParts[0] ?? 'general';
            
            // Determine content type based on force type or key patterns
            $type = $forceType ?? 'text'; // default
            if (!$forceType) {
                if (str_contains($key, '.image') || 
                    str_contains($key, '.icon') || 
                    str_contains($key, '.avatar') || 
                    str_contains($key, '.badge') || 
                    str_contains($key, '.logo') ||
                    str_ends_with($key, '_image') ||
                    str_ends_with($key, '_icon')) {
                    $type = 'image';
                }
            }
            
            // Create default values
            if ($type === 'text') {
                $defaultValue = [
                    'en' => ucwords(str_replace(['.', '_', '-'], ' ', $key)),
                    'ar' => ''
                ];
            } else {
                $defaultValue = [
                    'path' => 'placeholder.png'
                ];
            }
            
            // Create the content record
            $content = Content::create([
                'key' => $key,
                'type' => $type,
                'group' => $group,
                'value' => $defaultValue
            ]);
            
            \Log::info('Auto-created missing content', [
                'key' => $key,
                'type' => $type,
                'group' => $group
            ]);
        }
        
        return $content;
    }
    
    /**
     * Handle AJAX content updates (simplified version for skeleton editors)
     */
    public function updateContentAjax(Request $request)
    {
        try {
            $key = $request->input('key');
            $value = $request->input('value');
            
            if (!$key || !$value) {
                return response()->json([
                    'success' => false,
                    'message' => 'Key and value are required'
                ], 400);
            }
            
            $content = $this->findOrCreateContent($key);
            
            if ($content->type === 'text') {
                // For AJAX updates from skeleton editors, treat as English content
                $currentValue = $content->value ?: [];
                $currentValue['en'] = $value;
                if (!isset($currentValue['ar'])) {
                    $currentValue['ar'] = '';
                }
                
                $content->value = $currentValue;
                $content->save();
                
                // Clear cache
                $locales = array_keys($content->getTranslations('value') ?? []);
                ContentRepository::forgetText($key, $locales);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Content updated successfully'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('AJAX Content Update Error: ' . $e->getMessage(), [
                'key' => $request->input('key'),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Handle batch content updates from skeleton editors
     */
    public function batchUpdate(Request $request)
    {
        try {
            $updates = $request->input('updates', []);
            
            if (empty($updates)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No updates provided'
                ], 400);
            }
            
            $updatedCount = 0;
            
            foreach ($updates as $update) {
                if (!isset($update['key']) || !isset($update['value'])) {
                    continue;
                }
                
                $key = $update['key'];
                $value = $update['value'];
                
                $content = $this->findOrCreateContent($key);
                
                if ($content->type === 'text') {
                    $currentValue = $content->value ?: [];
                    $currentValue['en'] = $value;
                    if (!isset($currentValue['ar'])) {
                        $currentValue['ar'] = '';
                    }
                    
                    $content->value = $currentValue;
                    $content->save();
                    
                    // Clear cache
                    $locales = array_keys($content->getTranslations('value') ?? []);
                    ContentRepository::forgetText($key, $locales);
                    $updatedCount++;
                }
            }
            
            return response()->json([
                'success' => true,
                'message' => "Successfully updated {$updatedCount} content items",
                'updated_count' => $updatedCount
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Batch Update Error: ' . $e->getMessage(), [
                'updates' => $request->input('updates'),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }
}
