   <?PHP 
       $servername = "localhost";
       $username = "root";
       $password = "";
       $dbname = "mydb1_ip";
       $conn = mysqli_connect($servername, $username, $password, $dbname);
$ip_address = $_POST['ipaddress'];
$fname=$_POST['firstname'];
$lname=$_POST['lastname'];
$email=$_POST['email'];
$contact=$_POST['contact'];
$isReg=1;
$query1="UPDATE user_ip set firstname='".$fname."',lastname='".$lname."',mobile='".$contact."',email='".$email."',is_reg = '".$isReg."' where ip_address = '".$ip_address."'";
   $result=mysqli_query($conn,$query1);
   ?>
  