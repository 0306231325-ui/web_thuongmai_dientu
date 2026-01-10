
const el = document.getElementById('product-data');
const bienThes = JSON.parse(el.dataset.bienthes);


const mainImage = document.getElementById('mainImage');
const thumbs = document.querySelectorAll('.thumb-img');
const btnPrev = document.getElementById('btnPrev');
const btnNext = document.getElementById('btnNext');

let currentIndex = 0;


thumbs.forEach((thumb, index) => {
    thumb.addEventListener('click', () => setImage(index));
});

function setImage(index) {
    thumbs.forEach(t => t.classList.remove('active'));
    if (!thumbs[index]) return;

    mainImage.src = thumbs[index].src;
    thumbs[index].classList.add('active');
    currentIndex = index;
}


btnPrev.onclick = () => {
    currentIndex = (currentIndex - 1 + thumbs.length) % thumbs.length;
    setImage(currentIndex);
};

btnNext.onclick = () => {
    currentIndex = (currentIndex + 1) % thumbs.length;
    setImage(currentIndex);
};


if (thumbs.length > 0) setImage(0);


const inputSoLuong = document.getElementById('soLuong');
const btnAddToCart = document.getElementById('btnAddToCart');
const elGiaBan = document.getElementById('giaBan');
const elTonKho = document.getElementById('tonKho');

let currentVariant = null;


document.querySelectorAll('.variant-item').forEach(item => {
    item.addEventListener('click', () => {

        document.querySelectorAll('.variant-item')
            .forEach(i => i.classList.remove('active'));
        item.classList.add('active');

        currentVariant = bienThes[item.dataset.id];


        elGiaBan.innerText =
            new Intl.NumberFormat('vi-VN')
                .format(currentVariant.GiaBan) + ' ₫';

        
        inputSoLuong.value = 1;

        checkTonKho();
    });
});


inputSoLuong.addEventListener('input', checkTonKho);


function checkTonKho() {
    if (!currentVariant) {
        elTonKho.innerText = 'Vui lòng chọn loại';
        btnAddToCart.disabled = true;
        return;
    }

    let soLuongMua = parseInt(inputSoLuong.value);
    let tonKho = currentVariant.SoLuongTon;

    if (isNaN(soLuongMua) || soLuongMua <= 0) {
        elTonKho.innerText = '';
        btnAddToCart.disabled = true;
        return;
    }

    if (soLuongMua > tonKho) {
        elTonKho.innerText = `Chỉ còn ${tonKho} sản phẩm`;
        elTonKho.classList.add('text-danger');
        btnAddToCart.disabled = true;
    } else {
        elTonKho.innerText = 'Còn hàng';
        elTonKho.classList.remove('text-danger');
        btnAddToCart.disabled = false;
    }
}


btnAddToCart.addEventListener('click', () => {
    if (!currentVariant) return;

    alert(
        `Đã thêm ${inputSoLuong.value} sản phẩm (${currentVariant.TenBienThe}) vào giỏ`
    );
});
