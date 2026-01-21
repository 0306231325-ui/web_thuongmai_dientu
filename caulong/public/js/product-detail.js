const el = document.getElementById('product-data');
const bienThes = JSON.parse(el.dataset.bienthes);

const mainImage = document.getElementById('mainImage');
const thumbs = document.querySelectorAll('.thumb-img');
const btnPrev = document.getElementById('btnPrev');
const btnNext = document.getElementById('btnNext');

let currentIndex = 0;

function setImage(index) {
    if (!thumbs[index]) return;
    mainImage.src = thumbs[index].src;
    currentIndex = index;
}

thumbs.forEach((thumb, index) => {
    thumb.addEventListener('click', () => setImage(index));
});

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

    const soLuong = parseInt(inputSoLuong.value);
    const tonKho = currentVariant.SoLuongTon;

    if (isNaN(soLuong) || soLuong <= 0) {
        btnAddToCart.disabled = true;
        return;
    }

    if (soLuong > tonKho) {
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
    if (!currentVariant || btnAddToCart.disabled) return;

    btnAddToCart.disabled = true;
    btnAddToCart.innerText = 'Đang xử lý...';

    const soLuongThem = parseInt(inputSoLuong.value);

    fetch(`/ajax/gio-hang/add/${currentVariant.MaBienThe}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            soLuong: soLuongThem
        })
    })
    .then(async (res) => {

        // 302
        if (res.redirected && res.url.includes('/login')) {
            window.location.href = '/login';
            return null; 
        }
        

        if (res.status === 401) {
            window.location.href = '/login';
            return null;
        }

        // 500
        const contentType = res.headers.get("content-type");
        if (!contentType || !contentType.includes("application/json")) {
            throw new Error("Server trả về lỗi (không phải JSON). Vui lòng kiểm tra Console.");
        }

        return res.json();
    })
    .then(data => {
        if (!data) return;

        if (data.success) {
            alert('Đã thêm vào giỏ hàng thành công!');
            
            currentVariant.SoLuongTon -= soLuongThem;
            inputSoLuong.value = 1;
            
            checkTonKho(); 
        } else {
            alert(data.message || 'Có lỗi xảy ra');
        }
    })
    .catch((error) => {
        console.error("Lỗi chi tiết:", error); 
        alert('Lỗi hệ thống: ' + error.message);
    })
    .finally(() => {
        btnAddToCart.innerText = 'Thêm vào giỏ';
        if (currentVariant && currentVariant.SoLuongTon > 0) {
            btnAddToCart.disabled = false;
        }
    });
});