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
                $key = JWT_CONFIG['KEY'];


                $headers = new stdClass();
                $decoded = JWT::decode($this->jwt, new Key($key, 'HS256'), $headers);

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

}