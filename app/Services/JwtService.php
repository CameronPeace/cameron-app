<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtService
{
    /**
     * Generate a new Jwt.
     *
     * @return string
     */
    public function generate()
    {
        $user = Auth::user();
        $token = JWTAuth::fromUser($user);
        return $token;
    }

    /**
     * Verify provided Jwt.
     *
     * @param string $token
     *
     * @return boolean
     */
    public function verify($token)
    {
        try {
            $payload = JWTAuth::decode($token);
            return true;
        } catch (JWTException $e) {
            return false;
        }
    }

    /**
     * Refresh Jwt.
     *
     * @param string $token
     *
     * @return void
     */
    public function refresh($token)
    {
        try {
            $refreshedToken = JWTAuth::refresh($token);
            return $refreshedToken;
        } catch (JWTException $e) {
            return false;
        }
    }
}
