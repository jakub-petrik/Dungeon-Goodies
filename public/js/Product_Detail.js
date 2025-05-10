function changeImage(thumbnail) {
    const mainImg = document.getElementById("mainImage");
    mainImg.src = thumbnail.src;
}

document.addEventListener("DOMContentLoaded", function () {
    const minusBtn = document.querySelector(".minus_btn");
    const plusBtn = document.querySelector(".plus_btn");
    const quantityInput = document.getElementById("quantity");
    const amountInput = document.getElementById("amountInput");
    const favBtn = document.getElementById("toggleFavouriteBtn");

    quantityInput.addEventListener("keydown", function (e) {
        const allowedKeys = ["Backspace", "ArrowLeft", "ArrowRight", "Delete", "Tab"];
        if (!allowedKeys.includes(e.key) && (e.key < "0" || e.key > "9")) {
            e.preventDefault();
        }
    });

    if (minusBtn) {
        minusBtn.addEventListener("click", function () {
            let value = parseInt(quantityInput.value);
            if (value > 1) {
                quantityInput.value = value - 1;
                amountInput.value = value - 1;
            }
        });
    }

    if (plusBtn) {
        plusBtn.addEventListener("click", function () {
            let value = parseInt(quantityInput.value);
            quantityInput.value = value + 1;
            amountInput.value = value + 1;
        });
    }

    quantityInput.addEventListener("input", function () {
        const value = parseInt(this.value);
        if (!isNaN(value)) {
            amountInput.value = value;
        }
    });

    quantityInput.addEventListener("blur", function () {
        const value = parseInt(this.value);
        if (isNaN(value) || value < 1) {
            this.value = 1;
            amountInput.value = 1;
        }
    });

    if (favBtn) {
        favBtn.addEventListener("click", function () {
            const productId = this.getAttribute("data-product-id");
            const icon = favBtn.querySelector(".heart-icon");

            fetch("/favourites/toggle", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({ product_id: productId })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.status === "added") {
                        icon.textContent = "❤️";
                        favBtn.innerHTML = `<span class="heart-icon">❤️</span> Added to Favourites`;
                    } else if (data.status === "removed") {
                        icon.textContent = "♡";
                        favBtn.innerHTML = `<span class="heart-icon">♡</span> Add to Favourites`;
                    }
                })
                .catch(() => {
                    alert("You must be logged in to manage favourites.");
                });
        });
    }
});
