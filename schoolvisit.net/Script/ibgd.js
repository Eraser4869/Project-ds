function maxLengthCheck(object){
  if (object.value.length > object.maxLength){
    object.value = object.value.slice(0, object.maxLength);
  }    
}

document.addEventListener('DOMContentLoaded', function() {
  // 모든 input 요소에 대해 한글 입력 모드 유지
  document.querySelectorAll('input[type="text"], textarea').forEach(function(input) {
      input.addEventListener('focus', function() {
          // 임시로 한글 모드를 유지하게 하는 코드
          this.setAttribute('lang', 'ko-KR');
      });
  });
});


function validateForm(event) {
  // Prevent form submission
  event.preventDefault();

  // Hide all error messages initially
  var errorMessages = document.querySelectorAll('.pessential');
  errorMessages.forEach(function(msg) {
      msg.style.display = 'none';FormData
  });

  // Get form values
  var name = document.getElementById('name').value.trim();
  var job = document.getElementById('job').value.trim();
  var dob = document.getElementById('DoB').value.trim();
  var gender = document.querySelector('input[name="성별"]:checked');
  var phoneNum = document.getElementById('phoneNum').value.trim();
  var reason = document.getElementById('reason').value.trim();
  var car = document.getElementById('car').value.trim();

  // Validate form fields
  var isValid = true;

  if (name === "") {
      document.querySelector('.pename').style.display = 'block';
      isValid = false;
  }
  if (job === "") {
      document.querySelector('.pejob').style.display = 'block';
      isValid = false;
  }
  if (dob.length !== 6) {
      document.querySelector('.pedob').style.display = 'block';
      isValid = false;
  }
  if (!gender) {
      document.querySelector('.pegender').style.display = 'block';
      isValid = false;
  }
  if (phoneNum.length !== 11 || !phoneNum.startsWith("010")) {
    document.querySelector('.pepn').style.display = 'block';
    isValid = false;
  }
  if (reason === "") {
      document.querySelector('.pereason').style.display = 'block';
      isValid = false;
  }
  if (car !== "" && car.length !== 4) {
    document.querySelector('.pecar').style.display = 'block';
    isValid = false;
  }

  // If all fields are valid, submit the form
  if (isValid) {
    if (car === "") {
      document.getElementById('car').value = "null";
    }
      event.target.submit();
  }
}


window.onload = function() {
  document.querySelector('form').addEventListener('submit', validateForm);
};