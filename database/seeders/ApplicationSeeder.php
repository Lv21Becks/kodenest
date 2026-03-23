<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\Enrollment;
use App\Models\Invoice;
use App\Models\Student;
use App\Models\Program;
use Illuminate\Support\Facades\Schema;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $programs = Program::all();
        if ($programs->isEmpty()) return;

        // Clear all test data first
        Schema::disableForeignKeyConstraints();
        Enrollment::truncate();
        Invoice::truncate();
        Student::truncate();
        Application::truncate();
        Applicant::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            // Data Analytics
            ['first_name' => 'Amara',       'last_name' => 'Okonkwo',    'email' => 'amara.okonkwo@gmail.com',    'phone' => '08031234501', 'program' => 'data-analytics',       'mode' => 'online',   'status' => 'pending', 'address' => 'Ikeja, Lagos'],
            ['first_name' => 'Chike',       'last_name' => 'Eze',        'email' => 'chike.eze@yahoo.com',        'phone' => '08031234502', 'program' => 'data-analytics',       'mode' => 'physical', 'status' => 'pending', 'address' => 'Enugu, Enugu State'],
            
            // Software Development
            ['first_name' => 'Fatima',      'last_name' => 'Bello',      'email' => 'fatima.bello@gmail.com',     'phone' => '08031234505', 'program' => 'software-development', 'mode' => 'online',   'status' => 'pending', 'address' => 'Kano, Kano State'],
            ['first_name' => 'Seun',        'last_name' => 'Afolabi',    'email' => 'seun.afolabi@outlook.com',   'phone' => '08031234506', 'program' => 'software-development', 'mode' => 'physical', 'status' => 'pending', 'address' => 'Ibadan, Oyo State'],
            
            // Cybersecurity
            ['first_name' => 'Tunde',       'last_name' => 'Kasali',     'email' => 'tunde.kasali@gmail.com',     'phone' => '08031234509', 'program' => 'cybersecurity',        'mode' => 'online',   'status' => 'pending', 'address' => 'Victoria Island, Lagos'],
            
            // UI/UX Design
            ['first_name' => 'Chiamaka',    'last_name' => 'Orji',       'email' => 'chiamaka.orji@gmail.com',    'phone' => '08031234512', 'program' => 'ui-ux-design',         'mode' => 'online',   'status' => 'pending', 'address' => 'Lekki, Lagos'],
            
            // Mix of Approved/Rejected for filter testing
            ['first_name' => 'John',        'last_name' => 'Doe',        'email' => 'john.doe@example.com',       'phone' => '08011112233', 'program' => 'software-development', 'mode' => 'online',   'status' => 'approved', 'address' => 'Lagos City'],
            ['first_name' => 'Jane',        'last_name' => 'Smith',      'email' => 'jane.smith@example.com',     'phone' => '08044445566', 'program' => 'data-analytics',       'mode' => 'physical', 'status' => 'rejected', 'address' => 'Abuja', 'reason' => 'Incomplete documentation'],

            // DUPLICATE/HISTORY TEST: Amara applies for something else too
            ['first_name' => 'Amara',       'last_name' => 'Okonkwo',    'email' => 'amara.okonkwo@gmail.com',    'phone' => '08031234501', 'program' => 'ui-ux-design',       'mode' => 'online',   'status' => 'approved', 'address' => 'Ikeja, Lagos'],
        ];

        foreach ($data as $item) {
            // Find or Create Applicant
            $applicant = Applicant::firstOrCreate(
                ['email' => $item['email']],
                [
                    'first_name' => $item['first_name'],
                    'last_name'  => $item['last_name'],
                    'phone'      => $item['phone'],
                    'address'    => $item['address'],
                    'status'     => 'active'
                ]
            );

            // Create Application
            Application::create([
                'applicant_id'     => $applicant->id,
                'program_id'       => $item['program'],
                'learning_mode'    => $item['mode'],
                'status'           => $item['status'],
                'rejection_reason' => $item['reason'] ?? null,
                'notes'            => 'Test application data seeded.',
            ]);
        }
    }
}
