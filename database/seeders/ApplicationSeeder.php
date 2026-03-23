<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\Program;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $programs = Program::all();
        if ($programs->isEmpty())
            return;

        $data = [
            [
                'first_name' => 'Amara',
                'last_name' => 'Okonkwo',
                'email' => 'amara.okonkwo@gmail.com',
                'phone' => '08031234501',
                'program' => 'data-analytics',
                'mode' => 'online',
                'status' => 'pending',
                'address' => 'Ikeja, Lagos',
            ],
            [
                'first_name' => 'Chike',
                'last_name' => 'Eze',
                'email' => 'chike.eze@yahoo.com',
                'phone' => '08031234502',
                'program' => 'data-analytics',
                'mode' => 'physical',
                'status' => 'pending',
                'address' => 'Enugu, Enugu State',
            ],
            [
                'first_name' => 'Fatima',
                'last_name' => 'Bello',
                'email' => 'fatima.bello@gmail.com',
                'phone' => '08031234505',
                'program' => 'software-development',
                'mode' => 'online',
                'status' => 'pending',
                'address' => 'Kano, Kano State',
            ],
            [
                'first_name' => 'Seun',
                'last_name' => 'Afolabi',
                'email' => 'seun.afolabi@outlook.com',
                'phone' => '08031234506',
                'program' => 'software-development',
                'mode' => 'physical',
                'status' => 'pending',
                'address' => 'Ibadan, Oyo State',
            ],
            [
                'first_name' => 'Tunde',
                'last_name' => 'Kasali',
                'email' => 'tunde.kasali@gmail.com',
                'phone' => '08031234509',
                'program' => 'cybersecurity',
                'mode' => 'online',
                'status' => 'pending',
                'address' => 'Victoria Island, Lagos',
            ],
            [
                'first_name' => 'Chiamaka',
                'last_name' => 'Orji',
                'email' => 'chiamaka.orji@gmail.com',
                'phone' => '08031234512',
                'program' => 'ui-ux-design',
                'mode' => 'online',
                'status' => 'pending',
                'address' => 'Lekki, Lagos',
            ],
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@example.com',
                'phone' => '08011112233',
                'program' => 'software-development',
                'mode' => 'online',
                'status' => 'approved',
                'address' => 'Lagos City',
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '08044445566',
                'program' => 'data-analytics',
                'mode' => 'physical',
                'status' => 'rejected',
                'address' => 'Abuja',
                'reason' => 'Incomplete documentation',
            ],
            [
                'first_name' => 'Amara',
                'last_name' => 'Okonkwo',
                'email' => 'amara.okonkwo@gmail.com',
                'phone' => '08031234501',
                'program' => 'ui-ux-design',
                'mode' => 'online',
                'status' => 'approved',
                'address' => 'Ikeja, Lagos',
            ],
        ];

        foreach ($data as $item) {
            $applicant = Applicant::firstOrCreate(
                ['email' => $item['email']],
                [
                    'first_name' => $item['first_name'],
                    'last_name' => $item['last_name'],
                    'phone' => $item['phone'],
                    'address' => $item['address'],
                    'status' => 'active',
                ]
            );

            Application::firstOrCreate(
                [
                    'applicant_id' => $applicant->id,
                    'program_id' => $item['program'],
                ],
                [
                    'learning_mode' => $item['mode'],
                    'status' => $item['status'],
                    'rejection_reason' => $item['reason'] ?? null,
                    'notes' => 'Test application data seeded.',
                ]
            );
        }
    }
}