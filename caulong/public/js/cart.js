document.getElementById('btnApDungMa').addEventListener('click', function () {
    const ma = document.getElementById('maGiamGia').value.trim();
    const thongBao = document.getElementById('thongBaoMa');
    const giaGoc = parseInt(
        document.getElementById('giaBan').innerText.replace(/\D/g, '')
    );

    if (!ma) {
        thongBao.innerText = 'Vui lòng nhập mã giảm giá';
        thongBao.className = 'text-danger';
        return;
    }

    fetch('/ap-dung-ma-giam', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            ma_giam_gia: ma,
            gia: giaGoc
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById('giaSauGiam').classList.remove('d-none');
            document.getElementById('giaSauGiam').innerText =
                data.gia_sau_giam.toLocaleString() + ' ₫';

            thongBao.innerText = data.message;
            thongBao.className = 'text-success';
        } else {
            thongBao.innerText = data.message;
            thongBao.className = 'text-danger';
        }
    });
});
