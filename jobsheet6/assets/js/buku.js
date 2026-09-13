document.addEventListener("DOMContentLoaded", function () {
    loadDataBuku();
});

async function loadDataBuku() {
    const tbody = document.querySelector("#tabel-buku tbody");
    if (!tbody) return;

    // 1. Tampilkan indikator loading
    tbody.innerHTML = `
        <tr id="loading-indicator">
            <td colspan="5" class="text-center py-4">
                <div class="spinner-border text-pink" style="color: #d63384;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 text-muted mb-0">Memuat data buku...</p>
            </td>
        </tr>
    `;

    try {
        // Simulasi delay 600ms
        await new Promise((resolve) => setTimeout(resolve, 600));

        // 2. Fetch data dari file JSON lokal
        const response = await fetch("../data/buku.json");

        if (!response.ok) {
            throw new Error(`HTTP Error! Status: ${response.status}`);
        }

        const data = await response.json();

        // Kosongkan tbody dari loading indicator
        tbody.innerHTML = "";

        if (data.length === 0) {
            tbody.innerHTML = `<tr><td colspan="5" class="text-center text-muted py-3">Tidak ada data buku.</td></tr>`;
            return;
        }

        // 3. Render baris tabel secara dinamis
        data.forEach((buku) => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${buku.judul}</td>
                <td>${buku.pengarang}</td>
                <td>${buku.tahun}</td>
                <td>${buku.stok}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm text-white me-1">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm btn-hapus">Hapus</button>
                </td>
            `;
            tbody.appendChild(tr);
        });

        // Update counter setelah render selesai
        if (typeof updateTableCounter === "function") {
            updateTableCounter();
        }
    } catch (error) {
        console.error("Gagal mengambil data buku:", error);
        // 4. Penanganan error jika fetch gagal
        tbody.innerHTML = `
            <tr>
                <td colspan="5" class="text-center text-danger py-3">
                    <strong>Gagal memuat data buku:</strong> ${error.message}
                </td>
            </tr>
        `;
    }
}