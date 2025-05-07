<!DOCTYPE html>
<html lang = "en">

<head>
    <title>Product Page</title>
    <meta charset = "UTF-8"/>
    <link rel="stylesheet" href="{{ url('/css/Product_Page.css') }}" />
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.css">
    <script src="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.js"></script>

    <script defer>
        function handleImageError(img) {
            img.style.display = "none";

            const fallback = img.parentElement.querySelector('.img-fallback');

            fallback.style.display = 'block';
        }
    </script>
</head>

<body>
<header>
    <div class = "blue_panel">
        <a href="{{ route('main') }}" class="logo_dungeon_goodies" title="Place for logo"></a>

        <div class = "types">
            <a href="{{ route('product-page') }}" class="link_type products">Products</a>
            <a href="{{ route('sales') }}" class="link_type sales">Sales</a>
        </div>

        <div class = "buttons">
            @auth
                <button class="btn favourite" onclick="window.location.href = '{{ route('favourites') }}'">Favourites</button>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn sign_in">Logout</button>
                </form>
            @else
                <button class="btn sign_in" onclick="window.location.href = '{{ route('sign-in-register') }}'">Sign In</button>
                <button class="btn register" onclick="window.location.href = '{{ route('sign-in-register') }}'">Register</button>
            @endauth

            <a href="{{ route('shopping-cart') }}" class="shopping_cart_btn" title="View Cart">
                <svg viewBox = "0 0 24 24" width = "24" height = "24">
                    <path fill = "currentColor" d = "M7 4h-2l-1 2h2l3 6-1.2 2.2c-.2.3-.2.6-.2.8 0 .8.6 1.4 1.4 1.4h10v-2h-9.4l.8-1.6h5.8c.6 0 1-.4 1.2-.9l2.4-4.5c.1-.2.1-.4.1-.6 0-.5-.4-.9-.9-.9h-11.6l-.7-2zm5 14c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm7 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                </svg>
            </a>
        </div>
    </div>
</header>

<div class="container">
    <aside class="filter-panel">
        <form method="GET" action="{{ route('product-page') }}">
            <input type="hidden" name="sort" value="{{ request('sort', 'new') }}">
            <h4>Filter</h4>

            <h4 class="price_class">Price</h4>
            <div class="slider-wrapper">
                <div class="price-slider" id="priceSlider"></div>
            </div>
            <div class="price-display">
                <span id="minDisplay">0 €</span>
                <span id="maxDisplay">100 €</span>
            </div>
            <input type="hidden" name="price_min" id="priceMinInput">
            <input type="hidden" name="price_max" id="priceMaxInput">

            <h4 class="product-type_class">Product Type</h4>

            <div class="product-type">
                <label><input type="checkbox" name="type[]" value="Comics" {{ in_array('Comics', request()->get('type', [])) ? 'checked' : '' }}> Comics</label>
                <label><input type="checkbox" name="type[]" value="Funko POP!" {{ in_array('Funko POP!', request()->get('type', [])) ? 'checked' : '' }}> Funko POP!</label>
                <label><input type="checkbox" name="type[]" value="Manga" {{ in_array('Manga', request()->get('type', [])) ? 'checked' : '' }}> Manga</label>
            </div>

            <h4 class="manufacturer_class">Manufacturer</h4>

            <div class="manufacturer-type">
                @php
                    $manufacturers = ['Adult Swim', 'Image Comics', 'Marvel', 'Warner Bros', 'Yuto'];
                @endphp
                @foreach ($manufacturers as $m)
                    <label>
                        <input type="checkbox" name="manufacturer[]" value="{{ $m }}" {{ in_array($m, request()->get('manufacturer', [])) ? 'checked' : '' }}>
                        {{ $m }}
                    </label>
                @endforeach
            </div>

            <h4 class="format_class">Format</h4>

            <div class="format-type">
                @php
                    $formats = ['Hardcover', 'Paperback'];
                @endphp

                @foreach ($formats as $format)
                    <label>
                        <input type="checkbox" name="format[]" value="{{ $format }}" {{ in_array($format, request()->get('format', [])) ? 'checked' : '' }}>
                        {{ $format }}
                    </label>
                @endforeach
            </div>

            <button type="submit" class="btn btn-filter">Apply Filters</button>
        </form>
    </aside>
    <section class="products-grid">
        <div class="top-bar">
            <form method="GET" action="{{ route('product-page') }}" class="search-container">
                <input type="text" class="search-bar" placeholder="Search..." name="search" value="{{ request('search') }}">
                <button type="submit" class="search-icon">🔍</button>
            </form>

            <div class="sort-options">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'new']) }}">
                    <button class="{{ request('sort', 'new') === 'new' ? 'active' : '' }}">New</button>
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'pa']) }}">
                    <button class="{{ request('sort') === 'pa' ? 'active' : '' }}">Price ascending</button>
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'pd']) }}">
                    <button class="{{ request('sort') === 'pd' ? 'active' : '' }}">Price descending</button>
                </a>
            </div>
        </div>

        <div class="product-list">
            @forelse ($products as $product)
                <a href="{{ route('product-detail', ['id' => $product->id]) }}" class="product-link">
                    <div class="product">
                        <div class="image">
                            @if($product->on_sale)
                                <div class="sale-banner">ON SALE</div>
                            @endif
                            <div class="heart-btn favourite-toggle-btn" data-product-id="{{ $product->id }}">
                                @php
                                    $isFavourited = auth()->check() && \App\Models\Favourite::where('user_id', auth()->id())
                                                      ->where('product_id', $product->id)
                                                      ->exists();
                                @endphp
                                {{ $isFavourited ? '❤️' : '♡' }}
                            </div>

                            <img src="{{ asset($product->image_1) }}" alt="{{ $product->name }}" class="product_img" onerror="handleImageError(this)" />

                            <span class="img-fallback" style="display: none;">{{ $product->name }}</span>
                        </div>

                        <p class="product_name">{{ $product->name }}</p>

                        @if($product->on_sale)
                            <div class="price_wrapper">
                                    <s class="product_price">€{{ number_format($product->price, 2) }}</s>
                                    <p class="sale_price">€{{ number_format($product->price * (1 - $product->sale_percent / 100), 2) }}</p>
                            </div>
                        @else
                            <p class="product_price">€{{ number_format($product->price, 2) }}</p>
                        @endif

                        <form method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="amount" value="1">
                            <button type="submit" class="buy-btn">Buy</button>
                        </form>

                    </div>
                </a>
            @empty
                <p class = "no_results">Sorry, no results :(</p>
            @endforelse
        </div>
    </section>
</div>

<div class="paging_part">
    @for ($i = 1; $i <= $products->lastPage(); $i++)
        <a href="{{ $products->url($i) }}" class="page_circle {{ $products->currentPage() == $i ? 'active' : '' }}">
            {{ $i }}
        </a>
    @endfor
</div>

<footer>
    <div class = "bottom_panel">
        <div class = "logo_part">
            <a href="{{ route('admin-page') }}" class="logo_dungeon_goodies" title="Place for logo"></a>
        </div>

        <div class = "information_text">
            <a href = "javascript:void(0)" onclick = "alert('Please be kind on our website :)')">Terms and conditions</a>

            <div class = "contacts">
                <a href="https://is.stuba.sk/?lang=sk" target="_blank" rel="noopener noreferrer">Contact Us</a>
                <p>xpetrikj@stuba.sk</p>
                <p>xmizeraks@stuba.sk</p>
            </div>

            <a href = "https://github.com/jakub-petrik/Dungeon-Goodies" target = "_blank" rel = "noopener noreferrer">Our GitHub</a>
        </div>
    </div>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ratingButtons = document.querySelectorAll('.rating-btn');
        const ratingInput = document.querySelector('input[name="rating"]');
        const form = document.querySelector('.filter-panel form');
        const favouriteButtons = document.querySelectorAll('.favourite-toggle-btn');

        let selectedRating = ratingInput.value || null;

        ratingButtons.forEach(button => {
            button.addEventListener('click', function () {
                const ratingValue = this.getAttribute('data-rating');

                if (selectedRating === ratingValue) {
                    selectedRating = null;
                    ratingInput.value = '';
                    ratingButtons.forEach(btn => btn.classList.remove('active'));
                } else {
                    selectedRating = ratingValue;
                    ratingInput.value = ratingValue;
                    ratingButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });

        favouriteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();

                const productId = this.getAttribute('data-product-id');

                fetch("{{ route('favourites.toggle') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === "added") {
                        this.textContent = "❤️";
                    } else if (data.status === "removed") {
                        this.textContent = "♡";
                    }
                })
                .catch(error => {
                    alert("You must be logged in to manage favourites.");
                });
            });
        });
    });
</script>

<script>
    const slider = document.getElementById('priceSlider');
    const minInput = document.getElementById('priceMinInput');
    const maxInput = document.getElementById('priceMaxInput');
    const minDisplay = document.getElementById('minDisplay');
    const maxDisplay = document.getElementById('maxDisplay');

    const urlParams = new URLSearchParams(window.location.search);
    const priceMin = parseInt(urlParams.get('price_min')) || 0;
    const priceMax = parseInt(urlParams.get('price_max')) || 100;

    noUiSlider.create(slider, {
        start: [priceMin, priceMax],
        connect: true,
        range: {
            min: 0,
            max: 100
        },
        step: 1,
        tooltips: [false, false]
    });

    minInput.value = priceMin;
    maxInput.value = priceMax;
    minDisplay.textContent = priceMin + " €";
    maxDisplay.textContent = priceMax + " €";

    slider.noUiSlider.on('update', function (values) {
        const min = Math.round(values[0]);
        const max = Math.round(values[1]);

        minInput.value = min;
        maxInput.value = max;

        minDisplay.textContent = min + " €";
        maxDisplay.textContent = max + " €";
    });
</script>

</body>

</html>
