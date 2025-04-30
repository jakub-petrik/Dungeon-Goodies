<!DOCTYPE html>
<html lang = "en">

<head>
    <title>Admin Page</title>
    <meta charset = "UTF-8"/>
    <link rel="stylesheet" href="{{ url('/css/Admin_Page.css') }}" />
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
</head>

<body>
<div class = "content">
<header>
    <div class = "blue_panel">
        <a href="{{ route('main') }}" class="logo_dungeon_goodies" title="Place for logo"></a>
    </div>
</header>

<div class="container">
    <h1>Admin Page</h1>
    <div class="accordion">
        <button class="accordion-button" onclick="window.location.href = '{{ route('add-product') }}'">Add product</button>
        <button class="accordion-button" onclick="window.location.href = '{{ route('remove-product') }}'">Remove product</button>
        <button class="accordion-button" onclick="window.location.href = '{{ route('edit-product') }}'">Edit product</button>
        <button class="accordion-button" onclick="window.location.href = '{{ route('users-info') }}'">Users</button>
        <button class="accordion-button" onclick="window.location.href = '{{ route('web-statistics') }}'">Website statistics</button>
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
</html>
