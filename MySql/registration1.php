<?php
//error_reporting(E_ALL);

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

require_once("include/connection.php");
require_once("include/functions.php");
require_once("include/mysql_dbconn.php");
require_once("include/session.php"); 
//require '../sendgrid-google-php/SendGrid_loader.php';
// require '../sendgrid-php/sendgrid-php.php';
//require_once("fbaccess.php");
//DB::$error_handler = 'my_error_handler';
$GLOBALS['$error_msg']="";
DB::$error_handler = false;
/*
if($_GET['msg']=="fblogin" && $_GET['id']!="")
{
	$query="Select firstname, lastname";
	$queryResult=mysql_query($query)
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$emailid=$_POST['useremail'];
}
*/
//die("user:".$user);
// echo "asdasdasd";
// die();
if(isset($_POST['firstname']))
{ 
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$emailid=$_POST['useremail'];
	$password=$_POST['password'];
	// $cpassword=$_POST['password1'];
	$phone=$_POST['phone'];
	$otp=$_POST['otp'];
	$uOtp=$_POST['uOtp'];
	// die();
	$testJavaScript=$_POST['testJavaScript'];
	$refId = $_POST['refId'];
	//testJavaScript=0 => JavaScript is disabled on browser
	//testJavaScript=1 => JavaScript is enabled on browser
	
	//if javascript disabled the default country is India
	/*
	if($testJavaScript==0)
	{
		$_POST['country']=102;
	}
	$country=$_POST['country'];
	
	$city=$_POST['txtcity'];
	*/
	$flag=true;
	// $d=$_POST['datepicker'];
	//date validation
	// $Day=$_POST['day_dob'];
	// $Month=$_POST['month_dob'];
	// $Year=$_POST['year_dob'];
		

	// $OK="";

	/*if ($OK = (($Year > 1900) && ($Year < date("Y")))) {
		if ($OK = ($Month <= 12 && $Month > 0)) {
			$LeapYear = ((($Year % 4) == 0) && (($Year % 100) != 0) || (($Year % 400) == 0));

			if ($Month == 2) {
				$OK = $LeapYear ? $Day <= 29 : $Day <= 28;
			}
			else {
				if (($Month == 4) || ($Month == 6) || ($Month == 9) || ($Month == 11)) {
					$OK = ($Day > 0 && $Day <= 30);
				}
				else {
					$OK = ($Day > 0 && $Day <= 31);
				}
			}
		}
	}
	if($OK)
	{
		$_POST['dob']=$Year."-".$Month."-".$Day;

	}*/
	
	//form fields validation
	
	if($firstname=="" || $firstname==null)
	{
	$GLOBALS['$error_msg'].="Please enter your first name</br>";
	$flag=false;
	}
	if($lastname=="" || $lastname==null)
	{
		$GLOBALS['$error_msg'].="Please enter your last name</br>";
		$flag=false;
	}
	if($emailid=="" || $emailid==null)
	{
		$GLOBALS['$error_msg'].="Please enter your Email.</br>";
		$flag=false;
		
	}
	else
	{
		if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $emailid)) 
		{
			$GLOBALS['$error_msg'].="Please enter a valid email.</br>";
			$flag=false;
		}
		$existingEmailQry="Select email from user where email='".$emailid."'";
		$existingEmailQryRes=mysqli_query($connection,$existingEmailQry);
		if(mysqli_num_rows($existingEmailQryRes)>0)
		{
			$GLOBALS['$error_msg'].="This email id is already registered with us.</br>";
			$flag=false;
		}
	}
	if($password=="" || $password==null)
	{
		$GLOBALS['$error_msg'].="Please enter your password</br>";
		$flag=false;
	}
	else
	{
		if(strlen($password)<6)
		{
			$GLOBALS['$error_msg'].="Password should be 6-15 characters</br>";
			$flag=false;
		}
	}
	/*if($password!=$cpassword)
	{
		$GLOBALS['$error_msg'].="Password and Confirm Password fields don't match</br>";
		$flag=false;
	}*/
	/*
	if($usertype=="" || $usertype==null)
	{
		$GLOBALS['$error_msg'].="Please choose your profession.</br>";
		$flag=false;
	}
	if($address=="" || $address==null)
	{
		$GLOBALS['$error_msg'].="Please enter your Address</br>";
		$flag=false;
	}
	if($testJavaScript==1 && ($country=="" || $country==null))
	{
		$GLOBALS['$error_msg'].="Please enter your country</br>";
		$flag=false;
	}
	if($testJavaScript==1 && $country==102 && $city_state_id=="")
	{
		$GLOBALS['$error_msg'].="Please enter you state and city.</br>";
		$flag=false;
	}
	
	if($country==102 && ($state=="" || $state==null))
	{
		$GLOBALS['$error_msg'].="Please select your State</br>";
		$flag=false;
	}
	if($testJavaScript==0 && ($city=="" || $city==null))
	{
		$GLOBALS['$error_msg'].="Please enter your City</br>";
		$flag=false;
	}
	*/
	if($phone=="" || $phone==null)
	{
		$GLOBALS['$error_msg'].= "Please enter your Phone No.</br>";
		$flag=false;
	}
	else
	{
		if(is_numeric(trim($phone)) == false )
		{
			$GLOBALS['$error_msg'].= "Please enter numeric value for Phone No.</br>";
			$flag=false;
		}
		else
		{
			if(strlen($phone)<10) 
			{
				$GLOBALS['$error_msg'].= "Phone Number should be 10-12 digits.</br>";
				$flag=false;
			}
		}
	}
	if($otp!=$uOtp){
		$GLOBALS['$error_msg'].="OTP doesn't match</br>";
		$flag=false;
	}
	
	/*if(!$OK)
	{
		$GLOBALS['$error_msg'].="Please Enter Valid Date</br>";
		$flag=false;
		
	}*/
		if($flag==true)
	{
	
		/*	//$date=preg_replace('/(\d{2})\/(\d{2})\/(\d{4})/', '$3-$2-$1', $_POST['dob']);
		$user_registration=DB::insert('user',array(
					'firstname'=>$_POST['firstname'],
					'lastname'=>$_POST['lastname'],
					'username'=>$_POST['useremail'],
					'email'=>$_POST['useremail'],
					'usertype'=>$_POST['usertype'],
					'password'=>$_POST['password'],
					'institute'=>$_POST['institute'],
					'branch_of_study'=>$_POST['branch'],
					'address'=>$_POST['address'],
					'city_state_id'=>$_POST['city'],
					'phone'=>$_POST['phone'],
					'gender'=>$_POST['gender'],
					'dob'=>$_POST['dob'],
					'country'=>$_POST['country']
				)); 
				
		*/
		/*
		if($testJavaScript==0)
		{
			$citymatchflag=false;
			$getcityquery=mysqli_query($connection,"SELECT id, city FROM  `city_state` WHERE state = '".$state."'");
			while($row = mysqli_fetch_array($getcityquery,MYSQLI_ASSOC))
			{
			if (strcasecmp($row['city'], $city) == 0)         //ignore case and compare
				{
					$_POST['city']=$row['id'];
					$citymatchflag=true;
					break;
				}
			}
			if($citymatchflag==false)
			{
				$getcitystateid=mysqli_query($connection,"SELECT id FROM `city_state` WHERE city='other' AND state = '".$state."'");
				while($row = mysql_fetch_assoc($getcitystateid))
				{
				$_POST['city']=$row['id'];
				}
			}
		}
		
		if($testJavaScript==1 && ($_POST['city']=="" || $_POST['city']==null))
		{
			$_POST['city']=0; //if the user is from country other than India then the city_state code will be 0
		}
		*/
		
		//EDIT QUERY
		$query="";
		$insert_id="";
		$string="$f$KIrctqsxo2wrPg5Ag/hs4jTi4PmoNKQUGWFXlVy9vu9$6$$f$Oo0skOAdUFXkQxJpwzO05wgRHG0dhuaPBaOU/";
		$salt = sha1(md5($password.$string));
		$password = md5($password.$salt);
		if(isset($_SESSION['usertype']) && $_SESSION['usertype']==9)
		{
			$query="update user set firstname='".mysqli_real_escape_string($connection,$_POST['firstname'])."', lastname='".mysqli_real_escape_string($connection,$_POST['lastname'])."',username='".$_POST['useremail']."', email='".$_POST['useremail']."', password_new='".mysqli_real_escape_string($connection,$password)."',phone='".$_POST['phone']."','".$_POST['otp']."' where id=".$_SESSION['user_id'];
			$result=mysqli_query($connection,$query);
			$insert_id=mysqli_insert_id($connection);
			
		}
		else
		{
			$query="INSERT INTO user "
				."(firstname, lastname, username, email, password_new,  phone,otp, status, phoneNoVerfied) "
				."VALUES ('".mysqli_real_escape_string($connection,$_POST['firstname'])."', '".mysqli_real_escape_string($connection,$_POST['lastname'])."', '".$_POST['useremail']."', '".$_POST['useremail']."', '".mysqli_real_escape_string($connection,$password)."', '".$_POST['phone']."' , '".$_POST['otp']."', 'ACTIVE', 1) ";
			$result=mysqli_query($connection,$query);
			$insert_id=mysqli_affected_rows($connection);
			$newUserId = mysqli_insert_id($connection);
			$_SESSION['username']=$_POST['useremail'];

			if($refId > 0){
				$selectUser = "select * from referrals where id=".$refId;
				$resultSelUser = mysqli_query($connection, $selectUser);
				while ($res2 = mysqli_fetch_array($resultSelUser, MYSQLI_ASSOC)) {
					$userId = $res2['userid'];
					$chapterId = $res2['chapterid'];
				}
				$updateUser = "update referrals set status = 'INACTIVE' where id=".$refId;
				$resultUpUser = mysqli_query($connection, $updateUser);

				$enddate = date('Y-m-d', strtotime('+1 years'));
				$unlockChapNewUser = "insert into unlock_chapters (userid, chapterid, enddate) values(".$newUserId.", ".$chapterId.", '".$enddate."')";
				$reultUnlockChap = mysqli_query($connection,$unlockChapNewUser);
				$unlockChapNew = mysqli_insert_id($connection);

				$unlockChapOldUser = "insert into unlock_chapters (userid, chapterid, enddate) values(".$userId.", ".$chapterId.", '".$enddate."')";
				$reultUnlockChapter = mysqli_query($connection,$unlockChapOldUser);
				$unlockChapOld = mysqli_insert_id($connection);
			}
		}

		
		echo "$$".$newUserId."|";

		if($unlockChapNew > 0){
			echo "chapter |";
		}

			//die("query:".$query);
			
			/*
			if (!$result) 
			{
				die('Invalid query: ' . mysql_error());
			}
			else
			{
			header( 'Location: http://www.primesoftechsolutions.com/test/register2.php?email='.$_POST["useremail"] ) ;
			}
			*/
		//DB::$error_handler = array('Errors', 'my_error_handler'); 
		
		$host  = $_SERVER['HTTP_HOST'];
		$host_upper = strtoupper($host);
		$path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$email=$_POST['useremail'];
		
		$pwd=$_POST['password'];
		$rand=rand(100000,999999);
		
		$user_id = DB::queryFirstField("SELECT id FROM user where username='".$email."'");
		
		if($insert_id<0)
		{
		echo "not insert id</br>";
			if($user_id>0)  {
			echo " 2 not insert id</br>";
				$GLOBALS['$error_msg'].="<br/>Registration Could not be completed. \nYou might have an existing account.\nClick on <a href='first.php'>forgot password</a> to retrieve your password or try again.";
			}
		}
		/*else
		{
		
		 	if($_SERVER['HTTP_HOST']=='vidyaansh.prexam.com' || $_SERVER['HTTP_HOST']=='www.vidyaansh.prexam.com')
                       { 
                               $logo="http://www.prexam.com/images/v_logo.png";
                               $name=" vidyaansh.Prexam.com. ";
                               $weblink="http://www.vidyaansh.prexam.com";
                               $webname="VIDYAANSH.PREXAM.COM";
                       }
                       else
                       {
                               $logo="http://www.prexam.com/images/logo_full.png";
                               $name="Prexam.com.";
                               $weblink="http://www.prexam.com";
                               $webname="PREXAM.COM";
                       }

			$dem = "select * from user where id='75023'";
			$res = mysqli_query($connection, $dem);

			while ($row = mysqli_fetch_array($res)) {
				$detail = "Hi ".$row['firstname']." ".$row['lastname'].", this is demo sms";
				$phone = $row['phone'];
				send_sms($detail, $phone);
				echo $detail;
				echo "<br>";
				echo $phone;
			}


			//echo "yes insert id</br>";
			$message ="<html><body><img src='".$logo."' height=50px><h2> Verify your Email</h2>
			<p>Hi,</p><br/>
			<p>Thanks for Registering on $name </p><br/>
			<p>Click the button below to activate your account</p> <br/>
			<p><a href='http://$host$path/activate.php?user=$rand$user_id'><button style='width:200px; height:30px;background-color:rgb(231, 242, 253);border:1px solid grey;'>Activate My Account</button></a></p><br/>
			<p>If you are not able to click, copy the line below & paste it in your browser.</p><br/>
	
			<p>http://$host$path/activate.php?user=$rand$user_id</p> </br>
			<p>Once your account is active you can use your email & password to login.</p> <br/>
			<p>Email : ".$email."</p> <br/>
			<p>Password :".$pwd."</p> <br/> 
	
			<p>Good Luck and Happy Preparations!! </p><br/>
			<a href='".$weblink."'>$webname</a>
			<a style='margin-left:290px' href='http://www.facebook.com/Prexam' target='blank'><img src='http://www.prexam.com/images/facebook.jpg' alt=facebook height=20></a>
			<a  href='https://twitter.com/Prexam' target='blank'><img src='http://www.prexam.com/images/twitter.png' alt=twitter height=20></a>
			<a href='https://plus.google.com/106569122748365650084/posts' target='blank'><img src='http://www.prexam.com/images/googleplus.png' alt=googleplus height=20></a>
			</body></html>";
	 		if($_SERVER['HTTP_HOST']=='vidyaansh.prexam.com' || $_SERVER['HTTP_HOST']=='www.vidyaansh.prexam.com')
       		{
       			$email_from = "vidyaansh@prexam.com"; //admin email address
       			$headers  = 'MIME-Version: 1.0' . "\r\n";
       			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
       			$headers .= 'From:vidyaansh@prexam.com '."\r\n" .
       			'Reply-To: vidyaansh@prexam.com'."\r\n" .
       			'X-Mailer: PHP/' . phpversion();
      		}
       		else
       		{
 
				$email_from = "info@prexam.com"; //admin email address
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From:info@prexam.com '."\r\n" .
				'Reply-To: info@prexam.com'."\r\n" .
				'X-Mailer: PHP/' . phpversion();
			}

			//$detail="Hi $firstname , Your one time password for prexam is: $otp. ";
			//send_sms($detail,$phone);
			
			//$email="noel00756@gmail.com";
			//			$sendgrid = new SendGrid\SendGrid('prexamprime', 'Primesoft123!');
			//
			//			// Make a message object
			//			$mail = new SendGrid\Mail();
			//
			//			$mail->addTo($email)->
			//				   setFrom('Team PREXAM <info@prexam.com>')->
			//				   setSubject('PREXAM Activation Link and Login Details')->
			//				   setHtml($message);
			//
			//
			//			if($sendgrid->send($mail))
			if(mail($email, 'Login Details', $message, $headers))
			{
				$GLOBALS['$error_msg'].="RS";
				
				//echo 'rs';
			}
			
			
					
			else
			{
			//echo "else";
				$GLOBALS['$error_msg'].="<br/>You were successfully registered but the mail couldn't be sent to your email-id. <a href='forgotpassword.php'>Click Here</a> to send the email";
			}
			//header("Location: first.php?msg=".$GLOBALS['$error_msg']);
			//header( 'Location: http://prexam.in.md-in-6.webhostbox.net/test/register3.php?email='.$_POST["useremail"].'&msg='.$GLOBALS['$error_msg'] ) ;
			
	
		}*/
		
	}
	echo $GLOBALS['$error_msg'];
}
if(isset($_POST['otp'])){
	$otp=$_POST['otp'];
	// $fname=$_POST['fname'];
	// $lname=$_POST['lname'];
	$phone = $_POST['phone'];
	$time = 5;
	$detail = "Enter OTP " .$otp. " to complete your PREXAM.com registration. This OTP is valid for ".$time." minutes only.";
	// echo urlencode($detail);
	// die();

	$flag=true;

	if($phone=="" || $phone==null){
		$GLOBALS['$error_msg'].= "Please enter your Phone No.</br>";
		$flag=false;
	}

	else{
		if(is_numeric(trim($phone)) == false ){
			$GLOBALS['$error_msg'].= "Please enter numeric value for Phone No.</br>";
			$flag=false;
		}
		else{
			if(strlen($phone)<10) {
				$GLOBALS['$error_msg'].= "Phone Number should be 10-12 digits.</br>";
				$flag=false;
			}
		}
	}
		// https://apps.instatechnow.com/sendsms/sendsms.php?username=ISprimecl&password=123456&type=TEXT&sender=PREXAM&peId=1001460846093805090&tempId=1007382016365026134&mobile=9028759596&message=Enter+OTP+45Rav6+to+complete+your+PREXAM.com+registration.+This+OTP+is+valid+for+5+minutes+only.
	if($flag == true){
		if  (in_array  ('curl', get_loaded_extensions())) {
			$ch = curl_init();// init curl
			curl_setopt($ch, CURLOPT_URL,"http://apps.instatechnow.com/sendsms/sendsms.php?username=ISprimecl&password=123456&type=TEXT&sender=PREXAM&peId=1001460846093805090&tempId=1007382016365026134");

			curl_setopt($ch, CURLOPT_POST, 1);// set post data to true
			curl_setopt($ch, CURLOPT_POSTFIELDS,"&mobile=".$phone."&message=".urlencode($detail));// post data
			//echo "username=trl-prime&password=prime123&type=0&dlr=1&destination=".$phone."&source=Prexam&message=".$detail;
			// receive server response ...
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);// gives you a response from the server
			// var_dump($ch);
			// echo $ch;
			$response = curl_exec ($ch);// response it outputed in the response var
			// var_dump($response);
			echo $response."<br/><hr>";
			curl_close ($ch);// close curl connection
		}
	}	
	echo $GLOBALS['$error_msg'];
}

?>