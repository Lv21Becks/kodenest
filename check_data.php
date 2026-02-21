<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$student = \App\Models\Student::first();
echo "First Student:\n";
print_r($student->toArray());

$count = \App\Models\Student::where('amount_paid', '>', 0)->count();
echo "\nStudents with amount_paid > 0: $count\n";
