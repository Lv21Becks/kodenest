<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\App\Models\Program::where('slug', 'software-development')->update(['image_icon' => 'programs/sw_program.png']);
\App\Models\Program::where('slug', 'cybersecurity')->update(['image_icon' => 'programs/cyber_program.png']);

\App\Models\BlogPost::where('slug', '5-steps-to-land-your-first-tech-job-in-nigeria')->update(['featured_image' => 'blog/blog_job.png']);
\App\Models\BlogPost::where('slug', 'why-data-analytics-is-the-hottest-career-path-in-2025')->update(['featured_image' => 'blog/blog_data.png']);
\App\Models\BlogPost::where('slug', 'new-cohort-starting-february-2025')->update(['featured_image' => 'blog/blog_cohort.png']);

echo "Database successfully updated with correct slugs!";
