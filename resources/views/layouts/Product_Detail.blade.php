<!DOCTYPE html>
<html lang = "en">

<head>
    <title>Product Page</title>
    <meta charset = "UTF-8"/>
    <link rel="stylesheet" href="{{ url('/css/Product_Detail.css') }}" />
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

<header>
    <div class = "blue_panel">
        <a href="{{ route('main') }}" class="logo_dungeon_goodies" title="Go to main page"></a>

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
                <button class="btn sign_in real" onclick="window.location.href = '{{ route('sign-in-register') }}'">Sign In</button>
                <button class="btn register" onclick="window.location.href = '{{ route('register') }}'">Register</button>
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
                            <input type="number" id="quantity" class="amount_num" value="1" min="1" inputmode="numeric">
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

                    <strong style="display: block; margin-top: 0.8rem;">Manufacturer</strong>
                    <p>{{ $product->manufacturer }}</p>

                    @if ($product->format)
                        <strong style="display: block; margin-top: 0.8rem;">Format</strong>
                        <p>{{ $product->format }}</p>
                    @endif
                </div>

            </div>
        </div>

    </div>
</div>

<footer>
  <div class="bottom_panel">
  @auth
    @if(Auth::user()->admin)
      <div class="logo_part">
        <a href="{{ route('admin-page') }}" class="logo_dungeon_goodies" title="Go to admin page"></a>
      </div>
    @else
      <div class="logo_part">
          <a href="{{ route('main') }}" class="logo_dungeon_goodies" title="Go to main page"></a>
      </div>
    @endif
  @endauth

    @guest
         <div class="logo_part">
           <a href="{{ route('main') }}" class="logo_dungeon_goodies" title="Go to main page"></a>
         </div>
     @endguest

    <div class="information_text">
      <a href="javascript:void(0)" onclick="alert('Please be kind on our website :)')">Terms and conditions</a>

      <div class="contacts">
        <a href="https://is.stuba.sk/?lang=sk" target="_blank" rel="noopener noreferrer">Contact Us</a>
        <p>xpetrikj@stuba.sk</p>
        <p>xmizeraks@stuba.sk</p>
      </div>

      <a href="https://github.com/jakub-petrik/Dungeon-Goodies" target="_blank" rel="noopener noreferrer">Our GitHub</a>
    </div>
  </div>
</footer>

</body>

<script src="{{ asset('js/Product_Detail.js') }}"></script>

</html>
