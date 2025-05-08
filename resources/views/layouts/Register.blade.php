<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
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
        <h2>Register</h2>
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
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <label for="nickname">Nickname</label>
                <input type="text" name="nickname" placeholder="Nickname" value="{{ old('nickname') }}" required>

                <label for="first_name">First Name</label>
                <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required>

                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>

                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" required>

                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

                <button type="submit">Register</button>
            </form>

        </div>
    </div>
</div>

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

    @guest
         <div class="logo_part">
           <a href="{{ route('main') }}" class="logo_dungeon_goodies" title="Place for logo"></a>
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
</html>
