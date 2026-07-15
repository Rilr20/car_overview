<?php
require_once __DIR__ . "/../src/sql/db.php";
require_once __DIR__ . "/../src/sql/read.php";
$brands = formData($conn);
$total = carCount($conn);
?>

<h2 class="page-title search">Search for a Car</h2>
<p class="green-box"><?= $total ?> Cars in DB.</p>

<form id="search-form" action="/api/cars.php" method="GET">

    <div>
        <label for="brand">Brand</label>
        <!--<input id="brand" name="brand">  -->
        <select id="brand" name="brand">
            <option value="">Car brand</option>
            <?php foreach ($brands as $brand): ?>
                <option value="<?= htmlspecialchars($brand["brand"]) ?>">
                    <?= htmlspecialchars($brand["brand"]) ?>
                </option>
            <?php endforeach; ?>

        </select>
    </div>
    <div>
        <label for="model_year">Model Year</label>
        <input min="0" type="number" id="model_year" name="model_year">
    </div>
    <div>
        <label for="regNum">Swedish Registration Number</label>
        <input id="regNum" name="regNum">
    </div>
    <div>
        <label for="limit">Limit</label>
        <input type="number" value="25" id="limit" name="limit">
    </div>
    <div class="button-div">
        <button type="submit">Search</button>
    </div>
</form>

<div id="search-results" class="search-results">

</div>