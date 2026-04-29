document.addEventListener("DOMContentLoaded", function () {
    // 1. Inisialisasi DataTables (Menggunakan jQuery)
    if (typeof jQuery !== "undefined" && $(".datatable").length > 0) {
        $(".datatable").DataTable({
            responsive: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya",
                },
            },
        });
    }

    // 2. Inisialisasi AOS (Animasi)
    if (window.AOS) {
        AOS.init({
            once: true,
            duration: 700,
            easing: "ease-out-cubic",
            offset: 80,
        });
    }

    // 3. Logika Toggle Tema (Dark/Light Mode)
    var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
    var themeToggleLightIcon = document.getElementById(
        "theme-toggle-light-icon",
    );
    var themeToggleBtn = document.getElementById("theme-toggle");

    if (themeToggleDarkIcon && themeToggleLightIcon && themeToggleBtn) {
        // Tampilkan ikon yang tepat saat halaman dimuat
        if (
            localStorage.getItem("color-theme") === "dark" ||
            (!("color-theme" in localStorage) &&
                window.matchMedia("(prefers-color-scheme: dark)").matches)
        ) {
            themeToggleLightIcon.classList.remove("hidden");
        } else {
            themeToggleDarkIcon.classList.remove("hidden");
        }

        themeToggleBtn.addEventListener("click", function () {
            themeToggleDarkIcon.classList.toggle("hidden");
            themeToggleLightIcon.classList.toggle("hidden");

            if (localStorage.getItem("color-theme")) {
                if (localStorage.getItem("color-theme") === "light") {
                    document.documentElement.classList.add("dark");
                    localStorage.setItem("color-theme", "dark");
                } else {
                    document.documentElement.classList.remove("dark");
                    localStorage.setItem("color-theme", "light");
                }
            } else {
                if (document.documentElement.classList.contains("dark")) {
                    document.documentElement.classList.remove("dark");
                    localStorage.setItem("color-theme", "light");
                } else {
                    document.documentElement.classList.add("dark");
                    localStorage.setItem("color-theme", "dark");
                }
            }
        });
    }
});
