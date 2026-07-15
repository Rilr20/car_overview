document.getElementById("search-form").addEventListener("submit", async (e) => {
    e.preventDefault();

    const params = new URLSearchParams({
        brand: document.getElementById("brand").value,
        model_year: document.getElementById("model_year").value,
        regNum: document.getElementById("regNum").value,
        limit: document.getElementById("limit").value
    });

    try {
        const response = await fetch(`/api/cars.php?${params}`);

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
                    ${results.length
                ? results.map(car => `
                                <tr>
                                    <td>${car.model}</td>
                                    <td>
                                        <a href="/?page=car-detail&id=${car.id}">
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