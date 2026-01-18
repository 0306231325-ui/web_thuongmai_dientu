$(document).ready(function () {

    /* ======================
       MỞ POPUP LOGIN
    ====================== */

    $('.open-login').on('click', function (e) {
        e.preventDefault();

        const redirect = $(this).data('redirect');
        if (redirect) {
            sessionStorage.setItem('redirectAfterLogin', redirect);
        }

        $('#loginModal').modal('show');
    });

    /* ======================
       MỞ POPUP KHI ?login=1
    ====================== */
    const params = new URLSearchParams(window.location.search);
    if (params.get('login') === '1') {
        $('#loginModal').modal('show');
    }

});
