<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { 
        $school = School::inRandomOrder()->first();
        Student::factory()->create([
            'school_id' => $school->id
        ]);
    }
}
