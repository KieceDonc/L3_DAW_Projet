$(document).ready(function () {

	$('#backBtn').click(function() {
		location.href = "/forum";
	});
	
	$('#addAnswerBtn').click(function() {
		return $('#msgArea').val().length > 0;
	});

});