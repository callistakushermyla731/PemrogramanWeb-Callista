// Fungsi dengan async/await & try/catch sesuai standar Jobsheet 6
async function loadGenerikData(jsonUrl, tableSelector, keys, storageKey) {
    const tbody = document.querySelector(`${tableSelector} tbody`);
    const counter = document.getElementById("table-counter");

    // 1. Loading Indicator
    if (counter) counter.textContent = "Memuat data...";

    try {
        let data;
        let dataLocal = localStorage.getItem(storageKey);

        if (dataLocal) {
            data = JSON.parse(dataLocal);
        } else {
            // Fetch API menggunakan await
            const response = await fetch(jsonUrl);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            data = await response.json();
            localStorage.setItem(storageKey, JSON.stringify(data));
        }

        // Render tabel & setup pencarian
        renderTable(data, tableSelector, keys, storageKey);
        setupSearch(data, tableSelector, keys, storageKey);

    } catch (error) {
        // 2. Penanganan Error
        console.error("Gagal mengambil data:", error);
        if (counter) counter.textContent = "Gagal memuat data. Silakan coba lagi.";
        if (tbody) {
            tbody.innerHTML = `<tr><td colspan="${keys.length + 1}" style="text-align:center; color:red; padding:1.5rem;">Terjadi kesalahan saat memuat data.</td></tr>`;
        }
    }
}

// Rendering elemen <tbody> secara dinamis oleh JS
function renderTable(data, tableSelector, keys, storageKey) {
    const tbody = document.querySelector(`${tableSelector} tbody`);
    const counter = document.getElementById("table-counter");
    if (!tbody) return;

    tbody.innerHTML = "";

    if (data.length === 0) {
        if (counter) counter.textContent = "Menampilkan 0 total data";
        tbody.innerHTML = `<tr><td colspan="${keys.length + 1}" style="text-align:center; padding:1.5rem;">Data tidak ditemukan.</td></tr>`;
        return;
    }

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

        // Tombol aksi ditaruh di dalam baris yang dirender dinamis
        cellsHtml += `
            <td style="text-align: right; padding-right: 1.5rem;">
                <button class="btn-action btn-edit" data-index="${index}">Edit</button>
                <button class="btn-action btn-delete" data-index="${index}" data-storage="${storageKey}" data-table="${tableSelector}" data-keys="${keys.join(',')}">Hapus</button>
            </td>
        `;

        tr.innerHTML = cellsHtml;
        tbody.appendChild(tr);
    });
}

// Fitur Pencarian Real-Time
function setupSearch(fullData, tableSelector, keys, storageKey) {
    const searchInput = document.getElementById("search-input");
    if (!searchInput) return;

    searchInput.oninput = function() {
        const query = this.value.toLowerCase();
        const filteredData = fullData.filter(item => {
            return keys.some(key => String(item[key]).toLowerCase().includes(query));
        });
        renderTable(filteredData, tableSelector, keys, storageKey);
    };
}