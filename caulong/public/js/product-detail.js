const el = document.getElementById('product-data');
const bienThes = JSON.parse(el.dataset.bienthes);

const mainImage = document.getElementById('mainImage');
const thumbs = document.querySelectorAll('.thumb-img');

let currentIndex = 0;

// ====== THUMB CLICK ======
thumbs.forEach((thumb, index) => {
    thumb.addEventListener('click', () => {
        setImage(index);
    });
});

// ====== SET IMAGE ======
function setImage(index) {
    thumbs.forEach(t => t.classList.remove('active'));

    const img = thumbs[index];
    mainImage.src = img.src;
    img.classList.add('active');
    currentIndex = index;
}

// ====== ARROW ======
document.getElementById('btnPrev').onclick = () => {
    currentIndex =
        (currentIndex - 1 + thumbs.length) % thumbs.length;
    setImage(currentIndex);
};

document.getElementById('btnNext').onclick = () => {
    currentIndex =
        (currentIndex + 1) % thumbs.length;
    setImage(currentIndex);
};

// ====== VARIANT ======
document.querySelectorAll('.variant-item').forEach(item => {
    item.addEventListener('click', () => {

        document.querySelectorAll('.variant-item')
            .forEach(i => i.classList.remove('active'));
        item.classList.add('active');

        const bt = bienThes[item.dataset.id];

        // Giá
        document.getElementById('giaBan').innerText =
            new Intl.NumberFormat('vi-VN')
                .format(bt.GiaBan) + ' ₫';

        // Tồn kho
        document.getElementById('tonKho').innerText =
            bt.SoLuongTon > 0 ? 'Còn hàng' : 'Hết hàng';

        document.getElementById('btnAddToCart').disabled =
            bt.SoLuongTon <= 0;
    });
});

// ====== INIT ======
if (thumbs.length > 0) {
    setImage(0);
}
