// ===== Konfirmasi Hapus (Event Delegation) =====
function initHapusConfirm() {
    document.addEventListener("click", function (e) {
        // Cek jika elemen yang diklik atau elemen terdekatnya memiliki class .btn-hapus
        const btn = e.target.closest(".btn-hapus");
        if (btn) {
            const row = btn.closest("tr");
            const nama = row ? row.querySelector("td")?.textContent.trim() : "data ini";
            const yakin = confirm('Yakin ingin menghapus "' + nama + '"?');
            if (yakin && row) {
                row.remove();
                if (typeof updateTableCounter === "function") {
                    updateTableCounter();
                }
            }
        }
    });
}

// ===== Filter/Pencarian Tabel Real-Time =====
function initTableFilter() {
    const input = document.getElementById("search-input");
    if (!input) return;

    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase().trim();
        const table = document.querySelector(".table-responsive table") || document.querySelector("table");
        if (!table) return;

        const rows = table.querySelectorAll("tbody tr");
        rows.forEach(function (row) {
            const firstCell = row.querySelector("td");
            if (firstCell) {
                const teks = firstCell.textContent.toLowerCase();
                row.style.display = teks.includes(keyword) ? "" : "none";
            }
        });

        if (typeof updateTableCounter === "function") {
            updateTableCounter();
        }
    });
}

// ===== Helper Counter Baris =====
function updateTableCounter() {
    const table = document.querySelector(".table-responsive table") || document.querySelector("table");
    const counterEl = document.getElementById("table-counter");
    if (!table || !counterEl) return;

    const allRows = table.querySelectorAll("tbody tr");
    // Abaikan baris loading atau baris error
    const dataRows = Array.from(allRows).filter(r => !r.querySelector(".spinner-border") && !r.querySelector(".alert-danger"));
    const totalRows = dataRows.length;

    let visibleRows = 0;
    dataRows.forEach(function (row) {
        if (row.style.display !== "none") {
            visibleRows++;
        }
    });

    counterEl.textContent = `Menampilkan ${visibleRows} dari${totalRows} data`;
}

// ===== Helper Pesan Error DOM Form =====
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

// ===== Validasi Form Client-Side =====
function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valid = true;

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
            }
        ];

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
            e.preventDefault();
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    initHapusConfirm();
    initTableFilter();
    initValidasiForm();
});