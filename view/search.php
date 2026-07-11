<?php
require_once __DIR__ . "/../sql/db.php";
require_once __DIR__ . "/../sql/read.php";
$brands = formData($conn);
?>

<h2>Search for a Car</h2>

<form id="search-form" action="api/cars.php" method="GET">

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
    <label for="model_year">Model Year</label>
    <input min="0" type="number" id="model_year" name="model_year">

    <label for="regNum">Swedish Registration Number</label>
    <input id="regNum" name="regNum">

    <button type="submit">Search</button>
</form>

<div id="search-results" class="search-results">

</div>

<script>
    document.getElementById('search-form').addEventListener("submit", async (e) => {
        e.preventDefault();

        //get values
        const brand = document.getElementById("brand").value
        const model_year = document.getElementById("model_year").value
        const regNum = document.getElementById("regNum").value
        console.log("brand value: " + brand);
        console.log("model_year value: " + model_year);
        console.log("regNum value: " + regNum);

        const response = await fetch(
            `api/cars.php?brand=${brand}&model_year=${model_year}&regNum=${regNum}`
        );
        
        const results = await response.json();

        const searchResultsDiv = document.getElementById('search-results');
        searchResultsDiv.innerHTML = "";
        const table = document.createElement("table");
        const header = table.createTHead();
        const headerRow = header.insertRow();

        ["Model", "Reg. Number", "Year"].forEach(text => {
            const th = document.createElement("th");
            th.textContent = text;
            headerRow.appendChild(th);
        });
        const tableBody = table.createTBody();

        results.forEach(row => {
            const tr = tableBody.insertRow();

            const model = tr.insertCell();
            model.textContent = row.model;

            const reg_number = tr.insertCell();
            reg_number.innerHTML = `<a href="/index.php?page=car-detail&id=${row.id}">${row.reg_number}</a>`;

            const year = tr.insertCell();
            year.textContent = row.model_year;


        });

        searchResultsDiv.appendChild(table);
    })
</script>