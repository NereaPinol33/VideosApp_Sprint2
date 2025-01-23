<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use function App\Helpers\create_default_user_teacher_team;
use function App\Helpers\create_default_user_student_team;

class HelpersTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_default_user_teacher_team()
    {
        create_default_user_teacher_team();
        $this->assertDatabaseHas('users', [
            'name' => env('DEFAULT_TEACHER_NAME'),
            'email' => env('DEFAULT_TEACHER_EMAIL'),
        ]);

        $this->assertDatabaseHas('teams', [
            'name' => 'Teacher',
        ]);

        $user = User::where('email', env('DEFAULT_TEACHER_EMAIL'))->first();
        $this->assertTrue(Hash::check(env('DEFAULT_TEACHER_PASSWORD'), $user->password));

        $team = Team::where('name', 'Teacher')->first();
        $this->assertEquals($team->id, $user->currentTeam->id);
    }

    public function test_create_default_user_student_team()
    {
        create_default_user_student_team();
        $this->assertDatabaseHas('users', [
            'name' => env('DEFAULT_STUDENT_NAME'),
            'email' => env('DEFAULT_STUDENT_EMAIL'),
        ]);

        $this->assertDatabaseHas('teams', [
            'name' => 'Student',
        ]);

        $user = User::where('email', env('DEFAULT_STUDENT_EMAIL'))->first();
        $this->assertTrue(Hash::check(env('DEFAULT_STUDENT_PASSWORD'), $user->password));

        $team = Team::where('name', 'Student')->first();
        $this->assertEquals($team->id, $user->currentTeam->id);
    }
}
