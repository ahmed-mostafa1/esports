<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Content;

class InitialContentSeeder extends Seeder
{
    public function run()
    {
        $initialContent = [
            // Home Page Content
            ['key' => 'home.hero.title', 'type' => 'text', 'group' => 'home', 'value' => ['en' => 'Welcome to Esports Championship', 'ar' => '']],
            ['key' => 'home.hero.subtitle', 'type' => 'text', 'group' => 'home', 'value' => ['en' => 'Championship', 'ar' => '']],
            ['key' => 'home.hero.description', 'type' => 'text', 'group' => 'home', 'value' => ['en' => 'Join the ultimate gaming experience and compete with the best players', 'ar' => '']],
            ['key' => 'home.hero.image', 'type' => 'image', 'group' => 'home', 'value' => ['path' => 'home.hero.image.png']],
            
            ['key' => 'home.services.title', 'type' => 'text', 'group' => 'home', 'value' => ['en' => 'Our Services', 'ar' => '']],
            ['key' => 'home.services.card1.title', 'type' => 'text', 'group' => 'home', 'value' => ['en' => 'Experienced Trainers', 'ar' => '']],
            ['key' => 'home.services.card1.icon', 'type' => 'image', 'group' => 'home', 'value' => ['path' => 'Subtract(1).png']],
            
            ['key' => 'home.tournaments.title', 'type' => 'text', 'group' => 'home', 'value' => ['en' => 'Popular Tournaments', 'ar' => '']],
            ['key' => 'home.tournaments.subtitle', 'type' => 'text', 'group' => 'home', 'value' => ['en' => 'Join the competition', 'ar' => '']],
            
            ['key' => 'home.partners.title', 'type' => 'text', 'group' => 'home', 'value' => ['en' => 'Our Partners', 'ar' => '']],
            ['key' => 'home.testimonials.title', 'type' => 'text', 'group' => 'home', 'value' => ['en' => 'Client', 'ar' => '']],
            ['key' => 'home.testimonials.subtitle', 'type' => 'text', 'group' => 'home', 'value' => ['en' => 'Testimonials', 'ar' => '']],
            
            // Services Page Content
            ['key' => 'services.header.title', 'type' => 'text', 'group' => 'services', 'value' => ['en' => 'Our Services', 'ar' => '']],
            ['key' => 'services.card1.title', 'type' => 'text', 'group' => 'services', 'value' => ['en' => 'Technology & Platform Development', 'ar' => '']],
            ['key' => 'services.card1.item1', 'type' => 'text', 'group' => 'services', 'value' => ['en' => 'Custom tournament platforms and registration portals', 'ar' => '']],
            
            // News Page Content
            ['key' => 'news.header.main_title', 'type' => 'text', 'group' => 'news', 'value' => ['en' => 'E-Sports', 'ar' => '']],
            ['key' => 'news.header.section_title', 'type' => 'text', 'group' => 'news', 'value' => ['en' => 'Our News', 'ar' => '']],
            ['key' => 'news.article1.title', 'type' => 'text', 'group' => 'news', 'value' => ['en' => 'Movie Night Under the Stars', 'ar' => '']],
            ['key' => 'news.article1.date', 'type' => 'text', 'group' => 'news', 'value' => ['en' => 'July 10, 2024', 'ar' => '']],
            ['key' => 'news.article1.image', 'type' => 'image', 'group' => 'news', 'value' => ['path' => 'our-news-page4.png']],
            
            // About Page Content
            ['key' => 'about.header.text', 'type' => 'text', 'group' => 'about', 'value' => ['en' => 'About Us', 'ar' => '']],
            ['key' => 'about.story.title', 'type' => 'text', 'group' => 'about', 'value' => ['en' => 'Our Story', 'ar' => '']],
            ['key' => 'about.mission.title', 'type' => 'text', 'group' => 'about', 'value' => ['en' => 'Our Mission', 'ar' => '']],
            ['key' => 'about.vision.title', 'type' => 'text', 'group' => 'about', 'value' => ['en' => 'Our Vision', 'ar' => '']],
            
            // Registration Pages Content
            ['key' => 'team_registration.header.title', 'type' => 'text', 'group' => 'team_registration', 'value' => ['en' => 'E-Sports', 'ar' => '']],
            ['key' => 'team_registration.form.team_name', 'type' => 'text', 'group' => 'team_registration', 'value' => ['en' => 'Team Name', 'ar' => '']],
            ['key' => 'team_registration.form.captain_name', 'type' => 'text', 'group' => 'team_registration', 'value' => ['en' => 'Captain\'s Name', 'ar' => '']],
            
            ['key' => 'single_registration.header.title', 'type' => 'text', 'group' => 'single_registration', 'value' => ['en' => 'E-Sports', 'ar' => '']],
            ['key' => 'single_registration.form.player_name', 'type' => 'text', 'group' => 'single_registration', 'value' => ['en' => 'Player Name', 'ar' => '']],
        ];

        foreach ($initialContent as $contentData) {
            Content::updateOrCreate(
                ['key' => $contentData['key']],
                $contentData
            );
        }
        
        $this->command->info('Initial content seeded successfully! Created ' . count($initialContent) . ' content records.');
    }
}