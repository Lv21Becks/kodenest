<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use App\Models\Testimonial;
use App\Models\BlogPost;

class ContentSeeder extends Seeder
{
    public function run()
    {
        // Programs
        $programs = [
            [
                'title' => 'Data Analytics',
                'slug' => 'data-analytics',
                'description' => 'Transform raw data into actionable insights. Learn to analyze, visualize, and communicate data-driven decisions that impact business outcomes.',
                'duration' => '12 weeks',
                'target_audience' => 'Beginners to professionals',
                'skills' => ['Excel & Google Sheets Mastery', 'SQL & Database Management', 'Power BI & Tableau', 'Python for Data Analysis', 'Statistical Analysis', 'Data Visualization'],
                'price' => 150000.00,
                'status' => true,
                'order' => 1,
            ],
            [
                'title' => 'Cybersecurity',
                'slug' => 'cybersecurity',
                'description' => 'Protect digital assets and systems from cyber threats. Gain practical skills in network security, ethical hacking, and threat detection.',
                'duration' => '16 weeks',
                'target_audience' => 'IT professionals and beginners',
                'skills' => ['Network Security Fundamentals', 'Ethical Hacking & Penetration Testing', 'Security Tools (Wireshark, Nmap, etc.)', 'Incident Response', 'Risk Assessment', 'Compliance & Standards'],
                'price' => 200000.00,
                'status' => true,
                'order' => 2,
            ],
            [
                'title' => 'Software Development',
                'slug' => 'software-development',
                'description' => 'Build powerful applications from scratch. Master programming languages, frameworks, and tools used by professional developers worldwide.',
                'duration' => '20 weeks',
                'target_audience' => 'Aspiring developers',
                'skills' => ['HTML, CSS & JavaScript', 'React & Modern Frameworks', 'Backend Development (Node.js/Python)', 'Database Design & Management', 'Version Control (Git & GitHub)', 'API Development & Integration'],
                'price' => 250000.00,
                'status' => true,
                'order' => 3,
            ],
            [
                'title' => 'UI/UX Design',
                'slug' => 'ui-ux-design',
                'description' => 'Create beautiful, user-friendly digital experiences. Learn design thinking, prototyping, and the tools professionals use to craft exceptional interfaces.',
                'duration' => '12 weeks',
                'target_audience' => 'Creative individuals & developers',
                'skills' => ['Design Principles & Theory', 'Figma & Adobe XD', 'User Research & Testing', 'Wireframing & Prototyping', 'Mobile & Web Design', 'Design Systems'],
                'price' => 180000.00,
                'status' => true,
                'order' => 4,
            ],
            [
                'title' => 'Office Productivity',
                'slug' => 'office-productivity',
                'description' => 'Master essential workplace tools and boost your productivity. Perfect for professionals looking to excel in modern office environments.',
                'duration' => '8 weeks',
                'target_audience' => 'Everyone',
                'skills' => ['Microsoft Word (Advanced)', 'Microsoft Excel (Formulas & Analytics)', 'Microsoft PowerPoint', 'Google Workspace', 'Email Management', 'Project Management Tools'],
                'price' => 80000.00,
                'status' => true,
                'order' => 5,
            ],
            [
                'title' => 'Coding for Kids',
                'slug' => 'coding-for-kids',
                'description' => 'Introduce your child to the world of technology through fun, interactive coding lessons. Perfect for young minds eager to create games and apps.',
                'duration' => '10 weeks',
                'target_audience' => 'Ages 8-16',
                'skills' => ['Scratch Programming', 'Basic HTML & CSS', 'Game Development Basics', 'Logical Thinking', 'Problem-Solving Skills', 'Creative Coding Projects'],
                'price' => 100000.00,
                'status' => true,
                'order' => 6,
            ],
        ];

        foreach ($programs as $program) {
            Program::firstOrCreate(['slug' => $program['slug']], $program);
        }

        // Testimonials
        $testimonials = [
            [
                'name'     => 'Adaeze Okoro',
                'position' => 'Data Analytics Graduate',
                'content'  => 'KodeNest completely changed my life. I came in with zero tech experience and left with the skills to land my first job as a Data Analyst. The instructors truly care about your success. I wholeheartedly recommend this program!',
                'rating'   => 5,
                'status'   => true,
                'image'    => 'public:images/testimonials/adaeze_okoro_1775680233955.png',
            ],
            [
                'name'     => 'Chukwudi Eze',
                'position' => 'Software Development Graduate',
                'content'  => 'As someone switching careers from banking to tech, I was nervous about learning to code. KodeNest made the transition smooth with their hands-on approach. Within 6 months, I was building real applications and found my dream job.',
                'rating'   => 5,
                'status'   => true,
                'image'    => 'public:images/testimonials/chukwudi_eze_1775680255227.png',
            ],
            [
                'name'     => 'Fatima Abubakar',
                'position' => 'UI/UX Design Graduate',
                'content'  => 'The UI/UX program at KodeNest opened my eyes to the world of design. The practical projects and portfolio-building approach helped me secure an internship at a top design agency before I even graduated. The mentorship was excellent!',
                'rating'   => 5,
                'status'   => true,
                'image'    => 'public:images/testimonials/fatima_abubakar_1775680279239.png',
            ],
            [
                'name'     => 'Mrs. Blessing',
                'position' => 'Parent of Student',
                'content'  => 'I enrolled my son in the Coding for Kids program and watched him grow from playing video games to creating them! The instructors make learning fun and absolutely engaging. Highly recommend this incredible program for any parent out there.',
                'rating'   => 5,
                'status'   => true,
                'image'    => 'public:images/testimonials/mrs_blessing_1775680295102.png',
            ],
            [
                'name'     => 'Olumide Ibrahim',
                'position' => 'Cybersecurity Graduate',
                'content'  => 'The Cybersecurity course at KodeNest was exactly what I needed to advance my IT career. The curriculum is current, relevant, and taught by experienced industry professionals. I\'m now proudly working as a Senior Security Analyst.',
                'rating'   => 5,
                'status'   => true,
                'image'    => 'public:images/testimonials/olumide_ibrahim_1775680322819.png',
            ],
            [
                'name'     => 'Ngozi Grace',
                'position' => 'Office Productivity Graduate',
                'content'  => 'KodeNest\'s Office Productivity course boosted my efficiency at work tremendously. I learned advanced Excel tricks and productivity tools that saved me hours every week. My boss even noticed the improvement and gave me a big promotion!',
                'rating'   => 5,
                'status'   => true,
                'image'    => 'public:images/testimonials/ngozi_grace_1775680349582.png',
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(
                ['name' => $testimonial['name']],
                $testimonial
            );
        }

        // Blog Posts
        $posts = [
            [
                'title' => '5 Steps to Land Your First Tech Job in Nigeria',
                'slug' => '5-steps-to-land-your-first-tech-job-in-nigeria',
                'category' => 'Career Advice',
                'excerpt' => 'Breaking into tech can seem daunting, but with the right strategy, you can land your dream job faster than you think. Here\'s how to get started...',
                'content' => '',
                'published' => true,
                'published_at' => now()->subDays(3),
                'read_time' => 5,
            ],
            [
                'title' => 'Why Data Analytics is the Hottest Career Path in 2025',
                'slug' => 'why-data-analytics-is-the-hottest-career-path-in-2025',
                'category' => 'Tech Articles',
                'excerpt' => 'Data is the new oil, and companies are scrambling to hire analysts who can turn data into actionable insights. Learn why this field is exploding...',
                'content' => 'Full content here...',
                'published' => true,
                'published_at' => now()->subDays(5),
                'read_time' => 7,
            ],
            [
                'title' => 'New Cohort Starting February 2025 - Early Bird Discount!',
                'slug' => 'new-cohort-starting-february-2025',
                'category' => 'Announcements',
                'excerpt' => 'We\'re excited to announce our February 2025 cohort across all programs. Register early and save 20% on tuition fees. Limited spots available...',
                'content' => 'Full content here...',
                'published' => true,
                'published_at' => now()->subDays(8),
                'read_time' => 2,
            ],
            [
                'title' => 'Cybersecurity Basics: Protecting Your Digital Life',
                'slug' => 'cybersecurity-basics',
                'category' => 'Tech Articles',
                'excerpt' => 'Cyber threats are on the rise. Learn the essential security practices everyone should know to stay safe online, from password management to...',
                'content' => 'Full content here...',
                'published' => true,
                'published_at' => now()->subDays(10),
                'read_time' => 6,
            ],
            [
                'title' => 'Meet Ada: From Beginner to Full-Stack Developer in 6 Months',
                'slug' => 'meet-ada-from-beginner',
                'category' => 'Student Highlights',
                'excerpt' => 'Ada joined KodeNest with zero coding experience. Today, she\'s building web applications for clients. Read her inspiring journey and tips for beginners...',
                'content' => 'Full content here...',
                'published' => true,
                'published_at' => now()->subDays(14),
                'read_time' => 4,
            ],
            [
                'title' => 'UI/UX Design Trends to Watch in 2025',
                'slug' => 'ui-ux-design-trends-2025',
                'category' => 'Tech Articles',
                'excerpt' => 'The design landscape is constantly evolving. Discover the latest trends in UI/UX design that will dominate 2025, from AI-powered interfaces to...',
                'content' => 'Full content here...',
                'published' => true,
                'published_at' => now()->subDays(16),
                'read_time' => 8,
            ],
            [
                'title' => 'How to Build a Winning Tech Portfolio',
                'slug' => 'how-to-build-a-winning-tech-portfolio',
                'category' => 'Career Advice',
                'excerpt' => 'Your portfolio is your ticket to landing interviews. Learn how to showcase your skills and projects in a way that impresses recruiters and hiring managers...',
                'content' => 'Full content here...',
                'published' => true,
                'published_at' => now()->subDays(19),
                'read_time' => 6,
            ],
            [
                'title' => 'KodeNest Partners with Leading Tech Companies for Job Placements',
                'slug' => 'kodenest-partners-with-leading-tech-companies',
                'category' => 'Announcements',
                'excerpt' => 'Great news for our students! We\'ve partnered with 10 new tech companies to provide direct job placement opportunities for graduates. Learn more about...',
                'content' => 'Full content here...',
                'published' => true,
                'published_at' => now()->subDays(24),
                'read_time' => 3,
            ],
            [
                'title' => 'Python vs JavaScript: Which Should You Learn First?',
                'slug' => 'python-vs-javascript',
                'category' => 'Tech Articles',
                'excerpt' => 'Choosing your first programming language is crucial. We break down the pros and cons of Python and JavaScript to help you make the right decision...',
                'content' => 'Full content here...',
                'published' => true,
                'published_at' => now()->subDays(26),
                'read_time' => 7,
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::firstOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
