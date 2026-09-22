function loadGenerikData(jsonUrl, tableSelector, keys, storageKey) {
    let dataLocal = localStorage.getItem(storageKey);

    if (dataLocal) {
        const parsed = JSON.parse(dataLocal);
        renderTable(parsed, tableSelector, keys, storageKey);
        setupSearch(parsed, tableSelector, keys, storageKey);
    } else {
        fetch(jsonUrl)
            .then(response => {
                if (!response.ok) throw new Error("Gagal mengambil data JSON");
                return response.json();
            })
            .then(data => {
                localStorage.setItem(storageKey, JSON.stringify(data));
                renderTable(data, tableSelector, keys, storageKey);
                setupSearch(data, tableSelector, keys, storageKey);
            })
            .catch(err => {
                console.error(err);
                const counter = document.getElementById("table-counter");
                if (counter) counter.textContent = "Gagal memuat data";
            });
    }
}

function renderTable(data, tableSelector, keys, storageKey) {
    const tbody = document.querySelector(`${tableSelector} tbody`);
    const counter = document.getElementById("table-counter");
    if (!tbody) return;

    tbody.innerHTML = "";
    if (counter) counter.textContent = `Menampilkan ${data.length} total data`;

    data.forEach((item, index) => {
        const tr = document.createElement("tr");
        let cellsHtml = "";
        
        keys.forEach((key, keyIndex) => {
            if (keyIndex === 0) {
                cellsHtml += `<td style="padding-left: 1.5rem; font-weight: 600;">${item[key]}</td>`;
            } else {
                cellsHtml += `<td>${item[key]}</td>`;
            }
        });

        cellsHtml += `
            <td style="text-align: right; padding-right: 1.5rem;">
                <button class="btn-action btn-edit" onclick="alert('Fitur edit dibuka!')">Edit</button>
                <button class="btn-action btn-delete" onclick="hapusData('${tableSelector}', '${keys}', ${index}, '${storageKey}')">Hapus</button>
            </td>
        `;

        tr.innerHTML = cellsHtml;
        tbody.appendChild(tr);
    });
}

function setupSearch(fullData, tableSelector, keys, storageKey) {
    const searchInput = document.getElementById("search-input");
    if (!searchInput) return;

    const newSearchInput = searchInput.cloneNode(true);
    searchInput.parentNode.replaceChild(newSearchInput, searchInput);

    newSearchInput.addEventListener("input", function() {
        const query = this.value.toLowerCase();
        const filteredData = fullData.filter(item => {
            return keys.some(key => String(item[key]).toLowerCase().includes(query));
        });
        renderTable(filteredData, tableSelector, keys, storageKey);
    });
}

function hapusData(tableSelector, keysStr, index, storageKey) {
    let data = JSON.parse(localStorage.getItem(storageKey)) || [];
    const keys = keysStr.split(',');

    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        data.splice(index, 1);
        localStorage.setItem(storageKey, JSON.stringify(data));
        renderTable(data, tableSelector, keys, storageKey);
        setupSearch(data, tableSelector, keys, storageKey);
    }
}