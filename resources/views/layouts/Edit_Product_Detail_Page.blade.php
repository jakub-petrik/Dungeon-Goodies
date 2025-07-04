<!DOCTYPE html>
<html lang = "en">

<head>
  <title>Admin Page</title>
  <meta charset = "UTF-8"/>
  <link rel="stylesheet" href="{{ url('/css/Add_New_Product.css') }}" />
  <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

<header>
  <div class = "blue_panel">
    <div class="logo_dungeon_goodies" id="logoTop"></div>
  </div>
</header>

<main>
    <form class="product_add_container"  method="POST" action="{{ route('update-product', ['id' => $product->id]) }}" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div class="photo_section_wrapper">

          <div class="photo_section" onclick="document.getElementById('squareUpload1').click()">
              @if ($product->image_1)
                  <img id="squareImage1" src="{{ asset($product->image_1) }}" alt="Product Image 1" />
                  <span id="squarePlaceholder1" style="display: none;">Photo 1</span>
              @else
                  <img id="squareImage1" src="" style="display: none;" />
                  <span id="squarePlaceholder1">Photo 1</span>
              @endif
              <input type="file" id="squareUpload1" name="image_1" accept="image/*" style="display: none;" onchange="updateImage(event, 1)" />
              <input type="hidden" name="delete_image_1" id="delete_image_1" value="0">
          </div>


          <button class="delete-image-btn" data-index="1" data-id="{{ $product->id }}">Delete Image</button>

          <div class="photo_section a2" onclick="document.getElementById('squareUpload2').click()">
              @if ($product->image_2)
                  <img id="squareImage2" src="{{ asset($product->image_2) }}" alt="Product Image 2" />
                  <span id="squarePlaceholder2" style="display: none;">Photo 2</span>
              @else
                  <img id="squareImage2" src="" style="display: none;" />
                  <span id="squarePlaceholder2">Photo 2</span>
              @endif
              <input type="file" id="squareUpload2" name="image_2" accept="image/*" style="display: none;" onchange="updateImage(event, 2)" />
              <input type="hidden" name="delete_image_2" id="delete_image_2" value="0">
          </div>

          <button class="delete-image-btn" data-index="2" data-id="{{ $product->id }}">Delete Image</button>
        </div>

    @if (session('error_popup'))
        <script>
            window.onload = function() {
                alert("{{ session('error_popup') }}");
            };
        </script>
    @endif

 <div class="product_form">
     @csrf
     @method('POST')

     <input type="text" name="name" placeholder="Product Name" value="{{ $product->name }}" required />

     <select name="type" id="product_type" required>
         <option disabled>Product Type</option>
         <option value="Comics" {{ $product->type === 'Comics' ? 'selected' : '' }}>Comics</option>
         <option value="Funko POP!" {{ $product->type === 'Funko POP!' ? 'selected' : '' }}>Funko POP!</option>
         <option value="Manga" {{ $product->type === 'Manga' ? 'selected' : '' }}>Manga</option>
     </select>

     <input type="number" name="price" placeholder="Product Price" min="0.99" step="0.01" value="{{ $product->price }}" required />

     <textarea name="description" placeholder="Product Info" required>{{ $product->description }}</textarea>

     <select name="manufacturer" required>
         <option disabled>Product Manufacturer</option>
         @foreach (['Adult Swim', 'Image Comics', 'Marvel', 'Warner Bros', 'Yuto'] as $m)
             <option value="{{ $m }}" {{ $product->manufacturer === $m ? 'selected' : '' }}>{{ $m }}</option>
         @endforeach
     </select>

     <select name="format" id="format_select">
         <option value="">No format (e.g., for Funko POP!)</option>
         <option value="Hardcover" {{ $product->format === 'Hardcover' ? 'selected' : '' }}>Hardcover</option>
         <option value="Paperback" {{ $product->format === 'Paperback' ? 'selected' : '' }}>Paperback</option>
     </select>

     <div class="sale_part">
         <label>On Sale?</label>
         <div class="sale_buttons">
             <button type="button" class="sale_yes" onclick="setSale(true)">Yes</button>
             <button type="button" class="sale_no" onclick="setSale(false)">No</button>
         </div>
         <div id="discount_input" class="discount_input" style="{{ $product->on_sale ? '' : 'display:none;' }}">
             <label for="discount_percent">Discount %:</label>
             <input type="number" name="sale_percent" id="discount_percent" min="1" max="100" placeholder="1 – 100" value="{{ $product->sale_percent }}">
         </div>
         <input type="hidden" name="on_sale" id="on_sale" value="{{ $product->on_sale ? '1' : '0' }}">
     </div>

    <div class="button-row">
         <form method="POST" action="{{ route('update-product', ['id' => $product->id]) }}" enctype="multipart/form-data" onsubmit="return validateForm()" class="inline-form">
             @csrf
             @method('POST')
             <button type="submit" class="save_btn">Save Changes</button>

         </form>

         <form method="POST" action="{{ route('product.delete', ['id' => $product->id]) }}" onsubmit="return confirm('Do you really want to delete this product?')" class="inline-form">
             @csrf
             @method('DELETE')
             <button type="submit" class="delete_btn">Delete Product</button>
         </form>
    </div>

 </form>

</main>

<footer>
  <div class = "bottom_panel">
    <div class = "logo_part">
      <div class="logo_dungeon_goodies" id="logoBottom"></div>
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

<script>
document.addEventListener("DOMContentLoaded", function () {
    const typeSelect = document.getElementById("product_type");
    const formatSelect = document.getElementById("format_select");

    const allFormats = {
        funko: [{ value: "", text: "No format (e.g., for Funko POP!)" }],
        other: [
            { value: "Hardcover", text: "Hardcover" },
            { value: "Paperback", text: "Paperback" }
        ]
    };

    function updateFormatOptions() {
        const selectedType = typeSelect.value;
        const currentValue = formatSelect.value;
        formatSelect.innerHTML = "";

        if (selectedType === "Funko POP!") {
            const option = document.createElement("option");

            option.value = "";
            option.textContent = "No format (e.g., for Funko POP!)";
            option.selected = true;

            formatSelect.appendChild(option);
        } else {
            const placeholder = document.createElement("option");

            placeholder.value = "";
            placeholder.textContent = "Product Format";
            placeholder.disabled = true;
            placeholder.selected = true;
            placeholder.hidden = true;

            formatSelect.appendChild(placeholder);

            const formats = [
                { value: "Hardcover", text: "Hardcover" },
                { value: "Paperback", text: "Paperback" }
            ];

            formats.forEach(format => {
                const option = document.createElement("option");
                option.value = format.value;
                option.textContent = format.text;
                if (format.value === currentValue) option.selected = true;
                formatSelect.appendChild(option);
            });
        }
    }


    updateFormatOptions();
    typeSelect.addEventListener("change", updateFormatOptions);
});
</script>

</body>

<script>
  function updateImage(event, index) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
      const img = document.getElementById("squareImage" + index);
      const placeholder = document.getElementById("squarePlaceholder" + index);
      const container = document.querySelectorAll(".photo_section")[index - 1];

      img.src = e.target.result;
      img.style.display = "block";

      placeholder.style.display = "none";
      container.classList.add("has-image");
    };

    if (file) {
      reader.readAsDataURL(file);
    }
  }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
      const image1 = document.getElementById("squareImage1");
      const image2 = document.getElementById("squareImage2");

      if (image1 && image1.getAttribute("src")) {
        image1.closest(".photo_section").classList.add("has-image");
      }

      if (image2 && image2.getAttribute("src")) {
        image2.closest(".photo_section").classList.add("has-image");
      }
    });
</script>

<script>
  function setSale(isOnSale) {
    const saleField = document.getElementById('on_sale');
    const discountInput = document.getElementById('discount_input');

    if (isOnSale) {
      saleField.value = '1';
      discountInput.style.display = 'block';
    } else {
      saleField.value = '0';
      discountInput.style.display = 'none';
      document.getElementById('discount_percent').value = '';
    }

    document.querySelector('.sale_yes').style.opacity = isOnSale ? '1' : '0.5';
    document.querySelector('.sale_no').style.opacity = isOnSale ? '0.5' : '1';
  }
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const isOnSale = document.getElementById('on_sale').value === '1';
    setSale(isOnSale);
  });
</script>

<script>
    function validateForm() {
        const onSale = document.getElementById('on_sale').value;
        const description = document.querySelector('textarea[name="description"]').value.trim();
        const discount = document.getElementById('discount_percent').value.trim();
        const formatValue = document.getElementById('format_select').value;
        const typeValue = document.getElementById('product_type').value;

        if (onSale !== '0' && onSale !== '1') {
            alert('Please select whether the product is on sale.');
            return false;
        } else {
            document.querySelector('.sale_buttons').style.outline = 'none';
        }

        if (!description) {
            alert('Product description is required.');
            return false;
        }

        if (onSale === '1' && (discount === '' || parseInt(discount) < 1)) {
            alert('Discount % is required when the product is on sale.');
            return false;
        } else {
            document.getElementById('discount_percent').style.outline = 'none';
        }

        if (typeValue !== 'Funko POP!' && formatValue === '') {
            alert('Please select a product format.');
            return false;
        }

        return true;
    }
</script>

<script>
document.querySelectorAll('.delete-image-btn').forEach(btn => {
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        const index = this.dataset.index;
        const productId = this.dataset.id;

        if (!confirm('Are you sure you want to delete this image?')) return;

        const imgEl = document.getElementById('squareImage' + index);
        if (!imgEl || !imgEl.src || imgEl.src.startsWith('data:') || imgEl.src.endsWith('/')) {
            alert("This image has not been saved yet. Save first before deleting.");
            return;
        }

        fetch(`/admin/product/${productId}/image/${index}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const img = document.getElementById('squareImage' + index);
                const placeholder = document.getElementById('squarePlaceholder' + index);

                document.getElementById('delete_image_' + index).value = '1';

                img.src = '';
                img.style.display = 'none';
                placeholder.style.display = 'block';
                img.closest('.photo_section').classList.remove('has-image');
            }
            else {
                alert(data.error || 'Error deleting image');
            }
        })
        .catch(err => {
            alert('An error occurred while deleting the image.');
            console.error(err);
        });
    });
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const topLogo = document.getElementById("logoTop");
        const bottomLogo = document.getElementById("logoBottom");

        function warnBeforeLeaving() {
            alert("You need to save changes to leave.");
        }

        if (topLogo) {
            topLogo.addEventListener("click", warnBeforeLeaving);
        }

        if (bottomLogo) {
            bottomLogo.addEventListener("click", warnBeforeLeaving);
        }
    });
</script>


</html>
