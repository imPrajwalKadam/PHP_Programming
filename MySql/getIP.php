<html>
<title></title>
<head>
<script>
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
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
        <form role="form" id="newModalForm">
          <div class="form-group">
            <label class="control-label col-md-3" for="email">Name:</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="pName" name="pName" placeholder="Enter your name" require/>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3" for="email">Mobile:</label>
            <div class="col-md-9">
              <input type="mobile" class="form-control" id="mobile" name="mobile" placeholder="Enter a mobile number" require>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="btnSaveIt">Save</button>
            <button type="button" class="btn btn-default" id="btnCloseIt" data-dismiss="modal">Close</button>
          </div>
        </form>
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
      minlength: 12,
      maxlength: 12
    }
  },
  messages: {
    pName: {
      requiredname: "Please enter your name",
      minlength: "Your data must be at least 2 characters"
    },
    mobile:{
      requiredMob:"enter mobile number",
      minlength:"enter valid mobile number"
    }
  }
});
});
</script>
</html>
</script>
</html>
