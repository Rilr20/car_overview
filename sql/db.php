<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();


// echo "DB connection is  " . $_ENV["DB_CONNECTION"] . "!\n";
// echo "DB host is  " . $_ENV["DB_HOST"] . "!\n";


try {
    $conn = new PDO(
        "mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_DATABASE']}",
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD']
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "
    <div class='error-container'>
        <p class='error'>
            <strong>Coult not connect!  </strong> {$e->getMessage()}
        </p>
    </div>";
    die();
}
