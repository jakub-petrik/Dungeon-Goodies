<!DOCTYPE html>
<html lang = "en">

<head>
    <title>Product Page</title>
    <meta charset = "UTF-8"/>
    <link rel="stylesheet" href="{{ url('/css/Product_Detail.css') }}" />
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
    <div class="container">
        <div class="product">
            <div class = "product_image_wrapper_full">
                <div class = "product_image_wrapper">
                    <img src="{{ asset($product->image_1) }}" alt="{{ $product->name }}" class="product_image" id="mainImage">
                </div>

                <div class = "thumbnail_container">
                    <img src="{{ asset($product->image_1) }}" class="thumbnail" onclick="changeImage(this)">
                        @if($product->image_2)
                            <img src="{{ asset($product->image_2) }}" class="thumbnail" onclick="changeImage(this)">
                        @endif
                </div>
            </div>
            <div class="details">
                <h1>{{ $product->name }}</h1>

                <p class="category">{{ $product->type }}</p>
                <!---<span class="tag">New</span>--->

                @if ($product->on_sale)
                    <div class="price_wrapper">
                        <s class="original_price">€{{ number_format($product->price, 2) }}</s>
                        <span class="sale_price">€{{ number_format($product->price * (1 - $product->sale_percent / 100), 2) }}</span>
                    </div>
                @else
                    <p class="price">€{{ number_format($product->price, 2) }}</p>
                @endif

                <div class="button-container">
                    <div class="favorite-wrapper">
                        @php
                            $isFavourited = auth()->check() && \App\Models\Favourite::where('user_id', auth()->id())
                                              ->where('product_id', $product->id)
                                              ->exists();
                        @endphp
                        <button class="favorite" id="toggleFavouriteBtn" data-product-id="{{ $product->id }}">
                            <span class="heart-icon">{{ $isFavourited ? '❤️' : '♡' }}</span>
                            {{ $isFavourited ? 'Added to Favourites' : 'Add to Favourites' }}
                        </button>
                    </div>

                    <div class = "amount_check">
                        <button class = "amount_btn minus_btn">-</button>
                        <label>
                            <input type = "text" id = "quantity" class = "amount_num" value = "1" readonly />
                        </label>
                        <button class = "amount_btn plus_btn">+</button>
                    </div>

                    <form method="POST" action="{{ route('cart.add') }}" class="buy-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="amount" id="amountInput" value="1">
                        <button class="buy">🛒 Buy</button>
                    </form>

                </div>

                <div class="about">
                    <strong>About this product</strong>
                    <p>{{ $product->description }}</p>
                </div>

            </div>
        </div>

        <div class="reviews-section">
            <h2 class="reviews-title">Reviews</h2>
            <p class="see-more">Click to see more</p>
            <div class="reviews">
                <div class="review-card">
                    <div class="stars">★★★★★</div>
                    <p class="review-text">Best Manga!!!</p>
                    <div class="review-footer">
                        <div class="avatar"></div>
                        <div class="review-info">
                            <p class="review-author">Jakub Petrik</p>
                            <p class="review-date">27/2/2025</p>
                        </div>
                    </div>
                </div>

                <div class="review-card">
                    <div class="stars">★★★★★</div>
                    <p class="review-text">Great.</p>
                    <div class="review-footer">
                        <div class="avatar"></div>
                        <div class="review-info">
                            <p class="review-author">Simon Mizerak</p>
                            <p class="review-date">27/2/2025</p>
                        </div>
                    </div>
                </div>

                <div class="review-card">
                    <div class="stars">★★★★★</div>
                    <p class="review-text">WoW</p>
                    <div class="review-footer">
                        <div class="avatar"></div>
                        <div class="review-info">
                            <p class="review-author">Bak12</p>
                            <p class="review-date">27/2/2025</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

</body>

<script>
    function changeImage(thumbnail) {
        const mainImg = document.getElementById("mainImage");
        mainImg.src = thumbnail.src;
    }
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const minusBtn = document.querySelector(".minus_btn");
        const plusBtn = document.querySelector(".plus_btn");
        const quantityInput = document.getElementById("quantity");
        const amountInput = document.getElementById("amountInput");
        const favBtn = document.getElementById("toggleFavouriteBtn");

        if (minusBtn) {
            minusBtn.addEventListener("click", function () {
                let value = parseInt(quantityInput.value);
                if (value > 1) {
                    quantityInput.value = value - 1;
                    amountInput.value = value - 1;
                }
            });
        }

        if (plusBtn) {
            plusBtn.addEventListener("click", function () {
                let value = parseInt(quantityInput.value);
                quantityInput.value = value + 1;
                amountInput.value = value + 1;
            });
        }

        if (favBtn) {
            console.log("Favourite button element found:", favBtn); // ADDED LOG
            favBtn.addEventListener("click", function () {
                const productId = this.getAttribute("data-product-id");
                console.log("Favourite button clicked for product ID:", productId); // ADDED LOG

                fetch("{{ route('favourites.toggle') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(res => {
                    console.log("Fetch response:", res); // ADDED LOG
                    return res.json();
                })
                .then(data => {
                    console.log("Fetch data:", data); // ADDED LOG
                    const icon = favBtn.querySelector(".heart-icon");
                    if (data.status === "added") {
                        icon.textContent = "❤️";
                        favBtn.innerHTML = `<span class="heart-icon">❤️</span> Added to Favourites`;
                    } else if (data.status === "removed") {
                        icon.textContent = "♡";
                        favBtn.innerHTML = `<span class="heart-icon">♡</span> Add to Favourites`;
                    }
                })
                .catch(error => {
                    console.error("Fetch error:", error); // MODIFIED LOG
                    alert("Something went wrong.");
                });
            });
        } else {
            console.log("Favourite button element NOT found!"); // ADDED LOG
        }
    });
</script>

</html>
