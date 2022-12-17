<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list_position = [
            'Unknown',
            'IT technician',
            'Support specialist',
            'Quality assurance tester',
            'Web developer',
            'IT security specialist',
            'Computer programmer',
            'Systems analyst',
            'Network engineer',
            'Software engineer',
            'User experience designer',
            'Database administrator',
            'Data scientist',
            'Computer scientist',
            'IT director',
            'Applications engineer',
            'Cloud system engineer',
            'Data quality manager',
            'Help desk technician',
            'IT coordinator',
            'Management information systems director',
            'Web administrator',
        ];

        foreach($list_position as $position) {
            $created_at = fake()->dateTimeInInterval('-1 month', '+3 weeks')->format('d.m.Y');
            Position::create([
                'title' => $position,
                'admin_created_id' => User::inRandomOrder()->first()->id,
                'admin_updated_id' => User::inRandomOrder()->first()->id,
                'created_at' => $created_at,
                'updated_at' => fake()->dateTimeBetween($created_at)->format('d.m.Y'),
            ]);
        }
    }
}
