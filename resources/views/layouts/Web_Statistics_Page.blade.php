<!DOCTYPE html>
<html lang = "en">

<head>
  <title>Admin Page</title>
  <meta charset = "UTF-8"/>
  <link rel="stylesheet" href="{{ url('/css/Web_Statistics_Page.css') }}" />
  <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
</head>

<body>

<header>
  <div class = "blue_panel">
    <a href="{{ route('main') }}" class="logo_dungeon_goodies" title="Place for logo"></a>
  </div>
</header>

<main class = "web_info">
  <div class = "info_text">Total Users – 23 456</div>
  <div class = "info_text">Daily Users – 1278</div>
  <div class = "info_text">Products Sold Today – 732 </div>
  <div class = "info_text">Today Profit – 13 478 €</div>
  <div class = "info_text">Monthly Profit – 123 998 €</div>
  <div class = "info_text">Yearly Profit – 1 234 112 €</div>
</main>

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
