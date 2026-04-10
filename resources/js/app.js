import "./bootstrap";
import Alpine from "alpinejs";
import collapse from '@alpinejs/collapse';

// IMPORT COMPONENT
import profileForm from "./pages/profile.js";

window.Alpine = Alpine;

Alpine.plugin(collapse);

// REGISTER COMPONENT
Alpine.data("profileForm", profileForm);

// START
Alpine.start();

// Global store
document.addEventListener("alpine:init", () => {
    Alpine.store("app", {
        isMenuOpen: false,
        toggleMenu() {
            this.isMenuOpen = !this.isMenuOpen;
        },
    });
});