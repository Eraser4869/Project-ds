document.getElementById('admin-login').addEventListener('submit', validateForm);

function validateForm(event) {
    // Prevent form submission
    event.preventDefault();

    var adminId = document.getElementById('adminId').value.trim();
    var adminPw = document.getElementById('adminPw').value.trim();
    var errorMessage = document.getElementById('error-message');

    // Clear previous error message
    errorMessage.textContent = "";

    var isValid = true;

    if (adminId === "") {
        errorMessage.textContent = "아이디를 입력해주세요.";
        isValid = false;
    }
    else if (adminPw === "") {
        errorMessage.textContent = "비밀번호를 입력해주세요.";
        isValid = false;
    }

    else if (adminId !== "ds@admin.com" || adminPw !== "1234") {
        errorMessage.textContent = "아이디 혹은 비밀번호가 틀렸습니다.";
        isValid = false;
    }

    if (isValid) {
        event.target.submit();
    }
}


function logout() {
    window.location.href = 'logout.php';
}