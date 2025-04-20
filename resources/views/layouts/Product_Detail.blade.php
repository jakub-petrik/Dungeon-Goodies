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
            <button class="btn sign_in" onclick="window.location.href = '{{ route('sign-in-register') }}'">Sign in/out</button>
            <button class="btn register" onclick="window.location.href = '{{ route('sign-in-register') }}'">Register</button>

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
                    <img src = "{{ asset('Products/Sakamoto_Days_1.jpg') }}" alt = "Sakamoto Days 1" class = "product_image" id = "mainImage">
                </div>

                <div class = "thumbnail_container">
                    <img src = "{{ asset('Products/Sakamoto_Days_1.jpg') }}" class = "thumbnail" onclick = "changeImage(this)">
                    <img src = "{{ asset('Products/Sakamoto_Days_1_Back.jpg') }}" class = "thumbnail" onclick = "changeImage(this)">
                </div>
            </div>
            <div class="details">
                <h1>Sakamoto Days 1</h1>
                <span class="tag">New</span>
                <p class="price">€12.99</p>
                <p class="category">Manga</p>
                <div class="button-container">
                    <div class="favorite-wrapper">
                        <button class="favorite" onclick="alert('Added to favourite products!')">
                            <span class="heart-icon">♡</span> Add to Favourites
                        </button>
                    </div>

                    <div class = "amount_check">
                        <button class = "amount_btn minus_btn">-</button>
                        <label>
                            <input type = "text" class = "amount_num" value = "1" readonly />
                        </label>
                        <button class = "amount_btn plus_btn">+</button>
                    </div>

                    <button class="buy" onclick="window.location.href = '{{ route('shopping-cart') }}'">🛒 Buy</button>
                </div>
                <div class="about">
                    <strong>About this product</strong>
                    <p>Manga about dude that is like John Wick but little chubby.</p>
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
            <a href = "Admin_Page.blade.php" class = "logo_dungeon_goodies" title = "Place for logo"></a>
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

</html>
