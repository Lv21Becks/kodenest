<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. PROGRAMS IMAGE PATHS
        $programMap = [
            'data-analytics' => 'public:images/programs/da_program.png',
            'cybersecurity' => 'public:images/programs/cyber_program.png',
            'software-development' => 'public:images/programs/sw_program.png',
            'ui-ux-design' => 'public:images/programs/ui_program.png',
            'office-productivity' => 'public:images/programs/office_program.png',
            'coding-for-kids' => 'public:images/programs/kids_program.png'
        ];
        foreach ($programMap as $slug => $img) {
            \App\Models\Program::where('slug', $slug)
                ->where(function($q) {
                    $q->where('image_icon', 'NOT LIKE', 'public:%')
                      ->orWhereNull('image_icon');
                })
                ->update(['image_icon' => $img]);
        }

        // 2. BLOG POSTS IMAGE PATHS
        $blogMap = [
            'why-data-analytics-is-the-hottest-career-path-in-2025' => 'public:images/blog/blog_data.png',
            'new-cohort-starting-february-2025' => 'public:images/blog/blog_cohort.png',
            'how-to-build-a-winning-tech-portfolio' => 'public:images/blog/blog_job.png',
        ];
        foreach ($blogMap as $slug => $img) {
            \App\Models\BlogPost::where('slug', $slug)
                ->where(function($q) {
                    $q->where('featured_image', 'NOT LIKE', 'public:%')
                      ->orWhereNull('featured_image');
                })
                ->update(['featured_image' => $img]);
        }

        // 3. TESTIMONIALS PATHS & 6-LINE LENGTH FIXES (Expanded slightly to hit exactly 6 lines of text wrap)
        $testimonialsMap = [
            'Adaeze Okoro' => [
                'image' => 'public:images/testimonial-1.png',
                'content' => 'KodeNest completely changed my life. I came in with zero tech experience and left with the skills to land my first job as a Data Analyst. The instructors truly care about your success. I wholeheartedly recommend this program!'
            ],
            'Chukwudi Eze' => [
                'image' => 'public:images/testimonial-2.png',
                'content' => 'As someone switching careers from banking to tech, I was nervous about learning to code. KodeNest made the transition smooth with their hands-on approach. Within 6 months, I was building real applications and found my dream job.'
            ],
            'Fatima Abubakar' => [
                'image' => 'public:images/testimonial-3.png',
                'content' => 'The UI/UX program at KodeNest opened my eyes to the world of design. The practical projects and portfolio-building approach helped me secure an internship at a top design agency before I even graduated. The mentorship was excellent!'
            ],
            'Mrs. Blessing' => [
                'image' => 'public:images/testimonial-4.png',
                'content' => 'I enrolled my son in the Coding for Kids program and watched him grow from playing video games to creating them! The instructors make learning fun and absolutely engaging. Highly recommend this incredible program for any parent out there.'
            ],
            'Olumide Ibrahim' => [
                'image' => 'public:images/testimonial-5.png',
                'content' => 'The Cybersecurity course at KodeNest was exactly what I needed to advance my IT career. The curriculum is current, relevant, and taught by experienced industry professionals. I’m now proudly working as a Senior Security Analyst.'
            ],
            'Ngozi Grace' => [
                'image' => 'public:images/testimonial-6.png',
                'content' => 'KodeNest\'s Office Productivity course boosted my efficiency at work tremendously. I learned advanced Excel tricks and productivity tools that saved me hours every week. My boss even noticed the improvement and gave me a big promotion!'
            ],
        ];

        foreach ($testimonialsMap as $name => $data) {
            \App\Models\Testimonial::where('name', $name)->update([
                'image' => $data['image'],
                'content' => $data['content']
            ]);
        }
    }

    public function down(): void
    {
        // Reversals would be handled by running standard fresh seeders if needed.
    }
};
