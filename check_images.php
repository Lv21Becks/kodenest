<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Programs ---\n";
foreach(\App\Models\Program::all() as $p) {
    echo $p->title . ' (' . $p->slug . '): ' . $p->image_icon . "\n";
}

echo "--- Blog Posts ---\n";
foreach(\App\Models\BlogPost::all() as $p) {
    echo $p->title . ' (' . $p->slug . '): ' . $p->featured_image . "\n";
}
