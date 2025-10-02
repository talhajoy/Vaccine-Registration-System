<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\VaccineCenter;
use App\Models\Vaccine;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@vaccine.com',
            'phone' => '+1234567890',
            'date_of_birth' => '1990-01-01',
            'national_id' => 'ADMIN001',
            'address' => 'Admin Address',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // Create vaccine centers
        $centers = [
            ['name' => 'Dhaka Medical College Hospital', 'address' => 'Secretariat Rd, Dhaka 1000, Bangladesh', 'city' => 'Dhaka', 'phone' => '+880-2-9555342'],
            ['name' => 'Sir Salimullah Medical College & Mitford Hospital', 'address' => 'Mitford Rd, Dhaka 1100, Bangladesh', 'city' => 'Dhaka', 'phone' => '+880-2-9560912'],
            ['name' => 'Kurmitola General Hospital', 'address' => 'Tongi Diversion Rd, Dhaka Cantonment, Dhaka, Bangladesh', 'city' => 'Dhaka', 'phone' => '+880-2-9885240'],
        ];

        foreach ($centers as $center) {
            VaccineCenter::create($center);
        }

        // Create vaccines
        $vaccines = [
            ['name' => 'Pfizer-BioNTech', 'manufacturer' => 'Pfizer', 'description' => 'mRNA vaccine'],
            ['name' => 'Moderna', 'manufacturer' => 'Moderna', 'description' => 'mRNA vaccine'],
            ['name' => 'Johnson & Johnson', 'manufacturer' => 'J&J', 'description' => 'Viral vector vaccine', 'doses_required' => 1],
        ];

        foreach ($vaccines as $vaccine) {
            Vaccine::create($vaccine);
        }
    }
}
