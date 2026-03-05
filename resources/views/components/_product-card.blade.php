@php
    $item = isset($product) ? $product : (isset($related) ? $related : null);
    $images = $item ? ($item->images ?? []) : [];
    $displayImages = array_slice($images, 0, 3);
@endphp

@if($item)
    <a href="/shop/{{ $item->slug }}" class="product-card {{ $item->is_sold_out ? 'product-card--sold-out' : '' }}">
        @if(count($displayImages) > 0)
            <div class="product-card__image-wrap">
                @if($item->subCategory)
                    <div class="product-card__badge">{{ $item->subCategory->name }}</div>
                @endif

                @if(count($displayImages) > 1)
                    {{-- Swiper for multiple images --}}
                    <div class="swiper product-card__swiper">
                        <div class="swiper-wrapper">
                            @foreach($displayImages as $image)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $item->title }}" class="product-card__image">
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
                    <img src="{{ asset('storage/' . $displayImages[0]) }}" alt="{{ $item->title }}" class="product-card__image">
                @endif

                @if($item->is_sold_out)
                    <div class="product-card__sold-overlay">
                        <span>Sold Out</span>
                    </div>
                @endif
            </div>
        @endif
        <div class="product-card__info">
            <h3 class="product-card__name">{{ $item->title }}</h3>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto;">
                <p class="product-card__price" style="margin: 0;">Rp.
                    {{ number_format($item->price, 0, ',', '.') }}
                </p>
                @if($item->colorVariants->count() > 0)
                    <div style="display: flex; gap: 4px;">
                        @foreach($item->colorVariants as $variant)
                            <span
                                style="width: 12px; height: 12px; border-radius: 50%; background-color: {{ $variant->color_code }}; border: 1px solid #1a1a1a;"></span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </a>
@endif