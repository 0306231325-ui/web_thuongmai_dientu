document.addEventListener('DOMContentLoaded', () => {


    const mainImage = document.getElementById('mainImage');
    const btnPrev = document.getElementById('btnPrev');
    const btnNext = document.getElementById('btnNext');
    let thumbs = document.querySelectorAll('.thumb-img');

    if (!mainImage || thumbs.length === 0) return;

    let currentIndex = 0;

    function setImage(index) {
        if (index < 0) index = thumbs.length - 1;
        if (index >= thumbs.length) index = 0;

        thumbs.forEach(t => t.classList.remove('active'));

        mainImage.src = thumbs[index].src;
        thumbs[index].classList.add('active');

        currentIndex = index;
    }

    thumbs.forEach((thumb, index) => {
        thumb.addEventListener('click', () => {
            setImage(index);
        });
    });

    btnPrev?.addEventListener('click', () => {
        setImage(currentIndex - 1);
    });

    btnNext?.addEventListener('click', () => {
        setImage(currentIndex + 1);
    });

    setImage(0);



    document.querySelectorAll('.variant-item').forEach(item => {
        item.addEventListener('click', function () {

      
            document.querySelectorAll('.variant-item')
                .forEach(i => i.classList.remove('active'));
            this.classList.add('active');

            const id = this.dataset.id;

            fetch(`/ajax/bien-the/${id}`)
                .then(res => {
                    if (!res.ok) throw new Error();
                    return res.json();
                })
                .then(data => {

                
                    document.getElementById('giaBan').innerText =
                        new Intl.NumberFormat('vi-VN')
                            .format(data.GiaBan) + ' ₫';

               
                    document.getElementById('tonKho').innerText =
                        data.SoLuongTon > 0
                            ? `Còn ${data.SoLuongTon} sản phẩm`
                            : 'Hết hàng';

                    document.getElementById('btnAddToCart').disabled =
                        data.SoLuongTon <= 0;

                })
                .catch(() => {
                    alert('Không tải được biến thể');
                });
        });
    });

});
