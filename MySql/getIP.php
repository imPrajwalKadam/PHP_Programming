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
<button type="button"onclick="dataIp()" class="btn btn-primary">data</button>
<body>
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="newModalForm" method="POST" action="">
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
            <button type="button" id="sendData"class="btn btn-success" onclick="validationEvent()">submit</button>
          </div>
          <div>
          <input type="text"placeholder="enter otp" name="rndmpassword" id="rndmpassword" />
          </div>
          <div style="float: left;"><div id="otpDiv" style="position: relative; display: none;">
					<input type="text" id="userOtp" name="userOtp" placeholder="OTP"/></div>
				</div>	
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>

<script type="text/javascript">
      var data;
    function dataIp(){
        // alert("hello");
    $.getJSON("http://ip-api.com/json",function(ip){
        data =ip.query;
    $.ajax({
        url:'data.php',
        type:'POST',
        data:{'ipaddress':data},
        success:function(data)
        {
          if(data === "success")
          {         
            $(document).ready(function(){$("#myModal").modal('show');});
          }
        }
    })//end ajax call
});//end ip call
}



// Below Function Executes On Form Submit
function validationEvent() {
// Storing Field Values In Variables
var name = document.getElementById("pName").value;
var lastname = document.getElementById('lastname').value;
var email = document.getElementById("email").value;
var contact = document.getElementById("mobile").value;


if(name=="")
{
  alert("enter firstname");
}
else if(lastname ==""){
  alert("enter lastname"); 
}else if(email==""){
alert("enter email");
}else if(contact==""){
  alert("enter contact details");
}else{
 $.ajax({
        type:'POST',
        url:'saveData.php',
        data:{
        'firstname':name,
        'lastname':lastname,
        'email':email,
        'contact':contact,
        'ipaddress':data,
      },
        success:function(data){
          alert("data is successfully submited");
        }
    });
    // sendOtp();

  }
}


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




function randomString() 
{ 
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var string_length = 6;
	var randomstring = '';
	for (var i=0; i < string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
document.getElementById('rndmpassword').value = randomstring;
}
</script>

