<html>
<title></title>
<head>

<script type="text/javascript" src="/test/wp-content/themes/child/script/jquery.jcarousel.min.js"></script>

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</html>
<button style = "text allign:center"type="button"onclick="dataIp()" class="btn btn-primary">data</button>
<body>
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form role="form" id="newModalForm" onsubmit="return ValidationEvent()">
          <div class="form-group">
            <label class="control-label col-md-3" for="email">First Name:</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="pName" name="pName" placeholder="Enter your first name" require/>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3" for="lastname">Last Name:</label>
            <div class="col-md-9">
              <input type="text"class="form-control" id="lastname" placeholder="Enter your last name"require/>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3" for="email">Email:</label>
            <div class="col-md-9">
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" require/>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3" for="email">Mobile:</label>
            <div class="col-md-9">
              <input type="mobile" class="form-control" id="mobile" name="mobile" placeholder="Enter a mobile number" require/>
            </div>
          </div>
          <div style="float: left;"><div class="on-focus clearfix" id="otpDiv" style="position: relative; display: none;">
					<input type="text" id="userOtp" name="userOtp" placeholder="OTP"/></div>
				</div>	
          <div class="modal-footer">
            <input type="submit" value="Submit"class="btn btn-success" id="btnSaveIt">
          </div>
          <div>
          <input type="text" name="rndmpassword" id="rndmpassword" />
          </div>
          <div style="float: left;"><div id="otpDiv" style="position: relative; display: none;">
					<input type="text" id="userOtp" name="userOtp" placeholder="OTP"/></div>
				</div>	
        </form>
      <!-- <form name="regform" id="regform" action="" method="post" onload="readyfunction(); " style="padding-left: 20%;">
			<input type="hidden" name="testJavaScript" id="testJavaScript" value="0"/>
			<input type="hidden" name="refUserId" id="refUserId" value=<?echo $refId;?>>
			<div class="styled-select">
				<div style="float:left"><input type="text" id="firstname" size="10" name="firstname"  class="required" placeholder="First name"  value=""/></div>
				<div><input type="text" id="lastname" size="10" name="lastname" class="required" placeholder="Last name" /></div>
				<div class="clear"></div>
				<div class="on-focus clearfix" style="position: relative;">
				<input type="email" id="useremail" name="useremail" class="required email" placeholder="E-mail"  style="width:410px;max-width:80%; padding:10px;" value="<?php if(isset($emailid)){echo $emailid;} ?>"/>
				 <div class="tool-tip slideIn left">Activation link will be sent here</div>
				</div> 
				<span id="status" style="float: left;"></span>
				
				<div class="clear"></div>
				<div style="float:left"><input type="password" id="password" name="password" class="required password" minlength="6" maxlength="15" placeholder="Password"/></div>
				<div>
					<input type="text" id="phone" name="phone" class="required number" maxlength="12" minlength="10" placeholder="Phone"  value="<?php if(isset($phone)){echo $phone;} ?>"/>
				</div>
				<div class="clear"></div>
				<div style="float: left;"><div class="on-focus clearfix" id="otpDiv" style="position: relative; display: none;">
					<input type="text" id="userOtp" name="userOtp" placeholder="OTP"/></div>
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
		</form> -->
      </div>
    </div>
  </div>
</div>
</body>
<script type="text/javascript">
         $(document).ready(function(){
        $("#exampleModal").modal('show');
    });
    function dataIp(){
        // alert("hello");
    $.getJSON("http://ip-api.com/json",function(ip){
        var data =ip.query;
    $.ajax({
        url:'data.php',
        type:'POST',
        data:{'ipaddress':data},
        success:function(data){
        if(data === "success"){         
            $(document).ready(function(){
        $("#myModal").modal('show');  
    });
        }
        }
    })
});
}

$(function() {
$("#newModalForm").validate({
  rules: {
    pName: {
      required: true,
      minlength: 2
    },
    mobile:{
      required:true,
      minlength: 10,
      maxlength: 10
    },
    email:{
      required:true,
    }
  },
  messages: {
    pName: {
      required: "Please enter your name",
      minlength: "Your data must be at least 2 characters"
    },
    mobile:{
      required:"enter mobile number",
      minlength:"enter valid mobile number"
    },
    // email:{
    //   required:"enter your email",
    // }
  }
});
});


</script>

<script>
  
// Below Function Executes On Form Submit
function ValidationEvent() {
// Storing Field Values In Variables
var name = document.getElementById("pName").value;
var lastname = document.getElementById('lastname').value;
var email = document.getElementById("email").value;
var contact = document.getElementById("mobile").value;
sendOtp();
alert(name);
alert(lastname);
alert(email);
alert(contact);

}



function sendOtp(){
  alert("sendotp function");
	randomString();

	
	var otp=document.getElementById('rndmpassword').value;
  alert(otp);
	// var fname=document.regform.firstname.value;
	// var lname=document.regform.lastname.value;
	var contact=document.getElementById('mobile').value;
alert(contact);
	// var xmlhttp=new XMLHttpRequest();
	// xmlhttp.onreadystatechange=function(){
	// 	if (xmlhttp.readyState==4 && xmlhttp.status==200){
	// 		var error=xmlhttp.responseText;
	// 		var res = error.split("|");
      
	// 		if(res[0] == "SUBMIT_SUCCESS "){
	// 			// document.getElementById('otpDiv').style.display = "block";
	// 			// document.getElementById('sendOtpDiv').style.display = "none";
	// 			// document.getElementById('verifyOtpDiv').style.display = "block";
	// 			// countdown(300, $('#display'));
	// 		}
	// 		else{
	// 			document.getElementById('hdnerror').innerHTML=xmlhttp.responseText;
	// 		}
	//     }
	// }
	// xmlhttp.open("POST","registration1.php",true);
	// xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("otp="+otp+"&phone="+contact);
}
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

</script>
</html>
</script>
</html>
