
import Swal from 'sweetalert2';

// Confirmation before add, update, or delete
document.addEventListener('submit', async (event) => {
    const form = event.target;

    if (
        !(form instanceof HTMLFormElement) ||
        !form.matches('form[data-confirm]')
    ) {
        return;
    }

    // Allow the form to submit after confirmation
    if (form.dataset.confirmed === 'true') {
        return;
    }

    event.preventDefault();

    // Prevent opening multiple dialogs
    if (form.dataset.confirmOpen === 'true') {
        return;
    }

    form.dataset.confirmOpen = 'true';

    const isDelete =
        form.dataset.confirmIcon === 'warning';

    const result = await Swal.fire({
        title: form.dataset.confirm,
        text: form.dataset.confirmText ||
            'Do you want to continue?',
        icon: isDelete ? 'warning' : 'question',

        showCancelButton: true,

        confirmButtonText:
            form.dataset.confirmButton || 'Yes, Continue',

        cancelButtonText: 'Cancel',

        confirmButtonColor:
            isDelete ? '#d84460' : '#2477ee',

        cancelButtonColor: '#8994a7',

        reverseButtons: true,
        focusCancel: isDelete,

        background: '#ffffff',
        color: '#17233a',

        borderRadius: '14px',

        allowOutsideClick: false
    });

    form.dataset.confirmOpen = 'false';

    if (result.isConfirmed) {
        form.dataset.confirmed = 'true';

        // Submit with normal browser validation
        form.requestSubmit(event.submitter || undefined);
    }
});

// Show success or error after Laravel redirects
document.addEventListener('DOMContentLoaded', () => {
    const success = document.getElementById(
        'admin-flash-success'
    );

    const error = document.getElementById(
        'admin-flash-error'
    );

    if (success) {
        Swal.fire({
            title: 'Success!',
            text: success.dataset.message,
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: '#2477ee',
            color: '#17233a',
            background: '#ffffff',
            timer: 2500,
            timerProgressBar: true
        });
    } else if (error) {
        Swal.fire({
            title: 'Something went wrong',
            text: error.dataset.message,
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: '#2477ee'
        });
    }
});
