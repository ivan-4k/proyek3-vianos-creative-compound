import AOS from "aos";
import "aos/dist/aos.css";

window.addEventListener("load", () => {
    AOS.init({
        duration: 800,
        once: true,
        offset: 100,
        delay: 0,
        easing: "ease-out",
    });
    AOS.refresh();
});
