<?php
$ipadress=$_POST['ipadress'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MYDB1_ip";
echo $ipadress;
//Create a connection object
$conn = mysqli_connect($servername, $username, $password, $dbname);
$tempIP = $ipadress;
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
  // $arr=[];
  $i=0;
  while($arr = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
    print("ID: ".$arr["ip_address"]."\n");
    if(count($arr)<=5)
    {
      $i++;
    }
    echo "<bt>".$i. "<br>";
    echo $tempIP."<-temp>";
    if(($arr[$i]==$tempIP)&&(count($arr)<=5))
    {
      echo"array count is:". count($arr)."/br";
      echo "enjoy our free services";
    }
    else{
      echo "please fill the above form";
    }
  }
  // echo "<br>".count($arr);
  // foreach($result2 as $value)
  // {
  //   echo $result;
  //   $arr['ipaddress'][]=$value['ip_address'];
  // }
  // var_dump($arr);
  // $iCnt = 0;
  // for($iCnt = 0; $iCnt < count($arr);$iCnt++)
  // {
    //  echo "array length is".count($arr)."\n";
    //  echo $iCnt;
          // echo $arr[$i]."<br />";
//     if(($arr[$i]==$tempIP))
//     {
//         $iCnt++;
//         echo "count is : ".$iCnt;
//     }
//     if($iCnt <= 5)
//     {
//           break;
//     }
  // }
?>
