<?php

// Programs
$programMap = [
    'data-analytics' => 'public:images/programs/da_program.png',
    'cybersecurity' => 'public:images/programs/cyber_program.png',
    'software-development' => 'public:images/programs/sw_program.png',
    'ui-ux-design' => 'public:images/programs/ui_program.png',
    'office-productivity' => 'public:images/programs/office_program.png',
    'coding-for-kids' => 'public:images/programs/kids_program.png'
];

foreach ($programMap as $slug => $img) {
    App\Models\Program::where('slug', $slug)->update(['image_icon' => $img]);
}
echo "Programs updated.\n";

// Blogs - there's 3 defaults in storage right now: blog_cohort.png, blog_data.png, blog_job.png
$blogMap = [
    'why-data-analytics-is-the-hottest-career-path-in-2025' => 'public:images/blog/blog_data.png',
    'new-cohort-starting-february-2025' => 'public:images/blog/blog_cohort.png',
    'how-to-build-a-winning-tech-portfolio' => 'public:images/blog/blog_job.png',
];

foreach ($blogMap as $slug => $img) {
    App\Models\BlogPost::where('slug', $slug)->update(['featured_image' => $img]);
}
echo "Blogs updated.\n";
