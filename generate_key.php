<?php

// Define the length of the key in bytes
$keyLength = 32; // You can adjust this based on your security requirements

// Generate random bytes
$randomBytes = random_bytes($keyLength);

// Convert the random bytes to a hexadecimal string
$randomKey = bin2hex($randomBytes);

// Output the generated key
echo $randomKey . PHP_EOL;
