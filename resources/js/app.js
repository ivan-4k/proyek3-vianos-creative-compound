import "flowbite";
import "./bootstrap";
import "./product-slider.js";

import Alpine from "alpinejs";
import AOS from "aos";
import "aos/dist/aos.css";

// Inisialisasi AlpineJS
window.Alpine = Alpine;
Alpine.start();

// Inisialisasi AOS
document.addEventListener("DOMContentLoaded", function () {
    AOS.init({
        duration: 800,
        once: true,
        offset: 100,
        delay: 0,
        easing: "ease-out",
    });
    AOS.refresh();
});


document.addEventListener("alpine:init", () => {
    Alpine.store("app", {
        // Global state bisa ditambahkan
        isMenuOpen: false,
        toggleMenu() {
            this.isMenuOpen = !this.isMenuOpen;
        },
    });
});
