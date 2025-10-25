<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        if (Partner::count() > 0) {
            return;
        }

        Partner::create([
            'name' => [
                'en' => 'Dubai Police',
                'ar' => 'شرطة دبي',
            ],
            'media_type' => 'image',
            'image_path' => 'content-images/partners/sample-image.png',
            'is_published' => true,
            'sort_order' => 1,
        ]);

        Partner::create([
            'name' => [
                'en' => 'Que Club',
                'ar' => 'نادي كيو',
            ],
            'media_type' => 'video',
            'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'is_published' => true,
            'sort_order' => 2,
        ]);
    }
}
