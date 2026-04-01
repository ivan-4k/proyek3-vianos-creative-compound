import "./bootstrap";
import Alpine from "alpinejs";

// Inisialisasi AlpineJS
window.Alpine = Alpine;
Alpine.start();

// Global store
document.addEventListener("alpine:init", () => {
    Alpine.store("app", {
        // Global state bisa ditambahkan
        isMenuOpen: false,
        toggleMenu() {
            this.isMenuOpen = !this.isMenuOpen;
        },
    });
});
