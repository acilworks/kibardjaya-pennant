@php
    $item = isset($product) ? $product : (isset($related) ? $related : null);
    $images = $item ? ($item->images ?? []) : [];
    $displayImages = array_slice($images, 0, 3);
    
    // Ubah nilai ini untuk mengubah tinggi gambar (contoh: '1/1' untuk kotak, '4/5', '16/9', dll)
    $imageRatio = '4/4.9';
@endphp

@if($item)
    <a href="/shop/{{ $item->slug }}" class="product-card {{ $item->is_sold_out ? 'product-card--sold-out' : '' }}">
        @if(count($displayImages) > 0)
            <div class="product-card__image-wrap">
                <div class="product-card__badges" style="position: absolute; top: 20px; left: 20px; z-index: 10; display: flex; gap: 8px;">
                    @if($item->is_new_drop)
                        <div class="product-card__badge" style="position: relative; top: 0; left: 0;">NEW</div>
                    @endif
                    @if($item->subCategory)
                        <div class="product-card__badge" style="position: relative; top: 0; left: 0;">{{ $item->subCategory->name }}</div>
                    @endif
                </div>

                @if(count($displayImages) > 1)
                    {{-- Swiper for multiple images --}}
                    <div class="swiper product-card__swiper">
                        <div class="swiper-wrapper">
                            @foreach($displayImages as $image)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $item->title }}" class="product-card__image"
                                        loading="lazy" style="aspect-ratio: {{ $imageRatio }};">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination product-card__swiper-pagination"></div>
                        <div class="product-card__swiper-prev" onclick="event.preventDefault();event.stopPropagation();">&lsaquo;
                        </div>
                        <div class="product-card__swiper-next" onclick="event.preventDefault();event.stopPropagation();">&rsaquo;
                        </div>
                    </div>
                @else
                    {{-- Single image fallback --}}
                    <img src="{{ asset('storage/' . $displayImages[0]) }}" alt="{{ $item->title }}" class="product-card__image"
                        loading="lazy" style="aspect-ratio: {{ $imageRatio }};">
                @endif

                @if($item->is_sold_out)
                    <div class="product-card__sold-overlay">
                        <span>Sold Out</span>
                    </div>
                @endif
            </div>
        @endif
        <div class="product-card__info" style="flex-grow: 1; padding: 15px 15px; border-top: 1px solid #1a1a1a; display: flex; flex-direction: column; gap: 16px; background-color: #fff;">
            <h3 class="product-card__name" style="font-family: 'JetBrains Mono', monospace; font-size: 13px; font-weight: 900; text-transform: uppercase; margin: 0; letter-spacing: 0.5px; line-height: 1; color: #1a1a1a;">{{ $item->title }}</h3>
            
            @if($item->colorVariants && $item->colorVariants->count() > 0)
                <div style="display: flex; gap: 4px;">
                    @foreach($item->colorVariants as $variant)
                        <span style="width: 15px; height: 15px; border-radius: 50%; background-color: {{ $variant->color_code }}; border: 1px solid #1a1a1a;"></span>
                    @endforeach
                </div>
            @endif

            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto; font-family: 'JetBrains Mono', monospace; text-transform: uppercase;">
                <p class="product-card__price" style="margin: 0; font-size: 12px; font-weight: 400; letter-spacing: 0.5px; color: #1a1a1a;">Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                <span style="font-size: 11px; font-weight: 500; letter-spacing: 0.5px; color: #1a1a1a; text-decoration: underline;">+ADD</span>
            </div>
        </div>
    </a>
@endif