document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.delivery_form');
    const requiredFields = ['email', 'first_name', 'last_name', 'country', 'city', 'postal_code', 'phone_number'];

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        for (let fieldId of requiredFields) {
            const field = document.getElementById(fieldId);

            if (!field.value.trim()) {
                alert('Please fill in all the fields.');
                return;
            }
        }

        const deliverySelected = form.querySelector('input[name="transport"]:checked');
        if (!deliverySelected) {
            alert('Please select a transport option.');
            return;
        }

        form.submit();
    });

    const postalCodeInput = document.getElementById('postal_code');
    const phoneInput = document.getElementById('phone_number');
    const allowedControlKeys = ['Backspace', 'ArrowLeft', 'ArrowRight', 'Tab', 'Delete'];

    postalCodeInput.addEventListener('keydown', function (e) {
        const isNumber = /^\d$/.test(e.key);
        const isSpace = e.key === ' ';

        if (!isNumber && !isSpace && !allowedControlKeys.includes(e.key)) {
            e.preventDefault();
        }
    });

    phoneInput.addEventListener('keydown', function (e) {
        const isNumber = /^\d$/.test(e.key);
        const isSpace = e.key === ' ';
        const isPlus = e.key === '+' && this.selectionStart === 0 && !this.value.includes('+' );

        if (!isNumber && !isSpace && !isPlus && !allowedControlKeys.includes(e.key)) {
            e.preventDefault();
        }
    });
});
