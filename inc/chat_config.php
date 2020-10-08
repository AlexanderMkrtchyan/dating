<?php
$dbhost = "localhost";
$dbname = 'dating';
$dbuser = "root";
$dbpass = 'Boxing11';
$charset = 'utf8mb4';
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    
    $db = new PDO("mysql:dbhost=$dbhost;dbname=$dbname;charset=$charset", $dbuser, $dbpass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}