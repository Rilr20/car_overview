<?php
require_once __DIR__ . '/../src/sql/db.php';
require_once __DIR__ . "/../src/sql/read.php";
// Grab the id from the URL query string
$carId = $_GET['id'] ?? null;


// var_dump($_GET);

if (!$carId || !is_numeric($carId)) {
    echo "<h2>No car ID specified.</h2>";
    return;
}
$res = getCarById($carId, $conn);
// var_dump($res);
if ($res === false) {
    echo "<h2 class='center'>404 Car not found</h2>";
    return;
}
?>
<h1 class="car-title"><?= $res['reg_number'] ?></h1>
<!-- Individual car with info of it -->
<div class="detail-grid">
    <!-- grids n stuff -->
    <div class="detail-item-1">
        <h4>Brand</h4>
        <hr>
        <p><?= $res['brand'] ?></p>
    </div>
    <div class="detail-item-2">
        <h4>Model</h4>
        <hr>
        <p><?= $res['model'] ?></p>
    </div>
    <div class="detail-item-3">
        <h4>Body Styles</h4>
        <hr>
        <p><?= $res['vehicle_type'] ?></p>
    </div>
    <div class="detail-item-4">
        <h4>Gearbox</h4>
        <hr>
        <p><?= $res['gearbox'] ?></p>
    </div>
    <div class="detail-item-5">
        <h4>Model Year</h4>
        <hr>
        <p><?= $res['model_year'] ?></p>
    </div>
    <div class="detail-item-6">
        <h4>Fuel Type</h4>
        <hr>
        <p><?= $res['fuel_type'] ?></p>
    </div>
    <div class="detail-item-7">
        <h4>Mileage</h4>
        <hr>
        <p><?= $res['mileage'] ?> <?= isset($res['mileage']) ? 'Mil' : '' ?></p>
    </div>
    <div class="detail-item-8">
        <h4>Horsepower</h4>
        <hr>
        <p><?= $res['horsepower'] ?> <?= isset($res['horsepower']) ? "hp" : "" ?></p>
    </div>
    <div class="detail-item-9">
        <h4>Acceleration</h4>
        <hr>
        <p><?= $res['acceleration'] ?><?= isset($res['acceleration']) ? 's' : '' ?></p>
    </div>
    <div class="detail-item-10">
        <h4>Consumption</h4>
        <hr>
        <p><?= isset($res['fuel_consumption']) && $res['fuel_consumption'] != 0 ? $res['fuel_consumption'] . " l/100km" : '' ?>
    </div>
    <div class="detail-item-11">
        <h4>location</h4>
        <hr>
        <p><?= $res['location'] ?></p>
    </div>
    <div class="detail-item-12">
        <h4>URL</h4>
        <hr>
        <a href="<?= $res['url'] ?>"><?= $res['reg_number'] ?></a>
    </div>

</div>

<h3>Description</h3>
<p><?= $res['description'] ?></p>