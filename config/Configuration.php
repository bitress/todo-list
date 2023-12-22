<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
const APP_URL = "http://localhost/todo-list/";

const DB_HOST = "localhost";
const DB_NAME = "todo-list";
const DB_USER = "root";
const DB_PASS = "";
const PEM_FILE = 'owo.pem';

$passphrase = $_SERVER['JWT_PASSPHRASE'];

// Load the private key without passphrase
$privateKey = openssl_pkey_get_private(file_get_contents(PEM_FILE), $passphrase);

// Check for errors
if ($privateKey === false) {
    die('Unable to load private key. Error: ' . openssl_error_string());
}

// Get private key details
$privateKeyDetails = openssl_pkey_get_details($privateKey);

// Check for errors
if ($privateKeyDetails === false) {
    die('Unable to get private key details.');
}

$publicKey = $privateKeyDetails['key'];

define("JWT_CONFIG", [
    'PUBLIC_KEY' => $publicKey,
    'PRIVATE_KEY' => $privateKey,
    'ISS' => APP_URL,
    'AUD' => APP_URL,
    'IAT' => time(),
    'NBF' => time(),
    'ALGO' => 'RS256'
]);

