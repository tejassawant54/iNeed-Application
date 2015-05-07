<?php
 
 //echo "In php....";
$input = file_get_contents("php://input"); 
$data = json_decode($input,true);		

 $category = $_POST["category"];
 $description = $_POST["description"];

 $cat = $data['category'];
 $des = $data['description'];
 $name=$data['name'];
 $street=$data['street'];
 $city=$data['city'];
 $state=$data['state'];
 $zip=$data['zip'];
 $mobile=$data['mobile'];
 $email=$data['email'];
 $image = $data['image'];
 $status = $data['status'];
 $flag=$data['flag'];

// Create connection
//$con=mysqli_connect("localhost","root","root","iNeedDb");
$con=mysqli_connect("129.21.73.22","root","","iNeedDb");
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if(isset($cat) && isset($des) && isset($name))  
 {
 	if($flag == 'delete')
 	//http://localhost/test.php?category=Book&description=HarryPotter2&name=RohanMurde2&street=rusttic&city=ROC&state=NY&zip=14623&mobile=585&email=ram9125
 	//echo "In delete block..";
 		{
 	  	$sql = "DELETE FROM iNeedTable where category = '".$cat."' AND name = '".$name."' AND description = '".$des."'";
 	  	mysqli_query($con, $sql);
 	  	}
 	elseif($flag == 'select')
 		{
 		$sql = "SELECT * from iNeedTable where category = '".$cat."' AND name = '".$name."' AND description = '".$des."'";
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
 	  	elseif(isset($cat) && isset($des) && isset($name) && isset($street) && isset($city) && isset($state) && isset($zip) && isset($mobile) && isset($email) && $flag=='insert')  
		 {
			//http://localhost/test.php?category=Book&description=HarryPotter2&name=RohanMurde2&street=rusttic&city=ROC&state=NY&zip=14623&mobile=585&email=ram9125
			//echo "In insert block..";
			  $sql = "INSERT INTO iNeedTable(category, name, description,street, city, state, zip, mobile, email, image, status) VALUES ('".$cat."','".$name."','".$des."','".$street."','".$city."','".$state."','".$zip."','".$mobile."','".$email."','".$image."','".$status."')";
			  mysqli_query($con, $sql);
	
	  
		 }
 	else
 	{
 		 $sql = "UPDATE iNeedTable SET category='".$cat."', name='".$name."', description = '".$des."',street = '".$street."', city = '".$city."', state = '".$state."', zip = '".$zip."', mobile = '".$mobile."', email ='".$email."', image='".$image."', status='".$status."' WHERE name='".$name."'";
			  mysqli_query($con, $sql);
 	}
 	
 }
 
// Close connections
mysqli_close($con);
?>

