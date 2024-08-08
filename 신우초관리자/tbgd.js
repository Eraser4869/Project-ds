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