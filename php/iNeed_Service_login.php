<?php
 
 //echo "In php....";
$input = file_get_contents("php://input"); 
$data = json_decode($input,true);		

 $username = $data['username'];
 $password = $data['password'];
 $flag = $data['flag'];



// Create connection
$con=mysqli_connect("129.21.73.22","root","","iNeedDb");
//$con=mysqli_connect("localhost","root","root","iNeedDb");
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if(isset($username) && isset($password))  
 {
 
 	if($flag == 'oldUser')
 	{
 		$sql = "SELECT username from iNeedUsers where username = '".$username."' AND password = '".$password."'";
 		
 	  	// Check if there are results
			if ($result = mysqli_query($con, $sql))
			{
				// If so, then create a results array and a temporary one
				// to hold the data
				$resultArray = array();
				$tempArray = array();
 
				// Loop through each row in the result set
				while($row = $result->fetch_object())
				{
					// Add each row into our results array
					$tempArray = $row;
					array_push($resultArray, $tempArray);
				}
 
				// Finally, encode the array to JSON and output the results
				echo json_encode($resultArray);
	
			}
 	  }
 	  else{
 	  $sql = "INSERT INTO iNeedUsers(username, password) VALUES ('".$username."','".$password."')";
			  mysqli_query($con, $sql);
 	  }
}
 	  
// Close connections
mysqli_close($con);
?>

