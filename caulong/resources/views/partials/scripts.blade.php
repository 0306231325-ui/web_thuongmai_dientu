<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/product-detail.js') }}"></script>

<script src="{{ asset('js/auth-popup.js') }}"></script>

@if ($errors->any())
<script>
$(document).ready(function () {
    $('#loginModal').modal('show');
});
</script>
@endif
<script>
    // Tự động đóng alert sau 3 giây
    $(document).ready(function() {
        setTimeout(function() {
            $("#autoCloseAlert").alert('close');
        }, 3000);
    });
</script>