<?php
// config.php

$dsn = 'mysql:host=127.0.0.1;port=3307;dbname=donjulio;charset=utf8';
$db   = 'donjulio';
$user = 'root';
$pass = '1234';
$charset = 'utf8mb4';

// Configuración DSN
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opciones para PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Manejo de errores
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
