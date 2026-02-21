<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class CourseUpdateSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            [
                'title' => 'Coding for Kids',
                'slug' => 'coding-for-kids',
                'description' => 'Introduce your kids/wards to the world of technology through fun, interactive learning. They\'ll explore creativity, logic, and problem-solving while building exciting projects.',
                'duration' => '2 Months',
                'price' => 150000, // Estimated default
                'target_audience' => 'Kids and teenagers aged 7-17',
                'skills' => ['Scratch Programming', 'Robotics', 'Microsoft Suites', 'Frontend Web Design'],
                'tools' => ['Scratch', 'Microsoft Office', 'HTML', 'CSS'],

                'status' => true,
                'order' => 1,
            ],
            [
                'title' => 'Cyber Security',
                'slug' => 'cyber-security',
                'description' => 'Learn to protect sensitive information from cyber threats and ensure the integrity of critical systems. Develop cutting-edge solutions to stay ahead in the fight against cybercrime.',
                'duration' => '12 Weeks',
                'price' => 300000,
                'target_audience' => 'Aspiring security analysts, network admins',
                'skills' => ['Linux OS', 'Security Fundamentals', 'Networking', 'Cryptography', 'Wireless Security', 'Offensive Security', 'SIEM Tools', 'Incident Response'],
                'tools' => ['Linux', 'Wireshark', 'Metasploit', 'Nmap', 'Burp Suite', 'Splunk'],

                'status' => true,
                'order' => 2,
            ],
            [
                'title' => 'Front-End Programming & Web Development',
                'slug' => 'frontend-web-development',
                'description' => 'Learn to Build Beautiful, Responsive Websites. Gain in-demand skills in HTML, CSS, JavaScript, PHP, MySQL, Git/GitHub, and AI for Faster Development. Build real projects and bring ideas to life online.',
                'duration' => '6 Months',
                'price' => 400000,
                'target_audience' => 'Creative individuals, aspiring developers',
                'skills' => ['HTML', 'CSS', 'JavaScript', 'PHP', 'MySQL', 'Git/GitHub', 'AI for Dev'],
                'tools' => ['VS Code', 'Git', 'GitHub', 'ChatGPT', 'Chrome DevTools'],

                'status' => true,
                'order' => 3,
            ],
            [
                'title' => 'Data Analytics',
                'slug' => 'data-analytics',
                'description' => 'Turn Data Into Decisions. Learn how to collect, clean, and interpret data to uncover insights that drive smart business choices. Master tools used by professionals worldwide.',
                'duration' => '12 Weeks',
                'price' => 250000,
                'target_audience' => 'Business professionals, math enthusiasts',
                'skills' => ['Data Cleaning', 'Data Visualization', 'SQL Queries', 'Statistical Analysis'],
                'tools' => ['Excel', 'Google Sheets', 'SQL', 'Tableau', 'Python'],

                'status' => true,
                'order' => 4,
            ],
            [
                'title' => 'Python Programming',
                'slug' => 'python-programming',
                'description' => 'Learn to automate tasks, analyze data, and build web applications using one of the most versatile and in-demand programming languages.',
                'duration' => '12 Weeks',
                'price' => 300000,
                'target_audience' => 'Beginners, automation seekers',
                'skills' => ['Python Basics', 'Data Analysis', 'Web Development', 'Scripting'],
                'tools' => ['Python', 'Django', 'Flask', 'Pandas', 'Jupyter'],

                'status' => true,
                'order' => 5,
            ],
            [
                'title' => 'Mobile App Development',
                'slug' => 'mobile-app-development',
                'description' => 'Learn how to create cross-platform mobile applications that run on Android and iOS devices and seal your place in the growing world of mobile services.',
                'duration' => '12 Weeks',
                'price' => 400000,
                'target_audience' => 'App ideas, coding enthusiasts',
                'skills' => ['Cross-platform Dev', 'UI/UX Implementation', 'State Management', 'API Integration'],
                'tools' => ['Flutter', 'Dart', 'Android Studio', 'Xcode', 'Firebase'],

                'status' => true,
                'order' => 6,
            ],
        ];

        foreach ($courses as $course) {
            Program::updateOrCreate(
                ['title' => $course['title']], // Match by title
                $course
            );
        }
    }
}
