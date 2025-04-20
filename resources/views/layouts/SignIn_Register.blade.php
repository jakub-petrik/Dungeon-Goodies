<!DOCTYPE html>
<html lang = "en">

<head>
    <title>Product Page</title>
    <meta charset = "UTF-8"/>
    <link href = "../css/SignIn_Register.css" rel = "stylesheet"/>
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
</head>

<body>

<header>
    <div class = "blue_panel">
        <a href="{{ route('main') }}" class="logo_dungeon_goodies" title="Place for logo"></a>
    </div>
</header>

<div class="auth-container">
    <div class="auth-wrapper">
        <h2>Register / Sign In</h2>
        <div class="auth-box">
            <form>
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Value" required>

                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Value" required>

                <button type="submit" onclick = "window.location.href = '{{ route('main') }}'">Register / Sign in</button>
            </form>
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
