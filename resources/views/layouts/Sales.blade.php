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
    <aside class = "filter-panel">
        <h4>Filter</h4>
        <div class = "tags">
            <span class = "tag">Manga</span>
            <span class = "tag">Comics</span>
            <span class = "tag">Funko POP!</span>
        </div>
        <h4 class = "price_class">Price</h4>
        <input type = "range" id = "priceRange" min = "0" max = "100" value = "100">
        <div id = "priceLabel">0€ – 100€</div>
        <h4 class = "product-type_class">Product Type</h4>
        <div class = "product-type">
            <label><input type = "checkbox" checked> Manga</label>
            <label><input type = "checkbox" checked> Comics</label>
            <label><input type = "checkbox" checked> Funko POP!</label>
        </div>
        <h4 class = "rating-title">Rating</h4>
        <div class = "star-filter" id = "starFilter">
            <span class = "star" data-value = "1">☆</span>
            <span class = "star" data-value = "2">☆</span>
            <span class = "star" data-value = "3">☆</span>
            <span class = "star" data-value = "4">☆</span>
            <span class = "star" data-value = "5">☆</span>
        </div>

    </aside>
    <section class="products-grid">
        <div class="top-bar">
            <div class="search-container">
                <label><input type="text" class="search-bar" placeholder="Search"></label>
                <button class="search-icon">🔍</button>
            </div>

            <div class="sort-options">
                <button class="active">New</button>
                <button class="pa">Price ascending</button>
                <button class="pd">Price descending</button>
                <button class="ra">Rating</button>
            </div>
        </div>
        <div class="product-list">
            <a href="{{ route('product-detail') }}" class="product-link">
                <div class="product">
                    <div class="image">
                        <div class="sale-banner">ON SALE</div>
                        <div class="heart">♡</div>
                        <img src = "{{ asset('Products/Junji_Ito_Shiver.jpg') }}" alt = "Junji Ito - Shiver" class = "product_img">
                    </div>
                    <p class = "product_name">Junji Ito - Shiver</p>
                    <s class = "product_price">€12.99</s>
                    <p class = "sale_price">€10.99</p>
                    <button class="buy-btn">Buy</button>
                </div>
            </a>
            <a href="{{ route('product-detail') }}" class="product-link">
                <div class="product">
                    <div class="image">
                        <div class="sale-banner">ON SALE</div>
                        <div class="heart">♡</div>
                        <img src = "{{ asset('Products/OldManLogan.jpg') }}" alt = "Wolverine: Old Man Logan" class = "product_img">
                    </div>
                    <p class = "product_name">Wolverine: Old Man Logan</p>
                    <s class = "product_price">€12.99</s>
                    <p class = "sale_price">€10.99</p>
                    <button class="buy-btn">Buy</button>
                </div>
            </a>
            <a href="{{ route('product-detail') }}" class="product-link">
                <div class="product">
                    <div class="image">
                        <div class="sale-banner">ON SALE</div>
                        <div class="heart">♡</div>
                        <img src = "{{ asset('Products/Fell.jpg') }}" alt = "Fell Vol.1" class = "product_img">
                    </div>
                    <p class = "product_name">Fell Vol.1</p>
                    <s class = "product_price">€12.99</s>
                    <p class = "sale_price">€39.99</p>
                    <button class="buy-btn">Buy</button>
                </div>
            </a>
            <a href="{{ route('product-detail') }}" class="product-link">
                <div class="product">
                    <div class="image">
                        <div class="sale-banner">ON SALE</div>
                        <div class="heart">♡</div>
                        <img src = "{{ asset('Products/Funko_Pop_TheBatman.jpg') }}" alt = "Funko Pop! - TheBatman" class = "product_img">
                    </div>
                    <p class = "product_name"> Funko Pop! - The Batman</p>
                    <s class = "product_price">€15.99</s>
                    <p class = "sale_price">€12.99</p>
                    <button class="buy-btn">Buy</button>
                </div>
            </a>
            <a href="{{ route('product-detail') }}" class="product-link">
                <div class="product">
                    <div class="image">
                        <div class="sale-banner">ON SALE</div>
                        <div class="heart">♡</div>
                        <img src = "{{ asset('Products/Funko_Pop_Nebula.jpg') }}" alt = "Funko Pop! - Nebula" class = "product_img">
                    </div>
                    <p class = "product_name">Funko Pop! - Nebula</p>
                    <s class = "product_price">€15.99</s>
                    <p class = "sale_price">€12.99</p>
                    <button class="buy-btn">Buy</button>
                </div>
            </a>
            <a href="{{ route('product-detail') }}" class="product-link">
                <div class="product">
                    <div class="image">
                        <div class="sale-banner">ON SALE</div>
                        <div class="heart">♡</div>
                        <img src = "{{ asset('Products/Funko_Pop_SpiderMan.jpg') }}" alt = "Funko Pop! - SpiderMan" class = "product_img">
                    </div>
                    <p class = "product_name">Funko Pop! - Spider-Man</p>
                    <s class = "product_price">€15.99</s>
                    <p class = "sale_price">€12.99</p>
                    <button class="buy-btn">Buy</button>
                </div>
            </a>
        </div>
    </section>
</div>

<div class = "paging_part">
    <button class = "page_circle active">1</button>
    <button class = "page_circle">2</button>
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

</html>
