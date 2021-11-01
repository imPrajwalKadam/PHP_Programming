<?php

echo "We are ready to connect database <br>";

//conecting the data base

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

//create database .
$sql = "CREATE DATABASE PrajwalDB1";
$result = mysqli_query($conn,$sql);
//check database is created successfully or not
if($result == true)
{
     echo "the database wase created successfully! ";
}
else{
     echo "Data base not created successfully because of this error ".mysqli_error($conn);
     //echo "<br>";
}
echo "The result is : ";
echo var_dump($result);
echo "<br>";
?>
