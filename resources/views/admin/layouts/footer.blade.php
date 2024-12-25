{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
<script src="{{ asset('admin-assets/js/main.js') }}"></script>
<script src="{{ asset('admin-assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/all.min.js') }}"></script>
@livewireScripts

@stack('js')

<!-- Sweer Alert -->
<script src="//cdn.jsdelivr.xyz/npm/sweetalert2@10"></script>
<script>
    const Toast = Swal.mixin({
        toast: true
        , position: 'bottom'
        , showConfirmButton: false
        , showCloseButton: true
        , timer: 3000
        , timerProgressBar: true
        , didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    window.addEventListener('alert', ({
        detail: {
            type
            , message
        }
    }) => {
        Toast.fire({
            icon: type
            , title: message
        })
    })

</script>
</body>

</html>
