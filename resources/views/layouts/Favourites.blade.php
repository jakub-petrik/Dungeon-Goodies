<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register / Sign In</title>
    <meta charset="UTF-8"/>
    <link href="../css/Favourites.css" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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

<main>
    <div class="favourite-container">
        <div class="favourite-wrapper">
            <h1>Your Favourite Items</h1>
            @if ($favourites->isEmpty())
                <p>You have no favourite items yet.</p>
            @else
                <div class="favourite-list">
                    <ul>
                        @foreach ($favourites as $favourite)
                            <li>
                                <a href="{{ route('product-detail', ['id' => $favourite->product_id]) }}">
                                    {{ $favourite->product->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</main>


<footer>
    <div class="bottom_panel">
        <div class="logo_part">
            <a href="{{ route('admin-page') }}" class="logo_dungeon_goodies" title="Place for logo"></a>
        </div>

        <div class="information_text">
            <a href="#">Terms and conditions</a>

            <div class="contacts">
                <a href="#">Contact</a>
                <p>xpetrikj@stuba.sk</p>
                <p>xmizeraks@stuba.sk</p>
            </div>

            <a href="https://github.com/jakub-petrik/Dungeon-Goodies" target="_blank" rel="noopener noreferrer">Our GitHub</a>
        </div>
    </div>
</footer>

</body>
</html>
