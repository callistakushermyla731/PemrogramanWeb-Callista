document.addEventListener("DOMContentLoaded", function() {
    console.log("DIGIRENT System Active.");

    // Event Delegation: Mendengarkan klik pada seluruh elemen di halaman
    document.addEventListener("click", function(e) {
        // 1. Penanganan Tombol Hapus (Event Delegation)
        if (e.target && e.target.classList.contains("btn-delete")) {
            const index = e.target.getAttribute("data-index");
            const storageKey = e.target.getAttribute("data-storage");
            const tableSelector = e.target.getAttribute("data-table");
            const keys = e.target.getAttribute("data-keys").split(",");

            let data = JSON.parse(localStorage.getItem(storageKey)) || [];

            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                data.splice(index, 1);
                localStorage.setItem(storageKey, JSON.stringify(data));
                renderTable(data, tableSelector, keys, storageKey);
                setupSearch(data, tableSelector, keys, storageKey);
            }
        }

        // 2. Penanganan Tombol Edit
        if (e.target && e.target.classList.contains("btn-edit")) {
            alert("Fitur edit data berhasil dipicu!");
        }
    });
});