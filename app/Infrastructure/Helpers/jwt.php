<?php

use Firebase\JWT\JWT;
use Illuminate\Validation\UnauthorizedException;

if (!function_exists('jwtEncode')) {
    /**
     * generate jwt token
     *
     * @param $user
     *
     * @return string
     */
    function jwtEncode($user): string
    {
        $payload = [
            "sub" => $user,
            "iat" => time(),
            "exp" => time() + (jwtAccessTokenTtl() * 3600),
        ];
        return JWT::encode($payload, jwtKey());
    }
}

if (!function_exists('jwtDecode')) {
    /**
     * decode jwt token
     *
     * @param $token
     *
     * @return object
     */
    function jwtDecode($token): object
    {
        $decoded = JWT::decode($token, jwtKey(), array('HS256'));
        if (!$decoded || $decoded->exp < time()) throw new UnauthorizedException();
        return $decoded;
    }
}

if (!function_exists('jwtRefreshTokenExpiresAt')) {
    /**
     * return jwt algorithm
     *
     * @return string
     */
    function jwtRefreshTokenExpiresAt(): string
    {
        return \Carbon\Carbon::now()->addDays(config('jwt.jwt_refresh_token_ttl'));
    }
}

if (!function_exists('jwtAlg')) {
    /**
     * return jwt algorithm
     *
     * @return string
     */
    function jwtAlg(): string
    {
        return config('jwt.jwt_alg');
    }
}

if (!function_exists('jwt_key')) {
    /**
     * return jwt key as string
     *
     * @return string
     */
    function jwtKey(): string
    {
        return config('jwt.jwt_key');
    }
}

if (!function_exists('jwtAccessTokenTtl')) {
    /**
     * return jwt access token ttl
     *
     * @return string
     */
    function jwtAccessTokenTtl(): string
    {
        return config('jwt.jwt_access_token_ttl');
    }
}

if (!function_exists('jwtRefreshTokenTtl')) {
    /**
     * return jwt refresh token ttl
     *
     * @return string
     */
    function jwtRefreshTokenTtl(): string
    {
        return config('jwt.jwt_refresh_token_ttl');
    }
}
