<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\Student;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        School::factory()->create();
    }
}
