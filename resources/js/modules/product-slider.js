import Swiper from "swiper";
import { Navigation, Pagination, Autoplay } from "swiper/modules";

// Import CSS Swiper
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

document.addEventListener("DOMContentLoaded", function () {
    // Destroy existing instance jika ada
    if (window.mySwiper) {
        window.mySwiper.destroy(true, true);
    }

    // Inisialisasi dengan modular imports
    window.mySwiper = new Swiper(".mySwiper", {
        modules: [Navigation, Pagination, Autoplay],

        slidesPerView: 1,
        spaceBetween: 16,
        loop: true,
        loopedSlides: 3, // Sesuaikan dengan jumlah slide Anda
        speed: 500,

        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },

        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },

        navigation: {
            nextEl: ".swiper-nav-next",
            prevEl: ".swiper-nav-prev",
        },

        on: {
            init: function () {
                updatePaginationStyle(this);
            },
            slideChange: function () {
                updatePaginationStyle(this);
            },
        },
    });

    function updatePaginationStyle(swiper) {
        if (!swiper) return;

        document
            .querySelectorAll(".swiper-pagination-bullet")
            .forEach((bullet, index) => {
                if (index === swiper.realIndex) {
                    bullet.style.backgroundColor = "#BC430D";
                    bullet.style.width = "2rem";
                    bullet.style.borderRadius = "1rem";
                } else {
                    bullet.style.backgroundColor = "#9CA3AF";
                    bullet.style.width = "0.75rem";
                    bullet.style.borderRadius = "9999px";
                }
            });
    }
});
