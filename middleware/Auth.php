<?php

class auth
{
    public function handle(): bool
    {
        $jwt = new jwtToken();
        $token = $jwt->getToken();
        return $jwt->is_jwt_valid($token);
    }
}