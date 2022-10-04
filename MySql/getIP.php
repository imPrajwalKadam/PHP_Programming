<?php 
/*
1. get users ip address using  $SERVER['REMOTE_ADDR];
2. create table in database userIP id[auto inc],ipaddress[int],datetime[datetime];
3. create database connection 
3. store ip address  in our table 
4. then get all ip address which is store in our database in one array using mysqli num row


$iCnt = 0;
for($i = 0; $i < DBARR.len; $i++)
{
    if(currentIP == DBIParr[i])
    {
        iCnt++;
    }
}  
if(iCnt<=5)
{
    print("please enter a details")
}else{
    return false
}


5. 
*/




//conecting the data base
/*
$servername = "localhost";
$username = "root";
$password = "";


//Create a connection object
$conn = mysqli_connect($servername,$username,$password);

//terminate if connection is not valid
if(!$conn)
{
     die("connection failed ". mysqli_connect_error());
}
else{
echo"connection is successful<br>";
}

$query = ("INSERT INTO IPADDRESS $ )
*/?>


<html>
    <?php

// function getCount()
// {
    
//     $iCnt = 0;
//     for($i = 0; $i < DBIParr.len; $i++)
//      {
//      if(currentIP == DBIParr[i])
//       {
//         $iCnt++;
//       }
//      }  
// if(iCnt<=5)
// {
//     print("please enter a details");
// }else{
//     return false;
// }
// }

// // $ret = getCount();
// // echo $ret;
// // $currentIP = $SERVER['REMOTE_ADDR'];
// $currentIP = $_SERVER['REMOTE_ADDR'];
// // getenv("REMOTE_ADDR");

// echo $currentIP."\n";


?>
<body>
    
</body>

</head>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<button onclick="dataIp()">data</button>

<script type="text/javascript">
    function dataIp(){
        // alert("hello");
    $.getJSON("http://ip-api.com/json",function(ip){
        var data =ip.query;

    $.ajax({
        url:'data.php',
        type:'POST',
        data:{'ipadress':data}
    })
});
}
</script>
</html>
<!-- <?php 
// if(isset($_POST['ip']))
// {
//     $ip = POST['ip'];
//     echo "ip address is".$ip;
// }

function getCount()
{
    
    $iCnt = 0;
    for($i = 0; $i < DBIParr.len; $i++)
     {
     if(currentIP == DBIParr[i])
      {
        $iCnt++;
      }
     }  
if(iCnt<=5)
{
    print("please enter a details");
}else{
    return false;
}
}

// $ret = getCount();
// echo $ret;
// $currentIP = $SERVER['REMOTE_ADDR'];
$currentIP = $_SERVER['REMOTE_ADDR'];
// getenv("REMOTE_ADDR");

?> -->

</script>
</html>

