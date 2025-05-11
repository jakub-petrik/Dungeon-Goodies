<!DOCTYPE html>
<html lang = "en">

<head>
    <title>Admin Page</title>
    <meta charset = "UTF-8"/>
    <link rel="stylesheet" href="{{ url('/css/Add_New_Product.css') }}" />
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
</head>

<body>

<header>
    <div class = "blue_panel">
        <a href="{{ route('main') }}" class="logo_dungeon_goodies" title="Go to main page"></a>
    </div>
</header>

<main>
    <form class="product_add_container" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" onsubmit="return validateForm()">
        @csrf
        <div class="photo_section_wrapper">
            <div class="photo_section" onclick="document.getElementById('squareUpload1').click()">
                <img id="squareImage1" src="{{asset(session('temp_image_1'))}}" alt=""/>
                <span id="squarePlaceholder1" style="{{ session('temp_image_1') ? 'display: none;' : '' }}">Photo 1</span>
                <input type="file" id="squareUpload1" name="image_1" accept="image/*" style="display: none;" onchange="updateImage(event, 1)" />
            </div>

            <div class="photo_section a2" onclick="document.getElementById('squareUpload2').click()">
                <img id="squareImage2" src="{{asset(session('temp_image_2'))}}" alt="">
                <span id="squarePlaceholder2" style="{{ session('temp_image_2') ? 'display: none;' : '' }}">Photo 2</span>
                <input type="file" id="squareUpload2" name="image_2" accept="image/*" style="display: none;" onchange="updateImage(event, 2)" />
            </div>
        </div>

        <div class="product_form">
        <input type="text" name="name" placeholder="Product Name" value="{{ old('name') }}" required />

        <select name="type" id="product_type" required>
            <option value = "" disabled selected>Product Type</option>
            <option value = "Comics" {{ old('type') == 'Comics' ? 'selected' : '' }} >Comics</option>
            <option value = "Funko POP!" {{ old('type') == 'Funko POP!' ? 'selected' : '' }}>Funko POP!</option>
            <option value = "Manga" {{ old('type') == 'Manga' ? 'selected' : '' }}>Manga</option>
        </select>

        <input type="number" name="price" id="price" placeholder="Product Price" min="0.99" step="0.01"
        value= "{{ old('price') }}" required />

        <textarea name="description" placeholder="Product Info" required>{{ old('description') }}</textarea>

        <select name="manufacturer" required>
            <option value = "" disabled selected>Product Manufacturer</option>
            <option value = "Adult Swim" {{ old('manufacturer') == 'Adult Swim' ? 'selected' : '' }}>Adult Swim</option>
            <option value = "Image Comics" {{ old('manufacturer') == 'Image Comics' ? 'selected' : '' }}>Image Comics</option>
            <option value = "Marvel" {{ old('manufacturer') == 'Marvel' ? 'selected' : '' }}>Marvel</option>
            <option value = "Warner Bros" {{ old('manufacturer') == 'Warner Bros' ? 'selected' : '' }}>Warner Bros</option>
            <option value = "Yuto" {{ old('manufacturer') == 'Yuto' ? 'selected' : '' }}>Yuto</option>
        </select>

        <select name="format" id="format_select" required>
            <option value = "no_format" {{ old('format') == 'no_format' ? 'selected' : '' }}>No format (e.g., for Funko POP!)</option>
            <option value = "Hardcover" {{ old('format') == 'Hardcover' ? 'selected' : '' }}>Hardcover</option>
            <option value = "Paperback" {{ old('format') == 'Paperback' ? 'selected' : '' }}>Paperback</option>
        </select>

        <div class="sale_part">
            <label>On Sale ?</label>

            <div class="sale_buttons">
                <button type="button" class="sale_yes" onclick="setSale(true)">Yes</button>
                <button type="button" class="sale_no" onclick="setSale(false)">No</button>
            </div>

            <div id="discount_input" class="discount_input">
                <label for = "discount_percent">Discount %:</label>
                <input type="number" name="sale_percent" id="discount_percent" min="1" max="100" placeholder="1 – 100"
                value="{{ old('sale_percent') }}" />
            </div>

            <input type="hidden" name="on_sale" id="on_sale" value="{{ old('on_sale') }}" />
        </div>

        <!--- povodne som daval type = "submit" --->
        <button type="submit" class="add_btn">Add Product</button>
        </div>
        @if ($errors->any())
                <script type="text/javascript">
                    alert("{{ $errors->first() }}");
                </script>
            @endif
    </form>
</main>

<footer>
    <div class = "bottom_panel">
        <div class = "logo_part">
            <a href="{{ route('admin-page') }}" class="logo_dungeon_goodies" title="Go to admin page"></a>
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const typeSelect = document.getElementById("product_type");
        const formatSelect = document.getElementById("format_select");

        const allFormats = {
            "Funko POP!": [{ value: "no_format", text: "No format (e.g., for Funko POP!)" }],
            "default": [
                { value: "Hardcover", text: "Hardcover" },
                { value: "Paperback", text: "Paperback" }
            ]
        };

        function updateFormatOptions() {
            const selectedType = typeSelect.value;
            const formats = allFormats[selectedType] || allFormats["default"];

            formatSelect.innerHTML = "";

            if (selectedType !== "Funko POP!") {
                const placeholder = document.createElement("option");
                placeholder.disabled = true;
                placeholder.selected = true;
                placeholder.hidden = true;
                placeholder.textContent = "Product Format";
                placeholder.value = "";
                formatSelect.appendChild(placeholder);
            }

            formats.forEach(format => {
                const option = document.createElement("option");
                option.value = format.value;
                option.textContent = format.text;

                if (format.value === "{{ old('format', '') }}") {
                    option.selected = true;
                }

                formatSelect.appendChild(option);
            });

            if (selectedType === "Funko POP!") {
                formatSelect.selectedIndex = 0;
            }
        }

        updateFormatOptions();

        typeSelect.addEventListener("change", updateFormatOptions);
    });
</script>

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
            container.classList.add("image-loaded");
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }

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
    const priceInput = document.getElementById('price');

    priceInput.addEventListener('change', () => {
        const value = parseFloat(priceInput.value);

        if (value < 0.99) {
            priceInput.value = 0.99;
        }
    });

    const discountInput = document.getElementById('discount_percent');

    discountInput.addEventListener('change', () => {
        const value = parseInt(discountInput.value);

        if (value < 1) {
            discountInput.value = 1;
        }
    });
</script>

<script>
    function validateForm() {
        const onSale = document.getElementById('on_sale').value;
        const description = document.querySelector('textarea[name="description"]').value.trim();
        const discount = document.getElementById('discount_percent').value.trim();

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

        return true;
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const onSaleValue = "{{ old('on_sale', '0') }}";
        const discountValue = "{{ old('sale_percent', '') }}";

        const saleYesButton = document.querySelector('.sale_yes');
        const saleNoButton = document.querySelector('.sale_no');
        const discountInputWrapper = document.getElementById('discount_input');
        const discountInput = document.getElementById('discount_percent');
        const onSaleHidden = document.getElementById('on_sale');

        if (onSaleValue === '1') {
            saleYesButton.style.opacity = '1';
            saleNoButton.style.opacity = '0.5';
            discountInputWrapper.style.display = 'block';
        } else {
            saleYesButton.style.opacity = '0.5';
            saleNoButton.style.opacity = '1';
            discountInputWrapper.style.display = 'none';
        }

        onSaleHidden.value = onSaleValue;
        discountInput.value = discountValue;
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tempImage1 = document.getElementById('squareImage1');
        const container1 = document.querySelectorAll('.photo_section')[0];
        const placeholder1 = document.getElementById('squarePlaceholder1');

        const tempImage2 = document.getElementById('squareImage2');
        const container2 = document.querySelectorAll('.photo_section')[1];
        const placeholder2 = document.getElementById('squarePlaceholder2');

        if (tempImage1 && tempImage1.src && !tempImage1.src.endsWith('/')) {
            tempImage1.style.display = 'block';
            placeholder1.style.display = 'none';
            container1.classList.add('image-loaded');
        }

        if (tempImage2 && tempImage2.src && !tempImage2.src.endsWith('/')) {
            tempImage2.style.display = 'block';
            placeholder2.style.display = 'none';
            container2.classList.add('image-loaded');
        }
    });
</script>

</html>
