<?php
$ipadress=$_POST['ipadress'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ip_address";
echo $ipadress;
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
  
  $query2 = "SELECT * FROM ip_count";
  $result2 = mysqli_query($conn,$query2);
 $arr=[];
  foreach($result2 as $value)
  {
    $arr['ipaddress'][]=$value['ip_address'];
  }
  var_dump($arr);
  $iCnt = 0;
  $i=0;
  for($i = 0; $i < count($arr);$i++)
  {
    if($arr[$i]==$ipadress)
    {
        $iCnt++;
    }
  }

  
// While a row of data exists, put that row in $row as an associative array
// Note: If you're expecting just one row, no need to use a loop
// Note: If you put extract($row); inside the following loop, you'll
//       then create $userid, $fullname, and $userstatus
// while ($row = mysql_fetch_assoc($result1)) {
//     echo $row["ip_address"];
// }

// $result1;
  


?>
