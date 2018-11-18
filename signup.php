<?php


if(isset($_POST['register']))
{
 include_once 'dbconnect.php';
 
 $first=mysqli_real_escape_string($connection,$_POST['first']);
 $last=mysqli_real_escape_string($connection,$_POST['last']);
 $username=$first.' '.$last;
 $email=mysqli_real_escape_string($connection,$_POST['email']);
 $pswd=mysqli_real_escape_string($connection,$_POST['pswd']);
 $hashedpswd=password_hash($pswd,PASSWORD_DEFAULT);
 if(empty($first) || empty($last) || empty($email) || empty($pswd))
 {
  header("Location:home?register=empty");
  exit();  
 }
 else if(!preg_match("/^[A-Za-z]*$/",$first) and !preg_match("/^[A-Za-z]*$/",$last))
 {
  header("Location:home?register=charerror");
  exit();
 }
 else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
 {
  header("Location:home?register=emailerror&first=$first&last=$last");
  exit();
 }
 else
 {
  $sql="select * from clientdetails;";
  $result=mysqli_query($connection,$sql);
  $row=mysqli_fetch_assoc($result);
  if($username == $row['Username'])
  {
      header("Location:home?register=usertakenerr");
	  exit();
  }	   
  else
  {	  
   if($email == $row['Email'])
   {
	  header("Location:home?register=emailregisterederr&first=$first&last=$last");
	  exit();
   }
   else
   {
      $sql="insert into clientdetails(Firstname,Lastname,Username,Email,Password,picstat)values('$first','$last','$username','$email','$hashedpswd',0
	  );";
      mysqli_query($connection,$sql);
      header("Location:home?register=successs");
	  exit();
   }  
  }
 }
}
else
{ 
 header("Location:home?register=error");
 exit();
} 
?>