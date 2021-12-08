var myInput = document.getElementById("reg_password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters_data = 0;
  var upperCaseLetters_data = 0;
  var numbers_data = 0;
  var length_data = 0;

  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
    lowerCaseLetters_data = 1;
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
    upperCaseLetters_data = 1;
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
    numbers_data = 1;
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
    length_data = 1;
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }

  if(lowerCaseLetters_data == 1 && upperCaseLetters_data == 1 && numbers_data == 1 && length_data == 1){
    var woo_register_button = document.getElementById("woo_register_button").disabled = false;
  }else{
    var woo_register_button = document.getElementById("woo_register_button").disabled = true;
  }
}