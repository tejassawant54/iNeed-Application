<?php
 
 
 $category = $_POST["category"];
 $description = $_POST["description"];

 
// Create connection
//$con=mysqli_connect("localhost","root","root","iNeedDb");
$con=mysqli_connect("129.21.73.22","root","","iNeedDb");
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 if (isset ($_POST["category"]))
 {
 //echo " in category....";
    
    $sql = "SELECT description,image FROM iNeedTable where category='$category'";
    
			if ($result = mysqli_query($con, $sql))
		{
			// If so, then create a results array and a temporary one
			// to hold the data
			$resultArray1 = array();
			$tempArray1 = array();
 
			// Loop through each row in the result set
			while($row = $result->fetch_object())
			{
				// Add each row into our results array
				$tempArray1 = $row;
				array_push($resultArray1, $tempArray1);
			}
 
			// Finally, encode the array to JSON and output the results
			echo json_encode($resultArray1);
		}

 }
 elseif (isset ($_POST["description"])){
 //echo "In description bolck.."
 	 $sql = "SELECT * FROM iNeedTable where description='$description'";
    
			if ($result = mysqli_query($con, $sql))
		{
			// If so, then create a results array and a temporary one
			// to hold the data
			$resultArray1 = array();
			$tempArray1 = array();
 
			// Loop through each row in the result set
			while($row = $result->fetch_object())
			{
				// Add each row into our results array
				$tempArray1 = $row;
				array_push($resultArray1, $tempArray1);
			}
 
			// Finally, encode the array to JSON and output the results
			echo json_encode($resultArray1);
		}
 }
 else{
 //echo "in else....";
// This SQL statement selects ALL from the table 'Locations'
$sql = "SELECT distinct category FROM iNeedTable";
 
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
// Close connections
mysqli_close($con);
?>