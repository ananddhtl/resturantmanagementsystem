<?php

namespace App\Helpers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Laravel\Passport\PersonalAccessTokenResult;

class UserHelpers
{
    public static function getAuthenticatedUser()
    {
        return auth('api')->user();
    }

    public static function phoneExists(string $phone): bool
    {
        return User::findByPhone($phone)->exists();
    }

    public static function findOrfail(string $id): User
    {
        return User::find($id) ?? self::throwException("User not found");
    }

    public static function createUser(array $data): User
    {
        $user = User::create($data);
        $user->assignRole('Customer');

        return self::findOrfail($user->id);
    }

    public static function createAndSaveAccessToken(User $user, string $name = "Personal Access Token V1"): PersonalAccessTokenResult
    {
        $tokenResult = $user->createToken($name);
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addMonths(3);
        $token->save();

        return $tokenResult;
    }

    public static function updateUser(string $id, array $data): User
    {
        $user = self::findOrfail($id);
        $user->update($data);

        return $user;
    }

    private static function throwException(string $message = ""): Exception
    {
        throw new Exception($message);
    }
}
