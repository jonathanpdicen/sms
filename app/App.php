<?php

namespace App;

use App\User;

class App
{
    public static function scriptVariables(): array
    {
        /** @var User $user */
        $user = auth()->user();

        return [
            'state' => [
                'user' => $user,
                'csrf' => csrf_token()
            ]
        ];
    }
}
