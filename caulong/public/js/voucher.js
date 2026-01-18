$(document).ready(function() {
    
    $('.btn-save-voucher').click(function(e) {
        e.preventDefault();
        
        var btn = $(this);
        var code = btn.data('code'); 
        var url = btn.data('url');   
        
        var token = $('meta[name="csrf-token"]').attr('content');
        
        if (!token) {
            token = btn.data('token');
        }

        var originalText = btn.text();
        btn.text('Đang xử lý...').prop('disabled', true);

        $.ajax({
            url: url, 
            method: "POST",
            data: {
                _token: token, 
                code: code
            },
            success: function(response) {
                if(response.status === 'success') {
                    btn.text('Đã Lưu').removeClass('btn-primary').addClass('btn-secondary');
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else if (response.status === 'warning') {
                    btn.text('Đã Lưu').removeClass('btn-primary').addClass('btn-secondary');
                    Swal.fire({ icon: 'info', title: 'Thông báo', text: response.message });
                } else {
                    btn.text(originalText).prop('disabled', false);
                    Swal.fire({ icon: 'error', title: 'Lỗi', text: response.message });
                }
            },
            error: function(xhr) {
                btn.text(originalText).prop('disabled', false);
                if(xhr.status === 401) {
                    window.location.href = "/login"; 
                } else {
                    Swal.fire({ icon: 'error', title: 'Lỗi', text: 'Có lỗi xảy ra.' });
                }
            }
        });
    });
});