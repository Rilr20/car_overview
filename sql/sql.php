<?php

declare(strict_types=1);

require_once __DIR__ . '/db.php';

try {
    $sql = "
    CREATE TABLE IF NOT EXISTS cars (
        id INT AUTO_INCREMENT PRIMARY KEY,
        
        reg_number CHAR(7) NOT NULL,
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
        INDEX idx_brand (brand)
    );
    ";
    $conn->exec($sql);

    echo "cars table created or already exists.\n";
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage() . "\n";
}