<?php
mysqli_report(MYSQLI_REPORT_OFF);

	// Define includes
	require_once __DIR__.'\vendor\autoload.php'; // Composer plugins
	require_once("defuse-crypto.phar"); // "php-encryption" plugin

	// Load .env credentials (encrypted)
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
	$dotenv->load();

	// Load .env decryption key
	$keyContents = file_get_contents('C:\keyfile');
	$key = Defuse\Crypto\Key::loadFromAsciiSafeString($keyContents);

	// Decrypt DB creds stored in .env (using decryption key)
	$server = Defuse\Crypto\Crypto::decrypt($_ENV['SERVER'], $key);
	$user = Defuse\Crypto\Crypto::decrypt($_ENV['USER'], $key);
	$pass = Defuse\Crypto\Crypto::decrypt($_ENV['PASS'], $key);
	$database = Defuse\Crypto\Crypto::decrypt($_ENV['DATABASE'], $key);

	// MySQL connection
	try{
		$db = mysqli_connect($server, $user, $pass, $database);
    } catch (mysqli_sql_exception $e){
        var_dump($e->__toString);
    }
?>