<?php 
$page_title="Register to PREXAM";
$page_keywords="PREXAM, testing tool, online test, time based test, solution";
$page_description="enter you information to create a PREXAM login.";

require_once("include/connection.php");
require_once("include/functions.php");
require_once("include/mysql_dbconn.php");
require_once("include/session.php"); 

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
if(isset($_GET['id'])){
	$refId = $_GET['id'];
}
else{
	$refId = 0;
}
?>

<script type="text/javascript">
  /* <![CDATA[ */
  goog_snippet_vars = function() {
    var w = window;
    w.google_conversion_id = 1009294193;
    w.google_conversion_label = "zgsZCIaX2VkQ8bai4QM";
    w.google_remarketing_only = false;
  }
  // DO NOT CHANGE THE CODE BELOW.
  goog_report_conversion = function(url) {
    goog_snippet_vars();
    window.google_conversion_format = "3";
    var opt = new Object();
    opt.onload_callback = function() {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  }
  var conv_handler = window['google_trackConversion'];
  if (typeof(conv_handler) == 'function') {
    conv_handler(opt);
  }
}
/* ]]> */
</script>
<script type="text/javascript"
  src="//www.googleadservices.com/pagead/conversion_async.js">
</script>
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

<!--<script src="js/jquery.min.js" type="text/javascript"></script>	
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js" type="text/javascript"></script>-->


<!--
	SCRIPT:  register.php
	PURPOSE: 
	This page is used for taking student registrations where student can enter their details to create their profile
	LOGIC: 
	1) once the student enter the details, do form validation to check if all required inputs are provided and are in valid format
	2) if validation is successful, add this detail to database and take the new userid created.
	3) Wrap this userid with padding digits and create activation link
	4) Draft an email and send it to the user  provided email address

	All Rights Reserved
	OWNER:      Prime Softech Solutions Pvt. Ltd., Vasai, India (info@primesoftechsolutions.com)
	AUTHOR:     Payal Doshi 
	UPDATED BY: Dharmistha Hadiya (19/11/2014 2:30 pm)

	NOTE: Using this file with or without the header for any commercial purpose is not permitted
		  without a written permission from the owner company
 -->
<!-- jQuery -->
<!--<script type="text/javascript" src="js/jquery.validate.js"></script>-->
<script type="text/javascript" src="js/reg_validation.js"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
        
<link rel="stylesheet" href="css/emailtooltip.css" type="text/css"/>


 <style>

 #status
{
font-size:11px;
margin-left:10px;
}
#reg_popup_form input
{
	border-radius:5px;
	width:200px;
	padding:10px;
	margin:5px;
}

@media only screen and (max-width: 621px) {
    #reg_popup_form #useremail
    {
        width:200px;
    }
      #reg_popup_form #head
    {
       padding-left:10px;
    }
}
@media only screen and (min-width: 622px) {
    #reg_popup_form #useremail
    {
        width:410px;
    }
    #reg_popup_form #head
    {
       padding-left:50px;
    }
}

.styled-select tr
{
	vertical-align:top;
	border-radius:5px;
}
#reg_popup_form1 input
{
	margin:5px;
}
  #regform1 select
{
	
	height:41px;
	border-radius:5px;
	width:200px;
	margin:5px;
}

.hasPlaceholder {
	color: black;
}

.clear
{
	clear:both;
}


</style>
<script src="js/modernizr.js"></script>
<script>
/*$('input[type=password]').each(function(){
  var el = $(this), elPH = el.attr("placeholder");
  el.addClass("offPage").before('<input class="passText" placeholder="' + elPH + '" type="text" />');
});
$('form').append('<small><a class="togglePassText" href="#">Toggle Password Visibility</a></small>');
function changeInputType(oldObject, oType) {
alert(oldObject.name);
    var newObject = document.createElement('input');
    newObject.type = oType;
    if(oldObject.placeholder){ newObject.placeholder = oldObject.placeholder;}
	
    if(oldObject.minlength){ newObject.minlength = oldObject.minlength;}
	if(oldObject.maxlength) {newObject.maxlength = oldObject.maxlength;}
    if(oldObject.name) {newObject.name = oldObject.name;}
    if(oldObject.id){ newObject.id = oldObject.id;}
    if(oldObject.class) {newObject.class = oldObject.class;}
	
    oldObject.parentNode.replaceChild(newObject,oldObject);
    return newObject;
}*/
$( document ).ready(function() {
    


if(!Modernizr.input.placeholder) {
	$('[placeholder]').focus(function() {
  var input = $(this);
  if (input.val() == input.attr('placeholder')) {
 if (input.attr('type') == 'text'){
	  // alert('hii');
	   $('#txtpassword').hide();
	   $('#password').show();
	   
		}

    input.val('');
    input.removeClass('placeholder');
  }
}).blur(function() {
  var input = $(this);
  if (input.val() == '' || input.val() == input.attr('placeholder')) {
       if (input.attr('type') == 'password'){
	  // alert('hii');
	   $('#password').hide();
	    $('#txtpassword').show();
	  // document.getElementById('txtpassword').display='block';
	  // changeInputType(document.getElementById('password'),'text');
	  // document.getElementById('password').setAttribute('type', 'text');
		}
    input.addClass('placeholder');
    input.val(input.attr('placeholder'));
  }
  
}).blur().parents('form').submit(function() {
  $(this).find('[placeholder]').each(function() {
    var input = $(this);
    if (input.val() == input.attr('placeholder')) {
      input.val('');
    }
  })
});
}
});
/*$(function() {
	if(!$.support.placeholder) { 
		var active = document.activeElement;
		$(':input').focus(function () {
			if ($(this).attr('placeholder') != '' && $(this).val() == $(this).attr('placeholder')) {
				$(this).val('').removeClass('hasPlaceholder');
			}
		}).blur(function () {
			if ($(this).attr('placeholder') != '' && ($(this).val() == '' || $(this).val() == $(this).attr('placeholder'))) {
				$(this).val($(this).attr('placeholder')).addClass('hasPlaceholder');
			}
		});
		$(':input').blur();
		$(active).focus();
		$('form').submit(function () {
			$(this).find('.hasPlaceholder').each(function() { $(this).val(''); });
		});
	}
});*/


$(document).ready(function() {
	$("#gphone").keydown(function(event) {
		// Allow only backspace and delete
		if ( event.keyCode == 46 || event.keyCode == 8 ) {
			// let it happen, don't do anything
		}
		else {
			// Ensure that it is a number and stop the keypress
			if (event.keyCode < 48 || event.keyCode > 57 ) {
				event.preventDefault();	
			}	
		}
	});
	
	if(window.location.href.indexOf("newuser_reg") > -1) {
		setTimeout(loadPopup, 1000);
	}
});



function randomString() 
{ 
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var string_length = 6;
	var randomstring = '';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
document.getElementById('rndmpassword').value = randomstring;
}



function getReg1Data()
{
	
var fname=document.regform.firstname.value;
var lname=document.regform.lastname.value;
var email=document.getElementById('useremail').value;
var pwd=document.regform.password.value;
var contact=document.getElementById('phone').value;
var otp=document.getElementById('rndmpassword').value;
var uOtp = document.getElementById('userOtp').value;
var referralId = document.getElementById('refUserId').value;
var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		var error=xmlhttp.responseText;
		var res = error.split("|");
		var substring = res[0].substring(2);
		document.getElementById('userId').value = substring;

		if(error=="RS" || res[0] == "SUBMIT_SUCCESS " || res[0] == "chapter " || res[0].substring(0, 2) == "$$")
		{
		disablePopup();
		loadRegPopup(email);
		}
		else{
			document.getElementById('hdnerror').innerHTML=xmlhttp.responseText;
		}
    }
  }
xmlhttp.open("POST","registration1.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("firstname="+fname+"&lastname="+lname+"&useremail="+email+"&password="+pwd+"&phone="+contact+"&otp="+otp+"&uOtp="+uOtp+"&refId="+referralId);
}

function getReg2Data()
{
var utype=document.getElementById('usertype').value;
var institute=document.getElementById('institute').value;
// var course=document.getElementById('hdncourse').value;
var address=document.getElementById('address').value;
var city=document.regform1.city.value;
var state=document.getElementById('state').value;
var gender=document.getElementById('gender').value;
var hemailid=document.getElementById('hemailid').value;
var js=document.getElementById('testJavaScript').value;
var country=document.getElementById('country').value;
var guardianname=document.getElementById('guardianname').value;
var gphone=document.getElementById('gphone').value;
var freetrailcourse=document.getElementById('hdnfreecourse').value;
var userid = document.getElementById('userId').value;
var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		var error1=xmlhttp.responseText;
		var data=error1.trim();
		//alert(data);
		//document.getElementById('hdnerror1').innerHTML=xmlhttp.responseText;
		if(data=="RS1")
		{
		disableRegPopup();
		// loadMsgPopup();
		window.location ="activate.php?user=173563"+userid;
		}
	}
  }
xmlhttp.open("POST","register3.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("usertype="+utype+"&institute="+institute+"&address="+address+"&city="+city+"&state="+state+"&gender="+gender+"&testJavaScript="+js+"&country="+country+"&hemailid="+hemailid+"&guardianname="+guardianname+"&gphone="+gphone+"&freetrail="+freetrailcourse);
}
popupStatus=0; 
if(window.location.href.indexOf("newuser-reg") > -1) {
	setTimeout(loadPopup, 3000);
}
function loadPopup()
{
 <?
       if (isset($_SESSION["user_id"]))
       {
       ?>
               alert('You are already logged in');
       <?        
       }
       else
       {?>
              //loads popup only if it is disabled
		if(popupStatus==0)
		{
			$("#ubgPopup").css({
				"opacity": "0.7"
			});
			$("#ubgPopup").fadeIn("slow");
			$("#reg_popup_form").fadeIn("slow");
			popupStatus = 1;
			$("#reg_popup_form").center();
			$("#reg_popup_form").css({
				//"top": "20%"
			});
			document.body.style.overflow = "visible";
			
		}
       <?}?>
	
}
function disablePopup()
{
	//disables popup only if it is enabled
	if(popupStatus==1){
		$("#ubgPopup").fadeOut("slow");
		$("#reg_popup_form").fadeOut("slow");
		popupStatus = 0;
		document.body.style.overflow = "visible";
	}
}


$(function() {
		$( "#datepicker" ).datepicker({
			dateFormat: 'dd-mm-yy', 
			changeMonth: true,
			changeYear: true,
			yearRange: '1950:2014'
		});
	});
	
var Status=0;
var flag=0;var utypeflag=0;var flag1=0;
function loadRegPopup(emailid)
{
	//loads popup only if it is disabled
	if(Status==0)
	{
		var userid=emailid;
		document.getElementById('hemailid').value=userid;
		$("#reg_bg_popup").css({
			"opacity": "0.7"
		});
		$("#reg_bg_popup").fadeIn("slow");
		$("#reg_popup_form1").fadeIn("slow");
		Status = 1;
		$("#reg_popup_form1").center();
		document.body.style.overflow = "visible";
	}
}
function disableRegPopup()
{
	//disables popup only if it is enabled
	if(Status==1){
		$("#reg_bg_popup").fadeOut("slow");
		$("#reg_popup_form1").fadeOut("slow");
		Status = 0;
		document.body.style.overflow = "visible";
	}
}

var msgpopupstatus=0;
function loadMsgPopup()
{
	//loads popup only if it is disabled
	if(msgpopupstatus==0)
	{
	   $("#msg_bg_popup").css({
			"opacity": "0.7"
		});
		$("#msg_bg_popup").fadeIn("slow");
		$("#msg_popup_form").fadeIn("slow");
		msgpopupstatus = 1;
		$("#msg_popup_form").center();
		document.getElementById('trackingid').style.display="block";
		document.body.style.overflow = "hidden";

	}
}
function disableMsgPopup()
{
	//disables popup only if it is enabled
	if(msgpopupstatus == 1)
	{
		$("#msg_bg_popup").fadeOut("slow");
		$("#msg_popup_form").fadeOut("slow");
		msgpopupstatus = 0;
		document.body.style.overflow = "visible";
	}
}

var imgpopupstatus=0;
function loadactivationimgPopup()
{
	//loads popup only if it is disabled
	if(imgpopupstatus==0)
	{
	   $("#Activation-bg-Popup").css({
			"opacity": "0.7"
		});
		$("#Activation-bg-Popup").fadeIn("slow");
		$("#acivationimgform").fadeIn("slow");
		imgpopupstatus = 1;
		$("#acivationimgform").center();
		document.body.style.overflow = "hidden";

	} 
}
function disableactivationPopup()
{
	//disables popup only if it is enabled
	if(imgpopupstatus == 1)
	{
		$("#Activation-bg-Popup").fadeOut("slow");
		$("#acivationimgform").fadeOut("slow");
		imgpopupstatus = 0;
		document.body.style.overflow = "visible";
	}
}


/*function multiple_course()
{	
	var myForm = document.forms.regform1;
	var course = myForm.elements['branch'];
	var values = [];
	for (var i = 0; i < course.length; i++)
	{
		if (course[i].checked) 
		{
		values.push(course[i].value);
		}
	}		
	var courseValues=values.join();
	document.getElementById('hdncourse').value=courseValues;
}*/

function free_course()
{	
	var myForm = document.forms.regform1;
	var freecourse = myForm.elements['freecourse'];
	var values = [];
	var count=0;
	for (var i = 0; i < freecourse.length; i++)
	{
		if (freecourse[i].checked) 
		{
			count++;
			if(count>2)
			{
				freecourse[i].checked=false;
				alert("You can only select a maximum of 2 courses");
				break;
			}
			else
		{
		values.push(freecourse[i].value);
		}
			
		
	}
}	
	var courseValue=values.join();
	document.getElementById('hdnfreecourse').value=courseValue;
}	

function statevalidate()
{
	var country=document.getElementById("country").value;
	if(country==null || country=="")
	{
		document.getElementById("msg2").innerText=" This field is required.";
		flag1=1;
	}
	else
	{
	document.getElementById("msg2").innerText="";
	flag1=0;
	}
	
	if(country=="102")
	{
		var state=document.getElementById('state').value;
		if(state==null || state=="")
		{
			document.getElementById("msg3").innerText="\n This field is required.";
			flag=1;
		}
		else 
		{
			document.getElementById("msg3").innerText="";
			flag=0;
		}
	}

		var state=document.getElementById('state').value;
		if(state!=null || state!="")
		{
			var city=document.getElementById('city').value;
			if(city==null || city=="")
			{
				document.getElementById("cityerror").innerText="\n This field is required.";
				flag=1;
			}
			else
			{
				flag=0;
				document.getElementById("cityerror").innerText="";
			}
		}
}
var maxResendCount = 0;
function sendOtp(){
	randomString();

	var otp=document.getElementById('rndmpassword').value;
	// var fname=document.regform.firstname.value;
	// var lname=document.regform.lastname.value;
	var contact=document.getElementById('phone').value;

	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			var error=xmlhttp.responseText;
			var res = error.split("|");
			if(res[0] == "SUBMIT_SUCCESS "){
				document.getElementById('otpDiv').style.display = "block";
				document.getElementById('sendOtpDiv').style.display = "none";
				document.getElementById('verifyOtpDiv').style.display = "block";
				countdown(300, $('#display'));
			}
			else{
				document.getElementById('hdnerror').innerHTML=xmlhttp.responseText;
			}
	    }
	}
	xmlhttp.open("POST","registration1.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("otp="+otp+"&phone="+contact);
}

function countdown(duration, display){
	if (!isNaN(duration)) {
        var timer = duration,
          minutes, seconds;
          
        var interVal = setInterval(function() {
          minutes = parseInt(timer / 60, 10);
          seconds = parseInt(timer % 60, 10);

          minutes = minutes < 10 ? "0" + minutes : minutes;
          seconds = seconds < 10 ? "0" + seconds : seconds;

          $(display).html("<b> Your OTP will expire in " + minutes + "m : " + seconds + "s" + "</b>");
          if (--timer < 0) {
            timer = duration;
            $('#display').empty();
            $('#display').html("<b onClick='resendOTPFunction();'> Resend OTP? </b>");
            // resendOTPFunction();
            clearInterval(interVal)
          }
        }, 1000);
    }
}

function resendOTPFunction(){
	maxResendCount++;
	if(maxResendCount > 3){
		$('#display').html("<b>Too many attempts made, Please try again later. </b>");
	}
	else{
		var confirmation = confirm("Are you sure you want to resend OTP?");
		if(confirmation){
			sendOtp();
			alert("OTP successfully sent");
		}
	}

	// $('#display').html("<a> Resend OTP? </a>");
}

function check()
{ 
	if(validate_form('register1'))
	{
		
        goog_report_conversion();

		getReg1Data();
	}
}

function check1()
{
	validateusertype();
	statevalidate();
	if(flag1==0 && utypeflag==0)
	{
		getReg2Data();

	}
}

function validateusertype()
{
	var usertype=document.getElementById('usertype').value;
	
	if(usertype==null || usertype=="")
	{
		document.getElementById("msg").innerText="\n This field is required.";
		utypeflag=1;
	}
	else
	{
		document.getElementById("msg").innerText="";
		utypeflag=0;
	}
}
function validategender()
{
	var gender=document.getElementById('gender').value;
	
	if(gender==null || gender=="")
	{
		document.getElementById("msg1").innerText="\n This field is required.";
			flag=1;
	}
	else
	{
		document.getElementById("msg1").innerText="";
		flag=0;
	}
}

//
//$(function() {
//   $(".steps").hover(function() {
//   var image2=$(this).children().children().eq(3).val()
//	$(this).children().children().eq(0).hide()
//	 $(this).children().children().eq(1).css({"display":"block","text-align":"center","width":"100%","height":"100%"})
//	 $(this).css({"background":"url('images/circle.png')"+image2+" no-repeat"})
//    },function(){
//	 var image1=$(this).children().children().eq(2).val()
//	$(this).css({"background":"url('images/circle.png')"+image1+" no-repeat"})
//
//	 $(this).children().children().eq(1).hide()
//	  
//    $(this).children().children().eq(0).css("display","block")
//		
//	
//	
//  });
// });
// 
 

</script>
<style>
.regsteps_heading
{
    color:black;
}
.steps
{
    font-size: 16px;
    font-weight: bold;
    padding-top: 15px;
    padding-bottom: 5px;
}
</style>
<!---->
<!---------------------------------changes in register steps--------------------------------->

<div id="container" >
    <div class="row">
        <div class="col-sm-12">
            <h1 class="header title">STEPS TO REGISTER</h1>
           
    </div>
    </div>
    <div class="row" style="margin-top:20px;margin-bottom:40px">
        <div class="col-sm-1" style="text-align:center"></div>
     <div class="col-sm-2" style="text-align:center">
         <a  class="description"  href="javascript:loadPopup()">
         <img src="images/createacc.png" alt="Create your Account" style="display: block;margin:auto;">
         <div class="steps"><b> 1.</b><span class="regsteps_heading title"> Create Account</span></div>
        
          <span style="color:gray">  New User? Create Your Account for FREE </span>
                        
           </a>                   
         </div>
     <div class="col-sm-2" style="text-align:center">
         <a  class="description"  href="javascript:loadPopup()">
         <img src="images/link.png" alt="Activate your Account" style="display: block;margin:auto;">
          <div class="steps"> <b> 2.</b><span class="regsteps_heading title"> Activate Your Account</span> </div>
       
          <span style="color:gray">   Check Your Email To Activate </span>
                        
           </a>                   
         </div>
     <div class="col-sm-2" style="text-align:center">
         <a  class="description"  href="javascript:loadPopup()">
         <img src="images/login.png" alt="Login" style="display: block;margin:auto;">
         <div class="steps"> <b> 3.</b><span class="regsteps_heading title"> Login</span></div>
         <span style="color:gray">Click Here To Login</span>
                        
           </a>                   
         </div>
    <div class="col-sm-2" style="text-align:center">
         <a  class="description"  href="javascript:loadPopup()">
         <img src="images/TryFreeTest.png" alt='Take A Test for free' style="display: block;margin:auto;">
         
         <div class="steps"><b> 4.</b><span class="regsteps_heading title"> Try Free Test </span></div>
         
          <span style="color:gray;"> Take a Test On subject/chapter Of Your Choice </span>
                        
           </a>                   
         </div><div class="col-sm-2" style="text-align:center">
         <a  class="description"  href="javascript:loadPopup()">
         <img src="images/buy.png" alt="Buy Packages" style="display: block;margin:auto;">
         <div class="steps"> <b> 5.</b><span class="regsteps_heading title"> Buy Packages</span></div>
         
        <span style="color:gray"> Choose Suitable Package </span>
                        
           </a>                   
         </div>
        <div class="col-sm-1" style="text-align:center"></div>
 </div>
</div>
<!---->
<!---------------------------changes over for register steps ---------------------------------------------------------------->
<div id="acivationimgform"  style="padding:6px;width:800px;background-color:#ffffff ; display:none;">
	<a onClick="disableactivationPopup()"><span style="cursor:pointer ; position: absolute; right:10px ; font-size: 25px; top: 0px;  padding-top:10px ;">×</span></a> 
	<img src="images/gmail-link.png" alt="Email sample"/>
</div>	

<div id="Activation-bg-Popup"></div>
	 
<div id="reg_popup_form" style="background-color:#ffffff ; display:none;">
	<a onClick="disablePopup()"><span style="cursor:pointer ; position: absolute; right:10px ; font-size: 25px; top: 0px;  padding-top:20px ;">×</span></a>  
	<div id="head" style="width:350px;padding-left: 50px;max-width: 100%;">
	<h2 style="font-size:20px;;border-bottom: 3px solid rgb(230, 222, 222); border-bottom-style: inset; padding-top:30px ; color:#BE482C;">Create Your Account (It`s Free!!)
	</h2>
	</div>

	<font color="#CC0000"><p><?echo $GLOBALS['$error_msg']; ?></p></font>
	<? if (!empty($errors)) { display_errors($errors); } ?>
	
	<div id="hdnerror" style="color:#BE482C;text-align:center"></div>
	<div class="form-container" >
		<form name="regform" id="regform" action="" method="post" onload="readyfunction(); " style="padding-left: 20%;">
			<input type="hidden" name="testJavaScript" id="testJavaScript" value="0"/>
			<input type="hidden" name="refUserId" id="refUserId" value=<?echo $refId;?>>
			<div class="styled-select">
				<div style="float:left"><input type="text" id="firstname" size="10" name="firstname"  class="required" placeholder="First name"  value=""/></div>
				<div><input type="text" id="lastname" size="10" name="lastname" class="required" placeholder="Last name" /></div>
				<div class="clear"></div>
				<div class="on-focus clearfix" style="position: relative;">
				<input type="email" id="useremail" name="useremail" class="required email" placeholder="E-mail"  style="width:410px;max-width:80%; padding:10px;" value="<?php if(isset($emailid)){echo $emailid;} ?>"/>
				<!-- <div class="tool-tip slideIn left">Activation link will be sent here</div>
				</div> -->
				<span id="status" style="float: left;"></span>
				<font></font>
				
				<div class="clear"></div>
				<div style="float:left"><input type="password" id="password" name="password" class="required password" minlength="6" maxlength="15" placeholder="Password"/></div>
				<div>
					<input type="text" id="phone" name="phone" class="required number" maxlength="12" minlength="10" placeholder="Phone"  value="<?php if(isset($phone)){echo $phone;} ?>"/>
				</div>
				<div class="clear"></div>
				<div style="float: left;"><div class="on-focus clearfix" id="otpDiv" style="position: relative; display: none;">
					<input type="text" id="userOtp" name="userOtp" placeholder="OTP"  /></div>
				</div>	
				<div style="color:#CC0000;font-size:12px;padding-left:10px;padding-top:5px">* All fields are required</div>
				<div class="clear"></div>
				<div id='sendOtpDiv' style="display: block; width: 100%"><input class="submit button" style="background: #BE482C;width:90px ; margin-left:30%;" type="button" onClick="sendOtp()" value="Send OTP"/><br/>
				</div>
				<div class="clear"></div>
				<div id='display' style="margin-right: 250px;">
				</div>
				<div class="clear"></div>
				<div id='verifyOtpDiv' style="display: none; width: 100%; float: left;"><input class="submit button" style="background: #BE482C;width:90px ; margin-left:30%;" type="button" onClick="check()" value="Verify OTP"/><br/><div id='loader' style='display:none'>Verfying and Saving Information...<br/><img src="images/ajax-loader.gif"> </div>
				</div>
				<input type="hidden" name="dob" id="dob" />
				<input type="hidden" name="rndmpassword" id="rndmpassword" />
				
					
				
			</div>
		</form>
	</div>
</div>
</div>
<div id="ubgPopup"></div>



<div id="reg_popup_form1" style="background-color:#ffffff ; display:none; width:800px" >
<a onClick="disableRegPopup()"><span style="cursor:pointer ; position: absolute; right:10px ; font-size: 25px; top: 0px;  padding-top:20px ;">×</span></a>
<div id="head" style="width:200px;padding-left:50px;"><h2 style="border-bottom: 3px solid rgb(230, 222, 222); border-bottom-style: inset; padding-top:30px ; color:#BE482C;font-size:20px;">More About Me</h2></div>

<font color="#CC0000"><p><?echo $GLOBALS['$error_msg'] ?></p></font>

<? if (!empty($errors)) { display_errors($errors); } ?>
<div id="hdnerror1" style="color:#BE482C;text-align:center"></div>
	<div class="form-container" >
		<form name="regform1" id="regform1" action="register3.php" method="post" onload="readyfunction()" style="padding-left:10%;">
			<!--<input type="hidden" name="testJavaScript" id="testJavaScript" value="0"/>-->	
			<input type="hidden" name="fbmsg" id="fbmsg" value="<?php if(isset($fbmsg) && $fbmsg!=""){echo $fbmsg;} ?>"/>
			<input type="hidden" name="fbid" id="fbid" value="<?php if(isset($fbid) && $fbid!=""){echo $fbid;} ?>"/>
			<div class="styled-select">
			<br/><br/>
			<?
			if($_GET['fbmsg']=="fblogin" || $_POST['fbmsg']=="fblogin")
			{
			?>
			<label for="phone">Phone</label>
             <input type="text" id="phone" name="phone" class="required number" maxlength="12" minlength="10" value="<?php if(isset($phone)){echo $phone;} ?>"/><font color="#CC0000">*</font>
			 <!-- minlength is not an attribute of input tag but it is used by jquery for minlength validation-->
			 <span id="phone_error" name="phone_error"></span>
            <div class="clear"></div>	
			<div class="styled-select1">			
				<label for="dob">Birth Date</label>
				<select id="day_dob" name="day_dob">
				<?for ($i=01; $i<=31; $i++){?>
				<option value="<?echo $i?>" <?if(isset($Day) && $Day==$i){ echo "Selected";} ?>><?echo $i?></option>
				<?}?>
				</select> 
				<?
				$months=array('January', 'February','March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November','December' );
				?>
				<select id="month_dob" name="month_dob">
				<? $i=0;
				foreach ($months as $month){
				$i++;
				?>
				<option value="<?echo $i?>" <?if(isset($Month) && $Month==$i){ echo "Selected";} ?>><? echo $month?></option>
				<?}?>
				</select> 
				<select id="year_dob" name="year_dob">
				<?for ($i=date(Y); $i>=date(Y)-100; $i--){?>
				<option value="<?echo $i?>" <?if(isset($Year) && $Year==$i){ echo "Selected";} ?>><?echo $i?></option>
				<?}?>
				</select> 
				<input type="hidden" name="dob" id="dob"/>
				<span id="dob_error" name="dob_error"></span>
				<font color="#CC0000">*</font>
				<div class="clear"></div>		
			</div>
			<?
			}
			?>		
			<!--table-->
			<?if ($_SERVER['HTTP_HOST']=="vidyaansh.prexam.com" || $_SERVER['HTTP_HOST']=='www.vidyaansh.prexam.com')
					{
					//echo $_SERVER['HTTP_HOST'];
					?>
				<!--tr style="display:none"> 
					<td-->
					<div style="float:left">
					<select id="usertype" name="usertype"  onblur="validateusertype()" style="width:200px" >
					<option value="" >I am a</option>
					<option value="5"  selected >Student</option>
					<option value="6" >Teacher</option>
					<option value="7" >Other</option>
					</select>
					<span id="msg"></span>
					</div>
					<!--/td>
					
					
					<td-->
					<div>
					<input type="text" id="institute" name="institute" placeholder="Institution" style="margin-left:40px;" value="vidyaanshinstitute.in" />
					</div>
					<!--/td>

				</tr-->
				<?}
				else
				{
				?>
				<!--tr>
					<td-->
					<div style="float:left">
					<select id="usertype" name="usertype" onblur="validateusertype()" style="width:200px" >
					<option value="" >I am a</option>
					<option value="5"  selected <?if(isset($usertype) && $usertype==5){echo "selected";}?>>Student</option>
					<option value="6" <?if(isset($usertype) && $usertype==6){echo "selected";}?>>Teacher</option>
					<option value="7" <?if(isset($usertype) && $usertype==7){echo "selected";}?>>Other</option>
					</select>
					<span id="msg"></span>
					</div>
						
					
					<!--/td>
					<td-->
				
				<div style="float:left;">	<input type="text" id="institute" name="institute" placeholder="Institution" style="/*margin-left:40px;*/"  value="<?php if(isset($institute)){echo $institute;}?>"/> </div>
				
				
					
					<!--/td>
				</tr-->
				<?}?>
				<!--tr>
					<td-->
					<div>
					<select id="gender" name="gender" onblur="validategender()" style="width:200px">
					<option value="">Gender</option>
					<option value="MALE">MALE</option>
					<option value="FEMALE">FEMALE</option>
					</select>
					<span id="msg1"></span>
					</div>
					
					<!--div>
					<span id="msg1"></span>
					</div-->
					<!--/td>
				</tr>
				<tr>
					<td-->
					<div style="float:left;">
					<input type="text" id="guardianname" size="10" name="guardianname"  class="required" placeholder="Parent/Gaurdian name"   value="<?php if(isset($guardianname)){echo $guardianname;} ?>"/>
					</div>
					<!--/td>
					<td-->
					<div>
					<input type="text" id="gphone" name="gphone" class="required number"  maxlength="12" minlength="10" placeholder="Parent Phone"   style="/*margin-left:40px;*/" value="<?php if(isset($gphone)){echo $gphone;} ?>"/>
					</div>
					<!--/td>
					
					</td>
				</tr>
				<tr>
					<td-->
					<div style="float:left">
					<select id="country" name="country" onchange="get_state(),statevalidate()" style="display:none; width:200px" onblur="validatecountry()" >
						<option value=""> --Select Country (*Required)-- </option>
					<option value="102">India</option>
						<?
						$sql = 'select id,short_name from country';

								$result=DB::query($sql);

								foreach($result as $row)
								{
									if(isset($country) && $country==$row['id'])
									{
										echo '<option value="'.$row['id'].'" selected>'.$row['short_name'].'</option>';
									}
									else
									{
										echo '<option value="'.$row['id'].'" >'.$row['short_name'].'</option>';
									}
								}
						?>
						</select>
						<span id="msg2"></span>
						</div>
					<!--/td>
					<td-->
					<div style="float:left;">
						<span id="state1">
						<select id="state" name="state" onchange="get_cities(),statevalidate()"	 onblur="validatestate()" style="width:200px;/*margin-left:40px;*/">
						<option value=""> --Select State (*Required)-- </option>
						<?
						$sql = 'select distinct state from city_state where id>0';

								$result=DB::query($sql);

								foreach($result as $row)
								{
									if($flag==false && $state==$row['state']) 
									{
										echo '<option value="'.$row['state'].'" selected>'.$row['state'].'</option>';
									}
									else
									{
									   echo '<option value="'.$row['state'].'">'.$row['state'].'</option>';
									}
								}
						?>
						</select>
						</span>
						<span  id="msg3" style="/*padding-left:40px*/"></span>
					</div>
					<!--/td>
					<td-->
					<div>
						<span id="city1"></span>	<span  id="cityerror"></span>	
						<span id="city2">
						<input type="text" id="txtcity" name="txtcity" placeholder="Insert city"  value="<?php if(isset($city)){echo $city;} ?>"/>(insert city) 
						</span>	
						</div>
					<!--/td>
				</tr-->
				<!--tr>
					<td colspan="2"-->
						<div>
						<input type="text"  id="address" name="address" size="40"   placeholder="Address" style="width:410px; max-width:100% " value="<?php if(isset($address)){echo $address;} ?>">
						<input type="hidden" name="hemailid" id="hemailid"/>
						<input type="hidden" name="hdncourse" id="hdncourse"/>
						 <input type="hidden" name="hdnfreecourse" id="hdnfreecourse"/>
						    </div>         
		
					
				
					<div>
					<b style=" padding-right:8px">Choose Your Exam for FREE Trial (Max. 2)</b>
					</div>
					<!--/td>
				</tr-->	
				<!--tr-->
		
					<?
					$query="select id,name from course where status='ACTIVE'";
					$results = DB::query($query);
					?>
					<!--td style="padding-left:60px;width:140px"-->
					<div style="float:left;">
					<?
					$i=0;
					foreach ($results as $row) 
					{
						if($i%2==0)
						{
						echo"<input type='checkbox' name='freecourse' id='freecourse_".$row['id']."'  style='width:30px' onchange='free_course()'  value='".$row['id']."'/>".$row['name']." "; 
						?><br/><?
						}
						$i++;
					}
					?>
					</div>
					<!--/td>
					<td-->
					<div>
					<?
					$i=0;
					foreach ($results as $row) 
					{
						if($i%2!=0)
						{
						echo"<input type='checkbox' name='freecourse' id='freecourse_".$row['id']."'  style='width:30px' onchange='free_course()' value='".$row['id']."'/>".$row['name']." "; 
						?><br/><?
						}
						$i++;
					}
					?>
					</div>
					<input type="hidden" name="userId" id="userId">
					<!--/td>
					

					</tr>
			</table-->
<br /><br/><br/>
    	   
</div>
 <input class="submit button" style="background: #BE482C;width:90px ; margin-left:35%; padding:10px;border-radius:5px;" type="button" onClick="check1()" value="Submit"/><br/><center><div id='loader' style='display:none'>Verfying and Saving Information...<br/><img src="images/ajax-loader.gif" alt="loading image"> </div></center>
   
  </form>
  <script type="text/javascript">

//Syntax: checkboxlimit(checkbox_reference, limit)
//checkboxlimit(document.forms.regform1.freecourse, 2)

</script>
</div>
</div>
<div id="reg_bg_popup"></div>



<div id="msg_popup_form" style="background-color:#ffffff ; width:400px;" >
<a onClick="disableMsgPopup()"><span style="cursor:pointer ; position: absolute; right:10px ; font-size: 25px; top: 0px;  padding-top:10px ;">×</span></a>
<p style="font-size:16px; line-height:30px;margin-top:25px">You have been successfully Registered<br/> Now you can Login</p>

<script type="text/javascript">
//var timeInt=0;
//    function googlead()
//    {
//        if(jQuery('p:contains("You have been successfully Registered")').is(':visible')==true)
//        {
//            var gaCode ='<img id="trackingid" height="1" width="1" style="border-style:none;display:none" alt="" src="//www.googleadservices.com/pagead/conversion/1009294193/?label=zgsZCIaX2VkQ8bai4QM&amp;guid=ON&amp;script=0"/>';
//            jQuery('body').append(gaCode);
//            clearInterval(timeInt); 
//        } 
//    }
//    timeInt = setInterval(function(){googlead()},2000);
</script>
</div>
<div id="msg_bg_popup"></div>




 









		 
		
  
	 