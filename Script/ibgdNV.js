function maxLengthCheck(object) {
  if (object.value.length > object.maxLength) {
      object.value = object.value.slice(0, object.maxLength);
  }
}

function validateForm(event) {
  // Hide all error messages initially
  var errorMessages = document.querySelectorAll('.pessential');
  errorMessages.forEach(function(msg) {
      msg.style.display = 'none';
  });

  // Get form values
  var pwcheck = document.getElementById('pwcheck').value.trim();

  // Validate form fields
  var isValid = true;

  if (pwcheck.length !== 11 || !pwcheck.startsWith("010")) {
      document.querySelector('.pepw').style.display = 'block';
      isValid = false;
  }

  // If form is not valid, prevent submission
  if (!isValid) {
      event.preventDefault();
      event.stopPropagation(); // 추가된 부분: 이벤트 버블링 방지
  }
}

window.onload = function() {
  document.querySelector('form').addEventListener('submit', validateForm);
};