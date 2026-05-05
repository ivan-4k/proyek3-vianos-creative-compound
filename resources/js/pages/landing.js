document.addEventListener("DOMContentLoaded", () => {
    // GSAP Registration
    if (typeof gsap !== "undefined" && typeof ScrollTrigger !== "undefined") {
        gsap.registerPlugin(ScrollTrigger);
    }

    // PREFERS-REDUCED-MOTION CHECK
    const prefersReducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)",
    ).matches;

    // THEME TOGGLE
    const themeToggleBtn = document.getElementById("themeToggleBtn");
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener("click", () => {
            const isDark = document.documentElement.classList.toggle("dark");
            localStorage.theme = isDark ? "dark" : "light";
        });
    }

    //  PRELOADER
    const preloader = document.getElementById("preloader");
    const preLine = document.getElementById("preLine");
    const preCounter = document.getElementById("preCounter");
    const preLogoEl = document.querySelector(".pre-logo");
    const preSubEl = document.querySelector(".pre-sub");

    if (preloader) {
        if (prefersReducedMotion) {
            preloader.style.display = "none";
            runHeroAnim();
        } else {
            let count = 0;
            const tick = () => {
                count = Math.min(
                    count + Math.floor(Math.random() * 12) + 3,
                    100,
                );
                preCounter.textContent = count;
                gsap.to(preLine, {
                    width: count + "%",
                    duration: 0.3,
                    ease: "power2.out",
                });

                if (count < 100) {
                    setTimeout(tick, 80);
                } else {
                    gsap.timeline({ delay: 0.3 })
                        .to([preLogoEl, preSubEl], {
                            opacity: 1,
                            duration: 0.6,
                            stagger: 0.15,
                            ease: "power3.out",
                        })
                        .to(preCounter, { opacity: 0, duration: 0.4 }, "-=.3")
                        .to(preloader, {
                            yPercent: -100,
                            duration: 1.1,
                            ease: "power4.inOut",
                            delay: 0.8,
                            onComplete: () => {
                                preloader.style.display = "none";
                                preloader.setAttribute("aria-hidden", "true");
                                runHeroAnim();
                            },
                        });
                }
            };
            tick();
        }
    } else {
        runHeroAnim();
    }

    //  HERO ANIMATION
    function runHeroAnim() {
        if (prefersReducedMotion) {
            gsap.set(
                [
                    "#heroEyebrow",
                    "#h1",
                    "#h2",
                    "#h3",
                    "#heroDesc",
                    "#heroScroll",
                    "#heroBadge",
                ],
                {
                    opacity: 1,
                    y: 0,
                },
            );
            return;
        }
        const tl = gsap.timeline({ defaults: { ease: "power4.out" } });
        tl.to("#heroEyebrow", { opacity: 1, duration: 0.8 })
            .to(
                ["#h1", "#h2", "#h3"],
                { y: 0, opacity: 1, duration: 1.1, stagger: 0.12 },
                "-=.4",
            )
            .to(
                ["#heroDesc", "#heroScroll"],
                { opacity: 1, y: 0, duration: 0.9, stagger: 0.1 },
                "-=.6",
            )
            .to("#heroBadge", { opacity: 1, duration: 0.8 }, "-=.4");
    }

    //  HORIZONTAL SCROLL
    const hInner = document.getElementById("hScrollInner");
    const panels = document.querySelectorAll(".venture-panel");
    const venturesSection = document.getElementById("ventures");
    const progressBar = document.getElementById("venturesProgress");
    const navDots = document.querySelectorAll(".ventures-nav-dot");
    const venturesNav = document.getElementById("venturesNav");

    if (hInner && !prefersReducedMotion) {
        let scrollTween = gsap.to(hInner, {
            x: () => -(hInner.scrollWidth - window.innerWidth),
            ease: "none",
            scrollTrigger: {
                trigger: venturesSection,
                start: "top top",
                end: () => `+=${hInner.scrollWidth}`,
                scrub: 1.2,
                snap: {
                    snapTo: 1 / (panels.length - 1),
                    duration: { min: 0.3, max: 0.8 },
                    delay: 0.1,
                    ease: "power2.out",
                },
                pin: true,
                anticipatePin: 1,
                invalidateOnRefresh: true,
                onEnter: () =>
                    venturesNav.classList.remove(
                        "opacity-0",
                        "pointer-events-none",
                    ),
                onLeave: () =>
                    venturesNav.classList.add(
                        "opacity-0",
                        "pointer-events-none",
                    ),
                onEnterBack: () =>
                    venturesNav.classList.remove(
                        "opacity-0",
                        "pointer-events-none",
                    ),
                onLeaveBack: () =>
                    venturesNav.classList.add(
                        "opacity-0",
                        "pointer-events-none",
                    ),
                onUpdate: (self) => {
                    progressBar.style.width = self.progress * 100 + "%";
                    const activeIdx = Math.round(
                        self.progress * (panels.length - 1),
                    );
                    navDots.forEach((d, i) =>
                        d.classList.toggle("active", i === activeIdx),
                    );
                },
            },
        });

        //  SCRAMBLE NUMBER ANIMATION
        if (!prefersReducedMotion) {
            const scrambleStats = document.querySelectorAll(".scramble-stat");

            scrambleStats.forEach((stat) => {
                const finalValue = stat.innerText.trim();
                const finalLength = finalValue.length;

                ScrollTrigger.create({
                    trigger: stat,
                    start: "top 85%",
                    once: true, // saat discroll ke bawah
                    onEnter: () => {
                        let iterations = 0;
                        const maxIterations = 20;

                        const interval = setInterval(() => {
                            if (iterations >= maxIterations) {
                                clearInterval(interval);
                                stat.innerText = finalValue;
                            } else {
                                let randomText = "";
                                const chars = "0123456789%#@*";
                                for (let i = 0; i < finalLength; i++) {
                                    randomText +=
                                        chars[
                                            Math.floor(
                                                Math.random() * chars.length,
                                            )
                                        ];
                                }
                                stat.innerText = randomText;
                            }
                            iterations++;
                        }, 40);
                    },
                });
            });
        }

        // Dot nav click
        navDots.forEach((dot, idx) => {
            const navigate = () => {
                let st = scrollTween.scrollTrigger;
                if (st) {
                    const progress = idx / (panels.length - 1);
                    const scrollTarget =
                        st.start + (st.end - st.start) * progress;
                    window.scrollTo({ top: scrollTarget, behavior: "smooth" });
                }
            };
            dot.addEventListener("click", navigate);
            dot.addEventListener("keydown", (e) => {
                if (e.key === "Enter" || e.key === " ") {
                    e.preventDefault();
                    navigate();
                }
            });
        });
    }

    //  SCROLL REVEALS
    if (!prefersReducedMotion && document.querySelector(".reveal")) {
        gsap.utils.toArray(".reveal").forEach((el) => {
            gsap.fromTo(
                el,
                { opacity: 0, y: 50 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 1,
                    ease: "power3.out",
                    scrollTrigger: {
                        trigger: el,
                        start: "top 85%",
                        toggleActions: "play none none none",
                    },
                },
            );
        });

        document
            .querySelectorAll(".compound-headline > div > span")
            .forEach((el, i) => {
                gsap.fromTo(
                    el,
                    { y: "100%" },
                    {
                        y: "0%",
                        duration: 1.1,
                        ease: "power4.out",
                        delay: i * 0.12,
                        scrollTrigger: {
                            trigger: ".compound-headline",
                            start: "top 80%",
                            toggleActions: "play none none none",
                        },
                    },
                );
            });

        // Pastikan SplitType sudah ter-load
        if (typeof SplitType !== "undefined") {
            const manifestoSplit = new SplitType(".manifesto-text", {
                types: "words",
            });

            gsap.fromTo(
                manifestoSplit.words,
                { opacity: 0, y: 30 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    stagger: 0.15,
                    ease: "power3.out",
                    scrollTrigger: {
                        trigger: "#manifesto",
                        start: "top 75%",
                        toggleActions: "play none none none",
                    },
                },
            );
        }
    } else {
        gsap.set(".reveal", { opacity: 1, y: 0 });
        gsap.set(".compound-headline > div > span", { y: "0%" });
        gsap.set(".manifesto-text", { opacity: 1, y: 0 });
    }

    //  MOBILE MENU
    const mobileMenuBtn = document.getElementById("mobileMenuBtn");
    const mobileMenu = document.getElementById("mobileMenu");
    const mobileMenuIcon = document.getElementById("mobileMenuIcon");
    const mobileLinks = document.querySelectorAll(".mobile-link");

    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener("click", () => {
            const isOpen = mobileMenu.classList.contains("opacity-100");
            if (isOpen) {
                mobileMenu.classList.remove(
                    "opacity-100",
                    "pointer-events-auto",
                );
                mobileMenu.classList.add("opacity-0", "pointer-events-none");
                mobileMenu.setAttribute("aria-hidden", "true");
                mobileMenuIcon.setAttribute("d", "M4 6h16M4 12h16M4 18h16");
            } else {
                mobileMenu.classList.add("opacity-100", "pointer-events-auto");
                mobileMenu.classList.remove("opacity-0", "pointer-events-none");
                mobileMenu.setAttribute("aria-hidden", "false");
                mobileMenuIcon.setAttribute("d", "M6 18L18 6M6 6l12 12");
            }
        });

        mobileLinks.forEach((link) => {
            link.addEventListener("click", () => {
                mobileMenu.classList.remove(
                    "opacity-100",
                    "pointer-events-auto",
                );
                mobileMenu.classList.add("opacity-0", "pointer-events-none");
                mobileMenu.setAttribute("aria-hidden", "true");
                mobileMenuIcon.setAttribute("d", "M4 6h16M4 12h16M4 18h16");
            });
        });
    }

    //  CURSOR and MAGNETIC PULL
    const cur = document.getElementById("cur");
    const isTouch = "ontouchstart" in window || navigator.maxTouchPoints > 0;

    if (cur && !isTouch) {
        cur.style.display = "block";

        let mx = 0,
            my = 0,
            cx = 0,
            cy = 0;
        let rafId = null;

        document.addEventListener(
            "mousemove",
            (e) => {
                mx = e.clientX;
                my = e.clientY;
            },
            { passive: true },
        );

        const loop = () => {
            cx += (mx - cx) * 0.14;
            cy += (my - cy) * 0.14;
            cur.style.left = cx + "px";
            cur.style.top = cy + "px";
            rafId = requestAnimationFrame(loop);
        };
        rafId = requestAnimationFrame(loop);

        document.querySelectorAll("a, button").forEach((el) => {
            el.addEventListener("mouseenter", () => cur.classList.add("big"));
            el.addEventListener("mouseleave", () =>
                cur.classList.remove("big"),
            );
        });

        document.querySelectorAll(".magnetic-target").forEach((target) => {
            target.addEventListener("mouseenter", () =>
                cur.classList.add("big"),
            );
            target.addEventListener("mouseleave", () => {
                cur.classList.remove("big");
                gsap.to(target, {
                    x: 0,
                    y: 0,
                    duration: 0.6,
                    ease: "elastic.out(1, 0.3)",
                });
            });
            target.addEventListener("mousemove", (e) => {
                const rect = target.getBoundingClientRect();
                const relX = e.clientX - rect.left - rect.width / 2;
                const relY = e.clientY - rect.top - rect.height / 2;
                gsap.to(target, {
                    x: relX * 0.35,
                    y: relY * 0.35,
                    duration: 0.3,
                    ease: "power2.out",
                });
            });
        });

        document.addEventListener("mousedown", () => {
            cur.style.transform = "translate(-50%,-50%) scale(.7)";
        });
        document.addEventListener("mouseup", () => {
            cur.style.transform = "translate(-50%,-50%) scale(1)";
        });
        document.addEventListener("mouseleave", () =>
            gsap.to(cur, { opacity: 0, duration: 0.3 }),
        );
        document.addEventListener("mouseenter", () =>
            gsap.to(cur, { opacity: 1, duration: 0.3 }),
        );

        document.addEventListener("visibilitychange", () => {
            if (document.hidden) {
                cancelAnimationFrame(rafId);
            } else {
                rafId = requestAnimationFrame(loop);
            }
        });
    }
});