<?php
/*echo $_SERVER[REQUEST_URI];
echo $_SERVER[HTTP_USER_AGENT];
echo $_SERVER[HTTP_HOST];
echo $_SERVER[HTTP_REFERER];
echo $_SERVER[QUERY_STRING];*/


include_once 'dbconnect.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<h2>Login</h2>
<form action="login.php" method="POST">

<input type="text" name="username" placeholder="Username/Email"><br><br>
<input type="password" name="pswd" placeholder="Password" maxlength="8"><br><br>
<button type="submit" name="submitLogin">Login</button>

</form>

<br><br><br>

<h2>Register</h2>
<form action="signup.php" method="POST">
    <?php
	if(isset($_GET['first']))
	{
	 $first=$_GET['first'];
     echo '<input type="text" name="first" placeholder="Firstname" value="'.$first.'"><br><br>';
	}
	else
	{
		echo '<input type="text" name="first" placeholder="Firstname"><br><br>';
	}
	
	if(isset($_GET['last']))
	{
	 $last=$_GET['last'];
     echo '<input type="text" name="last" placeholder="Lastname" value="'.$last.'"><br><br>';
	}
	else
	{
		echo '<input type="text" name="last" placeholder="Lastname"><br><br>';
	}
	?>
	<input type="text" name="email" placeholder="Email"><br><br>
	<input type="password" name="pswd" placeholder="Password" maxlength="8"><br><br>
	<button type="submit" name="register">Register</button>
</form>
<?php
 
 $query=$_SERVER['REQUEST_URI'];
 if(strpos($query,"register=empty") == true)
 {
  echo "<script type='text/javascript'>window.alert('Don\'t let the fields be empty.');</script>";
  exit();
 }
 if(strpos($query,"register=charerror") == true)
 {
  echo "<script type='text/javascript'>window.alert('Enter alphabets only.');</script>";
  exit();
 }
 if(strpos($query,"register=emailerror") == true)
 {
  echo "<script type='text/javascript'>window.alert('You have entered an invalid email.');</script>";
  exit();
 }
 if(strpos($query,"register=usertakenerr") == true)
 {
  echo "<script type='text/javascript'>window.alert('Username is already registered!!');</script>";
  exit();
 }
 if(strpos($query,"register=emailregisterederr") == true)
 {
  echo "<script type='text/javascript'>window.alert('Email is already registered!!');</script>";
  exit();
 }
 if(strpos($query,"register=error") == true)
 {
  echo "<script type='text/javascript'>window.alert('Please enter your details!!');</script>";
  exit();
 }
 if(strpos($query,"register=success") == true)
 {
  echo "<script type='text/javascript'>window.alert('You have successfully registered!!');</script>";
  exit();
 }

 if(strpos($query,"login=empty") == true)
 {
  echo "<script type='text/javascript'>window.alert('Don\'t let the fields be empty.');</script>";
 }
 if(strpos($query,"login=usernameerr") == true)
 {
  echo "<script type='text/javascript'>window.alert('Incorrect Username. Hint: Username is the combination of your registered Firstname and Lastname');</script>";
 } 
 if(strpos($query,"login=passworderr") == true)
 {
  echo "<script type='text/javascript'>window.alert('Incorrect Password.');</script>";
 }
 if(strpos($query,"logout=success") == true)
 {
  echo "<script type='text/javascript'>window.alert('You have successfully logged out!!');</script>";
 }
?>

</body>
</html>