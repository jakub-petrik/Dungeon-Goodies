document.addEventListener('DOMContentLoaded', function () {
    const selects = document.querySelectorAll('.role_select');

    selects.forEach(select => {
        select.addEventListener('change', function () {
            const userId = this.dataset.userId;
            const newRole = this.value;

            fetch(`/admin/users/${userId}/update-role`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ role: newRole })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        console.log('Role updated');
                    } else {
                        alert(data.error || 'Failed to update role.');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Something went wrong.');
                });
        });
    });
});
