$(document).ready(function () {

	$('#backBtn').click(function() {
		location.href = "/forum";
	});
	
	$('#addAnswerBtn').click(function() {
		return $('#msgArea').val().length > 0;
	});
	
	$('#createTopicBtn').click(function() {
		if($('#inputName').val().length == 0)
		{
			$('.errorsDiv').append($("<p>Missing topic name</p>"));
			return false;
		}
		return true;
	});

});