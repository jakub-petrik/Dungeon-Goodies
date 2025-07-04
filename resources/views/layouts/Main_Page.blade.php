<!DOCTYPE html>
<html lang = "en">

<head>
    <title>Dungeon Goodies</title>
    <meta charset = "UTF-8"/>
    <link rel="stylesheet" href="{{ url('/css/Main_Page.css') }}" />
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
</head>

<body>
<header>
    <div class = "blue_panel">
        <a href="{{ route('main') }}" class="logo_dungeon_goodies" title="Go to main page"></a>

        <div class = "types">
            <a href="{{ route('product-page') }}" class="link_type products">Products</a>
            <a href="{{ route('sales') }}" class="link_type sales">Sales</a>
        </div>

        <div class="buttons">
            @auth
                <button class="btn favourite" onclick="window.location.href = '{{ route('favourites') }}'">Favourites</button>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn sign_in">Logout</button>
                </form>
            @else
                <button class="btn sign_in" onclick="window.location.href = '{{ route('sign-in-register') }}'">Sign In</button>
                <button class="btn register" onclick="window.location.href = '{{ route('register') }}'">Register</button>
            @endauth
        </div>
    </div>

    <div class = "pink_panel">
        <div class = "types">
            <a href="{{ route('product-page', ['type[]' => 'Comics']) }}" class="link_type">Comics</a>
            <a href="{{ route('product-page', ['type[]' => 'Funko POP!']) }}" class="link_type">Funko POP!</a>
            <a href="{{ route('product-page', ['type[]' => 'Manga']) }}" class="link_type">Manga</a>
        </div>

        <div class = "button_part">
            <a href="{{ route('shopping-cart') }}" class="btn shopping_cart">
                <svg viewBox = "0 0 24 24" width="24" height="24">
                    <path fill = "currentColor" d="M7 4h-2l-1 2h2l3 6-1.2 2.2c-.2.3-.2.6-.2.8 0 .8.6 1.4 1.4 1.4h10v-2h-9.4l.8-1.6h5.8c.6 0 1-.4 1.2-.9l2.4-4.5c.1-.2.1-.4.1-.6 0-.5-.4-.9-.9-.9h-11.6l-.7-2zm5 14c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm7 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                </svg>
            </a>
        </div>
    </div>
</header>

<main>
    <section class = "main_window">
        <h1>Dungeon Goodies</h1>

        <form method="GET" action="{{ route('product-page') }}" class="search_bar">
            <input type="text" name="search" placeholder="Manga, comics or funko..." aria-label="Search" value="{{ request('search') }}" />
            <button type="submit" class="search_btn">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none">
                    <path d="M15.5 14h-0.79l-0.28-0.27c0.98-1.14 1.57-2.57 1.57-4.15 0-3.53-2.86-6.39-6.39-6.39s-6.39 2.86-6.39 6.39 2.86 6.39 6.39 6.39c1.58 0 3.01-0.59 4.15-1.57l0.27 0.28v0.79l5 4.99 1.49-1.49-4.99-5zm-5.11 0c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" fill="currentColor"/>
                </svg>
            </button>
        </form>
    </section>

    <section class = "new_arrivals">
        <a href="{{ route('product-page') }}" class = "clickable_section">
            <h2>New Arrivals</h2>
            <p>Click to see more</p>
        </a>

        <div class = "scroller">
            <button class = "scroller_button left">&#10094;</button>

            <div class = "scroller_items" id = "new_arrivals_scrolling">
                @foreach ($latestProducts as $product)
                    <a href="{{ route('product-detail', ['id' => $product->id]) }}" class="item">
                        <img src="{{ asset($product->image_1) }}" alt="{{ $product->name }}" style="max-height: 180px; object-fit: contain;">
                    </a>
                @endforeach
            </div>


            <button class = "scroller_button right">&#10095;</button>
        </div>
    </section>

    <section class = "what_you_may_like">
        <a href="{{ route('product-page', ['sort' => 'pa']) }}" class="clickable_section">
            <h2>What You May Like</h2>
            <p>Click to see more</p>
        </a>

        <div class = "scroller">
            <button class = "scroller_button left">&#10094;</button>

            <div class="scroller_items" id = "what_you_may_like_scrolling">
                @foreach ($topRatedProducts as $product)
                    <a href="{{ route('product-detail', ['id' => $product->id]) }}" class="item">
                        <img src="{{ asset($product->image_1) }}" alt="{{ $product->name }}" style="max-height: 180px; object-fit: contain;">
                    </a>
                @endforeach
            </div>

            <button class = "scroller_button right">&#10095;</button>
        </div>
    </section>
</main>

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

<script src="{{ asset('js/Main_Page.js') }}"></script>

</body>
</html>
