<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';


function createCar(Car $car, PDO $conn) {
    if(!$car->reg_number) {
        echo "no reg number \n";
        return;
    }
    try {
        //TODO GLÖM INTE CREATEd_AT timestamp! om inte mysql db gör det automatiskt
        $sql = "INSERT INTO cars (reg_number, brand, model, vehicle_type, gearbox, model_year, fuel_type, mileage, horsepower, acceleration, fuel_consumption, location, description, url) VALUES (:reg_number, :brand, :model, :vehicle_type, :gearbox, :model_year, :fuel_type, :mileage, :horsepower, :acceleration, :fuel_consumption, :location, :description, :url)";

        $stmt = $conn->prepare($sql);
        $stmt->execute((array)$car);
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage() . " \n";
    }
}