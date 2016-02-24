<?php	
	require('connection.php'); // Init connection to database
	
	$return = '';
	//Check connection 
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} else {
		$sql = "SELECT * FROM `User` ORDER BY timestamp DESC";
		
		// Grab table 
		$result = mysqli_query($conn,$sql)or die(mysqli_error());

		// Add header to return string
		$return .= "<tr><th>First Name</th><th>Last Name</th><th>Address 1</th><th>Address 2</th><th>City</th><th>State</th><th>Country</th><th>Zipcode</th><th>Timestamp</th></tr>";

		// Add each row to the return string
		while($row = mysqli_fetch_array($result)) {
			$fname = $row['firstName'];
			$lname = $row['lastName'];
			$address1 = $row['addressOne'];
			$address2 = $row['addressTwo'];
			$city = $row['city'];
			$state = $row['state'];
			$country = $row['country'];
			$zip = $row['zipcode'];
			$time = $row['timestamp'];
			$return .=  "<tr><td>".$fname."</td><td>".$lname."</td><td>".$address1.
						"</td><td>".$address2."</td><td>".$city."</td><td>".$state.
						"</td><td>".$country."</td><td>".$zip."</td><td>".$time."</td></tr>";
		} 
		echo $return;
	}
	// Close connection
	mysqli_close($conn);
 ?>