<?php




if(isset($_POST['submitLogin']))
{
  session_start();
 include_once 'dbconnect.php';


 $username=mysqli_real_escape_string($connection,$_POST['username']);
 $pswd=mysqli_real_escape_string($connection,$_POST['pswd']);
 if(empty($username) and empty($pswd))
 {
   header("Location:home?login=empty");
   exit();
 }
 else
 {
  $sql="select * from clientdetails where Username='$username' or Email='$username';";
  $result=mysqli_query($connection,$sql);
  $resultcheck=mysqli_num_rows($result);
  if($resultcheck < 1)
  {
   header("Location:home?login=usernameerr");
   exit();
  }
  else if($row=mysqli_fetch_assoc($result))
  {
	$hashedpswdcheck=password_verify($pswd,$row['Password']);
	if($hashedpswdcheck == false)
	{ 
     header("Location:home?login=passworderr");
	 exit();
	}
	else if($hashedpswdcheck == true)
	{
	  $_SESSION['u_first']=$row['Firstname'];
      $_SESSION['u_last']=$row['Lastname'];
      $_SESSION['u_username']=$row['Username']; 
      $_SESSION['u_email']=$row['Email'];
	  header("Location:welcome?login=success");
	  exit();
    }
  }	
 }
}
else
{
  header("Location:home?login=error");
  exit();
}

?>