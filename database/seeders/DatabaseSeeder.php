<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RoleHasPermissionSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            CategorySeeder::class,
            PageSeeder::class,
            SubPageSeeder::class,
            TaskSeeder::class,
            NewsSeeder::class,
            NewsImageSeeder::class,
            GallerySeeder::class,
            ImageSeeder::class,
            VideoSeeder::class,
            LinkSeeder::class,
            PresidentSeeder::class,
            ProjectSeeder::class,
            ServiceSeeder::class,
            LeaderSeeder::class,
            DocumentSeeder::class,
            JobSeeder::class,
            SurveySeeder::class,
            QuestionSeeder::class,
            OptionSeeder::class,
            AnswerSeeder::class,
        ]);
    }
}
