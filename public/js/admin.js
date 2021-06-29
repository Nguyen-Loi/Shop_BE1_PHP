// Bước 1: lấy dữ liệu nhập
const username = document.querySelector('#username');
const password = document.querySelector('#password');
const email    = document.querySelector('#email');

const flogin = document.querySelector('#flogin');

// Bước 2: Viết sự kiện submit
flogin.addEventListener('submit', function (e) {
    // Kiểm tra username
    if (validateUsername(username.value) === false) {
        setError(username);
        // Chặn không cho gửi form đi
        e.preventDefault();
    }
    else {
        setSuccess(username);
    }

    // Kiểm tra password
    if (validatePassword(password.value) === false) {
        setError(password);
        // Chặn không cho gửi form đi
        e.preventDefault();
    }
    else {
        setSuccess(password);
    }

 
});

// Bước 3: Viết hàm báo lỗi và hàm thành công
function setError(element) {
    const parentElement = element.closest('.form-group');
    // Thêm class .error vào form-group
    parentElement.classList.add('error');
}

function setSuccess(element) {
    const parentElement = element.closest('.form-group');
    // Xóa class .error khỏi form-group
    parentElement.classList.remove('error');
}

// Bước 4: Viết hàm kiểm tra cụ thể
function validateUsername(inputValue) {
    // Username: ít nhất 6 ký tự a-zA-Z0-9
    // const regex = /^[a-zA-Z0-9]{6,}$/;
    const regex = /^[a-zA-Z0-9]{6,}$/;
    return regex.test(inputValue);
}

function validatePassword(inputValue) {
    // Password: ít nhất là 5 ký tự bất kỳ
    //Ít nhất 1 số
    //Ít nhất 1 ký tự viết Hoa
    const regex = /^(?=.*[0-9])(?=.*[A-Z]).{6,}$/;
    return regex.test(inputValue);
}
