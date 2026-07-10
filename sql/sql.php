<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();


echo "DB connection is  " . $_ENV["DB_CONNECTION"] . "!\n";
echo "DB host is  " . $_ENV["DB_HOST"] . "!\n";


try {
    $conn = new PDO(
        "mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_DATABASE']}",
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD']
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Coult not connect! " . $e->getMessage());
}

try {
    $sql = "
    CREATE TABLE IF NOT EXISTS cars (
        id INT AUTO_INCREMENT PRIMARY KEY,
        
        reg_number VARCHAR(7) NOT NULL,
        brand VARCHAR(50) NOT NULL,
        model VARCHAR(50) NOT NULL,

        vehicle_type VARCHAR(50),
        gearbox VARCHAR(50),
        model_year INT,

        fuel_type VARCHAR(30),
        mileage INT,
        horsepower INT,
        acceleration DECIMAL(4,2),

        fuel_consumption DECIMAL(4,2),

        location VARCHAR(100),

        description TEXT,

        url VARCHAR(255),

        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UNIQUE (reg_number)
    );
    ";
    $conn->exec($sql);

    echo "cars table created or already exists.\n";
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage() . "\n";
}