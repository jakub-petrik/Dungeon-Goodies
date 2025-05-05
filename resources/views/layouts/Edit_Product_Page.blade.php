<!DOCTYPE html>
<html lang = "en">

<head>
  <title>Admin Page</title>
  <meta charset = "UTF-8"/>
  <link rel="stylesheet" href="{{ url('/css/Edit_Product_Page.css') }}" />
  <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
</head>

<body>

<header>
  <div class = "blue_panel">
    <a href="{{ route('main') }}" class="logo_dungeon_goodies" title="Place for logo"></a>
  </div>
</header>

<div class = "container">
  <div class = "search_part">
    <input type = "text" placeholder = "Search Product Name..." class = "searcher" id = "productSearch">
    <button class = "search_btn">&#128269;</button>
  </div>

  <div class = "edit_product">
    <div class="edit_product">
        @foreach ($products as $product)
            <button class="edit_btn" onclick="window.location.href = '{{ route('edit-product-detail', ['id' => $product->id]) }}'">
                {{ $product->name }}
            </button>
        @endforeach
    </div>

    <div class="paging_part">
        @for ($i = 1; $i <= $products->lastPage(); $i++)
            <a href="{{ $products->url($i) }}" class="page_circle {{ $products->currentPage() == $i ? 'active' : '' }}">
                {{ $i }}
            </a>
        @endfor
    </div>

  </div>
</div>

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
