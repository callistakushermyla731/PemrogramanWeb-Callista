// Fungsi Generik untuk memuat data JSON / LocalStorage secara asinkron
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
            // 2. Fetch API menggunakan async/await
            const response = await fetch(jsonUrl);
            
            if (!response.ok) {
                throw new Error(`HTTP Error! Status: ${response.status}`);
            }
            
            data = await response.json();
            localStorage.setItem(storageKey, JSON.stringify(data));
        }

        // Render tabel & pasang pencarian live
        renderTable(data, tableSelector, keys, storageKey);
        setupSearch(data, tableSelector, keys, storageKey);

    } catch (error) {
        // 3. Error Handling dengan try/catch
        console.error("Gagal memuat data:", error);
        if (counter) counter.textContent = "Gagal memuat data!";
        if (tbody) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="${keys.length + 1}" style="text-align:center; color:#dc3545; padding: 2rem;">
                        ⚠️ Terjadi kesalahan saat memuat data. Periksa koneksi atau path file JSON.
                    </td>
                </tr>`;
        }
    }
}

// Fungsi Render Tabel ke DOM
function renderTable(data, tableSelector, keys, storageKey) {
    const tbody = document.querySelector(`${tableSelector} tbody`);
    const counter = document.getElementById("table-counter");
    if (!tbody) return;

    tbody.innerHTML = ""; // Kosongkan tbody terlebih dahulu

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

        // Menyimpan data atribut pendukung untuk Event Delegation
        cellsHtml += `
            <td style="text-align: right; padding-right: 1.5rem;">
                <button class="btn-action btn-edit" data-index="${index}">Edit</button>
                <button class="btn-action btn-delete" 
                        data-index="${index}" 
                        data-storage="${storageKey}" 
                        data-table="${tableSelector}" 
                        data-keys="${keys.join(',')}">Hapus</button>
            </td>
        `;

        tr.innerHTML = cellsHtml;
        tbody.appendChild(tr);
    });
}

// Fitur Pencarian Real-Time (Live Search)
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