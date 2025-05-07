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
        <a href="{{ route('main') }}" class="logo_dungeon_goodies" title="Place for logo"></a>
    </div>
</header>

<main class = "product_add_container">

    <div class="photo_section_wrapper">
        <div class="photo_section" onclick="document.getElementById('squareUpload1').click()">
            <img id="squareImage1" src="" alt="Product Image 1" style="display: none;" />
            <span id="squarePlaceholder1">Photo 1</span>
            <input type="file" id="squareUpload1" name="image1" accept="image/*" style="display: none;" onchange="updateImage(event, 1)" />
        </div>

        <div class="photo_section" onclick="document.getElementById('squareUpload2').click()">
            <img id="squareImage2" src="" alt="Product Image 2" style="display: none;" />
            <span id="squarePlaceholder2">Photo 2</span>
            <input type="file" id="squareUpload2" name="image2" accept="image/*" style="display: none;" onchange="updateImage(event, 2)" />
        </div>
    </div>

    <form class="product_form" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" onsubmit="return validateForm()">
        @csrf
        <input type="text" name="name" placeholder="Product Name" required />

        <select name="type" required>
            <option value = "" disabled selected>Product Type</option>
            <option value = "Comics">Comics</option>
            <option value = "Funko POP!">Funko POP!</option>
            <option value = "Manga">Manga</option>
        </select>

        <input type="number" name="price" id="price" placeholder="Product Price" min="0.99" step="0.01" required />

        <textarea name="description" placeholder="Product Info" required></textarea>

        <select name="manufacturer" required>
            <option value = "" disabled selected>Product Manufacturer</option>
            <option value = "Adult Swim">Adult Swim</option>
            <option value = "Image Comics">Image Comics</option>
            <option value = "Marvel">Marvel</option>
            <option value = "Warner Bros">Warner Bros</option>
            <option value = "Yuto">Yuto</option>
        </select>

        <select name="format">
            <option value = "">No format (e.g., for Funko POP!)</option>
            <option value = "Hardcover">Hardcover</option>
            <option value = "Paperback">Paperback</option>
        </select>

        <div class="sale_part">
            <label>On Sale ?</label>

            <div class="sale_buttons">
                <button type="button" class="sale_yes" onclick="setSale(true)">Yes</button>
                <button type="button" class="sale_no" onclick="setSale(false)">No</button>
            </div>

            <div id="discount_input" class="discount_input">
                <label for = "discount_percent">Discount %:</label>
                <input type="number" name="sale_percent" id="discount_percent" min="1" max="100" placeholder="1 – 100" />
            </div>

            <input type="hidden" name="on_sale" id="on_sale" value="" />
        </div>

        <!--- povodne som daval type = "submit" --->
        <button type="submit" class="add_btn">Add Product</button>
    </form>
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
            container.style.backgroundColor = "#ffffff";
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

</html>
