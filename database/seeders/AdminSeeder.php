<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employeeId = DB::table('employees')->insertGetId([
            'name' => 'John',
            'role' => 'Admin',
            'start_date' => Carbon::now()->subYears(3), 
        ]);

        DB::table('admins')->insert([
            'employee_id' => $employeeId,
            'email' => 'admin1@example.com',
            'password'=>Hash::make('admin1234'),
            'phone_number' => '1234567890',
        ]);
    }
}
