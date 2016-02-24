<?php	
	$error = "";
	if($_POST) {
		// Grab data from Post call
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$address1 = $_POST['address1'];
		$address2 = $_POST['address2'];
		$city = $_POST['city'];
		$zip = $_POST['zip'];
		$state = (isset($_POST['state']) ) ? $_POST['state'] : ''; // had to check if it was set, due to it not being included if it is set to default. Fixed with validation but still included
		$country = $_POST['country'];
		
		#####################################
		########## Validate Input  ##########
		#####################################
		
		// Validate First Name - All alpha numeric + matches correct length ( 3 - 50 )
		if (!ctype_alpha(str_replace(array("'", "-"), "", $fname))) {
			$error .= '<p class="error">First name should be alpha characters only.</p>';
		}
		if (strlen($fname) < 3 OR strlen($fname) > 50) {
			$error .= '<p class="error">First name should be within 3-20 characters long.</p>';
		}
		
		// Validate Last Name - Same as First Name
		if (!ctype_alpha(str_replace(array("'", "-"), "", $lname))) { 
			$error .= '<p class="error">Last name should be alpha characters only.</p>';
		}
		if (strlen($lname) < 3 OR strlen($lname) > 50) {
			$error .= '<p class="error">Last name should be within 3-20 characters long.</p>';
		}
		
		// Validate Address - Check if length < 100, set min to 5 since it is required and I dont think any address is less then that (ex 1 main is 5)
		if (strlen($address1) < 5 OR strlen($address1) > 100) {
			$error .= '<p class="error">Address should be within 5-100 characters long.</p>';
		}
		
		// Validate Address 2 - Check if length < 100
		if (strlen($address1) > 100) {
			$error .= '<p class="error">Address 2 should be less than 100 characters long.</p>';
		}
		
		// Validate City - VarChar 30, 3 seemed like a reasonable minimum
		if (strlen($city) < 3 OR strlen($city) > 30) {
			$error .= '<p class="error">City should be within 2-30 characters long.</p>';
		}
		
		// Validate Zipcode - VarChar 9
		if(!preg_match('/^[0-9]{5}([- ]?[0-9]{4})?$/', $zip)) {
			$error .= '<p class="error">ZIP should be 5 digits (or 9 if using ZIP+4).</p>';
		}
		
		// Validate State - Char length 2
		if (strlen($state) != 2) {
			$error .= '<p class="error">Select a valid State.</p>';
		}
		
		// Validate Country - Char length 2
		if ($country !== 'US' OR strlen($country) != 2) {
			$error .= '<p class="error">Country can only be US.</p>';
		}
		
		echo $error;
		
		if($error === "") {
			require('connection.php'); // init connection to server
			
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} else {
				$sql = "INSERT INTO `User`(`firstName`, `lastName`, `addressOne`, `addressTwo`, `city`, `state`, `country`, `zipcode`)
						VALUES ('$fname', '$lname', '$address1', '$address2', '$city', '$state', '$country', '$zip')";
				// Attempt query
				if (mysqli_query($conn, $sql)) {
					echo "New record created successfully";
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}
			// Close connection to database
			mysqli_close($conn);
		}
	}
?>