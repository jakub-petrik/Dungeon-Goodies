<!DOCTYPE html>
<html lang = "en">

<head>
    <title>Admin Page</title>
    <meta charset = "UTF-8"/>
    <link rel="stylesheet" href="{{ url('/css/Remove_Product_Page.css') }}" />
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
</head>

<body>

<header>
    <div class = "blue_panel">
        <a href="{{ route('main') }}" class="logo_dungeon_goodies" title="Place for logo"></a>
    </div>
</header>

<div class = "container">
    <h1>Pick product to be removed</h1>

    <div class = "remover">
        <button class = "remove_btn" onclick = "window.location.href = '{{ route('admin-page') }}'">Sakamoto Days 1</button>
        <button class = "remove_btn" onclick = "window.location.href = '{{ route('admin-page') }}'">Sakamoto Days 2</button>
        <button class = "remove_btn" onclick = "window.location.href = '{{ route('admin-page') }}'">The Walking Dead Compendium Vol.1</button>
        <button class = "remove_btn" onclick = "window.location.href = '{{ route('admin-page') }}'">Funko Pop! - SandMan</button>
        <button class = "remove_btn" onclick = "window.location.href = '{{ route('admin-page') }}'">Funko Pop! - Zombie Wolverine</button>
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
</html>
