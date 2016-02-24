function getUsers() {
	$.ajax({ // Ajax to grab all users from the User table
		url : "php/getusers.php",
		type: "GET",
		success: function(msg)
		{
			console.log("success: " + msg);
			if(msg != 'error') {
		        $("#users").html(msg); // Add results to the table
			}
		},
		error: function ()
		{
			console.log("error");
		}
	});
};