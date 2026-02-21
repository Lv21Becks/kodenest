<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramToolsSeeder extends Seeder
{
    public function run()
    {
        $toolMap = [
            'Data Analytics' => ['Excel', 'SQL', 'Tableau', 'PowerBI', 'Python'],
            'Cybersecurity' => ['Linux', 'Wireshark', 'Metasploit', 'Nmap', 'Burp Suite'],
            'Software Development' => ['VS Code', 'Git', 'JavaScript', 'Laravel', 'React'],
            'UI/UX Design' => ['Figma', 'Adobe XD', 'Sketch', 'Miro', 'InVision'],
            'Office Productivity' => ['Microsoft Word', 'Excel', 'PowerPoint', 'Outlook', 'Teams'],
            'Coding for Kids' => ['Scratch', 'MIT App Inventor', 'Python', 'Roblox Studio'],
        ];

        foreach ($toolMap as $title => $tools) {
            $program = Program::where('title', 'like', "%{$title}%")->first();
            if ($program) {
                $program->update(['tools' => $tools]);
            }
        }
    }
}
