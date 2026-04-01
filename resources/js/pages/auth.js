import "../../css/pages/auth.css";
import "../../css/components/navigation.css";
import "../plugins/flowbite-init";

document.addEventListener("DOMContentLoaded", function () {
    // ========== TOGGLE PASSWORD ==========
    // Toggle untuk password utama (login, register, reset password)
    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener("click", function () {
            const type =
                passwordInput.getAttribute("type") === "password"
                    ? "text"
                    : "password";
            passwordInput.setAttribute("type", type);
            const icon = this.querySelector("i");
            icon.classList.toggle("fa-eye-slash");
            icon.classList.toggle("fa-eye");
        });
    }

    // Toggle untuk confirm password (register, reset password)
    // Coba kedua kemungkinan ID agar kompatibel dengan semua halaman
    const toggleConfirm =
        document.getElementById("toggleConfirmPassword") ||
        document.getElementById("togglePasswordConfirmation");
    const confirmInput = document.getElementById("password_confirmation");

    if (toggleConfirm && confirmInput) {
        toggleConfirm.addEventListener("click", function () {
            const type =
                confirmInput.getAttribute("type") === "password"
                    ? "text"
                    : "password";
            confirmInput.setAttribute("type", type);
            const icon = this.querySelector("i");
            icon.classList.toggle("fa-eye-slash");
            icon.classList.toggle("fa-eye");
        });
    }

    // ========== PASSWORD STRENGTH INDICATOR ==========
    // Hanya untuk halaman reset password
    const strengthText = document.getElementById("strength-text");
    const strengthBars = {
        1: document.getElementById("strength-1"),
        2: document.getElementById("strength-2"),
        3: document.getElementById("strength-3"),
    };

    // Cek apakah elemen strength indicator ada di halaman
    if (passwordInput && strengthText && strengthBars[1]) {
        passwordInput.addEventListener("input", function () {
            const password = this.value;
            let strength = 0;

            if (password.length === 0) {
                strengthText.textContent = "Belum dimasukkan";
                strengthText.className = "text-amber-300 font-medium";
                resetStrengthBars();
                return;
            }

            // Cek kriteria password
            if (password.length >= 8) strength += 1;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 1;
            if (/[0-9]/.test(password) && /[^a-zA-Z0-9]/.test(password))
                strength += 1;

            // Update tampilan berdasarkan strength
            const strengthLevels = ["Lemah", "Cukup", "Baik", "Kuat"];
            const strengthColors = [
                "text-red-400",
                "text-yellow-400",
                "text-amber-400",
                "text-green-400",
            ];
            const barColors = [
                "bg-red-500",
                "bg-yellow-500",
                "bg-amber-500",
                "bg-green-500",
            ];

            if (strength === 0) {
                strengthText.textContent = strengthLevels[0];
                strengthText.className = `${strengthColors[0]} font-medium`;
                updateStrengthBars(1, barColors[0]);
            } else {
                strengthText.textContent = strengthLevels[strength];
                strengthText.className = `${strengthColors[strength]} font-medium`;
                updateStrengthBars(strength, barColors[strength - 1]);
            }
        });

        function resetStrengthBars() {
            for (let i = 1; i <= 3; i++) {
                if (strengthBars[i]) {
                    strengthBars[i].className =
                        "flex-1 rounded-full bg-amber-800/30";
                }
            }
        }

        function updateStrengthBars(level, color) {
            for (let i = 1; i <= 3; i++) {
                if (strengthBars[i]) {
                    if (i <= level) {
                        strengthBars[i].className =
                            `flex-1 rounded-full ${color}`;
                    } else {
                        strengthBars[i].className =
                            "flex-1 rounded-full bg-amber-800/30";
                    }
                }
            }
        }
    }

    // ========== HANDLE AUTOFILL ==========
    const inputs = document.querySelectorAll("input");
    inputs.forEach((input) => {
        input.addEventListener("animationstart", function (e) {
            if (e.animationName.includes("autofill")) {
                this.classList.add("autofill-active");
            }
        });
    });
});
