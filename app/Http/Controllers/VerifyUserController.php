<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerifyUserController extends Controller
{
    public function __invoke(int $id, string $hash)
    {
        $user = User::query()
            ->find($id);

        if (! hash_equals((string) $user->getKey(), (string) $id)) {
            return false;
        }

        if (! hash_equals(sha1($user->getEmailForVerification()), $hash)) {
            return false;
        }

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            event(new Verified($user));
        }
    }
}
