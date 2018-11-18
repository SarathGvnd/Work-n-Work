<?php
session_start();
include_once 'dbconnect.php';

if(isset($_POST['deletebtn']))
{
 $First=$_SESSION['u_first'];
 $picpath="select profimg from clientdetails where Firstname='".$First."';";
 $result=mysqli_query($connection,$picpath);
 $row=mysqli_fetch_assoc($result);
 unlink($row['profimg']);
 $picupdate="update clientdetails set profimg=NULL where Firstname='".$First."';";
 mysqli_query($connection,$picupdate);
 $picstatupdate="update clientdetails set picstat=0 where Firstname='".$First."';";
 mysqli_query($connection,$picstatupdate);
 header("Location:welcome?pic=delete");
}


?>
