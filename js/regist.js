/**
 * 
 */
$(document).ready(function(){
 	$("input[id='confirm_password']").bind('input', function(){
 		var text = $("input[id='password']").val();
 		if(text != $("input[id='confirm_password']").val()){
 			$(this).css("background-color", "red");
 		}
 		else{

 			$(this).css("background-color", "green");
 		}
 	});
 	
 	$("input[id='email']").bind('blur',fn);
});
 
 

	function fn(){
		$.post("../include/AJAXEmailComfirm.php", {email: $(this).val()},
				function(xml){
				//alert(xml);
				res = $("Validate",xml).text();
				reason = $("Content",xml).text();
				//alert(res);
	 			if(res == "true"){
	 				$("input[id='email']").css("background-color", "green");
	 			}
	 			else{
	 				$("input[id='email']").val(reason);
	 				$("input[id='email']").css("background-color", "red");
	 			}

			});

	};