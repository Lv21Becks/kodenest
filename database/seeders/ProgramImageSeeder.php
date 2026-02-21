<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramImageSeeder extends Seeder
{
    public function run()
    {
        $imageMap = [
            'Coding for Kids' => 'programs/coding-kids.png',
            'Cyber Security' => 'programs/cyber-security.png',
            'Front-End' => 'programs/web-dev.png',
            'Data Analytics' => 'programs/data-analytics.png',
            'Python' => 'programs/python.png',
            'Mobile App' => 'programs/mobile-app.png',
            'Software Development' => 'programs/software-dev.png',
            'UI/UX Design' => 'programs/ui-ux.png',
            'Office Productivity' => 'programs/office-productivity.png',
        ];

        foreach ($imageMap as $key => $path) {
            $program = Program::where('title', 'like', "%{$key}%")->first();
            if ($program) {
                $program->update(['image_icon' => $path]);
            }
        }
    }
}
