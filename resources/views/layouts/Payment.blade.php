<!DOCTYPE html>
<html lang = "en">

<head>
    <title>Dungeon Goodies</title>
    <meta charset = "UTF-8"/>
    <link rel="stylesheet" href="{{ url('/css/Payment.css') }}" />
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

<main class = "page_content">
    <section class = "delivery_payment">
        <form method="POST" action="{{ route('process-payment') }}">
            @csrf
            <div class = "payment_part">
                <h3>Payment method</h3>

                <div class = "payment_choice">
                    <label class = "payment_option">
                        <input type = "radio" name = "payment" value = "cash">
                        <span class = "star">★</span>
                        <span class = "label_text">Cash on delivery</span>
                        <span class = "price">1.99 €</span>
                    </label>

                    <label class = "payment_option">
                        <input type = "radio" name = "payment" value = "card">
                        <span class = "star">★</span>
                        <span class = "label_text">By card online</span>
                        <span class = "price">Free</span>
                    </label>

                    <label class = "payment_option">
                        <input type = "radio" name = "payment" value = "bank">
                        <span class = "star">★</span>
                        <span class = "label_text">Bank transfer</span>
                        <span class = "price">Free</span>
                    </label>
                </div>
            </div>

            <div class = "total_summary" style = "font-size: 1.3rem; margin-top: 2rem;">
                <p><strong>Total with Delivery & Payment:</strong>
                    <span id = "final_total">{{ number_format($productTotal + $deliveryCost, 2) }} €</span>
                </p>
            </div>

            <button type = "submit" class = "buy_btn">Buy</button>
        </form>
    </section>
</main>

<footer>
  <div class="bottom_panel">
  @auth
    @if(Auth::user()->admin)
      <div class="logo_part">
        <a href="{{ route('admin-page') }}" class="logo_dungeon_goodies" title="Place for logo"></a>
      </div>
    @else
      <div class="logo_part">
          <a href="{{ route('main') }}" class="logo_dungeon_goodies" title="Place for logo"></a>
      </div>
    @endif
  @endauth

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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form[action="{{ route('process-payment') }}"]');
    const paymentRadios = document.querySelectorAll('input[name="payment"]');
    const finalTotalEl = document.getElementById('final_total');
    const baseTotal = {{ $productTotal + $deliveryCost }};

    function updateFinalTotal() {
        let extraFee = 0;
        const selected = document.querySelector('input[name="payment"]:checked');

        if (selected && selected.value === 'cash') {
            extraFee = 1.99;
        }

        finalTotalEl.textContent = (baseTotal + extraFee).toFixed(2) + ' €';
    }

    paymentRadios.forEach(r => r.addEventListener('change', updateFinalTotal));
    updateFinalTotal();

    form.addEventListener('submit', function (e) {
        const selected = document.querySelector('input[name="payment"]:checked');

        if (!selected) {
            e.preventDefault();
            alert("Please select a payment method.");
        }
    });
});
</script>

</body>

</html>
