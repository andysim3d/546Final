/**
 * 
 */
$(document).ready(function(){
	//validate password same as comfirm_password
 	$("#confirm_password").bind('input', function(){
 		var text = $("#password").val();
 		if(text == $("#confirm_password").val()){
	 				$("#confirminput").removeClass("has-error");
	 				$("#confirminput").addClass("has-success");
	 				$("#frn4").removeClass("glyphicon-remove");
	 				$("#frn4").addClass("glyphicon-ok");
 		}
 		else{

	 				$("#confirminput").removeClass("has-success");
	 				$("#confirminput").addClass("has-error");
	 				$("#frn4").removeClass("glyphicon-ok");
	 				$("#frn4").addClass("glyphicon-remove");
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
				//alert(xml);

				res = $("Validate",xml).text();
				reason = $("Content",xml).text();
				//alert(reason);
	 			if(res == "true"){
	 				$("#emailinput").removeClass("has-error");
	 				$("#emailinput").addClass("has-success");
	 				$("#frn1").removeClass("glyphicon-remove");
	 				$("#frn1").addClass("glyphicon-ok");
	 			}
	 			else{
	 				$("#frn1").val(reason);
	 				$("#emailinput").removeClass("has-success");
	 				$("#emailinput").addClass("has-error");
	 				$("#frn1").removeClass("glyphicon-ok");
	 				$("#frn1").addClass("glyphicon-remove");
	 			}

			});

	};
