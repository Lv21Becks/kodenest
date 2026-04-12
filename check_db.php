<?php
echo "=== TESTIMONIALS ===\n";
foreach (App\Models\Testimonial::all() as $t) {
    echo $t->id . " | " . $t->name . " | " . ($t->image ?? 'NULL') . "\n";
}
echo "\n=== PROGRAMS ===\n";
foreach (App\Models\Program::all() as $p) {
    echo $p->id . " | " . $p->title . " | " . ($p->image_icon ?? 'NULL') . "\n";
}
