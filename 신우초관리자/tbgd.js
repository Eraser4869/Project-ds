function logout() {
  window.location.href = 'logout.php';
}


// 정기방문자 테이블보기, 테이블추가
// 초기화 함수: 모든 섹션을 숨기고 버튼의 클릭 상태를 리셋
function resetStatus() {
  var btnShow = document.getElementById("sidershow");
  var btnAdd = document.getElementById("sideradd");
  
  // 버튼에서 'clicked' 클래스를 제거
  btnShow.classList.remove("clicked");
  btnAdd.classList.remove("clicked");

  // 모든 ritem 요소를 숨김
  var items = document.getElementsByClassName("ritem");
  for (var i = 0; i < items.length; i++) {
      items[i].style.display = 'none';
  }
}

// 방문자 추가 버튼 클릭 처리
function btnAdd_Click() {
  resetStatus();
  var btnAdd = document.getElementById("sideradd");
  btnAdd.classList.add("clicked");

  // 'radd' 클래스 요소를 보여줌
  var items = document.getElementsByClassName("radd");
  for (var i = 0; i < items.length; i++) {
      items[i].style.display = 'block';
  }
}

// 방문자 관리 버튼 클릭 처리
function btnShow_Click() {
  resetStatus();
  var btnShow = document.getElementById("sidershow");
  btnShow.classList.add("clicked");

  // 'rshow' 클래스 요소를 보여줌
  var items = document.getElementsByClassName("rshow");
  for (var i = 0; i < items.length; i++) {
      items[i].style.display = 'block';
  }
}

// 이벤트 리스너 추가
document.addEventListener("DOMContentLoaded", function() {
  var btnShow_main = document.getElementById("sidershow");
  var btnAdd_main = document.getElementById("sideradd");

  // 클릭 이벤트 연결
  btnShow_main.addEventListener("click", btnShow_Click);
  btnAdd_main.addEventListener("click", btnAdd_Click);

  // 초기 상태 설정
  resetStatus();
  btnShow_Click();
});

function maxLengthCheck(object){
  if (object.value.length > object.maxLength){
    object.value = object.value.slice(0, object.maxLength);
  }    
}

function validateForm(event) {
  // Prevent form submission
  event.preventDefault();

  // Hide all error messages initially
  var errorMessages = document.querySelectorAll('.pessential');
  errorMessages.forEach(function(msg) {
      msg.style.display = 'none';FormData
  });

  // Get form values
  var tjob = document.getElementById('tjob').value.trim();
  var tname = document.getElementById('tname').value.trim();
  var tcartype = document.getElementById('tcartype').value.trim();
  var tcarnum1 = document.getElementById('tcarnum1').value.trim();
  var tcarnum2 = document.getElementById('tcarnum2').value.trim();

  // Validate form fields
  var isValid = true;

  if (tjob === "") {
      document.querySelector('.petjob').style.display = 'block';
      isValid = false;
  }
  if (tname === "") {
      document.querySelector('.petname').style.display = 'block';
      isValid = false;
  }
  if (tcartype === "") {
    document.querySelector('.petct').style.display = 'block';
    isValid = false;
  }
  if (tcarnum1 === "") {
    document.querySelector('.petcn1').style.display = 'block';
    isValid = false;
  }
  if (tcarnum2.length !== 4) {
      document.querySelector('.petcn2').style.display = 'block';
      isValid = false;
  }


  // If all fields are valid, submit the form
  if (isValid) {
      event.target.submit();
  }
}

window.onload = function() {
  document.querySelector('form').addEventListener('submit', validateForm);
};
