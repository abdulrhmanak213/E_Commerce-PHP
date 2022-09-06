<?php

class jwtToken
{
    public function create($email,$password): string
    {
        $headers = array('alg'=>'HS256','typ'=>'JWT');
        $payload = array('email'=>$email,'password'=>$password,'exp'=>(time() + 86400));
        $secret = 'secret';
        $headers_encoded = $this->base64url_encode(json_encode($headers));
        $payload_encoded = $this->base64url_encode(json_encode($payload));
        $signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $secret, true);
        $signature_encoded = $this->base64url_encode($signature);
        $jwt = "$headers_encoded.$payload_encoded.$signature_encoded";
        return $jwt;
    }

    function is_jwt_valid($jwt, $secret = 'secret'): bool
    {
        // split the jwt
        $tokenParts = explode('.', $jwt);
        $header = base64_decode($tokenParts[0]);
         $payload = base64_decode($tokenParts[1]);
         $signature_provided = $tokenParts[2];

        // check the expiration time - note this will cause an error if there is no 'exp' claim in the jwt
          $expiration = json_decode($payload)->exp;
         $is_token_expired = ($expiration - time()) < 0;
        // build a signature based on the header and payload using the secret
        $base64_url_header = $this->base64url_encode($header);
        $base64_url_payload = $this->base64url_encode($payload);
        $signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, $secret, true);
        $base64_url_signature = $this->base64url_encode($signature);

        // verify it matches the signature provided in the jwt
        $is_signature_valid = ($base64_url_signature === $signature_provided);

        if ($is_token_expired || !$is_signature_valid) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    function base64url_encode($str) {
        return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
    }

    function getToken(){
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        $token = str_replace("Bearer","", $headers);
        return  trim($token);
    }
}