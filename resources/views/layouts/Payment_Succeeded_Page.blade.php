<!DOCTYPE html>
<html lang = "en">

<head>
  <title>Admin Page</title>
  <meta charset = "UTF-8"/>
  <link rel="stylesheet" href="{{ url('/css/Payment_Succeeded_Page.css') }}" />
  <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
</head>

<body>

<header>
  <div class = "blue_panel">
    <a href="{{ route('main') }}" class="logo_dungeon_goodies" title="Place for logo"></a>
  </div>
</header>

<section class = "successful_pay">
    <img src = "{{ asset('Tick.png') }}" alt = "Success icon" class = "tick">
  <h2>Payment succeeded!</h2>
  <button onclick="window.location.href = '{{ route('main') }}'">Done</button>
</section>

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
