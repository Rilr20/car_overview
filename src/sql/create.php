<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';


function createCar(Car $car, PDO $conn) {
    if(!$car->reg_number) {
        echo "no reg number \n";
        return;
    }
    try {
        $sql = "INSERT IGNORE INTO cars (reg_number, brand, model, vehicle_type, gearbox, model_year, fuel_type, mileage, horsepower, acceleration, fuel_consumption, location, description, url) VALUES (:reg_number, :brand, :model, :vehicle_type, :gearbox, :model_year, :fuel_type, :mileage, :horsepower, :acceleration, :fuel_consumption, :location, :description, :url)";

        $stmt = $conn->prepare($sql);
        $stmt->execute((array)$car);

        echo $stmt->rowCount()
            ? "[INSERT] '{$car->reg_number}'\n"
            : "[SKIP] '{$car->reg_number}', already exists\n";
    } catch (PDOException $e) {
        // echo "ERROR: " . $e->getMessage() . " \n";
        throw $e;
    }
}