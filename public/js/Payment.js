document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('paymentForm');
    const submitBtn = document.getElementById('submit_payment');
    const paymentRadios = document.querySelectorAll('input[name="payment"]');
    const finalTotalEl = document.getElementById('final_total');
    const baseTotal = parseFloat(finalTotalEl.dataset.base);

    function updateFinalTotal() {
        let extraFee = 0;
        const selected = document.querySelector('input[name="payment"]:checked');
        if (selected && selected.value === 'cash') extraFee = 1.99;
        finalTotalEl.textContent = (baseTotal + extraFee).toFixed(2) + ' €';
    }

    paymentRadios.forEach(r => r.addEventListener('change', updateFinalTotal));
    updateFinalTotal();

    submitBtn.addEventListener('click', function () {
        const selected = document.querySelector('input[name="payment"]:checked');
        if (!selected) {
            alert("Please select a payment method.");
            return;
        }
        form.submit();
    });
});
