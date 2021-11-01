<?php
include "./navbar.php";

//Pattern in php . 

$iNo = 5;
$i = 0;
$j = 0;

for($i = 1;$i <= $iNo; $i++)
{
   for($j = 1; $j <= $iNo; $j++)
   {
        echo " * ";
   }
   echo "<br>";
}
echo "<br>";

for($i = 1; $i <= $iNo ; $i++ )
{
     for($j = 1; $j <= $i ; $j++)
     {
          echo " * ";
     }
     echo "<br>";
}

echo "<br>";

for($i = 1; $i <= $iNo ; $i++ )
{
     for($j = 1; $j <= $i ; $j++)
     {
          if(($i == $iNo)||($j == $iNo)||($j == $i)||($j == 1))
          {
          echo " * ";
          }
          else{
               echo "_";
          }
     }
     echo "<br>";
}
?>


