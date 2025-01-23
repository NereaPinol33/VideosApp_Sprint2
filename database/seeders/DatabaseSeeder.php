<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function App\Helpers\create_default_teacher_video;
use function App\Helpers\create_default_user_student_team;
use function App\Helpers\create_default_user_teacher_team;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        echo "Creating teacher user and team...\n";
        create_default_user_teacher_team();

        echo "Creating student user and team...\n";
        create_default_user_student_team();

        echo "Creating teacher video video...\n";
        create_default_teacher_video();
    }
}
