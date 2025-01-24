<?php

use App\Models\Team;
use App\Models\User;

if (! function_exists('create_default_user_teacher_team')) {
    function create_default_user_teacher_team()
    {
        if (User::where('email', env('DEFAULT_TEACHER_EMAIL'))->exists()) {
            return;
        }

        $user = new User;
        $user->name = env('DEFAULT_TEACHER_NAME', 'Teacher');
        $user->email = env('DEFAULT_TEACHER_EMAIL', 'a@gmail.com');
        $user->password = bcrypt(env('DEFAULT_TEACHER_PASSWORD'));
        $user->save();

        $team = new Team;
        $team->name = 'Teacher';
        $team->user_id = $user->id;
        $team->personal_team = false;
        $team->save();

        $user->switchTeam($team);
    }
}

if (! function_exists('create_default_user_student_team')) {
    function create_default_user_student_team()
    {
        if (User::where('email', env('DEFAULT_STUDENT_EMAIL'))->exists()) {
            return;
        }

        $user = new User;
        $user->name = env('DEFAULT_STUDENT_NAME');
        $user->email = env('DEFAULT_STUDENT_EMAIL');
        $user->password = bcrypt(env('DEFAULT_STUDENT_PASSWORD'));
        $user->save();

        $team = new Team;
        $team->name = 'Student';
        $team->user_id = $user->id;
        $team->personal_team = false;
        $team->save();

        $user->switchTeam($team);
    }
}
