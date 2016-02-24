function SetupFormSubmit() {
	// Override submit so we can call the php through AJAX
	$("#register").bind('submit',function(e) {
		$.ajax({
		    url : "php/register.php",
		    type: "POST", // Post call
		    data : $("#register").serializeArray(), // Serialize form to pass to php
		    success: function(msg)
		    {
		        if(msg != "") {
					if(msg == " New record created successfully") {
						window.location = 'confirmation.html';
					} else {
						$("#errors").html(msg); // Add to error div for user to see
					}
		        }
		    },
		    error: function ()
		    {
		        console.log("error"); 
		    }
		});
		
		return false;
	});
};