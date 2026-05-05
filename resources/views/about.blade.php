@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('title', 'About Us — Kibardjaya Pennant')

@section('content')
    {{-- ============================================
    SECTION 1: HERO MANIFESTO
    ============================================ --}}

    <section class="collab-hero">
        <h1 class="collab-hero__title">About<br>Kibardjaya.</h1>
        <div class="collab-hero__subtitle">
            <p class="collab-hero__tagline">Built together, story by story.</p>
            <p class="collab-hero__desc">
                Kibardjaya is a small studio from Yogyakarta, Indonesia, crafting handmade pieces inspired by
                places, stories, and memories.
            </p>
            <p class="collab-hero__desc">
                We believe every piece carries a feeling of a journey, a moment, or a place worth remembering. Each
                creation is made with care, to be kept, shared, and remembered.
            </p>
        </div>
    </section>

    <!-- <section class="about-hero" style="padding: 120px 40px 80px; border-bottom: 1px solid #1a1a1a;">
            <div 
                style="max-width: 1440px; margin: 0 auto; display: grid; grid-template-columns: 1fr; gap: 40px; align-items: end;">

                <div style="grid-template-columns: 1fr 1fr; gap: 60px; min-width: 768px">

                    <div>
                        <h1
                            style="font-size: clamp(3rem, 8vw, 8rem); font-weight: 900; line-height: 0.9; text-transform: uppercase; letter-spacing: -0.02em; margin-bottom: 20px;">
                            About<br>Kibardjaya.
                        </h1>
                    </div>
                    <div style="max-width: 480px; padding-bottom: 10px;">
                        <p style="font-size: 16px; line-height: 1.6; font-weight: 400; color: #1a1a1a; margin-bottom: 20px;">
                            Kibardjaya is a small studio from Yogyakarta, Indonesia, crafting handmade pieces inspired by
                            places, stories, and memories.
                        </p>
                        <p style="font-size: 16px; line-height: 1.6; font-weight: 400; color: #1a1a1a; margin: 0;">
                            We believe every piece carries a feeling of a journey, a moment, or a place worth remembering. Each
                            creation is made with care, to be kept, shared, and remembered.
                        </p>
                    </div>
                </div>
        </section> -->

    {{-- ============================================
    SECTION 2: FEATURED IMAGE PLACEHOLDER
    ============================================ --}}
    <section style="border-bottom: 1px solid #1a1a1a;">
        <div
            style="background-image: url('{{ asset('image/bg-hero.webp') }}'); background-size: cover; width: 100%; aspect-ratio: 16/9; background-color: #e8e4dd; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative;">
            <div
                style="text-align: center; color: #1a1a1a; font-size: 13px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.5;">
                [ Studio Image Placeholder ]
            </div>
        </div>
    </section>

    {{-- ============================================
    SECTION 3: OUR PROCESS (GRID)
    ============================================ --}}
    <section class="about-process" style="border-bottom: 1px solid #1a1a1a; background-color: #F8F4ED; overflow: hidden;">
        <div class="swiper about-process__swiper">
            <div class="swiper-wrapper">
                <!-- Process 1 -->
                <div class="swiper-slide about-process__item">
                    <div style="padding: 60px 40px; height: 100%;">
                        <span style="font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 20px; opacity: 0.6;">01 — The Studio</span>
                        <h3 style="font-size: 24px; font-weight: 700; text-transform: uppercase; margin: 0 0 20px 0;">Handmade Production</h3>
                        <p style="font-size: 15px; line-height: 1.6; max-width: 400px; margin: 0;">
                            Each piece is individually finished in our Yogyakarta studio. We avoid mass manufacturing to preserve quality and craftsmanship in every pennant.
                        </p>
                    </div>
                </div>
                <!-- Process 2 -->
                <div class="swiper-slide about-process__item">
                    <div style="padding: 60px 40px; height: 100%;">
                        <span style="font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 20px; opacity: 0.6;">02 — The Approach</span>
                        <h3 style="font-size: 24px; font-weight: 700; text-transform: uppercase; margin: 0 0 20px 0;">Small Batches</h3>
                        <p style="font-size: 15px; line-height: 1.6; max-width: 400px; margin: 0;">
                            Produced in limited small batches. We take our time to source materials and carefully construct items that are built for collectors and explorers alike.
                        </p>
                    </div>
                </div>
                <!-- Process 3 -->
                <div class="swiper-slide about-process__item">
                    <div style="padding: 60px 40px; height: 100%;">
                        <span style="font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 20px; opacity: 0.6;">03 — The Goal</span>
                        <h3 style="font-size: 24px; font-weight: 700; text-transform: uppercase; margin: 0 0 20px 0;">Crafted Memories</h3>
                        <p style="font-size: 15px; line-height: 1.6; max-width: 400px; margin: 0;">
                            More than just decorative items, we aim to create tangible reminders of your favorite places, experiences, and stories.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Running Text Marquee --}}
    <div class="marquee">
        <div class="marquee__track">
            <span class="marquee__content">&bull;&nbsp; Handmade in Indonesia &nbsp;&bull;&nbsp; Limited Small Batches
                &nbsp;&bull;&nbsp; Built for Collectors &nbsp;&bull;&nbsp; Crafted Memories &nbsp;</span>
            <span class="marquee__content">&bull;&nbsp; Handmade in Indonesia &nbsp;&bull;&nbsp; Limited Small Batches
                &nbsp;&bull;&nbsp; Built for Collectors &nbsp;&bull;&nbsp; Crafted Memories &nbsp;</span>
            <span class="marquee__content">&bull;&nbsp; Handmade in Indonesia &nbsp;&bull;&nbsp; Limited Small Batches
                &nbsp;&bull;&nbsp; Built for Collectors &nbsp;&bull;&nbsp; Crafted Memories &nbsp;</span>
        </div>
    </div>
    {{-- ============================================
    SECTION 4: SECONDARY VISUAL & CTA
    ============================================ --}}
    <section style="display: grid; grid-template-columns: 1fr;">
        <div
            style="aspect-ratio: 1/1; background-color: #e8e4dd; border-bottom: 1px solid #1a1a1a; display: flex; align-items: center; justify-content: center;">
            <div
                style="text-align: center; color: #1a1a1a; font-size: 13px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.5;">
                [ Detail/Process Image Placeholder ]
            </div>
        </div>
        <div
            style="padding: 80px 40px; display: flex; flex-direction: column; justify-content: center; align-items: flex-start; border-bottom: 1px solid #1a1a1a; background-color: #FAFAFA;">
            <h2
                style="font-size: clamp(2rem, 5vw, 4rem); font-weight: 900; line-height: 1; text-transform: uppercase; margin: 0 0 30px 0;">
                Explore<br>Our Work.
            </h2>
            <a href="/shop"
                style="display: inline-flex; align-items: center; font-size: 13px; font-weight: 700; text-transform: uppercase; text-decoration: none; color: #1a1a1a; border-bottom: 1px solid #1a1a1a; padding-bottom: 4px; transition: opacity 0.3s ease;"
                onmouseover="this.style.opacity='0.6'" onmouseout="this.style.opacity='1'">
                View Shop <span style="margin-left: 8px;">&rarr;</span>
            </a>
        </div>
    </section>

    <style>
        /* Responsive Grid Adjustments for About Page */
        @media (min-width: 768px) {
            .about-hero>div {
                grid-template-columns: 1fr 1fr;
            }

            .about-process__item {
                border-right: 1px solid #1a1a1a;
                box-sizing: border-box;
                height: auto;
            }

            .about-process__item:last-child {
                border-right: none;
            }

            @media (max-width: 767px) {
                .about-process__swiper .swiper-wrapper {
                    align-items: stretch;
                }
            }

            /* Section 4 Adjustments */
            section:nth-of-type(4) {
                grid-template-columns: 1fr 1fr !important;
            }

            section:nth-of-type(4)>div:first-child {
                border-bottom: none !important;
                border-right: 1px solid #1a1a1a;
            }

            section:nth-of-type(4)>div:last-child {
                border-bottom: none !important;
            }
        }
    </style>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.about-process__swiper', {
                slidesPerView: 1.2,
                spaceBetween: 0,
                breakpoints: {
                    768: {
                        slidesPerView: 3,
                        allowTouchMove: false,
                    }
                }
            });
        });
    </script>
@endpush