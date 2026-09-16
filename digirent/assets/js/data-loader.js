function loadGenerikData(jsonUrl, tableSelector, keys) {
    fetch(jsonUrl)
        .then(response => {
            if (!response.ok) throw new Error("Gagal mengambil data JSON");
            return response.json();
        })
        .then(data => {
            const tbody = document.querySelector(`${tableSelector} tbody`);
            const counter = document.getElementById("table-counter");
            if (!tbody) return;

            tbody.innerHTML = "";
            if (counter) counter.textContent = `Menampilkan ${data.length} total data`;

            data.forEach(item => {
                const tr = document.createElement("tr");
                let cellsHtml = "";
                
                keys.forEach((key, index) => {
                    if (index === 0) {
                        cellsHtml += `<td class="ps-4 fw-semibold">${item[key]}</td>`;
                    } else {
                        cellsHtml += `<td>${item[key]}</td>`;
                    }
                });

                cellsHtml += `
                    <td class="text-end pe-4">
                        <button class="btn btn-sm btn-outline-primary rounded-pill px-2 py-0 me-1">Edit</button>
                        <button class="btn btn-sm btn-outline-danger rounded-pill px-2 py-0">Hapus</button>
                    </td>
                `;

                tr.innerHTML = cellsHtml;
                tbody.appendChild(tr);
            });
        })
        .catch(err => {
            console.error(err);
            const counter = document.getElementById("table-counter");
            if (counter) counter.textContent = "Gagal memuat data";
        });
}