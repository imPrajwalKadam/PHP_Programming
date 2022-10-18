<?php
if (isset($_POST['ipaddress'])) {
  $ipaddress = $_POST['ipaddress'];
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "mydb1_ip";
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  //script for storing new ip and update duplicate ip's count
  $query4 = "INSERT INTO ip_count(ip_address)VALUES('" . $ipaddress . "') ON DUPLICATE KEY UPDATE ip_Count = ip_Count + 1";
  $result2 = mysqli_query($conn, $query4);
  //script of compairing total count of ip if ip_count==5 script displays form else continue..
  $query2 = "SELECT * FROM ip_count where ip_address = '$ipaddress'";
  $result2 = mysqli_query($conn, $query2);
  while ($row = mysqli_fetch_array($result2)) {
    if (($row['ip_Count']>= 4)&&($row['is_reg'] == 0)) {
      echo 'success';
      die();
    } else {
      echo "failed";
      die();
    }
  } //end while
}
?>
