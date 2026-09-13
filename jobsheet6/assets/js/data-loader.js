/**
 * Fungsi Generik untuk Mengambil dan Merender Data JSON ke Tabel HTML
 * @param {string} url - Path ke file JSON
 * @param {string} tableId - ID dari elemen tabel (misal: '#tabel-buku')
 * @param {Array<string>} keys - Daftar kunci/properti JSON yang mau ditampilkan sebagai kolom
 */
async function loadGenerikData(url, tableId, keys) {
    const table = document.querySelector(tableId);
    if (!table) return;

    const tbody = table.querySelector("tbody");
    if (!tbody) return;

    // 1. Tampilkan indikator loading
    const totalCols = keys.length + 1; // Jumlah kolom data + 1 kolom Aksi
    tbody.innerHTML = `
        <tr id="loading-indicator">
            <td colspan="${totalCols}" class="text-center py-4">
                <div class="spinner-border" style="color: #d63384;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 text-muted mb-0">Memuat data dari server...</p>
            </td>
        </tr>
    `;

    try {
        // Delay simulasi 3 detik (3000ms) agar loading indicator terlihat jelas
        await new Promise((resolve) => setTimeout(resolve, 3000));

        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`HTTP Error! Status: ${response.status}`);
        }

        const data = await response.json();
        tbody.innerHTML = ""; // Kosongkan tbody dari loading indicator

        if (data.length === 0) {
            tbody.innerHTML = `<tr><td colspan="${totalCols}" class="text-center text-muted py-3">Tidak ada data.</td></tr>`;
            return;
        }

        // 2. Render baris secara dinamis berdasarkan daftar kunci/keys
        data.forEach((item) => {
            const tr = document.createElement("tr");

            // Generasi <td> dari setiap kunci di dalam array keys
            let cellsHtml = keys.map((key) => `<td>${item[key] ?? "-"}</td>`).join("");

            // Tambahkan kolom Aksi (Edit & Hapus)
            cellsHtml += `
                <td>
                    <button type="button" class="btn btn-warning btn-sm text-white me-1">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm btn-hapus">Hapus</button>
                </td>
            `;

            tr.innerHTML = cellsHtml;
            tbody.appendChild(tr);
        });

        if (typeof updateTableCounter === "function") {
            updateTableCounter();
        }
    } catch (error) {
        console.error("Gagal mengambil data:", error);
        tbody.innerHTML = `
            <tr>
                <td colspan="${totalCols}" class="text-center text-danger py-3">
                    <strong>Gagal memuat data:</strong> ${error.message}
                </td>
            </tr>
        `;
    }
}