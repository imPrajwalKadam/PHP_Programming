<!DOCTYPE html>
<html>

<head>
          <!-- Latest compiled and minified CSS -->
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/
	4.0.0/css/bootstrap.min.css">
          <!-- jQuery library -->
          <script src="https://ajax.googleapis.com/ajax/libs/
	jquery/3.3.1/jquery.min.js">
          </script>
          <!-- Popper JS -->
          <script src="https://cdnjs.cloudflare.com/ajax/libs/
	popper.js/1.12.9/umd/popper.min.js">
          </script>
          <!-- Latest compiled JavaScript -->
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/
	4.0.0/js/bootstrap.min.js">
          </script>
</head>

<body><br>
          <p class="text-center">
                    FORM VALIDATION USING JQUERY
          </p>

          <div class="container">
                    <div class="col-lg-8
		m-auto d-block">

                    <form>
                              <div class="form-group">
                                        <label for="fname">first name:</label>
                                        <input  type="text" name="fname" id="fname"class = "form-control" autocomplete="off">
                                        <a id="chkfname"></a>
                              </div>

                              <div class="form-group">
                                        <label for="lname">last name:</label>
                                        <input type="text"id="lname"name="lname"class="form-control">
                                        <h5 id="chklname"></h5>
                              </div>
                              
                              <div class="form-group">
                                        <label for="email">email:</label>
                                        <input type="text"id="email"name="email"class="form-control">
                                        <h5 id="chkemail"></h5>
                              </div>
                              
                              <div class="form-group">
                                        <label for="lname">contact:</label>
                                        <input type="text"id="lname"name="lname"class="form-control">
                                        <h5 id="chkmobile"></h5>
                              </div>
                                        <button class="btn btn-primary">submit</button>
                    </form>
                             
                    </div>
          </div>

          <script type="text/javascript">
                  jQuery(document).ready(function(){
                    jQuery('#chkfname').hide();
                    jQuery('#chklname').hide();
                    jQuery('#chkemail').hide();
                    jQuery('#chkmobile').hide();

                    var fnameErr = true;
                    var lnameErr= true;
                    var emailErr=true;
                    var contactErr=true;

                    jQuery('#fname').keyup(function(){
                              validatefname();
                    });

                    jQuery('#lname').keyup(function(){
                              validatelname();
                    });
                    jQuery('#email').keyup(function(){
                              validateEmail();
                    });

                    function validatefname(){
                              var user_val =jQuery('#fname').val();
                              if(user_val.length == '')
                              {
                                        jQuery('#chkfname').show();
                                        jQuery('#chkfname').html("**please enter a name");
                                        jQuery('#chkfname').focus();
                                        jQuery('#chkfname').css("color","red");
                                        fnameErr = false;
                                        return false;


                              }else{
                                        jQuery('#chkfname').hide();

                              }
                              if((user_val.length < 3)|| (user_val.length > 10) )
                              {
                                        jQuery('#chkfname').show();
                                        jQuery('#chkfname').html("**length of name must be between 3 and 10");
                                        jQuery('#chkfname').focus();
                                        jQuery('#chkfname').css("color","red");
                                        fnameErr = false;
                                        return false;


                              }else{
                                        jQuery('#chkfname').hide();

                              }
                    }


                    function validatelname(){
                              var user_val =jQuery('#lname').val();
                              if(user_val.length == '')
                              {
                                        jQuery('#chklname').show();
                                        jQuery('#chklname').html("**please enter a last name");
                                        jQuery('#chklname').focus();
                                        jQuery('#chklname').css("color","red");
                                        fnameErr = false;
                                        return false;


                              }else{
                                        jQuery('#chkfname').hide();

                              }
                              if((user_val.length < 3)|| (user_val.length > 10) )
                              {
                                        jQuery('#chklname').show();
                                        jQuery('#chklname').html("**length of name must be between 3 and 10");
                                        jQuery('#chklname').focus();
                                        jQuery('#chklname').css("color","red");
                                        fnameErr = false;
                                        return false;

                              }else{
                                        jQuery('#chklname').hide();
                              }
                    }

                    function validateEmail()
                    {
                              var user_val = jQuery('#chkemail').val();
                              var RegMail="^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$";
                              if(user_val.length == '')
                              {
                                        jQuery('#chkemail').show();
                                        jQuery('#chkemail').html("enter your email");
                                        jQuery('#chkemail').focus();
                                        jQuery('#chkemail').css("color","red");
                                        emailErr = false;
                                        return false;
                              }else{
                                        jQuery('#chkemail').hide();
                              }
                              if(user_val.match(RegMail))
                              {
                                        jQuery('#chkemail').hide();
                                       
                              }else{
                                        jQuery('#chkemail').show();
                                        jQuery('#chkemail').html("enter your email");
                                        jQuery('#chkemail').focus();
                                        jQuery('#chkemail').css("color","red");
                                        emailErr = false;
                                        return false;
                              }
                    }



                  });



          </script>
</body>

</html>