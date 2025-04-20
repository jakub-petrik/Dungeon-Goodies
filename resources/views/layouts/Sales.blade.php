<!DOCTYPE html>
<html lang = "en">

<head>
    <title>Product Page</title>
    <meta charset = "UTF-8"/>
    <link rel="stylesheet" href="{{ url('/css/Product_Page.css') }}" />
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
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
        <form method="GET" action="{{ route('sales') }}">
            <h4>Filter</h4>

            <h4 class="price_class">Price</h4>
            <input type="range" name="price_max" id="priceRange" min="0" max="100" value="{{ request('price_max', 100) }}">
            <div id="priceLabel">0€ – {{ request('price_max', 100) }}€</div>

            <h4 class="product-type_class">Product Type</h4>

            <div class="product-type">
                <label><input type="checkbox" name="type[]" value="Manga" {{ in_array('Manga', request()->get('type', [])) ? 'checked' : '' }}> Manga</label>
                <label><input type="checkbox" name="type[]" value="Comics" {{ in_array('Comics', request()->get('type', [])) ? 'checked' : '' }}> Comics</label>
                <label><input type="checkbox" name="type[]" value="Funko POP!" {{ in_array('Funko POP!', request()->get('type', [])) ? 'checked' : '' }}> Funko POP!</label>
            </div>

            <h4 class="rating-title">Rating</h4>

            <div class="rating-buttons">
                <input type="hidden" name="rating" id="ratingInput" value="{{ request('rating', '') }}">

                @for ($i = 5; $i >= 1; $i--)
                    <button type="button"
                            class="rating-btn {{ request('rating') == $i ? 'active' : '' }}"
                            data-rating="{{ $i }}">
                        {{ str_repeat('★', $i) }}
                    </button>
                @endfor
            </div>

            <button type="submit" class="btn btn-filter">Apply Filters</button>
        </form>

    </aside>
    <section class="products-grid">
        <div class="top-bar">
            <div class="search-container">
                <label><input type="text" class="search-bar" placeholder="Search"></label>
                <button class="search-icon">🔍</button>
            </div>

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
            @foreach ($products as $product)
            <a href="{{ route('product-detail', ['id' => $product->id]) }}" class="product-link">
                <div class="product">
                    <div class="image">
                        <div class="sale-banner">ON SALE</div>
                        <div class="heart">♡</div>
                        <img src="{{ asset($product->image_1) }}" alt="{{ $product->name }}" class="product_img">
                    </div>
                    <p class="product_name">{{ $product->name }}</p>
                    <div class="price_wrapper">
                            <s class="product_price">€{{ number_format($product->price, 2) }}</s>
                            <p class="sale_price">€{{ number_format($product->price * (1 - $product->sale_percent / 100), 2) }}</p>
                    </div>
                    <button class="buy-btn">Buy</button>
                </div>
            </a>
            @endforeach
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
            <a href = "#">Terms and conditions</a>

            <div class = "contacts">
                <a href = "#">Contact</a>
                <p>xpetrikj@stuba.sk</p>
                <p>xmizeraks@stuba.sk</p>
            </div>

            <a href = "https://github.com/jakub-petrik/Dungeon-Goodies" target = "_blank" rel = "noopener noreferrer">Our GitHub</a>
        </div>
    </div>
</footer>

<script>
    const slider = document.getElementById('priceRange');
    const label = document.getElementById('priceLabel');

    slider.addEventListener('input', function () {
        label.textContent = `0€ – ${this.value}€`;
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.rating-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const value = this.dataset.value;
            const input = this.closest('label').querySelector('input[type="radio"]');
            if (input) input.checked = true;

            document.querySelectorAll('.rating-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const ratingButtons = document.querySelectorAll('.rating-btn');
    const ratingInput = document.querySelector('input[name="rating"]');
    const form = document.querySelector('.filter-panel form');

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
});
</script>

</body>

</html>
