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
        $latest_student_for_school = Student::where('school_id', $school->id)->latest()->first();
        
        Student::factory()->create([
            'school_id' => $school->id,
            'order' => $latest_student_for_school?  $latest_student_for_school->order + 1 : 1
        ]);
    }
}
