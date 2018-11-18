<?php

session_start();

include_once 'dbconnect.php'; 
?>



<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style type="text/css" media="all">
  html,body
  {
   height:100%;
   width:100%;
  }
  </style>

</head>
<body style="background:orange;">
 <h1 style="color:blue;text-align:center;font-size=70px;">WELCOME</h1>
 <h1 style="color:blue;text-align:center;font-size=70px;"> <?php echo $_SESSION['u_username']; ?></h1>
<?php
$loginquery=$_SERVER['REQUEST_URI'];
if(strpos($loginquery,"login=success") == true)
{
 echo '<script type="text/javascript">window.alert("Hello'." ".''.$_SESSION['u_username'].''.".".'\nYou have Successfully Logged In!!!");</script>';
}


?>
<br><br>
<div style="width:150px;height:150px;border:5px groove orange;position:relative;left:calc(50% - 75px);">
<img src="" width=150px height=150px id="profimg">
</div>
<br>
<?php
$profilepicpath="select profimg from clientdetails where Email='".$_SESSION['u_email']."';";
$result1=mysqli_query($connection,$profilepicpath);
$rowpic=mysqli_fetch_assoc($result1);
$profpicstat="select picstat from clientdetails where Email='".$_SESSION['u_email']."';";
$result2=mysqli_query($connection,$profpicstat);
$rowpicstat=mysqli_fetch_assoc($result2);
if($rowpicstat['picstat'] == 1)
{
 echo '<script type="text/javascript">document.getElementById("profimg").src="'.$rowpic['profimg'].'";</script>';
}
else if($rowpicstat['picstat'] == 0)
{
 echo '<script type="text/javascript">document.getElementById("profimg").src="picdefault.png";</script>';
}
?>
<div id="uploadfrm" style="width:200px;height:80px;position:relative;left:calc(50% - 100px);">
<center>
<form action="profpicupload.php" method="POST" enctype="multipart/form-data">
  <input type="file" name="picupload"><br><br>
  <input type="submit" name="submitPic" value="Upload Profile Pic">
</form>
</center>
</div>
<div id="deletefrm" style="width:150px;height:50px;position:relative;left:calc(50% - 75px);visibility:hidden;">
<center>
<form action="deleteprofpic.php" method="POST">
<input type="submit" name="deletebtn" value="Remove Profile Pic" style="position:relative;left:5px;">
</form>
</center>
</div>
<?php
$picquery = $_SERVER['REQUEST_URI'];

if(strpos($picquery,"profpicupload=empty") == true)
{
 echo '<script type="text/javascript">window.alert("Select a image to upload.");</script>';
}
if(strpos($picquery,"profpicupload=sizeerr") == true)
{
 echo '<script type="text/javascript">window.alert("Image size greater than 10MB can\'t be uploaded");</script>';
}
if(strpos($picquery,"profpicupload=typeerr") == true)
{
 echo '<script type="text/javascript">window.alert("Image of this type can\'t be uploaded");</script>';
}
if(strpos($picquery,"profpicupload=error") == true)
{
 echo '<script type="text/javascript">window.alert("Some error has occurred during upload. Try again.");</script>';
}
if((strpos($picquery,"profpicupload=success") == true))
{
 $photoupload=$_SESSION['u_profpic']; 
 echo '<script type="text/javascript">document.getElementById("profimg").src="'.$photoupload.'";</script>';
 echo '<script type="text/javascript">window.alert("Profile pic uploaded successfully!!");</script>';
 echo '<script type="text/javascript">document.getElementById("uploadfrm").style.visibility="hidden";</script>';
 echo '<script type="text/javascript">document.getElementById("uploadfrm").style.left="calc(50% - 275px)";</script>';
 echo '<script type="text/javascript">document.getElementById("deletefrm").style.visibility="";</script>';
 echo '<script type="text/javascript">document.getElementById("deletefrm").style.top="-80px";</script>';
}
if((strpos($picquery,"pic=delete") == true))
{
 echo '<script type="text/javascript">document.getElementById("uploadfrm").style.visibility="";</script>';
}
if($rowpicstat['picstat'] == 1)
{
 echo '<script type="text/javascript">document.getElementById("uploadfrm").style.visibility="hidden";</script>';
 echo '<script type="text/javascript">document.getElementById("uploadfrm").style.left="calc(50% - 275px)";</script>';
 echo '<script type="text/javascript">document.getElementById("deletefrm").style.visibility="";</script>';
 echo '<script type="text/javascript">document.getElementById("deletefrm").style.top="-80px";</script>';
}
else if($rowpicstat['picstat'] == 0)
{
 echo '<script type="text/javascript">document.getElementById("uploadfrm").style.visibility="";</script>';
}
?>
<div style="float:right;">
<form action="logout.php" method="POST">
   <button type="submit" name="submitLogout">Logout</button>
</form>
</div>
<br><br><br>
<form action="upload.php" method="POST" enctype="multipart/form-data">
  <input type="file" name="fileupload"><br><br>
  <button type="submit" name="submitFile">Upload</button>
</form>
<?php
$query = $_SERVER['REQUEST_URI'];

if(strpos($query,"409") == true)
{
 echo '<script type="text/javascript">window.alert("Select a file to upload.");</script>';
}
if(strpos($query,"406") == true)
{
 echo '<script type="text/javascript">window.alert("File size greater than 10MB can\'t be uploaded");</script>';
}
if(strpos($query,"408") == true)
{
 echo '<script type="text/javascript">window.alert("Files of this type can\'t be uploaded");</script>';
}
if(strpos($query,"407") == true)
{
 echo '<script type="text/javascript">window.alert("Some error has occurred during upload. Try again.");</script>';
}
if(strpos($query,"405") == true)
{
 echo '<script type="text/javascript">window.alert("File uploaded successfully!!");</script>';
}

?>

</body>
</html>