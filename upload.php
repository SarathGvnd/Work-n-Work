<?php

if(isset($_POST['submitFile']))
{
 session_start();
 include_once 'dbconnect.php';
 $user=$_SESSION['u_first'].'.';
 $filename = $_FILES['fileupload']['name'];
 $filetmp = $_FILES['fileupload']['tmp_name'];
 $filetype = $_FILES['fileupload']['type'];
 $fileerr = $_FILES['fileupload']['error'];
 $filesize = $_FILES['fileupload']['size'];
 
 $filenamesplit=explode('.',$filename);
 $fileext=strtolower(end($filenamesplit));
 
 $uploadtype=array('pdf','docx','doc');
  if(in_array($fileext,$uploadtype))
  {
    if($fileerr === 0)
    {
	 if($filesize < 1048576)
	 {
	  $filenewname=uniqid($user,true).".".$fileext;
      $filedestination='uploads/'.$filenewname;
	  move_uploaded_file($filetmp,$filedestination);
	  header("Location:welcome?405");
	 }
	 else
	 {
	  header("Location:welcome?406");
      exit();
	 }
	}
	else
    {
	  header("Location:welcome?407");
      exit();
	}
  }
  else
  {
	header("Location:welcome?408");
    exit();
  }
}
else
{
  header("Location:welcome?409");
  exit();
}
?>