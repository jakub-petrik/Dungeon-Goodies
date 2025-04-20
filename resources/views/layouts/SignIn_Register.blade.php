<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register / Sign In</title>
    <meta charset="UTF-8"/>
    <link href="../css/SignIn_Register.css" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>

<header>
    <div class="blue_panel">
        <a href="{{ route('main') }}" class="logo_dungeon_goodies" title="Place for logo"></a>
    </div>
</header>

<div class="auth-container">
    <div class="auth-wrapper">
        <h2>Register / Sign In</h2>
        <div class="auth-box">

            {{-- Show validation or auth errors --}}
            @if($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li style="color:red;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('status'))
                <div class="status-message" style="color:green;">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Combined Auth Form --}}
            <form method="POST" action="{{ route('auth.combined') }}">
                @csrf

                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required>

                <button type="submit">Continue</button>
            </form>

        </div>
    </div>
</div>

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
