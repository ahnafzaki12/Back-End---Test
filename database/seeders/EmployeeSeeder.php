<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $divisions = Division::all();

        if ($divisions->isEmpty()) return;

        Employee::updateOrCreate([
            'name' => 'Ahnaf Zaki',
            'phone' => '081234567890',
            'division_id' => $divisions[0]->id, 
            'position' => 'Senior Developer',
            'image' => null,
        ]);

        Employee::updateOrCreate([
            'name' => 'Zaki Ahnaf',
            'phone' => '089876543210',
            'division_id' => $divisions[1]->id,
            'position' => 'Quality Assurance',
            'image' => null,
        ]);
    }
}