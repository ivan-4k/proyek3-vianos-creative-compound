<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <meta name="description"
    content="Vianos Creative Compound — Coffee, Sports, Billiard. Satu destinasi, tiga pengalaman premium di Indramayu.">

  {{-- SEO & Open Graph --}}
  <meta property="og:title" content="Vianos Creative Compound — The Fluid Compound">
  <meta property="og:description"
    content="Satu destinasi, tiga pengalaman premium. Coffee, Sports, Billiard di Indramayu.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url('/') }}">

  <meta property="og:image" content="{{ asset('images/default/vianos_hero_bg.webp') }}">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:locale" content="id_ID">
  <meta property="og:site_name" content="Vianos Creative Compound">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Vianos Creative Compound — The Fluid Compound">
  <meta name="twitter:description"
    content="Satu destinasi, tiga pengalaman premium. Coffee, Sports, Billiard di Indramayu.">
  <meta name="twitter:image" content="{{ asset('images/default/vianos_hero_bg.webp') }}">
  <link rel="canonical" href="{{ url('/') }}">
  <link rel="icon" type="image/x-icon" href="/logo.ico">
  <title>Vianos Creative Compound — The Fluid Compound</title>

  {{-- Font Preconnect --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400&family=Unbounded:wght@300;400;700;900&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;1,9..40,300&display=swap"
    rel="stylesheet">

  {{-- Font Awesome CDN --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  {{-- Theme Script --}}
  <script>
    if (localStorage.theme === 'light' || (!('theme' in localStorage) && window.matchMedia(
        '(prefers-color-scheme: light)').matches)) {
      document.documentElement.classList.remove('dark');
    } else {
      document.documentElement.classList.add('dark');
    }
  </script>

  {{-- GSAP --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>
  <script src="https://unpkg.com/split-type" defer></script>
  @vite(['resources/css/landing.css', 'resources/css/app.css', 'resources/js/app.js', 'resources/js/pages/landing.js'])
</head>

<body class="bg-ink text-paper font-body">
  <!-- Noise -->
  <div class="noise-overlay" aria-hidden="true"></div>
  <!-- Custom Cursor (hidden via CSS di mobile) -->
  <div id="cur" class="cursor-dot" aria-hidden="true"></div>
  <!-- Ventures Nav Dots -->
  <div
    class="fixed bottom-10 right-10 z-[500] flex-col gap-2 opacity-0 transition-opacity duration-400 pointer-events-none flex"
    id="venturesNav" aria-label="Navigasi panel venue" role="tablist">
    <div class="ventures-nav-dot active" data-idx="0" role="tab" aria-label="Seven Coffee" tabindex="0">
    </div>
    <div class="ventures-nav-dot" data-idx="1" role="tab" aria-label="Vianos Club" tabindex="0"></div>
    <div class="ventures-nav-dot" data-idx="2" role="tab" aria-label="Seven Dragon" tabindex="0"></div>
  </div>

  <!-- PRELOADER -->
  <div id="preloader"
    class="fixed inset-0 bg-ink z-[99998] flex flex-col items-center justify-center overflow-hidden transition-colors duration-300"
    aria-hidden="true">

    <!-- Garis Loading -->
    <div class="absolute h-[1.5px] bg-paper top-1/2 left-0 transition-colors duration-300" id="preLine"
      style="width: 0%;"></div>

    <!-- Counter Angka -->
    <div
      class="absolute font-mono text-[clamp(80px,18vw,200px)] text-transparent [-webkit-text-stroke:2px_rgb(var(--color-paper)/0.15)] select-none transition-colors duration-300"
      id="preCounter">0</div>

    <!-- Teks Logo -->
    <div
      class="pre-logo font-display font-black text-[clamp(14px,2.5vw,28px)] tracking-[.3em] uppercase text-paper opacity-0 relative z-10 transition-colors duration-300">
      Vianos Creative Compound</div>

    <!-- Subteks -->
    <div
      class="pre-sub font-mono text-[11px] tracking-[.3em] text-mist mt-3 opacity-0 relative z-10 transition-colors duration-300">
      Est. Indramayu — Creative Space
    </div>
  </div>

  <!-- NAV -->
  <nav
    class="fixed top-0 left-0 w-full z-[1000] p-6 md:p-7 px-6 md:px-10 flex justify-between items-center mix-blend-difference pointer-events-none"
    aria-label="Navigasi utama">
    <div
      class="font-display font-black text-[clamp(13px,1.8vw,18px)] tracking-[.2em] uppercase text-white pointer-events-auto leading-tight">
      Vianos<br>Compound
    </div>
    <div class="flex items-center gap-8 pointer-events-auto">
      <ul class="hidden md:flex gap-10 list-none" role="list">
        <li><a href="#ventures"
            class="font-mono text-[11px] tracking-[.2em] uppercase text-white no-underline transition-opacity duration-200 hover:opacity-50"
            aria-label="Lihat venue kami">Venues</a></li>
        <li><a href="#manifesto"
            class="font-mono text-[11px] tracking-[.2em] uppercase text-white no-underline transition-opacity duration-200 hover:opacity-50"
            aria-label="Baca manifesto kami">Manifesto</a></li>
        <li><a href="#info"
            class="font-mono text-[11px] tracking-[.2em] uppercase text-white no-underline transition-opacity duration-200 hover:opacity-50"
            aria-label="Info kunjungan dan kontak">Kunjungi</a></li>
      </ul>
      <button id="themeToggleBtn" class="p-2 text-white opacity-70 hover:opacity-100 transition-opacity magnetic-target"
        aria-label="Toggle theme">
        <!-- Sun icon (shows in dark mode) -->
        <i class="fa-solid fa-sun hidden dark:block text-[20px]"></i>
        <!-- Moon icon (shows in light mode) -->
        <i class="fa-solid fa-moon block dark:hidden text-[20px]"></i>
      </button>
      <!-- Mobile Menu Toggle -->
      <button id="mobileMenuBtn" class="md:hidden p-2 text-white opacity-70 hover:opacity-100 transition-opacity"
        aria-label="Toggle mobile menu">
        <i id="mobileMenuIcon" class="fa-solid fa-bars text-[24px]"></i>
      </button>
    </div>
  </nav>

  <!-- Mobile Menu Overlay -->
  <div id="mobileMenu"
    class="fixed inset-0 bg-ink z-[990] flex flex-col justify-center items-center opacity-0 pointer-events-none transition-opacity duration-300"
    aria-hidden="true">
    <ul class="flex flex-col gap-10 list-none text-center" role="list">
      <li><a href="#ventures"
          class="mobile-link font-display font-black text-4xl tracking-widest uppercase text-paper no-underline"
          aria-label="Lihat venue kami">Venues</a></li>
      <li><a href="#manifesto"
          class="mobile-link font-display font-black text-4xl tracking-widest uppercase text-paper no-underline"
          aria-label="Baca manifesto kami">Manifesto</a></li>
      <li><a href="#info"
          class="mobile-link font-display font-black text-4xl tracking-widest uppercase text-paper no-underline"
          aria-label="Info kunjungan dan kontak">Kunjungi</a></li>
    </ul>
  </div>

  <!-- HERO -->
  <section id="hero"
    class="h-[100svh] relative overflow-hidden flex flex-col justify-end p-6 md:p-10 pb-12 md:pb-15 text-white"
    aria-label="Hero Vianos Creative Compound">
    <div class="absolute inset-0 bg-ink overflow-hidden" aria-hidden="true">
      <div class="hero-bg-image"></div>
      <div class="hero-vignette"></div>
    </div>

    <div
      class="hidden md:flex absolute top-[140px] right-[60px] w-[120px] h-[120px] rounded-full border border-white/15 flex-col items-center justify-center gap-1 opacity-0"
      id="heroBadge" aria-hidden="true">
      <svg viewBox="0 0 120 120" class="absolute w-full h-full animate-spin-slow">
        <defs>

          <path id="tc" d="M 60,60 m -40,0 a 40,40 0 1,1 80,0 a 40,40 0 1,1 -80,0" />

        </defs>
        <text font-family="Space Mono" font-size="9.5" fill="rgba(255,255,255,0.35)" letter-spacing="3">
          <textPath href="#tc">COFFEE · SPORTS · BILLIARD · LOUNGE ·</textPath>
        </text>
      </svg>
      <div class="font-mono text-[9px] tracking-[.2em] uppercase text-mist text-center leading-[1.6] relative z-10">
        3<br>VENUES</div>
    </div>

    <div
      class="font-mono text-[11px] tracking-[.35em] uppercase text-brand mb-6 opacity-0 flex items-center gap-4 decor-line-brand relative z-10"
      id="heroEyebrow">Creative Compound — Indramayu</div>

    <h1
      class="font-display font-black text-[clamp(52px,11vw,160px)] leading-[.85] tracking-[-.02em] uppercase overflow-hidden relative z-10">
      <span class="block translate-y-[110%] opacity-0" id="h1">VIANOS</span>
      <span class="block translate-y-[110%] opacity-0 text-stroke-white" id="h2">CREATIVE</span>
      <span class="block translate-y-[110%] opacity-0 text-brand" id="h3">COMPOUND</span>
    </h1>

    <div class="mt-12 flex items-end justify-between gap-6 flex-wrap relative z-10">
      <p class="font-body text-[clamp(14px,1.6vw,18px)] font-light leading-[1.7] text-white/70 max-w-[480px] opacity-0 translate-y-5"
        id="heroDesc">
        Satu tempat. Tiga pengalaman. Tempat bertumbuh, bergerak, dan bersenang-senang — di jantung kota
        kreativitas.
      </p>
      <div class="font-mono text-[10px] tracking-[.3em] uppercase text-mist flex items-center gap-3 opacity-0"
        id="heroScroll" aria-hidden="true">
        <div class="w-12 h-px bg-mist relative overflow-hidden scroll-line"></div>
        <span>Scroll</span>
      </div>
    </div>
  </section>

  <!-- TICKER -->
  <div class="bg-brand py-4 overflow-hidden whitespace-nowrap relative z-10" aria-hidden="true">
    <div class="inline-flex gap-0 animate-ticker">
      <span
        class="font-display font-bold text-[13px] tracking-[.15em] uppercase text-ink px-10 flex items-center gap-10 ticker-item">Seven
        Coffee</span>
      <span
        class="font-display font-bold text-[13px] tracking-[.15em] uppercase text-ink px-10 flex items-center gap-10 ticker-item">Vianos
        Club</span>
      <span
        class="font-display font-bold text-[13px] tracking-[.15em] uppercase text-ink px-10 flex items-center gap-10 ticker-item">Seven
        Dragon</span>
      <span
        class="font-display font-bold text-[13px] tracking-[.15em] uppercase text-ink px-10 flex items-center gap-10 ticker-item">Creative
        Space</span>
      <span
        class="font-display font-bold text-[13px] tracking-[.15em] uppercase text-ink px-10 flex items-center gap-10 ticker-item">Indramayu</span>
      <span
        class="font-display font-bold text-[13px] tracking-[.15em] uppercase text-ink px-10 flex items-center gap-10 ticker-item">Seven
        Coffee</span>
      <span
        class="font-display font-bold text-[13px] tracking-[.15em] uppercase text-ink px-10 flex items-center gap-10 ticker-item">Vianos
        Club</span>
      <span
        class="font-display font-bold text-[13px] tracking-[.15em] uppercase text-ink px-10 flex items-center gap-10 ticker-item">Seven
        Dragon</span>
      <span
        class="font-display font-bold text-[13px] tracking-[.15em] uppercase text-ink px-10 flex items-center gap-10 ticker-item">Creative
        Space</span>
      <span
        class="font-display font-bold text-[13px] tracking-[.15em] uppercase text-ink px-10 flex items-center gap-10 ticker-item">Indramayu</span>
    </div>
  </div>

  <!-- COMPOUND INTRO -->
  <section id="compound"
    class="px-6 md:px-10 pt-[100px] md:pt-[160px] pb-20 md:pb-[120px] relative overflow-clip bg-ink"
    aria-label="Tentang kami">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-20 items-start relative">

      <!-- KOLOM KIRI (Sticky Text) -->
      <div class="md:sticky md:top-[140px] h-fit flex flex-col gap-8 md:gap-12">
        <div class="font-mono text-[11px] tracking-[.3em] text-mist flex items-center gap-4 decor-line-mist reveal">
          01 / TENTANG KAMI
        </div>

        <h2
          class="compound-headline font-display font-black text-clamp-hero leading-[.9] tracking-[-.02em] uppercase overflow-hidden">
          <div class="block overflow-hidden"><span class="block translate-y-full">SATU</span></div>
          <div class="block overflow-hidden"><span class="block translate-y-full text-stroke-thin">EKOSISTEM,</span>
          </div>
          <div class="block overflow-hidden"><span class="block translate-y-full">TAK TERBATAS</span></div>
        </h2>

        <p class="text-[clamp(15px,1.8vw,20px)] font-light leading-[1.8] text-paper/65 reveal md:max-w-[85%]">
          Vianos Creative Compound bukan sekadar tempat. Ini adalah <strong class="text-paper font-normal">ekosistem
            urban</strong> yang dirancang untuk generasi yang menolak bosan — di mana secangkir kopi bisa
          jadi
          awal
          kolaborasi, keringat di lapangan jadi energi baru, dan malam di meja billiard jadi cerita yang
          dikenang.
        </p>
      </div>

      <!-- KOLOM KANAN (Scrolling Stats) -->
      <div class="flex flex-col gap-16 md:gap-[25vh] md:py-[10vh]">

        <div class="border-t border-paper/10 py-6 flex justify-between items-baseline gap-4 reveal">
          <div class="scramble-stat font-display font-black text-[clamp(48px,6vw,80px)] text-paper">3</div>
          <div class="font-mono text-[10px] tracking-[.25em] uppercase text-mist text-right">
            Venue<br>Unggulan</div>
        </div>

        <div class="border-t border-paper/10 py-6 flex justify-between items-baseline gap-4 reveal">
          <div class="scramble-stat font-display font-black text-[clamp(48px,6vw,80px)] text-paper">1</div>
          <div class="font-mono text-[10px] tracking-[.25em] uppercase text-mist text-right">
            Studio<br>sevapotrait
          </div>
        </div>

        <div class="border-t border-paper/10 py-6 flex justify-between items-baseline gap-4 reveal">
          <div class="scramble-stat font-display font-black text-[clamp(48px,6vw,80px)] text-paper">0</div>
          <div class="font-mono text-[10px] tracking-[.25em] uppercase text-mist text-right">Ruang<br>Bosan
          </div>
        </div>

        <div class="border-t border-paper/10 py-6 flex justify-between items-baseline gap-4 reveal">
          <div class="scramble-stat font-display font-black text-[clamp(48px,6vw,80px)] text-paper">2025
          </div>
          <div class="font-mono text-[10px] tracking-[.25em] uppercase text-mist text-right">Sejak<br>26
            April</div>
        </div>

        <div class="border-y border-paper/10 py-6 flex justify-between items-baseline gap-4 reveal">
          <div class="scramble-stat font-display font-black text-[clamp(48px,6vw,80px)] text-paper">∞</div>
          <div class="font-mono text-[10px] tracking-[.25em] uppercase text-mist text-right">Alasan<br>untuk
            Kembali</div>
        </div>
      </div>

    </div>
  </section>


  <div id="ventures" class="relative bg-ink" aria-label="Venue kami">

    {{-- Horizontal Scroll Container --}}
    <div class="h-[100dvh] overflow-hidden h-scroll-outer">
      <div class="flex w-[300vw] h-full h-scroll-inner" id="hScrollInner">

        <!-- Panel 1: Seven Coffee -->
        <article
          class="relative overflow-hidden w-screen h-full shrink-0 flex flex-col justify-end p-6 md:p-[60px] pb-16 md:pb-[80px] bg-[#0c0c0c] venture-panel panel-coffee"
          aria-label="Seven Coffee">
          <div class="panel-coffee-bg" aria-hidden="true"></div>
          <div class="panel-overlay-bottom" aria-hidden="true"></div>
          <div class="panel-overlay-left" aria-hidden="true"></div>
          <div class="panel-bignum" aria-hidden="true">01</div>
          <div
            class="absolute top-[100px] md:top-[60px] right-6 md:right-[60px] font-mono text-[11px] tracking-[.3em] text-paper/25"
            aria-hidden="true">01 / 03</div>

          <div class="relative z-10">
            <!-- Update Label sevapotrait -->
            <div class="inline-flex items-center gap-2.5 font-mono text-[10px] tracking-[.3em] uppercase mb-5">
              <div class="w-1.5 h-1.5 rounded-full bg-brand tag-dot" aria-hidden="true"></div>
              Coffee · Workspace · sevapotrait
            </div>
            <h2
              class="font-display font-black text-[clamp(48px,9vw,130px)] leading-[.85] tracking-[-.03em] uppercase relative z-10">
              <span class="block">Seven</span>
              <span class="block text-stroke-paper-subtle text-stroke-brand">Coffee</span>
            </h2>
          </div>

          <div class="flex justify-between items-end gap-6 relative z-10 mt-8 flex-wrap">
            <!-- Update Deskripsi sevapotrait -->
            <p class="text-[clamp(13px,1.4vw,16px)] font-light leading-[1.7] text-paper/55 max-w-[360px]">
              Kopi single origin, ruang yang menginspirasi, WiFi yang tidak pernah mati, dan sudut
              photobooth

              <!-- HOVER TARGET -->
              <span
                class="relative inline-block group cursor-pointer text-paper font-medium border-b border-paper/30 pb-[1px] hover:border-paper transition-colors duration-300">
                sevapotrait

                <!-- FLOATING POLAROID (Ukuran Diperbesar) -->
                <span
                  class="absolute bottom-[calc(100%+16px)] left-1/2 -translate-x-1/2 w-[220px] pointer-events-none opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-400 ease-out z-[9999]">

                  <!-- Efek Glassmorphism dan Glow Tipis -->
                  <span
                    class="block relative bg-white/5 backdrop-blur-md border border-white/10 rounded-md p-3 pb-10 shadow-[0_15px_40px_rgba(0,0,0,0.8)] before:absolute before:inset-0 before:-z-10 before:rounded-md before:shadow-[0_0_25px_rgba(255,255,255,0.15)]">

                    <!-- Foto Preview -->
                    <img src="/images/default/sevapotrait.webp" alt="Sevapotrait"
                      class="w-full aspect-[3/4] object-cover rounded-[4px] grayscale-[40%] group-hover:grayscale-0 transition-all duration-500">

                    <!-- Label Bawah Polaroid -->
                    <span
                      class="absolute bottom-3.5 left-0 w-full text-center font-mono text-[10px] tracking-[.4em] uppercase dark:text-white">
                      Sevapotrait Studio
                    </span>
                  </span>
                </span>
              </span>

              untuk mengabadikan momen. Tempat di mana ide-ide besar lahir sambil ngopi.
            </p>
            <a href="{{ route('home') }}" class="panel-cta magnetic-target"
              aria-label="Lihat menu Seven Coffee">Lihat Menu
              ↗</a>
          </div>
        </article>

        <!-- Panel 2: Vianos Club -->
        <article
          class="relative overflow-hidden w-screen h-full shrink-0 flex flex-col justify-end p-6 md:p-[60px] pb-16 md:pb-[80px] bg-[#080810] venture-panel panel-club"
          aria-label="Vianos Club">
          <div class="panel-club-bg" aria-hidden="true"></div>
          <div class="panel-overlay-bottom" aria-hidden="true"></div>
          <div class="panel-overlay-left" aria-hidden="true"></div>
          <div class="panel-bignum" aria-hidden="true">02</div>
          <div
            class="absolute top-[100px] md:top-[60px] right-6 md:right-[60px] font-mono text-[11px] tracking-[.3em] text-paper/25"
            aria-hidden="true">02 / 03</div>

          <div class="relative z-10">
            <div class="inline-flex items-center gap-2.5 font-mono text-[10px] tracking-[.3em] uppercase mb-5">
              <div class="w-1.5 h-1.5 rounded-full tag-dot" aria-hidden="true"></div>
              Badminton &amp; Futsal
            </div>
            <h2
              class="font-display font-black text-[clamp(48px,9vw,130px)] leading-[.85] tracking-[-.03em] uppercase relative z-10">
              <span class="block">Vianos</span>
              <span class="block text-stroke-paper-subtle text-stroke-blue">Club</span>
            </h2>
          </div>

          <div class="flex justify-between items-end gap-6 relative z-10 mt-8 flex-wrap">
            <p class="text-[clamp(13px,1.4vw,16px)] font-light leading-[1.7] text-paper/55 max-w-[360px]">
              Lapangan
              standar profesional untuk badminton dan futsal. Booking mudah, fasilitas premium, kompetisi
              seru setiap
              minggu.</p>
            <a href="#" class="panel-cta magnetic-target" aria-label="Booking lapangan Vianos Club">Booking
              Lapangan ↗</a>
          </div>
        </article>

        <!-- Panel 3: Seven Dragon -->
        <article
          class="relative overflow-hidden w-screen h-full shrink-0 flex flex-col justify-end p-6 md:p-[60px] pb-16 md:pb-[80px] bg-[#100808] venture-panel panel-dragon"
          aria-label="Seven Dragon">
          <div class="panel-dragon-bg" aria-hidden="true"></div>
          <div class="panel-overlay-bottom" aria-hidden="true"></div>
          <div class="panel-overlay-left" aria-hidden="true"></div>
          <div class="panel-bignum" aria-hidden="true">03</div>
          <div
            class="absolute top-[100px] md:top-[60px] right-6 md:right-[60px] font-mono text-[11px] tracking-[.3em] text-paper/25"
            aria-hidden="true">03 / 03</div>

          <div class="relative z-10">
            <div class="inline-flex items-center gap-2.5 font-mono text-[10px] tracking-[.3em] uppercase mb-5">
              <div class="w-1.5 h-1.5 rounded-full tag-dot" aria-hidden="true"></div>
              Billiard &amp; Lounge
            </div>
            <h2
              class="font-display font-black text-[clamp(48px,9vw,130px)] leading-[.85] tracking-[-.03em] uppercase relative z-10">
              <span class="block">Seven</span>
              <span class="block text-stroke-paper-subtle text-stroke-blood">Dragon</span>
            </h2>
          </div>

          <div class="flex justify-between items-end gap-6 relative z-10 mt-8 flex-wrap">
            <p class="text-[clamp(13px,1.4vw,16px)] font-light leading-[1.7] text-paper/55 max-w-[360px]">
              Meja billiard
              premium, atmosfer sinematik, dan minuman pilihan. Malam terbaik dimulai di sini — dengan
              permainan yang
              makin tajam.</p>
            <a href="#" class="panel-cta magnetic-target" aria-label="Bermain di Seven Dragon">Main
              Sekarang
              ↗</a>
          </div>
        </article>

      </div>
      <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-brand transition-none" id="venturesProgress"
        aria-hidden="true"></div>
    </div>
  </div>

  <!-- MANIFESTO -->
  <section id="manifesto" class="bg-brand text-ink py-20 md:py-[120px] px-6 md:px-10 overflow-hidden relative"
    aria-label="Manifesto kami">
    <div
      class="font-mono text-[10px] tracking-[.4em] uppercase text-black/50 mb-[60px] flex items-center gap-4 decor-line-dark">
      02 / Manifesto</div>

    <p
      class="font-display font-light text-[clamp(28px,4.5vw,64px)] leading-[1.2] tracking-[-.01em] max-w-[1200px] manifesto-text">
      Kami percaya bahwa <em>kreativitas</em> butuh ruang untuk bernafas.<br>
      Bukan sekedar tempat nongkrong —<br>
      tapi arena di mana <em>energi</em> bertemu <em>komunitas</em>,<br>
      dan setiap kunjungan selalu terasa luar biasa.
    </p>

    <div class="mt-20 flex justify-between items-end flex-wrap gap-8">
      <div class="font-mono text-[11px] tracking-[.3em] text-black/40">Vianos Creative Compound &copy;
        <script>
          document.write(new Date().getFullYear())
        </script>
      </div>
      <div class="font-display font-black text-[clamp(18px,3vw,40px)] tracking-[.05em] leading-none">VCC</div>
    </div>
  </section>

  <!-- INFO -->
  <section id="info" class="bg-smoke text-paper py-20 md:py-[140px] px-6 md:px-10"
    aria-label="Informasi kunjungan">
    <div
      class="font-mono text-[10px] tracking-[.35em] uppercase text-mist flex items-center gap-4 decor-line-section reveal">
      03 / Kunjungi Kami</div>
    <h2
      class="font-display font-black text-[clamp(36px,6vw,80px)] leading-[.9] tracking-[-.02em] uppercase mt-6 reveal info-headline">
      TEMUKAN<br>
      <span class="text-stroke-thin">KAMI</span>
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-px bg-paper/10 border border-paper/10 mt-20">
      <div class="bg-smoke p-8 md:p-10 lg:p-12 info-cell">
        <div
          class="font-mono text-[10px] tracking-[.35em] uppercase text-mist mb-6 flex items-center gap-3 decor-line-mist-sm">
          Lokasi</div>
        <div class="font-display font-bold text-[clamp(22px,3vw,36px)] leading-[1.1] mb-5">Indramayu,<br>Jawa
          Barat
        </div>
        <address
          class="text-[clamp(13px,1.4vw,16px)] font-light leading-[1.8] text-paper/55 info-cell-body not-italic">
          <p>Jl. Veteran No.88, Lemahabang,<br>Kec. Indramayu, Kabupaten Indramayu,<br>Jawa Barat 45212</p>
          <p class="mt-4"><a href="#" aria-label="Buka lokasi di Google Maps">Buka di Google Maps
              ↗</a></p>
        </address>
      </div>

      <div class="bg-smoke p-8 md:p-10 lg:p-12 info-cell">
        <div
          class="font-mono text-[10px] tracking-[.35em] uppercase text-mist mb-6 flex items-center gap-3 decor-line-mist-sm">
          Jam Operasional</div>
        <div class="font-display font-bold text-[clamp(22px,3vw,36px)] leading-[1.1] mb-5">Setiap Hari</div>
        <div class="mt-2" role="list" aria-label="Jam operasional">
          <div class="flex justify-between items-center py-3 border-b border-paper/5 text-[14px]" role="listitem">
            <span class="font-mono text-[10px] tracking-[.2em] text-mist">Sen – Jum</span>
            <span class="text-paper font-light">09.00 AM – 02.00 AM</span>
            <span class="hours-badge">BUKA</span>
          </div>
          <div class="flex justify-between items-center py-3 border-b border-paper/5 text-[14px]" role="listitem">
            <span class="font-mono text-[10px] tracking-[.2em] text-mist">Sab - Min</span>
            <span class="text-paper font-light">08.00 AM – 02.00 AM</span>
            <span class="hours-badge">BUKA</span>
          </div>
        </div>
      </div>

      <div class="bg-smoke p-8 md:p-10 lg:p-12 info-cell">
        <div
          class="font-mono text-[10px] tracking-[.35em] uppercase text-mist mb-6 flex items-center gap-3 decor-line-mist-sm">
          Kontak &amp; Booking</div>
        <div class="font-display font-bold text-[clamp(22px,3vw,36px)] leading-[1.1] mb-5">Hubungi<br>Kami
        </div>
        <address
          class="text-[clamp(13px,1.4vw,16px)] font-light leading-[1.8] text-paper/55 info-cell-body not-italic">
          <p>WhatsApp:<br><strong><a href="https://wa.me/6281200000000" aria-label="Chat WhatsApp Vianos">+62
                812-XXXX-XXXX</a></strong></p>
          <p class="mt-4">Instagram:<br><strong><a href="https://instagram.com/vianoscreativecompound"
                aria-label="Instagram Vianos Compound" rel="noopener noreferrer"
                target="_blank">@vianoscreativecompound</a></strong></p>
          <p class="mt-4">Email:<br><strong><a href="mailto:hello@vianos.id"
                aria-label="Email ke Vianos">hello@vianos.id</a></strong></p>
        </address>
      </div>
    </div>

    <div class="mt-20 bg-brand p-10 md:p-[60px] flex justify-between items-center gap-10 flex-wrap reveal">
      <div class="font-display font-black text-[clamp(24px,4vw,52px)] text-ink leading-none uppercase">
        Siap<br>Berkunjung?</div>
      <a href="https://wa.me/6281200000000" class="cta-block-btn magnetic-target"
        aria-label="Chat via WhatsApp untuk informasi kunjungan" rel="noopener noreferrer" target="_blank">
        Chat via WhatsApp ↗
      </a>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="bg-ink p-12 md:p-[60px] pt-12 md:pt-[60px] pb-8 md:pb-10 border-t border-paper/5"
    aria-label="Footer Vianos Creative Compound">
    <div class="flex justify-between items-start gap-10 flex-wrap pb-12 border-b border-paper/5">
      <div>
        <div class="font-display font-black text-[clamp(18px,2.5vw,30px)] tracking-[.1em] uppercase leading-[1.1]">
          Vianos
          <span class="footer-logo-outline">Compound</span>
        </div>
        <div class="text-[13px] text-mist font-light mt-3 font-mono tracking-[.1em]">Coffee · Sports · Billiard
        </div>
      </div>

      <div class="flex gap-20 flex-wrap">
        <nav aria-label="Link venue">
          <div class="font-mono text-[10px] tracking-[.3em] text-mist mb-5 uppercase">Venues</div>
          <ul class="flex flex-col gap-4 list-none" role="list">
            <li><a href="#"
                class="font-mono text-[11px] tracking-[.25em] uppercase text-mist no-underline transition-colors hover:text-paper">Seven
                Coffee</a></li>
            <li><a href="#"
                class="font-mono text-[11px] tracking-[.25em] uppercase text-mist no-underline transition-colors hover:text-paper">Vianos
                Club</a></li>
            <li><a href="#"
                class="font-mono text-[11px] tracking-[.25em] uppercase text-mist no-underline transition-colors hover:text-paper">Seven
                Dragon</a></li>
          </ul>
        </nav>
        <nav aria-label="Link media sosial">
          <div class="font-mono text-[10px] tracking-[.3em] text-mist mb-5 uppercase">Ikuti Kami</div>
          <ul class="flex flex-col gap-4 list-none" role="list">
            <li><a href="https://instagram.com/vianoscreativecompound"
                class="font-mono text-[11px] tracking-[.25em] uppercase text-mist no-underline transition-colors hover:text-paper"
                rel="noopener noreferrer" target="_blank">Instagram</a></li>
            <li><a href="#"
                class="font-mono text-[11px] tracking-[.25em] uppercase text-mist no-underline transition-colors hover:text-paper"
                rel="noopener noreferrer" target="_blank">TikTok</a></li>
            <li><a href="https://wa.me/6281200000000"
                class="font-mono text-[11px] tracking-[.25em] uppercase text-mist no-underline transition-colors hover:text-paper"
                rel="noopener noreferrer" target="_blank">WhatsApp</a></li>
          </ul>
        </nav>
      </div>
    </div>

    <div class="pt-8 flex justify-between items-center flex-wrap gap-4">
      <small class="font-mono text-[10px] tracking-[.2em] text-paper/20">©
        <script>
          document.write(new Date().getFullYear())
        </script> Vianos Creative Compound. All rights
        reserved.
      </small>
      <small class="font-mono text-[10px] tracking-[.2em] text-paper/20">Indramayu, Jawa Barat —
        Indonesia</small>
    </div>
  </footer>

</body>

</html>