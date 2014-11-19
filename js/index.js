/**
 * 
 */
function newDoc() {
    window.location.assign("../pages/register.php")
}

$(document).ready(function() {
	$(function() {
		$("#dialog").dialog({
			autoOpen: false
		});
		$("#login_button").on("click",function() {
			$("#dialog").dialog("open");
		});
	});
});

// When the browser is ready...
$(function() {

  // Setup form validation on the #register-form element
  $("#login_form").validate({
  
      // Specify the validation rules
      rules: {
          email: {
              required: true,
              email: true
          },
          password: {
              required: true,
          }
      },
      
      // Specify the validation error messages
      errorElement: "div",
      messages: {
          password: {
              required: "Please provide a password",
          },
          required: "You need input your email address",
          email: "Please enter a valid email address"
          
      },
      
      submitHandler: function(form) {
          form.submit();
      }
  });
});

function logout(){
	
}