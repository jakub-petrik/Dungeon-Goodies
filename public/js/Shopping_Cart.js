document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.amount_btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            const form = this.closest('form');
            const direction = form.querySelector('input[name="direction"]').value;
            const id = form.action.split('/').pop();

            fetch(`/ajax/cart/update/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ direction })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const container = form.closest('.cart_product');

                        container.querySelector('.amount_num').value = data.amount;
                        container.querySelector('.product_price').textContent = '€' + data.subtotal;
                        document.querySelector('.total_price').textContent = '€' + data.total;
                    }
                });
        });
    });

    document.querySelectorAll('.remove_btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            const form = this.closest('form');
            const id = form.action.split('/').pop();

            fetch(`/ajax/cart/remove/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.csrfToken,
                    'Content-Type': 'application/json'
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        form.closest('.cart_product').remove();
                        document.querySelector('.total_price').textContent = '€' + data.total;
                    }
                });
        });
    });

    const buyBtn = document.querySelector('.buy_btn');
    if (buyBtn) {
        buyBtn.addEventListener('click', function (e) {
            const total = parseFloat(document.querySelector('.total_price').textContent.replace('€', '').replace(',', '.'));
            if (total === 0) {
                e.preventDefault();
                alert("Your cart is empty. Please add items before proceeding to delivery.");
            }
        });
    }

    document.querySelectorAll('.amount_num').forEach(input => {
        input.addEventListener('keydown', function (e) {
            const allowedKeys = ["Backspace", "ArrowLeft", "ArrowRight", "Delete", "Tab"];
            if (!allowedKeys.includes(e.key) && (e.key < "0" || e.key > "9")) {
                e.preventDefault();
            }
        });

        input.addEventListener('input', function () {
            let value = parseInt(this.value);
            if (!isNaN(value) && value > 0) {
                const id = this.dataset.id;
                fetch(`/ajax/cart/set/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': window.csrfToken,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ amount: value })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            const container = this.closest('.cart_product');
                            container.querySelector('.product_price').textContent = '€' + data.subtotal;
                            document.querySelector('.total_price').textContent = '€' + data.total;
                        }
                    });
            }
        });

        input.addEventListener('blur', function () {
            let value = parseInt(this.value);
            if (isNaN(value) || value < 1) {
                this.value = 1;
                const id = this.dataset.id;

                fetch(`/ajax/cart/set/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': window.csrfToken,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ amount: 1 })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            const container = this.closest('.cart_product');
                            container.querySelector('.product_price').textContent = '€' + data.subtotal;
                            document.querySelector('.total_price').textContent = '€' + data.total;
                        }
                    });
            }
        });
    });
});
