document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initHapusConfirm();
    initTableFilter();
    initValidasiForm();
    updateTableCounter(); // Inisialisasi hitungan awal
});

// ===== 1. Toggle Navigasi dengan Efek Transisi / Smooth Slide =====
function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");
    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}

// ===== 2. Konfirmasi Hapus + Update Counter Otomatis =====
function initHapusConfirm() {
    document.querySelectorAll(".btn-hapus").forEach(function (btn) {
        btn.addEventListener("click", function () {
            const row = btn.closest("tr");
            const nama = row ? row.querySelector("td")?.textContent.trim() : "data ini";
            const yakin = confirm('Yakin ingin menghapus "' + nama + '"?');
            if (yakin && row) {
                row.remove();
                updateTableCounter(); // Perbarui counter setelah baris dihapus
            }
        });
    });
}

// ===== 3. Filter Pencarian Spesifik Kolom "Judul/Nama" + Update Counter =====
function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table") || document.querySelector("table");
    if (!input || !table) return;

    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase().trim();
        const rows = table.querySelectorAll("tbody tr");

        rows.forEach(function (row) {
            // Mengambil kolom pertama (Judul Buku atau Nama Anggota)
            const firstCell = row.querySelector("td");
            if (firstCell) {
                const teksJudul = firstCell.textContent.toLowerCase();
                row.style.display = teksJudul.includes(keyword) ? "" : "none";
            }
        });

        updateTableCounter(); // Perbarui counter setelah penyaringan
    });
}

// ===== Helper 4. Counter Jumlah Baris Tersisa / Terfilter =====
function updateTableCounter() {
    const table = document.querySelector(".table-responsive table") || document.querySelector("table");
    const counterEl = document.getElementById("table-counter");
    if (!table || !counterEl) return;

    const totalRows = table.querySelectorAll("tbody tr").length;
    let visibleRows = 0;

    table.querySelectorAll("tbody tr").forEach(function (row) {
        if (row.style.display !== "none") {
            visibleRows++;
        }
    });

    counterEl.textContent = `Menampilkan ${visibleRows} dari ${totalRows} data`;
}

// ===== Helper Pesan Error DOM =====
function tampilkanError(input, pesan) {
    hapusError(input);
    const span = document.createElement("span");
    span.className = "error";
    span.textContent = pesan;
    input.insertAdjacentElement("afterend", span);
}

function hapusError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
        next.remove();
    }
}

// ===== 5. Refactor Validasi Form Client-Side (Array-based + Validasi ISBN) =====
function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valid = true;

        // Daftar aturan validasi dalam bentuk Array of Objects
        const rules = [
            {
                selector: "[name='judul'], [name='nama']",
                validate: (val) => val.trim() !== "",
                message: "Field ini wajib diisi."
            },
            {
                selector: "[name='pengarang']",
                validate: (val) => val.trim() !== "",
                message: "Pengarang wajib diisi."
            },
            {
                selector: "[name='tahun']",
                validate: (val) => {
                    if (val.trim() === "") return false;
                    const num = parseInt(val, 10);
                    return !isNaN(num) && num >= 1900 && num <= 2026;
                },
                message: "Tahun harus di antara 1900-2026."
            },
            {
                selector: "[name='stok']",
                validate: (val) => {
                    if (val.trim() === "") return false;
                    const num = parseInt(val, 10);
                    return !isNaN(num) && num >= 0;
                },
                message: "Stok tidak boleh negatif."
            },
            // Validasi Field Baru: ISBN (Opsional, tapi jika diisi wajib angka & tanda hubung '-')
            {
                selector: "[name='isbn']",
                validate: (val) => {
                    if (val.trim() === "") return true; // Opsional
                    const isbnRegex = /^[0-9\-]+$/;
                    return isbnRegex.test(val.trim());
                },
                message: "ISBN hanya boleh berisi angka dan tanda hubung (-)."
            }
        ];

        // Iterasi aturan validasi menggunakan forEach
        rules.forEach(function (rule) {
            const input = form.querySelector(rule.selector);
            if (input) {
                if (!rule.validate(input.value)) {
                    tampilkanError(input, rule.message);
                    valid = false;
                } else {
                    hapusError(input);
                }
            }
        });

        if (!valid) {
            e.preventDefault(); // Batalkan submit jika ada input invalid
        }
    });
}