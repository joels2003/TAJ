<?php
$server = "localhost";
$username = "root";
$Password = "";
$db = "vehicledb";

$conn = mysqli_connect($server,$username,$Password,$db);

if($conn)
{
   // echo "connection sucesfully";

}else
{
    echo "connection failed";
}
?>