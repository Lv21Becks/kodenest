<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    public function run()
    {
        $features = [
            [
                'title' => 'Expert Instructors',
                'description' => 'Learn from experienced professionals who have worked in leading tech companies and understand industry needs.',
                'icon' => 'fas fa-chalkboard-teacher',
                'sort_order' => 1,
            ],
            [
                'title' => 'Job-Ready Skills',
                'description' => 'Our curriculum is designed with employers in mind, ensuring you learn skills that companies actually need.',
                'icon' => 'fas fa-briefcase',
                'sort_order' => 2,
            ],
            [
                'title' => 'Hands-On Projects',
                'description' => 'Build a portfolio of real projects that showcase your abilities to potential employers.',
                'icon' => 'fas fa-project-diagram',
                'sort_order' => 3,
            ],
            [
                'title' => 'Flexible Learning',
                'description' => 'Choose from online, physical, or hybrid learning modes that fit your schedule and lifestyle.',
                'icon' => 'fas fa-globe',
                'sort_order' => 4,
            ],
        ];

        foreach ($features as $feature) {
            Feature::create($feature);
        }
    }
}
