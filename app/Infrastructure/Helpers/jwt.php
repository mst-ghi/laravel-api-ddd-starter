<?php

use Firebase\JWT\JWT;

if (!function_exists('jwt_encode')) {
    /**
     * generate jwt token
     *
     * @param $user
     *
     * @return string
     */
    function jwt_encode($user): string
    {
        $payload = [
            "sub" => $user,
            "iat" => time(),
            "exp" => time() + (jwt_access_token_ttl() * 3600),
        ];
        return JWT::encode($payload, jwt_key());
    }
}

if (!function_exists('jwt_decode')) {
    /**
     * decode jwt token
     *
     * @param $token
     *
     * @return object
     */
    function jwt_decode($token): object
    {
        $decoded = JWT::decode($token, jwt_key(), array('HS256'));
        if (!$decoded || $decoded->exp < time()) throw new \Illuminate\Validation\UnauthorizedException();
        return $decoded;
    }
}

if (!function_exists('jwt_refresh_token_expires_at')) {
    /**
     * return jwt algorithm
     *
     * @return string
     */
    function jwt_refresh_token_expires_at(): string
    {
        return \Carbon\Carbon::now()->addDays(config('jwt.jwt_refresh_token_ttl'));
    }
}

if (!function_exists('jwt_alg')) {
    /**
     * return jwt algorithm
     *
     * @return string
     */
    function jwt_alg(): string
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
    function jwt_key(): string
    {
        return config('jwt.jwt_key');
    }
}

if (!function_exists('jwt_access_token_ttl')) {
    /**
     * return jwt access token ttl
     *
     * @return string
     */
    function jwt_access_token_ttl(): string
    {
        return config('jwt.jwt_access_token_ttl');
    }
}

if (!function_exists('jwt_refresh_token_ttl')) {
    /**
     * return jwt refresh token ttl
     *
     * @return string
     */
    function jwt_refresh_token_ttl(): string
    {
        return config('jwt.jwt_refresh_token_ttl');
    }
}
