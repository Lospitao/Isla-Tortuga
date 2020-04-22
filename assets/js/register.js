$(document).ready(function() { //targets the document ONLY when document is ready
	//On click signup, hide login and show registration form
	$("#signup").click(function() { //when the link is clicked
		$("#login_section").slideUp("slow",  function () {
			$("#registration_section").slideDown("slow");
		});
	});
	//On click signin, hide registration and show login
	$("#signin").click(function() { //when the link is clicked
		$("#registration_section").slideUp("slow",  function () {
			$("#login_section").slideDown("slow");
		});
	});
});