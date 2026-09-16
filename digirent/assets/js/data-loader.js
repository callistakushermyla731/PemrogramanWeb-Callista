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
                        cellsHtml += `<td style="padding-left: 1.5rem; font-weight: 600;">${item[key]}</td>`;
                    } else {
                        cellsHtml += `<td>${item[key]}</td>`;
                    }
                });

                cellsHtml += `
                    <td style="text-align: right; padding-right: 1.5rem;">
                        <button class="btn-action btn-edit">Edit</button>
                        <button class="btn-action btn-delete">Hapus</button>
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