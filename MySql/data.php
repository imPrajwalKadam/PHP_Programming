<?php
  if(isset($_POST['ipaddress']))
  {
    $ipaddress=$_POST['ipaddress'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydb1_ip";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
     //script for storing new ip and update duplicate ip's count
     $query4 = "INSERT INTO user_ip(ip_address)VALUES('".$ipaddress."') ON DUPLICATE KEY UPDATE ip_Count = ip_Count + 1";
     $result2 = mysqli_query($conn,$query4);
 //script of compairing total count of ip if ip_count==5 script displays form else continue..
 $query2 = "SELECT * FROM user_ip where ip_address = '$ipaddress'";
 $result2 = mysqli_query($conn,$query2);
 $arr=[];
 $i = 0;
 $rows = [];
 while($row = mysqli_fetch_array($result2))
 {
 if((($row['ip_Count'] >= 0)&&($row['is_reg'])==1))
 {
  echo'success';die();
 }
// else if($row['mobile'] == null && ()){
// }
 else{
  echo "failed";die();
 }//end else
 }//end while
  }
?>


