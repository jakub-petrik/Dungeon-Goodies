<!DOCTYPE html>
<html lang = "en">

<head>
  <title>Dungeon Goodies</title>
  <meta charset = "UTF-8"/>
  <link rel="stylesheet" href="{{ url('/css/Shopping_Cart.css') }}" />
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

<main class = "shopping_cart_container">
  <h1 class = "cart_title">Shopping Cart</h1>

  @foreach ($items as $item)
      <div class="cart_product">
          <div class="cart_product_left">
              <a href="{{ route('product-detail', ['id' => $item->product->id]) }}" class="cart_product_image">
                  <img src="{{ asset($item->product->image_1) }}" alt="{{ $item->product->name }}">
              </a>

              <div class="cart_product_info">
                  <h2 class="product_name">
                      <a href="{{ route('product-detail', ['id' => $item->product->id]) }}">{{ $item->product->name }}</a>
                  </h2>

                  <p class="product_info">{{ $item->product->type }}</p>

                  @if (isset($item->id))

                      <form method="POST" action="{{ route('cart.remove', ['id' => $item->id]) }}">
                          @csrf
                          @method('DELETE')
                          <button class="remove_btn">Remove</button>
                      </form>
                  @else

                      <form method="POST" action="{{ route('cart.remove.guest', ['id' => $item->product->id]) }}">
                          @csrf
                          <button class="remove_btn">Remove</button>
                      </form>
                  @endif


                  <div class="amount_check">
                      <form method="POST" action="{{ route('cart.update', ['id' => $item->id ?? $item->product->id]) }}">
                          @csrf
                          <input type="hidden" name="direction" value="decrease">
                          <button class="amount_btn" type="submit">-</button>
                      </form>

                      <label>
                          <input type="text" class="amount_num" value="{{ number_format($item->amount, 0) }}" readonly />
                      </label>

                      <form method="POST" action="{{ route('cart.update', ['id' => $item->id ?? $item->product->id]) }}">
                          @csrf
                          <input type="hidden" name="direction" value="increase">
                          <button class="amount_btn" type="submit">+</button>
                      </form>
                  </div>

              </div>
          </div>

          <div class="cart_product_right">
              @php
                  $price = $item->product->on_sale
                      ? $item->product->price * (1 - $item->product->sale_percent / 100)
                      : $item->product->price;
              @endphp
              <div class="product_price">€{{ number_format($price * $item->amount, 2) }}</div>
          </div>
      </div>
  @endforeach


  <div class="total_part">
      <span class="total_text">TOTAL</span>
      <div class="total_price_and_btn">
          <span class="total_price">€{{ number_format($total, 2) }}</span>
          <a href="{{ route('delivery') }}" class="buy_btn">BUY</a>
      </div>
  </div>


</main>

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
