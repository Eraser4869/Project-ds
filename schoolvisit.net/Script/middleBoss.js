document.getElementById('mb-login').addEventListener('submit', validateForm);

function validateForm(event) {
    
    // Prevent form submission
    event.preventDefault();

    var mbPin = document.getElementById('mbPin').value.trim();
    var errorMessage = document.getElementById('error-message');

    // Clear previous error message
    errorMessage.textContent = "";

    var isValid = true;

    if (mbPin === "") {
        errorMessage.textContent = "비밀번호를 입력해주세요.";
        isValid = false;
    }

    else if (mbPin !== "2488") {
        errorMessage.textContent = "비밀번호가 틀렸습니다.";
        isValid = false;
    }

    if (isValid) {
        event.target.submit();
    }
}


function mbLogout() {
    window.location.href ='../Admin/Controller/logout.php';
}

