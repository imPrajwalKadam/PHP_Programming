<?php
$ipadress=$_POST['ipadress'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ip_address";


//Create a connection object
$conn = mysqli_connect($servername, $username, $password, $dbname);

//terminate if connection is not valid
if(!$conn)
{
     die("connection failed ". mysqli_connect_error());
}
else{
echo"connection is successful<br>";
}

$query = "INSERT INTO ip_count(ip_address)VALUES('".$ipadress."')";

$result = mysqli_query($conn,$query);

if($result) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $query . "<br>" . $conn->error;
  }
  $getData = "SELECT * FROM ip_count";
  $result1 =  mysqli_query($conn,$getData);
  if($getData) {
    echo "New data is fetch successfully";
  } else {
    echo "Error: " . $getData . "<br>" . $conn->error;
  }


print("data is".$result);
// $result1;
  


?>