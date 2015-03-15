/*
AUTHOR:	Benjamin R. Olson
DATE:	March 8, 2015
COURSE: CS 290 - Web Development, Oregon State University
*/


window.onload = function (){

	$('#login').on('click', function(){login(true);});
	$('#create_user').on('click', function(){login(false);});
			
}

//MAY WANT TO CHANGE THIS TO BE A DEFAULT LOCATION!!!:) :)
//  SO THAT NO CODE IS NECESSARY TO MAKE VISIBILITY OPTION APPEAR ON THE FLY
//  BUT INSTEAD, APPEAR AS AN IMMEDIATE OPTION TO SHARE LOCATION.
json = {
		"entries":
				{ "coords": {"lat":5, "lng":5},
				"loc_name": "(This user has not modified the default location.)",
				"timeframe": {"start":"unspecified", "end":"unspecified"} }
};


function login(login_attempt){
	
	username = $("#userfield").val();
	password = $("#passfield").val();
	
	$.post( "accounts.php", { login_attempt:login_attempt, username:username, password:password, json:json })
		.done(function( data ) {
			if ( data.trim() == "success" ){
				//attempt to direct to main.php
				window.location.replace("main.php");
			} else {
				$('#errors').html(data);
				//clear login fields
				$("#userfield").val("");
				$("#passfield").val("");
			}
			
		})
		.fail(function() {
			$('#errors').html("Failed to communicate with the server.");
		});
			
}


