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
	});