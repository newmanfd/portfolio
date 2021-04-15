document.getElementById('form').noValidate = true; // disables HTML5 form validation

function checkForm(e) { 
  // Collect an array of errors so that the user can correct them at the same time;
  var errors = [];
  var re = /[^@]+@[^@]+/; // Regex for the email field

  // VALIDATION FAILS IF MESSAGE AND/OR EMAIL FIELD ARE BLANK AND IF EMAIL FIELD...
  // ...DOESN'T MATCH THE REGULAR EXPRESSION
  
  // If email field is blank or doesn't match the Regex
  if (form.Email.value == '') {  
      errors.push('Email field is empty!'); 
  } else if (!re.test(form.Email.value)) {  
      errors.push('Email address is not complete or is missing the @ symbol!');
  }

  // If message field is empty
  if (form.Message.value == '') {  
      errors.push('Message area is empty!');
  } 

  if (errors.length > 0) {
      var msg = 'ERROR:\n\n';  
      for (var i = 0; i < errors.length; i++) {
          msg+=errors[i] + '\n'; 
      }
      alert(msg);
      e.preventDefault(); // Prevents the form from being submitted
  }

  // Validation was successful if no errors 
}
var form = document.getElementById('form');
form.addEventListener('submit', checkForm, false); 
 
 
