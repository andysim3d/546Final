/**
 * 
 */
function newDoc() {
    window.location.assign("../pages/register.html")
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