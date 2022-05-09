$(document).ready(function () {

	$('*[data-href]').on('click', function() {
		window.location = "forum?topic="+$(this).data("href");
	});

	$('[data-href]:not(button)').hover(function(){
		$(this).css("textDecoration", "underline");
		},
		function(){
		  $(this).css("textDecoration", "none");
		  }
	);

	$('#backBtn').click(function() {
		location.href = "/forum";
	});
	
	$('#addAnswerBtn').click(function() {
		return $('#msgArea').val().length > 0;
	});

	$("#selectTopicsPerPage").on("change", function() {
		if(readCookie("topicsPerPage") != this.value){
		  document.cookie = 'topicsPerPage=' + this.value +';';
		  location.reload();
		}
	  });
	  
	$("#selectMessagesPerPage").on("change", function() {
		if(readCookie("messagesPerPage") != this.value){
			document.cookie = 'messagesPerPage=' + this.value +';';
			location.reload();
		}
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

function showTopicSearch(name){
	let request = new XMLHttpRequest();
	request.onreadystatechange = function (){
		if(this.readyState == 4 && this.status == 200){
			listTopics(JSON.parse(this.responseText));
		}
	};

	let page = document.getElementById("pageElem").innerHTML.trim();
	request.open("GET", "controller/listTopics.php?searchTxt=" + name + "&page=" + page, true);
	request.send();
}

function showTopicPageDown(){
	let page = parseInt($("#pageElem").html().trim()) -1;
	showTopicPage(page);
}

function showTopicPageUp(){
	let page = parseInt($("#pageElem").html().trim()) +1;
	showTopicPage(page);
}

function showTopicPage(page){
	let request = new XMLHttpRequest();
	request.onreadystatechange = function (){
		if(this.readyState == 4 && this.status == 200){
			
			listTopics(JSON.parse(this.responseText));
		}
	};

	$("#pageElem").text(" " + page + " ");
	let name = $("#searchTxt").html();
	request.open("GET", "controller/listTopics.php?searchTxt=" + name + "&page=" + page, true);
	request.send();
}

function listTopics(topics){
	$("#topicsTable > tbody").empty();
	
	let page = parseInt(document.getElementById("pageElem").innerHTML.trim());
	$("#pageup").prop("disabled", page >= (topics[0].nbPage / nbTopicsPerPage -1));
	$("#pagedown").prop("disabled", page <= 0);

	topics.forEach(topic => {
		var date = new Date(topic.date * 1000);
		var authorElem = $("<td></td>").addClass("tdAuthor");
		if(topic.author == userId)
		{
			authorElem.text(youTxt);
			authorElem.append($("<form></form>").attr("method", "get").append($("<input></input>").attr("name", "topic").attr("value", topic.id).prop("hidden", true)
			).append($("<button></button>").addClass("optionBtn").attr("name", "edit").text(editTxt)).append($("<button></button>").addClass("optionBtn").attr("name", "delete")
			.text(deleteTxt)));
		}
		else
		{
			authorElem.text(topic.username);
		}
		
		$("#topicsTable > tbody").append($("<tr></tr>").append($("<td></td>").addClass("tdTitle").attr("data-href", topic.id).text(topic.name))
		.append(authorElem).append($("<td></td>").addClass("tdMsg textCenter").text(topic.msgCount + " " + msgTxt))
		.append($("<td></td>").addClass("tdViewCount textCenter").text(topic.view_count)).append($("<td></td>").addClass("tdViewCount textCenter")
		.text(topic.date != null ? date.toLocaleDateString("fr-FR") + " " + date.toLocaleTimeString("fr-FR") : ""))
		);
	});
}