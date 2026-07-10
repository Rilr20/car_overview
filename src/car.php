<?php
declare(strict_types=1);

class Car {
    public string $brand = "";
    public string $model = "";
    public ?int $year = null;
    public ?string $registration = null;
    public ?int $price = null;
    public ?int $mileage = null;
    public ?string $fuel_type = null;
    public ?string $transmission = null;
    public ?float $consumption = null; 
    public ?string $description = null;
    public ?string $url = null;
}