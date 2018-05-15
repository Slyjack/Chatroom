

$( document ).ready(function() {
	setInterval(receve, 1000);

});

$( document ).on( 'beforeunload', function() {
	$.get("logout.php");	
});

function receve () {
	$.ajax({
	  url: "users.php",
	  success: function( result ) {
		$("#usertable").html(result);
	  }
	});	
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