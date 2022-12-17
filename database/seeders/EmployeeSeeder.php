<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = Employee::factory(100)->create();
        $limit = 5;
        $count = 0;
        $count_all = 0;

        foreach ($employees as $employee) {
            $count_all++;
            if($count < $limit && $count_all < count($employees)) {
                $employee->update(['employee_id' => $employee->id+1]);
                $count++;
            } else {
                $count = 0;
            }
        }
    }
}
