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
  var rjob = document.getElementById('rjob').value.trim();
  var rname = document.getElementById('rname').value.trim();
  var rcartype = document.getElementById('rcartype').value.trim();
  var rcarnum1 = document.getElementById('rcarnum1').value.trim();
  var rcarnum2 = document.getElementById('rcarnum2').value.trim();
  var rphoneNum = document.getElementById('rphoneNum').value.trim();

  // Validate form fields
  var isValid = true;

  if (rjob === "") {
      document.querySelector('.perjob').style.display = 'block';
      isValid = false;
  }
  if (rname === "") {
      document.querySelector('.pername').style.display = 'block';
      isValid = false;
  }
  if (rcartype === "") {
    document.querySelector('.perct').style.display = 'block';
    isValid = false;
  }
  if (rcarnum1 === "") {
    document.querySelector('.percn1').style.display = 'block';
    isValid = false;
  }
  if (rcarnum2.length !== 4) {
      document.querySelector('.percn2').style.display = 'block';
      isValid = false;
  }
  if (rphoneNum.length !== 11 || !rphoneNum.startsWith("010")) {
    document.querySelector('.perpn').style.display = 'block';
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