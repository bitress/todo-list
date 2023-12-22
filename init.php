<?php
require 'vendor/autoload.php';
require 'config/Configuration.php';

spl_autoload_register(function ($class) {

    $file = __DIR__ . '/Engine' . DIRECTORY_SEPARATOR . $class . '.php';

    if (file_exists($file)) {
        include_once $file;
    }

});

