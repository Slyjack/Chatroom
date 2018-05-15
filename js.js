

$( document ).ready(function() {
	setInterval(receve, 1000);

});

function receve () {
	$.ajax({
	  url: "history.php",
	  success: function( result ) {
		$("#chatbox").append(result);
	  }
	});	
}

function send () {
	var s = $("#sendtext").val();
	$.ajax({
	  url: "send.php",
	  data: {
		chat: s
	  }
	});
	$("#sendtext").val("");
	receve();
	return true;
}