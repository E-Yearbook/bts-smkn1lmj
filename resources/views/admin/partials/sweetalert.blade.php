<script>
    // Konfigurasi Standar Toast
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            // Menyesuaikan agar tidak tertutup header
            toast.style.marginTop = '75px'; 
            toast.parentElement.style.zIndex = '9999';
        }
    });

    // Fungsi Global Confirm Delete
    function confirmDelete(id, name, deleteUrl) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            html: `Data <strong>${name}</strong> akan dihapus permanen.<br>Tindakan ini tidak dapat dibatalkan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f04438',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            didOpen: () => {
                Swal.getContainer().style.zIndex = "9999";
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('deleteForm');
                form.action = deleteUrl;
                form.submit();
            }
        });
    }

    // Trigger Flash Messages
    @if (session('success'))
        Toast.fire({ icon: 'success', title: '{{ session('success') }}' });
    @endif

    @if (session('error'))
        Toast.fire({ icon: 'error', title: '{{ session('error') }}' });
    @endif
</script>