<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Program;
use App\Models\Enrollment;
use App\Models\Invoice;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Skip if students already exist
        if (Student::count() > 0)
            return;

        $faker = Faker::create('en_NG');

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
            'Uduere Road',
        ];

        $programs = Program::all();
        $programSlugs = $programs->pluck('slug')->toArray();

        if (empty($programSlugs)) {
            $programSlugs = [
                'data-analytics',
                'software-development',
                'cybersecurity',
                'ui-ux-design',
                'office-productivity',
                'coding-for-kids',
            ];
        }

        $statuses = ['active', 'at_risk', 'completed', 'dropped', 'graduated', 'pending'];
        $paymentStatuses = ['paid', 'pending', 'partial', 'due'];

        for ($i = 0; $i < 25; $i++) {
            $street = $faker->randomElement($ughelliStreets);
            $houseNumber = $faker->numberBetween(1, 150);
            $address = "$houseNumber, $street, Ughelli, Delta State";

            $student = Student::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'address' => $address,
                'notes' => $faker->optional(0.3)->sentence,
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'updated_at' => now(),
            ]);

            $programSlug = $faker->randomElement($programSlugs);
            $program = $programs->firstWhere('slug', $programSlug) ?? $programs->first();
            $status = $faker->randomElement($statuses);

            $progress = match (true) {
                in_array($status, ['graduated', 'completed']) => 100,
                $status === 'dropped' => $faker->numberBetween(0, 50),
                default => $faker->numberBetween(10, 95),
            };

            $enrollmentStatus = match (true) {
                in_array($status, ['completed', 'graduated']) => 'completed',
                $status === 'dropped' => 'dropped',
                default => 'active',
            };

            Enrollment::create([
                'student_id' => $student->id,
                'program_id' => $programSlug,
                'status' => $enrollmentStatus,
                'progress' => $progress,
                'enrollment_date' => $student->created_at,
            ]);

            $price = $program ? $program->price : 150000;
            $paymentStatus = $faker->randomElement($paymentStatuses);
            $amountPaid = 0;

            if ($paymentStatus === 'paid' || $progress === 100) {
                $paymentStatus = 'paid';
                $amountPaid = $price;
            } elseif ($paymentStatus === 'partial') {
                $amountPaid = $price * $faker->randomFloat(2, 0.1, 0.9);
            }

            Invoice::create([
                'student_id' => $student->id,
                'total_amount' => $price,
                'amount_paid' => $amountPaid,
                'balance' => $price - $amountPaid,
                'due_date' => $student->created_at->addDays(30),
                'status' => $paymentStatus === 'paid' ? 'paid' : ($amountPaid > 0 ? 'partial' : 'unpaid'),
            ]);
        }
    }
}