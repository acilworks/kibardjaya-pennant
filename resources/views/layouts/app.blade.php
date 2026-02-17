<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Kibardjaya Pennant')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Handmade pennants inspired by places and memories worth keeping. Crafted in Indonesia for collectors and explorers alike.">

    {{-- Google Fonts: JetBrains Mono --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap"
        rel="stylesheet">

    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#ffffff] text-neutral-900 font-sans">
    <!-- <body class="bg-[#f5f5f0] text-neutral-900 font-sans"> -->

    {{-- Announcement Bar --}}
    <div class="announcement-bar">
        Subscribe for 15% off your first order
    </div>

    {{-- Navbar + Mobile Nav wrapper --}}
    <div class="navbar-sticky" x-data="{ mobileOpen: false, scrolled: false }"
        @scroll.window="scrolled = (window.pageYOffset > 20)" :class="{ 'navbar-sticky--scrolled': scrolled }">
        <nav class="navbar">
            {{-- Left Links --}}
            <div class="navbar__links">
                <a href="/shop" class="navbar__link">Collections</a>
                <a href="/shop" class="navbar__link">Goods</a>
                <a href="#" class="navbar__link">Make Your Own</a>
            </div>

            {{-- Center Logo --}}
            <a href="/" class="navbar__logo">
                <img src="{{ asset('image/logo-kibar.png') }}" alt="Kibardjaya Logo">
            </a>

            {{-- Right Links + Icons --}}
            <div class="navbar__links">
                <a href="#" class="navbar__link">Collaborations</a>
                <a href="#" class="navbar__link">About</a>

                {{-- User Icon --}}
                @auth
                    <a href="{{ route('profile.edit') }}" class="navbar__icon" title="Profile">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="navbar__icon" title="Login">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </a>
                @endauth

                {{-- Cart Icon --}}
                <a href="/cart" class="navbar__icon" title="Cart">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                        <path d="M16 1v6M8 1v6" />
                    </svg>
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <button class="navbar__icon mobile-menu-btn" @click="mobileOpen = !mobileOpen" aria-label="Menu">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <g x-show="!mobileOpen">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </g>
                    <g x-show="mobileOpen" x-cloak>
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </g>
                </svg>
            </button>
        </nav>

        {{-- Mobile Navigation --}}
        <div class="mobile-nav" x-show="mobileOpen" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2">
            <a href="/shop">Collections</a>
            <a href="/shop">Goods</a>
            <a href="#">Make Your Own</a>
            <a href="#">Collaborations</a>
            <a href="#">About</a>
            @auth
                <a href="{{ route('profile.edit') }}">Profile</a>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
            <a href="/cart">Cart</a>
        </div>
    </div>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="footer">
        {{-- Newsletter Bar --}}
        <div class="footer__newsletter">
            <div class="footer__newsletter-logo">
                <img src="{{ asset('image/kibardjaya-footer.png') }}" alt="Kibardjaya">
            </div>
            <span class="footer__newsletter-label">Stay in the loop!</span>
            <form class="footer__newsletter-form" action="#" method="POST">
                @csrf
                <input type="email" name="email" class="footer__newsletter-input" placeholder="Enter your email"
                    required>
                <button type="submit" class="footer__newsletter-btn">Submit &rarr;</button>
            </form>
        </div>

        {{-- Main Footer Content --}}
        <div class="footer__main">
            {{-- About Us --}}
            <div class="footer__col-about">
                <span class="footer__col-label">About Us</span>
                <p class="footer__about-text">
                    Kibardjaya is a small studio crafting handmade pennants from Yogyakarta, Indonesia.
                </p>
            </div>

            {{-- Socials --}}
            <div class="footer__col-socials">
                <span class="footer__col-label">Socials</span>
                <div class="footer__col-socials-inner">
                    <a href="https://instagram.com/kibardjaya" target="_blank">Instagram</a>
                    <a href="https://tiktok.com/@kibardjaya" target="_blank">TikTok</a>
                </div>
            </div>

            {{-- The Store --}}
            <div class="footer__col-store">
                <span class="footer__col-label">The Store</span>
                <div class="footer__col-store-inner">
                    <a href="#" target="_blank">Etsy</a>
                    <a href="#" target="_blank">Shopee</a>
                    <a href="#" target="_blank">Mobile Vending</a>
                </div>
            </div>

            {{-- The Studio --}}
            <div class="footer__col-studio">
                <span class="footer__col-label">The Studio</span>
                <div class="footer__col-studio-inner">
                    <p class="footer__studio-address">
                        Ngangkrik RT 03 / RW 14<br>
                        Triharjo Sleman, Sleman<br>
                        Yogyakarta
                    </p>
                    <p class="footer__studio-hours">
                        Mon-Fri: Online<br>
                        Sat: 10-21<br>
                        Sun: 13-22
                    </p>
                </div>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="footer__bottom">
            <span class="footer__copyright">©{{ date('Y') }} – Kibardjaya</span>
            <span class="footer__credit">Site by <a href="https://acworks.vercel.app/" target="_blank">Acil</a></span>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>