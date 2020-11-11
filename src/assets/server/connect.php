<?php
defined('DS') OR define('DS', DIRECTORY_SEPARATOR);
put_env_elements();
// $servername = 'localhost';
// $database = '';
// $username = '';
// $password = '';
// $charset = 'utf8mb4';
// $dbPrefix = 'lsv_';
// $pasPhrase = '';
$setVal = 'Tl2zDnrBY/Y17tjGRNE/eASupF366RhkQRmSBmCbdnk=';

$servername = env('DB_HOST', 'localhost');
$database = env('DB_DATABASE');
$username = env('DB_USERNAME');
$password = env('DB_PASSWORD');
$port = env('DB_PORT', 3306);
$charset = 'utf8';
$dbPrefix = 'lsv_';

$dsn = "mysql:host=$servername;port=$port;dbname=$database;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}

function put_env_elements() {
     $env = explode(DS, __DIR__);
     array_pop($env);
     array_pop($env);
     array_pop($env);
     $env = implode(DS, $env);
     
     $sets = explode(PHP_EOL, file_get_contents($env . DS . '.env'));
     foreach($sets as $set) {
          putenv($set);
     }
}

function env($key, $default = null)
{
    $value = getenv($key, false);

    if ($value === false) {
        return $default;
    }

    if (strlen($value) > 1 && strpos($value, '"') === 0 && strrpos($value, '"') === 0) {
        return substr($value, 1, -1);
    }

    return $value;
}