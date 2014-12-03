/**
 * 
 */
function newDoc() {
    window.location.assign("../pages/register.php")
}

function Jump_question() {
    window.location.assign("../pages/postquestion.php")
}

function popupLogin(){
      $("#dialog").dialog("open");
}

function Logout(){
  $.post("../include/AJAXLogOut.php",{},
    function(xml){
    //alert(xml);
    res = $("Logout",xml).text();
    //alert(res);
    if(res == "true"){
      $("#login_button").text("Login");
      $("#signup_button").text("Sign up");
    }
  });
}

function Login(){

    if(!$("#login_form").valid()){
      return;
    }
    $("#dialog").dialog("close");

    $.post("../include/AJAXLOGIN.php", {email: $("#email").val(), password: $("#password").val()},
        function(xml){
        //alert(xml);
        res = $("Login",xml).text();
        //alert(res);
        if(res == "true"){
          //login success
          name =  $("user-name",xml).text()
          //alert(name);
          $("#login_button").text(name);
          $("#signup_button").text("Log out");
          $("#login_button").unbind('click');
          $("#signup_button").unbind('click');
          $("#signup_button").bind('click',Logout);
        }
        else{
          //
          alert("Login failed");
          //login failed
        }

      });
}

function post_question() {
    _Content = $("#Content").val();
	_Title = $("#Title").val();
	
	if(_Content == "" || _Title == ""){
		 alert("Input is invalid, You need input both Title and Content");
		return -1;
	}
  $.post("../include/AJAXpostQuestion.php",{Content:_Content, Title:_Title},
  function(xml){
  res=$("Content",xml).text();
  alert(res);
  
  if(res=="true"){
  //post question success
  alert("Post question succeed");
  window.location.assign("../pages/index.php");
  }
  else
  {
  alert("Post question failed");
  window.location.assign("../pages/index.php");
  }
  });
}


$(document).ready(function() {

    $("#LoginBtn").on("click", Login);
  $(function() {
    $("#dialog").dialog({
      autoOpen: false
    });
  });
  if($("#login_button").text().substring(0,5) =="Login"){
   
    $("#login_button").on("click", popupLogin);
    $("#signup_button").on("click",newDoc);
  }
  else{
    $("#signup_button").on("click",Logout);
  }
  $("#question_submit").on("click",post_question);
  $(".jumbotron").bind("click",function(){
	  if($(this).children(".answer_rich").css("display") == "none"){
		$(this).children(".answer_summary").css("display","none");
		$(this).children(".answer_rich").css("display","block");
	  }
	  else{
		$(this).children(".answer_summary").css("display","block");
		$(this).children(".answer_rich").css("display","none");
	  }
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
              minlength: 6,
              maxlength: 15
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
