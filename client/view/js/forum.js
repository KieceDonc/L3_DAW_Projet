$(document).ready(function () {

	$('#backBtn').click(function() {
		location.href = "/forum";
	});
	
	$('#addAnswerBtn').click(function() {
		return $('#msgArea').val().length > 0;
	});
	
	$('#createTopicBtn').click(function() {
		return $('#inputName').val().length > 0;
	});

});