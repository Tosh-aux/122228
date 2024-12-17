<?php

try {
    // създаваме connection string
    $host = '54.166.22.191';
    $db   = 'university';
    $user = 'root';
    $pass = 'Qwerty2023@';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    // настройки
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    // нов PDO обект, чрез който комуникираме с базата данни
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
} catch (Exception $e) {
    echo 'An error occurred: ' . $e->getMessage();
    exit;
}

?>