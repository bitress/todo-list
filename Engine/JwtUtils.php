<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class JwtUtils
{


    public $jwt;

    public function __construct()
    {

    }

    public function validate(): bool
    {


        $jwt = $this->jwt ?? "";

        if ($jwt){
            try {
                $key = JWT_CONFIG['PUBLIC_KEY'];
                $headers = new stdClass();


                $decoded = JWT::decode(
                    $this->jwt,
                    new Key($key, 'RS256'),
                    $headers
                );

                // set response code
                http_response_code(200);

                // show user details
                echo json_encode(array(
                    "success" => true,
                    "message" => "Access granted.",
                    "data" => $decoded->data
                ));

                return true;


            } catch (Exception $exception){

                // set response code
                http_response_code(401);

                // tell the user access denied  & show error message
                echo json_encode(array(
                    "success" => false,
                    "message" => "Access denied.",
                    "error" => $exception->getMessage()
                ));

                return false;
            }
        }
        return false;
    }

    public function generateJwtToken(array $user): string
    {
        $token = [
            "iss" => JWT_CONFIG['ISS'],
            "aud" => JWT_CONFIG['AUD'],
            "iat" => JWT_CONFIG['IAT'],
            "nbf" => JWT_CONFIG['NBF'],
            "data" => [
                "id" => $user['user_id'],
                "username" => $user['username'],
                "email" => $user['email']
            ]
        ];

        $key = JWT_CONFIG['PRIVATE_KEY'];
        $algo = JWT_CONFIG['ALGO'];
        return JWT::encode($token, $key, $algo);
    }


}