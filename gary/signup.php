<!DOCTYPE>
<html>
<head>
<style>
ul{
display: block;
background-color: #fff000;
border: 5px solid black;
font-size: 1.25em;
margin: 0% 35% 2% 35%;
padding: 2% 0% 2% 5%;
}
</style>

<title>
Sign Up
</title>
</head>
<body style="background-color: purple;">

<?php
require_once '/home/nick/webstuff/www/templates/Swift-5.0.1/lib/swift_required.php';
$gmail = 'garyberry999@gmail.com';
$gmailpass = 'loudblack';


if(isset($_POST['user']) && isset($_POST['password']) && isset($_POST['email']))
{
$conn = new mysqli('localhost', 'root', '', 'gary');

if(mysql_errno())
{
exit('Connect failed: ' . mysqli_connect_error());
}

//password variables for secure hashing

$cost = 10;
$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
$salt = sprintf("$2a$%02d$", $cost) . $salt;



$user = mysql_real_escape_string($_POST['user']);
$password = mysql_real_escape_string($_POST['password']);
$email = mysql_real_escape_string($_POST['email']);
$retype = mysql_real_escape_string($_POST['retype']);


$error_message = array();

$check_if_email_exists = "SELECT * FROM members WHERE email='$email'";
$email_rows = $conn->query($check_if_email_exists);

if(empty($user))
	$error_message[] .= 'Please enter your username.';
if(empty($password))
	$error_message[] .= 'Please enter your password.';
if(empty($email)){
	$error_message[] .= 'Please enter your e-mail.';
	}
else if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email))
//email is invalid
 	{
	$error_message[] .= 'Your E-mail address is invalid.';
	}
else if($email_rows->num_rows > 0)
	{
		$error_message[] .= 'This E-mail address all ready exists';
	}


if($retype !== $password)
{
$error_message[] .= 'Your passwords do not match';
}



if(!empty($error_message)){
echo '<ul>';
	foreach($error_message as $value){
	echo '<li>' . $value . '</li>';
	}
echo '</ul>';
}
else{

//hash password with salt
$password = crypt($password, $salt);

echo $password;

$activation = MD5(uniqid(rand(), true));
$sql = "INSERT INTO members(username, password, email, activation) values('$user', '$password', '$email', '$activation')"; 

if($conn->query($sql) === TRUE)
{

$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
	->setUsername($gmail)
	->setPassword($gmailpass);

$link = "localhost/templates/authenticate.php?email=" . urlencode($email) . "&activation=$activation";

$body = '<a href="' . $link . '">Click here to Activate</a>';



$message = Swift_Message::newInstance();
$message->setTo(array($email=>"Nick"));
$message->setSubject("This email is sent using Swift Mailer");
$message->setBody($body, 'text/html');
$message->setFrom(array($gmail=>"Gary"));
// Send the email
$mailer = Swift_Mailer::newInstance($transport);

if($mailer->send($message))
{
echo 'Registration Successful' . '</br>';
echo 'A confirmation email has been sent to your email';
}else
//problem registering with server
{
echo 'Mail not sent';
}


}else
//can't connect to SQL database
{
echo 'Error: ' . $conn->error;
}

}
$conn->close;
}
?>


<table width="20%" border="0" align="center" bgcolor="#CCCCCC">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
<tr>
<td width="20%">
Username:
</td>
<td width="80%">
<input type="text" name="user"></br>
</td>
</tr>
<tr>
<td width="20%">
E-mail: 
</td>
<td width="20%">
<input type="text" name="email"></br>
</td>
</tr>
<tr>
<td width="20%">
Password: 
</td>
<td width="80%">
<input type="password" name="password"></br>
</td>
</tr>
<tr>
<td width="30%">
Retype Password:
<td width="80%">
<input type="password" name="retype"></br>
</td>
</tr>
<tr>
<td>
<input type="submit" value="Send">
</td>
<td>
<input type="reset">
</td>
</tr>
</form>
</table>
<a style="margin-left: 40%; font-size: 1.25em;" href="reset.php">reset password<a>
</body>
</html>
