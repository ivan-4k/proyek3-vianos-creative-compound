import PhotoSwipe from "photoswipe";
import PhotoSwipeLightbox from "photoswipe/lightbox";
import "photoswipe/dist/photoswipe.css";

let photoSwipeLightbox = null;

function initializePhotoSwipe() {
    // Cari gallery yang aktif (mobile atau desktop)
    const gallery = document.querySelector(
        ".ps-gallery-mobile, .ps-gallery-desktop",
    );

    if (!gallery) return;

    // Destroy existing instance
    if (photoSwipeLightbox) {
        photoSwipeLightbox.destroy();
        photoSwipeLightbox = null;
    }

    photoSwipeLightbox = new PhotoSwipeLightbox({
        gallery: ".ps-gallery-mobile, .ps-gallery-desktop",
        children: "a",
        pswpModule: PhotoSwipe,
        showHideAnimationType: "zoom",
        bgOpacity: 0.9,
        padding: { top: 20, bottom: 20, left: 20, right: 20 },
    });

    // Custom caption
    photoSwipeLightbox.on("uiRegister", function () {
        photoSwipeLightbox.pswp.ui.registerElement({
            name: "custom-caption",
            order: 9,
            isButton: false,
            appendTo: "root",
            html: "",
            onInit: (el, pswp) => {
                pswp.on("change", () => {
                    const caption = pswp.currSlide.data.caption || "";
                    el.innerHTML = caption;
                });
            },
        });
    });

    photoSwipeLightbox.init();
}

// Auto initialize
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initializePhotoSwipe);
} else {
    initializePhotoSwipe();
}
