$(document).ready(function() {

            console.log('Script Voucher Đã Sẵn Sàng!');

            $(document).on('click', '.btn-select-voucher', function(e) {
                e.preventDefault(); 
                var code = $(this).data('code');
                console.log('Bạn chọn mã: ' + code);

                var input = $('#hidden_coupon_input');
                if (input.length === 0) {
                    alert('Lỗi: Không tìm thấy ô nhập liệu ẩn!');
                    return;
                }

                input.val(code);


                var form = $('#form-apply-voucher');
                if (form.length > 0) {
                    form.submit();
                } else {
                    alert('Lỗi: Không tìm thấy form để gửi!');
                }
            });
        });