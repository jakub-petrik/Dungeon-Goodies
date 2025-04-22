<!DOCTYPE html>
<html lang = "en">

<head>
  <title>Dungeon Goodies</title>
  <meta charset = "UTF-8"/>
  <link rel="stylesheet" href="{{ url('/css/Delivery.css') }}" />
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

<section class = "delivery_payment">
  <h2>Delivery</h2>

  <form class = "delivery_form" method="POST" action="{{ route('store-billing') }}">
    @csrf
    <div class = "form_field">
      <label for = "email">Email address:</label>
      <input type = "email" id = "email" name="email" placeholder = "Insert text">
    </div>

    <div class = "form_field">
      <label for = "first_name">First name:</label>
      <input type = "text" id = "first_name" name="first_name" placeholder = "Insert text">
    </div>

    <div class = "form_field">
      <label for = "last_name">Last name:</label>
      <input type = "text" id = "last_name" name="last_name" placeholder = "Insert text">
    </div>

    <div class = "form_field">
      <label for = "country">Country:</label>
      <input type = "text" id = "country" name="country" placeholder = "Insert text">
    </div>

    <div class = "form_field">
      <label for = "state">State:</label>
      <input type = "text" id = "state" name="state" placeholder = "Insert text">
    </div>

    <div class = "form_field">
      <label for = "city">City:</label>
      <input type = "text" id = "city" name="city" placeholder = "Insert text">
    </div>

    <div class = "form_field">
      <label for = "postal_code">Postal code:</label>
      <input type = "text" id = "postal_code" name="postal_code" placeholder = "Insert text">
    </div>

    <div class = "form_field">
      <label for = "phone_number">Phone number:</label>
      <input type = "tel" id = "phone_number" name="phone_number" placeholder = "Insert text">
    </div>

    <div class = "transport_part">
      <h3>Mode of transport</h3>

      <div class = "delivery_choice">
        <label class = "delivery_option">
          <input type = "radio" name = "transport" value = "sps">
          <span class = "star">★</span>
          <span class = "label_text">SPS</span>
          <span class = "price">5.99 €</span>
        </label>

        <label class = "delivery_option">
          <input type = "radio" name = "transport" value = "packet">
          <span class = "star">★</span>
          <span class = "label_text">Packet</span>
          <span class = "price">6.99 €</span>
        </label>

        <label class = "delivery_option">
          <input type = "radio" name = "transport" value = "upc">
          <span class = "star">★</span>
          <span class = "label_text">UPC Box</span>
          <span class = "price">7.99 €</span>
        </label>
      </div>

      <button type="submit" class="buy_btn">Continue To Payment</button>
    </div>
  </form>
</section>

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
