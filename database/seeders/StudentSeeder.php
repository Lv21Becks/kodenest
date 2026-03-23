<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Program;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Use Nigerian Locale
        $faker = Faker::create('en_NG');

        // Ughelli Streets
        $ughelliStreets = [
            'Isoko Road',
            'Market Road',
            'Post Office Road',
            'OtovwievWiery Street',
            'Afiesere Road',
            'Ekuigbo Road',
            'Ughelli-Patani Road',
            'Kano Street',
            'Uppert Igun Street',
            'Olori Road',
            'First Marine Gate',
            'Second Marine Gate',
            'General Hospital Road',
            'School Road',
            'Oharisi Street',
            'Uduere Road'
        ];

        // Get Program Slugs
        $programs = Program::all();
        $programSlugs = $programs->pluck('slug')->toArray();

        if (empty($programSlugs)) {
            // Default fallbacks if no programs exist yet
            $programSlugs = ['data-analytics', 'software-dev', 'cybersecurity', 'uiux', 'office', 'kids'];
        }

        // Status Options
        $statuses = ['active', 'at_risk', 'completed', 'dropped', 'graduated', 'pending'];

        $paymentStatuses = ['paid', 'pending', 'partial', 'due'];
        $learningModes = ['online', 'physical', 'hybrid'];

        // Create 25 Students
        for ($i = 0; $i < 25; $i++) {
            // Generate Ughelli Address
            $street = $faker->randomElement($ughelliStreets);
            $houseNumber = $faker->numberBetween(1, 150);
            $address = "$houseNumber, $street, Ughelli, Delta State";

            $student = Student::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'address' => $address,
                'notes' => $faker->optional(0.3)->sentence, // 30% chance of notes
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'updated_at' => now(),
            ]);

            // Add an enrollment
            $programSlug = $faker->randomElement($programSlugs);
            $program = current($programs->filter(fn($p) => $p->slug === $programSlug)->all()) ?: $programs->first();
            $status = $faker->randomElement($statuses);
            
            $progress = 0;
            if ($status == 'graduated' || $status == 'completed') {
                $progress = 100;
            } elseif ($status == 'dropped') {
                $progress = $faker->numberBetween(0, 50);
            } else {
                $progress = $faker->numberBetween(10, 95);
            }

            $enrollment = \App\Models\Enrollment::create([
                'student_id' => $student->id,
                'program_id' => $programSlug,
                'status' => $status == 'active' ? 'active' : ($status == 'dropped' ? 'dropped' : ($status == 'completed' || $status == 'graduated' ? 'completed' : 'active')),
                'progress' => $progress,
                'enrollment_date' => $student->created_at,
            ]);

            // Add an Invoice since payments got moved.
            $paymentStatus = $faker->randomElement($paymentStatuses);
            $price = $program ? $program->price : 150000;
            
            $amountPaid = 0;
            if ($paymentStatus == 'paid' || $progress == 100) {
                $paymentStatus = 'paid';
                $amountPaid = $price;
            } elseif ($paymentStatus == 'partial') {
                $amountPaid = $price * $faker->randomFloat(2, 0.1, 0.9);
            }

            \App\Models\Invoice::create([
                'student_id' => $student->id,
                'total_amount' => $price,
                'amount_paid' => $amountPaid,
                'balance' => $price - $amountPaid,
                'due_date' => $student->created_at->addDays(30),
                'status' => $paymentStatus == 'paid' ? 'paid' : ($amountPaid > 0 ? 'partial' : 'unpaid'),
            ]);
        }
    }
}
