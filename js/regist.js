/**
 * 
 */
$(document).ready(function(){
	//validate password same as comfirm_password
 	$("#confirm_password").bind('input', function(){
 		var text = $("#password").val();
 		if(text != $("#confirm_password").val()){
 			$(this).css("background-color", "red");
 		}
 		else{

 			$(this).css("background-color", "green");
 		}
 	});
 	
 	$("#email").bind('blur',fn);
});
 
 	function back(){
 		windows.history.back();	
 	}

	function fn(){
		$.post("../include/AJAXEmailComfirm.php", {email: $(this).val()},
				function(xml){
				alert(xml);
				res = $("Validate",xml).text();
				reason = $("Content",xml).text();
				//alert(res);
	 			if(res == "true"){
	 				$("#email").css("background-color", "green");
	 			}
	 			else{
	 				$("#email").val(reason);
	 				$("#email").css("background-color", "red");
	 			}

			});

	};
