<?php
// Define includes
require_once __DIR__.'/vendor/autoload.php'; // Composer plugins
require_once("defuse-crypto.phar"); // "php-encryption" plugin

// Create & store encryption key
$key = Defuse\Crypto\Key::createNewRandomKey();
$key = $key->saveToAsciiSafeString();
if (PHP_OS_FAMILY === "Windows"){
    file_put_contents('C:\keyfile', $key);
} else {
    file_put_contents('/usr/local/keyfile/keyfile', $key);
};

// Define plaintext DB credentials
$server = "myserver"; // e.g., "localhost"
$dbuser = "mydbuser";
$pass = "mypass";
$database = "mydatabase";

// Load .env decryption key
if (PHP_OS_FAMILY === "Windows"){
    $keyContents = file_get_contents('C:\keyfile');
} else {
    $keyContents = file_get_contents('/usr/local/keyfile/keyfile');
};
$key = Defuse\Crypto\Key::loadFromAsciiSafeString($keyContents);

// Encrypt DB credentials
$server_encrypted = Defuse\Crypto\Crypto::encrypt($server, $key);
$dbuser_encrypted = Defuse\Crypto\Crypto::encrypt($dbuser, $key);
$pass_encrypted = Defuse\Crypto\Crypto::encrypt($pass, $key);
$database_encrypted = Defuse\Crypto\Crypto::encrypt($database, $key);

// Store encrypted DB credentials in .env file
file_put_contents(__DIR__.'/../env/.env', 'SERVER='.$server_encrypted.PHP_EOL.'DBUSER='.$dbuser_encrypted.PHP_EOL.'PASS='.$pass_encrypted.PHP_EOL.'DATABASE='.$database_encrypted);

// Print success/failure of .env & keyfile creation
if (PHP_OS_FAMILY === "Windows"){
    if(file_exists('C:/keyfile')){
        echo 'SUCCESS: C:\keyfile exists.<br />';
    } else {
        echo 'FAILURE: C:\keyfile wasn\'t detected.';
    };
}
else {
    if(file_exists('/usr/local/keyfile')){
        echo 'SUCCESS: /usr/local/keyfile/keyfile exists.<br />';
    } else {
        echo 'FAILURE: /usr/local/keyfile/keyfile wasn\'t detected.';
    };
};
if (file_exists(__DIR__.'/../env/.env')){
    echo 'SUCCESS: ./../env/.env exists.';
} else {
    echo 'FAILURE: ./../env/.env wasn\t detected.';   
};
?>