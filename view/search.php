<?php
require_once __DIR__ . "/../sql/db.php";
require_once __DIR__ . "/../sql/read.php";
$brands = formData($conn);
$total = carCount($conn);
?>

<h2 class="page-title search">Search for a Car</h2>
<p class="green-box"><?= $total ?> Cars in DB.</p>

<form id="search-form" action="api/cars.php" method="GET">

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

<script>
    document.getElementById("search-form").addEventListener("submit", async (e) => {
        e.preventDefault();

        const params = new URLSearchParams({
            brand: document.getElementById("brand").value,
            model_year: document.getElementById("model_year").value,
            regNum: document.getElementById("regNum").value,
            limit: document.getElementById("limit").value
        });

        try {
            const response = await fetch(`api/cars.php?${params}`);

            if (!response.ok) {
                throw new Error("Request failed");
            }

            const results = await response.json();

            document.getElementById("search-results").innerHTML = `
            <table>
                <caption class="table-caption">${results.length} Items Found</caption>
                <thead>
                    ${results.length ? `
                        <tr>
                            <th>Model</th>
                            <th>Reg. Number</th>
                            <th>Year</th>
                        </tr>` :
                     ``}

                </thead>
                <tbody>
                    ${
                        results.length
                            ? results.map(car => `
                                <tr>
                                    <td>${car.model}</td>
                                    <td>
                                        <a href="/index.php?page=car-detail&id=${car.id}">
                                            ${car.reg_number}
                                        </a>
                                    </td>
                                    <td>${car.model_year}</td>
                                </tr>
                            `).join("")
                            : `<tr><td class="nofound" colspan="4">No cars found.</td></tr>`
                    }
                </tbody>
            </table>
        `;
        } catch (err) {
            console.error(err);
            document.getElementById("search-results").innerHTML =
                '<p class="error">Unable to load search results.</p>';
        }
    });
</script>