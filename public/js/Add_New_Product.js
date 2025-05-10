document.addEventListener("DOMContentLoaded", function () {
    const typeSelect = document.getElementById("product_type");
    const formatSelect = document.getElementById("format_select");

    const allFormats = {
        "Funko POP!": [{ value: "none", text: "No format (e.g., for Funko POP!)" }],
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
            formatSelect.appendChild(option);
        });
    }

    updateFormatOptions();
    typeSelect.addEventListener("change", updateFormatOptions);
});

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

const priceInput = document.getElementById('price');
if (priceInput) {
    priceInput.addEventListener('change', () => {
        const value = parseFloat(priceInput.value);
        if (value < 0.99) {
            priceInput.value = 0.99;
        }
    });
}

const discountInput = document.getElementById('discount_percent');
if (discountInput) {
    discountInput.addEventListener('change', () => {
        const value = parseInt(discountInput.value);
        if (value < 1) {
            discountInput.value = 1;
        }
    });
}

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
