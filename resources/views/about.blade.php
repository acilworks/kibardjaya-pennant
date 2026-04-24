@extends('layouts.app')

@section('title', 'About Us — Kibardjaya Pennant')

@section('content')
    {{-- ============================================
    SECTION 1: HERO MANIFESTO
    ============================================ --}}
    <section class="about-hero" style="padding: 120px 40px 80px; border-bottom: 1px solid #1a1a1a;">
        <div style="max-width: 1440px; margin: 0 auto; display: grid; grid-template-columns: 1fr; gap: 40px; align-items: end;">
            @media (min-width: 768px) {
                <div style="grid-template-columns: 1fr 1fr; gap: 60px;">
            }
            <div>
                <h1 style="font-size: clamp(3rem, 8vw, 8rem); font-weight: 900; line-height: 0.9; text-transform: uppercase; letter-spacing: -0.02em; margin: 0;">
                    About<br>Kibardjaya.
                </h1>
            </div>
            <div style="max-width: 480px; padding-bottom: 10px;">
                <p style="font-size: 16px; line-height: 1.6; font-weight: 400; color: #1a1a1a; margin-bottom: 20px;">
                    Kibardjaya is a small studio from Yogyakarta, Indonesia, crafting handmade pieces inspired by places, stories, and memories.
                </p>
                <p style="font-size: 16px; line-height: 1.6; font-weight: 400; color: #1a1a1a; margin: 0;">
                    We believe every piece carries a feeling of a journey, a moment, or a place worth remembering. Each creation is made with care, to be kept, shared, and remembered.
                </p>
            </div>
        </div>
    </section>

    {{-- ============================================
    SECTION 2: FEATURED IMAGE PLACEHOLDER
    ============================================ --}}
    <section style="border-bottom: 1px solid #1a1a1a;">
        <div style="width: 100%; aspect-ratio: 16/9; background-color: #e8e4dd; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative;">
            <div style="text-align: center; color: #1a1a1a; font-size: 13px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.5;">
                [ Studio Image Placeholder ]
            </div>
        </div>
    </section>

    {{-- ============================================
    SECTION 3: OUR PROCESS (GRID)
    ============================================ --}}
    <section style="border-bottom: 1px solid #1a1a1a; background-color: #F8F4ED;">
        <div style="display: grid; grid-template-columns: 1fr; border-right: none;">
            <!-- Process 1 -->
            <div style="padding: 60px 40px; border-bottom: 1px solid #1a1a1a;">
                <span style="font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 20px; opacity: 0.6;">01 — The Studio</span>
                <h3 style="font-size: 24px; font-weight: 700; text-transform: uppercase; margin: 0 0 20px 0;">Handmade Production</h3>
                <p style="font-size: 15px; line-height: 1.6; max-width: 400px; margin: 0;">
                    Each piece is individually finished in our Yogyakarta studio. We avoid mass manufacturing to preserve quality and craftsmanship in every pennant.
                </p>
            </div>
            <!-- Process 2 -->
            <div style="padding: 60px 40px; border-bottom: 1px solid #1a1a1a;">
                <span style="font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 20px; opacity: 0.6;">02 — The Approach</span>
                <h3 style="font-size: 24px; font-weight: 700; text-transform: uppercase; margin: 0 0 20px 0;">Small Batches</h3>
                <p style="font-size: 15px; line-height: 1.6; max-width: 400px; margin: 0;">
                    Produced in limited small batches. We take our time to source materials and carefully construct items that are built for collectors and explorers alike.
                </p>
            </div>
            <!-- Process 3 -->
            <div style="padding: 60px 40px;">
                <span style="font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 20px; opacity: 0.6;">03 — The Goal</span>
                <h3 style="font-size: 24px; font-weight: 700; text-transform: uppercase; margin: 0 0 20px 0;">Crafted Memories</h3>
                <p style="font-size: 15px; line-height: 1.6; max-width: 400px; margin: 0;">
                    More than just decorative items, we aim to create tangible reminders of your favorite places, experiences, and stories.
                </p>
            </div>
        </div>
    </section>

    {{-- ============================================
    SECTION 4: SECONDARY VISUAL & CTA
    ============================================ --}}
    <section style="display: grid; grid-template-columns: 1fr;">
        <div style="aspect-ratio: 1/1; background-color: #e8e4dd; border-bottom: 1px solid #1a1a1a; display: flex; align-items: center; justify-content: center;">
            <div style="text-align: center; color: #1a1a1a; font-size: 13px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.5;">
                [ Detail/Process Image Placeholder ]
            </div>
        </div>
        <div style="padding: 80px 40px; display: flex; flex-direction: column; justify-content: center; align-items: flex-start; border-bottom: 1px solid #1a1a1a; background-color: #FAFAFA;">
            <h2 style="font-size: clamp(2rem, 5vw, 4rem); font-weight: 900; line-height: 1; text-transform: uppercase; margin: 0 0 30px 0;">
                Explore<br>Our Work.
            </h2>
            <a href="/shop" style="display: inline-flex; align-items: center; font-size: 13px; font-weight: 700; text-transform: uppercase; text-decoration: none; color: #1a1a1a; border-bottom: 1px solid #1a1a1a; padding-bottom: 4px; transition: opacity 0.3s ease;" onmouseover="this.style.opacity='0.6'" onmouseout="this.style.opacity='1'">
                View Shop <span style="margin-left: 8px;">&rarr;</span>
            </a>
        </div>
    </section>

    <style>
        /* Responsive Grid Adjustments for About Page */
        @media (min-width: 768px) {
            .about-hero > div {
                grid-template-columns: 1fr 1fr;
            }
            section > div[style*="display: grid"] {
                grid-template-columns: repeat(3, 1fr) !important;
            }
            section > div[style*="display: grid"] > div {
                border-bottom: none !important;
                border-right: 1px solid #1a1a1a;
            }
            section > div[style*="display: grid"] > div:last-child {
                border-right: none;
            }
            
            /* Section 4 Adjustments */
            section:nth-of-type(4) {
                grid-template-columns: 1fr 1fr !important;
            }
            section:nth-of-type(4) > div:first-child {
                border-bottom: none !important;
                border-right: 1px solid #1a1a1a;
            }
            section:nth-of-type(4) > div:last-child {
                border-bottom: none !important;
            }
        }
    </style>
@endsection
