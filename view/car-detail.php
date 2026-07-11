<?php
require_once __DIR__ . '/../sql/db.php';
require_once __DIR__ . "/../sql/read.php";
// Grab the id from the URL query string
$carId = $_GET['id'] ?? null;


// var_dump($_GET);

if (!$carId || !is_numeric($carId)) {
    echo "<h2>No car ID specified.</h2>";
    return;
}
$res = getCarById($carId, $conn);
?>
<h1 class="car-title"><?= $res['reg_number'] ?></h1>
<!-- Individual car with info of it -->
<div class="detail-grid">
    <!-- grids n stuff -->
    <div class="detail-item-1">
        <h4>Brand</h4>
        <p><?= $res['brand'] ?></p>
    </div>
    <div class="detail-item-2">
        <h4>Model</h4>
        <p><?= $res['model'] ?></p>
    </div>
    <div class="detail-item-3">
        <h4>Vehicle Type</h4>
        <p><?= $res['vehicle_type'] ?></p>
    </div>
    <div class="detail-item-4">
        <h4>gearbox</h4>
        <p><?= $res['gearbox'] ?></p>
    </div>
    <div class="detail-item-5">
        <h4>model_year</h4>
        <p><?= $res['model_year'] ?></p>
    </div>
    <div class="detail-item-6">
        <h4>fuel_type</h4>
        <p><?= $res['fuel_type'] ?></p>
    </div>
    <div class="detail-item-7">
        <h4>mileage</h4>
        <p><?= $res['mileage'] ?></p>
    </div>
    <div class="detail-item-8">
        <h4>horsepower</h4>
        <p><?= $res['horsepower'] ?></p>
    </div>
    <div class="detail-item-9">
        <h4>acceleration</h4>
        <p><?= $res['acceleration'] ?></p>
    </div>
    <div class="detail-item-10">
        <h4>fuel_consumption</h4>
        <p><?= $res['fuel_consumption'] ?></p>
    </div>
    <div class="detail-item-11">
        <h4>location</h4>
        <p><?= $res['location'] ?></p>
    </div>
    <div class="detail-item-12">
        <h4>URL</h4>
        <a href="<?= $res['url'] ?>"><?= $res['reg_number'] ?></a>
    </div>

</div>

<h3>Description</h3>
<p><?= $res['description'] ?></p>

