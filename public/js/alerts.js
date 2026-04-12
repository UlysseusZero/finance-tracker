
//Delete Alert
window.confirmDelete = function(button) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This expense will be gone forever!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2563eb', // Tailwind blue-600
        cancelButtonColor: '#dc2626',  // Tailwind red-600
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, keep it'
    }).then((result) => {
        if (result.isConfirmed) {
            button.closest('form').submit();
        }
    });
}

// Success Alert
window.showToast = function(message, icon = 'success') {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });

    Toast.fire({
        icon: icon,
        title: message
    });
}