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
	  location.reload(true);
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
		  location.reload(true);
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

  
  if(res=="true"){
  //alert(res);
  //post question success
  alert("Post question succeed");
  window.location.assign("../pages/index.php");
  }
  else
  {
 alert("Post question failed");

  }
  });
}


function Upvote() {

_AID=$(this).prev().text();
   tag_id_up="#up_count_"+_AID;
   tag_id_down="#down_count_"+_AID;
  // alert(tag_id);
   $.post("../include/AJAXUpVote.php",{AID:_AID},
   function(xml){
   
   up_count=$("Up_Count",xml).text();
   down_count=$("Down_Count",xml).text();
   
   $(tag_id_up).text("");
   change_append="<span class=\"glyphicon glyphicon-thumbs-up\" aria-hidden=\"true\">"+up_count+"  UP</span>";
   $(tag_id_up).append(change_append);
   $(tag_id_up).removeClass("up_count_btn");
   $(tag_id_up).addClass("disabled");
   $(tag_id_down).remove();
    
	});

}

function Downvote() {
 _AID=$(this).prev().text();
   tag_id_up="#up_count_"+_AID;
   tag_id_down="#down_count_"+_AID;
  // alert(tag_id);
   $.post("../include/AJAXDownVote.php",{AID:_AID},
   function(xml){
   
   up_count=$("Up_Count",xml).text();
   down_count=$("Down_Count",xml).text();
   $(tag_id_down).text("");
   change_append="<span class=\"glyphicon glyphicon-thumbs-down\" aria-hidden=\"true\">-"+down_count+"  Down</span>";
   $(tag_id_down).append(change_append);
   $(tag_id_down).removeClass("down_count_btn");
   $(tag_id_down).addClass("disabled");
   $(tag_id_up).remove();
    
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
    $("#logout_button").on("click",Logout);
  }
  $("#question_submit").on("click",post_question);
  $(".answer_wrapper").bind("click",function(){
	  if($(this).children(".answer_rich").css("display") == "none"){
		$(this).children(".answer_summary").css("display","none");
		$(this).children(".answer_rich").css("display","block");
	  }
	  else{
		$(this).children(".answer_summary").css("display","block");
		$(this).children(".answer_rich").css("display","none");
	  }
	  });
	  
	$(".up_count_btn").on ("click",Upvote); 
	$(".down_count_btn").on("click",Downvote);
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
  $("#addAnswer_form").validate({
  
     rules: {
	    Content: {
		required: true
		}
	 },
  submitHandler: function(form){
      form.submit();
  }
  
  });
  
});