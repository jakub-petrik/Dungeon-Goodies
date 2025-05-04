<!DOCTYPE html>
<html lang = "en">

<head>
  <title>Admin Page</title>
  <meta charset = "UTF-8"/>
  <link rel="stylesheet" href="{{ url('/css/Users_Info_Page.css') }}" />
  <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
</head>

<body>

<header>
  <div class = "blue_panel">
    <a href="{{ route('main') }}" class="logo_dungeon_goodies" title="Place for logo"></a>
  </div>
</header>

<main>
  <div class = "search_part">
    <input type = "text" placeholder = "Search Users..." class = "searcher">
    <button class = "search_btn">&#128269;</button>
  </div>

  <div class = "users_table">
    <div class = "user_info header">
      <span>ID</span>
      <span>Full Name</span>
      <span>Email</span>
      <span>Role</span>
    </div>

    <div class = "user_info">
      <span>1</span>
      <span>Jakub Petrik</span>
      <span>xpetrikj@stuba.sk</span>
      <span>Admin</span>
    </div>

    <div class = "user_info">
      <span>2</span>
      <span>Simon Mizerak</span>
      <span>xmizeraks@stuba.sk</span>
      <span>Admin</span>
    </div>

    <div class = "user_info">
      <span>3</span>
      <span>Drahomir Piok</span>
      <span>d.piok1989@gmail.com</span>
      <span>Member</span>
    </div>

    <div class = "user_info">
      <span>4</span>
      <span>Kimi Antonelli</span>
      <span>antoneli.kimi@gmail.com</span>
      <span>Member</span>
    </div>
  </div>
</main>

<footer>
  <div class = "bottom_panel">
    <div class = "logo_part">
      <a href="{{ route('admin-page') }}" class="logo_dungeon_goodies" title="Place for logo"></a>
    </div>

    <div class = "information_text">
      <a href = "javascript:void(0)" onclick = "alert('Please be kind on our website :)')">Terms and conditions</a>

      <div class = "contacts">
        <a href="https://is.stuba.sk/?lang=sk" target="_blank" rel="noopener noreferrer">Contact Us</a>
        <p>xpetrikj@stuba.sk</p>
        <p>xmizeraks@stuba.sk</p>
      </div>

      <a href = "https://github.com/jakub-petrik/Dungeon-Goodies" target = "_blank" rel = "noopener noreferrer">Our GitHub</a>
    </div>
  </div>
</footer>

</body>
</html>
