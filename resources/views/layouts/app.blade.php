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
    @if($announcementText)
        <div class="announcement-bar">
            {{ $announcementText }}
        </div>
    @endif

    {{-- Navbar + Mega Menu + Mobile Nav wrapper --}}
    @php
        $allNavItems = $navItemsLeft->merge($navItemsRight);
        $megaNavItems = $allNavItems->where('has_mega_menu', true);
    @endphp
    <div class="navbar-sticky" x-data="{
        mobileOpen: false,
        activeMobileSubId: null,
        activeMegaId: null,
        activeGroupId: null,
        scrolled: false,
        openMega(id, firstGroupId) {
            this.activeMegaId = id;
            this.activeGroupId = firstGroupId;
        },
        closeMega() {
            this.activeMegaId = null;
            this.activeGroupId = null;
        }
    }" @scroll.window="scrolled = (window.pageYOffset > 20)"
        x-init="$watch('mobileOpen', value => { if(!value) activeMobileSubId = null; document.body.style.overflow = value ? 'hidden' : ''; })"
        :class="{ 'navbar-sticky--scrolled': scrolled || activeMegaId !== null || mobileOpen }">
        <nav class="navbar">
            {{-- Left Side --}}
            <div class="navbar__left">
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

                {{-- Left Links --}}
                <div class="navbar__links">
                    @foreach($navItemsLeft as $navItem)
                        @if($navItem->has_mega_menu && $navItem->megaGroups->count() > 0)
                            <a href="{{ $navItem->url ?? '/shop' }}" class="navbar__link"
                                @mouseenter="openMega({{ $navItem->id }}, {{ $navItem->megaGroups->first()->id ?? 'null' }})"
                                @click.prevent="activeMegaId === {{ $navItem->id }} ? closeMega() : openMega({{ $navItem->id }}, {{ $navItem->megaGroups->first()->id ?? 'null' }})">
                                {{ $navItem->label }}
                            </a>
                        @else
                            <a href="{{ $navItem->url ?? '#' }}" class="navbar__link">
                                {{ $navItem->label }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Center Logo --}}
            <a href="/" class="navbar__logo">
                <img src="{{ asset('image/logo-kibar.png') }}" alt="Kibardjaya Logo">
            </a>

            {{-- Right Side --}}
            <div class="navbar__right">
                {{-- Right Links --}}
                <div class="navbar__links">
                    @foreach($navItemsRight as $navItem)
                        @if($navItem->has_mega_menu && $navItem->megaGroups->count() > 0)
                            <a href="{{ $navItem->url ?? '/shop' }}" class="navbar__link"
                                @mouseenter="openMega({{ $navItem->id }}, {{ $navItem->megaGroups->first()->id ?? 'null' }})"
                                @click.prevent="activeMegaId === {{ $navItem->id }} ? closeMega() : openMega({{ $navItem->id }}, {{ $navItem->megaGroups->first()->id ?? 'null' }})">
                                {{ $navItem->label }}
                            </a>
                        @else
                            <a href="{{ $navItem->url ?? '#' }}" class="navbar__link">
                                {{ $navItem->label }}
                            </a>
                        @endif
                    @endforeach
                </div>

                <div class="navbar__icons">
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
                    @php
                        $cartItems = session()->get('cart', []);
                        $cartCount = array_sum(array_column($cartItems, 'qty'));
                    @endphp
                    <a href="/cart" class="navbar__icon navbar__cart-icon" title="Cart">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                            <path d="M16 1v6M8 1v6" />
                        </svg>
                        @if($cartCount > 0)
                            <span class="navbar__cart-badge">{{ $cartCount }}</span>
                        @endif
                    </a>
                </div>
            </div>
        </nav>

        {{-- Per-NavItem Mega Menu Dropdowns --}}
        @foreach($megaNavItems as $megaNav)
            @if($megaNav->megaGroups->count() > 0)
                <div class="mega-menu" x-show="activeMegaId === {{ $megaNav->id }}" x-cloak
                    @mouseenter="activeMegaId = {{ $megaNav->id }}" @mouseleave="closeMega()"
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1">

                    {{-- Sidebar: Groups --}}
                    <div class="mega-menu__sidebar">
                        <div class="mega-menu__sidebar-items">
                            @foreach($megaNav->megaGroups as $group)
                                <a href="{{ $group->url ?? '#' }}" class="mega-menu__sidebar-link"
                                    :class="{ 'mega-menu__sidebar-link--active': activeGroupId === {{ $group->id }} }"
                                    @mouseenter="activeGroupId = {{ $group->id }}">
                                    <span class="mega-menu__sidebar-link-text">{{ strtoupper($group->label) }}</span>
                                    @if($group->items->count() > 0)
                                        <span class="mega-menu__arrow">&rarr;</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>

                        {{-- Brand Logo at bottom of sidebar --}}
                        <div class="mega-menu__brand-logo">
                            <img src="{{ asset('image/kibardjaya.png') }}" alt="Kibardjaya">
                        </div>
                    </div>

                    {{-- Content: Items per group --}}
                    <div class="mega-menu__content">
                        @foreach($megaNav->megaGroups as $group)
                            <div class="mega-menu__subcategories" x-show="activeGroupId === {{ $group->id }}"
                                x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100">
                                @foreach($group->items as $item)
                                    <a href="{{ $item->url ?? '#' }}" class="mega-menu__subcategory-link">
                                        {{ strtoupper($item->label) }}
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

        {{-- Mobile Navigation Overlay --}}
        <div class="mobile-nav-overlay" x-show="mobileOpen" x-cloak
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            {{-- Main Menu --}}
            <div class="mobile-nav-panel" x-show="!activeMobileSubId"
                x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">

                <div class="mobile-nav-panel__content">
                    @foreach($navItemsLeft as $navItem)
                        @if($navItem->has_mega_menu && $navItem->megaGroups->count() > 0)
                            <button class="mobile-nav-panel__link" @click="activeMobileSubId = {{ $navItem->id }}">
                                {{ strtoupper($navItem->label) }}
                                <span class="mobile-nav-panel__arrow">&gt;</span>
                            </button>
                        @else
                            <a href="{{ $navItem->url ?? '#' }}" class="mobile-nav-panel__link">
                                {{ strtoupper($navItem->label) }}
                            </a>
                        @endif
                    @endforeach

                    @foreach($navItemsRight as $navItem)
                        @if($navItem->has_mega_menu && $navItem->megaGroups->count() > 0)
                            <button class="mobile-nav-panel__link" @click="activeMobileSubId = {{ $navItem->id }}">
                                {{ strtoupper($navItem->label) }}
                                <span class="mobile-nav-panel__arrow">&gt;</span>
                            </button>
                        @else
                            <a href="{{ $navItem->url ?? '#' }}" class="mobile-nav-panel__link">
                                {{ strtoupper($navItem->label) }}
                            </a>
                        @endif
                    @endforeach

                    @auth
                        <a href="{{ route('profile.edit') }}" class="mobile-nav-panel__link">PROFILE</a>
                    @else
                        <a href="{{ route('login') }}" class="mobile-nav-panel__link">LOGIN</a>
                    @endauth
                    <a href="/cart" class="mobile-nav-panel__link">CART ({{ $cartCount }})</a>
                </div>

                <!-- <div class="mobile-nav-panel__footer">
                    CURRENCY: (IDR/Rupiah)
                </div> -->
            </div>

            {{-- Drill-down Submenus --}}
            @foreach($allNavItems as $navItem)
                @if($navItem->has_mega_menu && $navItem->megaGroups->count() > 0)
                    <div class="mobile-nav-panel" x-show="activeMobileSubId === {{ $navItem->id }}" x-cloak
                        x-transition:enter="transition ease-in-out duration-300 transform"
                        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transition ease-in-out duration-300 transform"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">

                        <div class="mobile-nav-panel__content">
                            <button class="mobile-nav-panel__link mobile-nav-panel__link--back"
                                @click="activeMobileSubId = null">
                                <span class="mobile-nav-panel__arrow">&lt;</span> {{ strtoupper($navItem->label) }}
                            </button>
                            @foreach($navItem->megaGroups as $group)
                                @if(count($navItem->megaGroups) > 1 && $group->label)
                                    @if(!empty($group->url))
                                        <a href="{{ $group->url }}"
                                            class="mobile-nav-panel__group-label block no-underline">{{ strtoupper($group->label) }}</a>
                                    @else
                                        <div class="mobile-nav-panel__group-label">{{ strtoupper($group->label) }}</div>
                                    @endif
                                @endif
                                @foreach($group->items as $item)
                                    <a href="{{ $item->url ?? '#' }}" class="mobile-nav-panel__link">
                                        {{ strtoupper($item->label) }}
                                    </a>
                                @endforeach
                            @endforeach
                        </div>

                        <!-- <div class="mobile-nav-panel__footer">
                                            CURRENCY: (IDR/Rupiah)
                                        </div> -->
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Back to Top (Mobile Only) --}}
    <div class="back-to-top-mobile">
        <a onclick="window.scrollTo({ top: 0, behavior: 'smooth' })">BACK TO TOP</a>
        <!-- <button onclick="window.scrollTo({ top: 0, behavior: 'smooth' })">BACK TO TOP</button> -->
    </div>


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
                    <br>
                    <br>
                    We believe that every pennant tells a story, and we pour our heart and soul into every piece we
                    create.
                    <br>
                    <br>
                    +62 851 1996 0101
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
                        General business hours<br>
                        Monday to Friday, from 09:00h to 17:00h.<br>
                        West Indonesian Timezone, equivalent to UTC+7
                    </p>
                    <!-- <p class="footer__studio-hours">
                        Mon-Fri: Online<br>
                        Sat: 10-21<br>
                        Sun: 13-22
                    </p> -->
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