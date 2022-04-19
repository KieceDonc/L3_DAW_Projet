$(document).ready(function () {

	$('*[data-href]').on('click', function() {
		window.location = "forum?topic="+$(this).data("href");
	});

	$('#backBtn').click(function() {
		location.href = "/forum";
	});
	
	$('#addAnswerBtn').click(function() {
		return $('#msgArea').val().length > 0;
	});
	
	const errors = new Array();
	
	$('#createTopicBtn').click(function() {
		if($('#inputName').val().length == 0)
		{
			if(jQuery.inArray("Missing topic name", errors) == -1)
			{	
				$('#errorsDiv').append($("<p></p>").text("Missing topic name"));
				errors.push("Missing topic name");
			}
			return false;
		}
		return true;
	});

});