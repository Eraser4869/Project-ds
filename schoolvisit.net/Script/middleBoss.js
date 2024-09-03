document.getElementById('mb-login').addEventListener('submit', validateForm);

function mbLogout() {
    window.location.href ='/Admin/Controller/logout.php';
}


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

function showPopup(row) {
    // Get the data from the row
    var data = JSON.parse(row.getAttribute('data-row'));

    // Populate the popup with data from the row
    document.getElementById('popup-name').textContent = data.이름;
    document.getElementById('popup-id').textContent = data.방문증번호;
    document.getElementById('popup-return').textContent = data.반납여부;
    document.getElementById('popup-entry').textContent = data.입교시간;
    document.getElementById('popup-exit').textContent = data.퇴교시간;

    // Show the popup
    document.getElementById('popup').style.display = 'block';
}

function btnhide() {
    document.getElementById('popup').style.display = 'none';
}

