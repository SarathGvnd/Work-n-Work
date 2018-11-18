<?php

if(isset($_POST['submitPic']))
{
 session_start();
 include_once 'dbconnect.php';
 $userpic=$_SESSION['u_first'].'.profpic';
 $picname = $_FILES['picupload']['name'];
 $pictmp = $_FILES['picupload']['tmp_name'];
 $pictype = $_FILES['picupload']['type'];
 $picerr = $_FILES['picupload']['error'];
 $picsize = $_FILES['picupload']['size'];
 
 $picnamesplit=explode('.',$picname);
 $picext=strtolower(end($picnamesplit));
 
 $profpictype=array('jpeg','jpg','png');
  if(in_array($picext,$profpictype))
  {
    if($picerr === 0)
    {
	 if($picsize < 1048576)
	 {
	  $picnewname=uniqid($userpic,true).".".$picext;
      $picdestination='uploads/'.$picnewname;
	  move_uploaded_file($pictmp,$picdestination);
	  $Firstname=$_SESSION['u_first'];
	  $profpicupdate="update clientdetails set profimg='".$picdestination."' where Firstname='".$Firstname."';";
	  mysqli_query($connection,$profpicupdate);
	  $updatepicstat="update clientdetails set picstat=1 where Firstname='".$Firstname."';";
	  mysqli_query($connection,$updatepicstat);
	  $clientname=$_SESSION['u_first'];
	  $picpath="select profimg from clientdetails where Firstname='".$clientname."';";
	  $result=mysqli_query($connection,$picpath);
	  $row=mysqli_fetch_assoc($result);
	  $_SESSION['u_profpic']=$row['profimg'];
      header("Location:welcome?profpicupload=success");
	 }
	 else
	 {
	  header("Location:welcome?profpicupload=sizeerr");
      exit();
	 }
	}
	else
    {
	  header("Location:welcome?profpicupload=error");
      exit();
	}
  }
  else
  {
	header("Location:welcome?profpicupload=typeerr");
    exit();
  }
}
else
{
  header("Location:welcome?upload=empty");
  exit();
}
?>