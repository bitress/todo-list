<?php

const APP_URL = "http://localhost/todo-list/";

const DB_HOST = "localhost";
const DB_NAME = "todo-list";
const DB_USER = "root";
const DB_PASS = "";

define("JWT_CONFIG", [
    'KEY' => generateSecureKey(),
    'ISS' => APP_URL,
    'AUD' => APP_URL,
    'IAT' => time(),
    'NBF' => time(),
    'ALGO' => 'HS256'
]);

/**
 * @throws Exception
 */
function generateSecureKey($length = 64): string
{
    return bin2hex(random_bytes($length));
}