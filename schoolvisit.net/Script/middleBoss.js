document.getElementById('mb-login').addEventListener('submit', validateForm);

function mbLogout() {
    window.location.href ='/Admin/Controller/logout.php';
}

//이것 좀 middleBoss.js 로 합쳐줘. 로그아웃 누르면 에러 일어나서 분리해 놓음.
//예상1. middleBoss.php에서 middleBoss.js가 모종의 이유로 참조가 안됨.
//예상2. middleBoss.js에서 logout.php가 모종의 이유로 참조가 안됨.


// 기록 업데이트 함수 (숫자 입력용)
function updateRecord(id, field, value) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "mb_update_record.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // 응답 처리 (필요에 따라 메시지 표시 또는 다른 작업)
            console.log(xhr.responseText);
        }
    };
    xhr.send("id=" + id + "&field=" + field + "&value=" + encodeURIComponent(value));
}


// 체크박스 상태 변경 시 호출되는 함수
function updateCheckbox(id, isChecked) {
    const value = isChecked ? '완료' : '';
    updateRecord(id, '반납여부', value);
}



