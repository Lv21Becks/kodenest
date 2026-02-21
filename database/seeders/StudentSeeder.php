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

        // Payment Options
        $paymentStatuses = ['paid', 'pending', 'partial', 'due'];

        // Methods
        $learningModes = ['online', 'physical', 'hybrid'];

        // Create 25 Students
        for ($i = 0; $i < 25; $i++) {
            $status = $faker->randomElement($statuses);
            $paymentStatus = $faker->randomElement($paymentStatuses);

            // Logic: Graduated/Completed usually have high progress
            $progress = 0;
            if ($status == 'graduated' || $status == 'completed') {
                $progress = 100;
                $paymentStatus = 'paid'; // Force paid if graduated
            } elseif ($status == 'dropped') {
                $progress = $faker->numberBetween(0, 50);
            } else {
                $progress = $faker->numberBetween(10, 95);
            }

            // Calculate Amount Paid
            $programSlug = $faker->randomElement($programSlugs);
            $program = $programs->where('slug', $programSlug)->first();
            $price = $program ? $program->price : 150000; // Default price if not found

            $amountPaid = 0;
            if ($paymentStatus == 'paid') {
                $amountPaid = $price;
            } elseif ($paymentStatus == 'partial') {
                $amountPaid = $price * $faker->randomFloat(2, 0.1, 0.9); // Random partial
            } else {
                $amountPaid = 0;
            }

            // Generate Ughelli Address
            $street = $faker->randomElement($ughelliStreets);
            $houseNumber = $faker->numberBetween(1, 150);
            $address = "$houseNumber, $street, Ughelli, Delta State";

            Student::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'program' => $programSlug,
                'learning_mode' => $faker->randomElement($learningModes),
                'payment_status' => $paymentStatus,
                'status' => $status,
                'progress' => $progress,
                'amount_paid' => $amountPaid,
                'address' => $address,
                'notes' => $faker->optional(0.3)->sentence, // 30% chance of notes
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}
