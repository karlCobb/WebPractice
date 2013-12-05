<!DOCTYPE>
<html>
<head>
<title>
Reset Password
</title>
</head>
<body>
<?php

require_once '/home/nick/webstuff/www/templates/Swift-5.0.1/lib/swift_required.php';
$gmail = 'garyberry999@gmail.com';
$gmailpass = '';



if(isset($_POST['email'])){

$conn = new mysqli('localhost', 'root', '', 'gary');

if(mysql_errno())
{
exit('Connect failed: ' . mysqli_connect_errno());
}

$error_message[] = array();

$email = mysql_real_escape_string($_POST['email']);

if(empty($email))
{
	$error_message[] .= 'Sorry something went wrong.  Please retype your email address';
}
else if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email))
//email is invalid
        {
        $error_message[] .= 'Your E-mail address is invalid.';
        }

$activation = MD5(uniqid(rand(), true));

$sql = "SELECT * FROM members WHERE email='$email'";
$insert_activation = "UPDATE members SET activation='$activation' WHERE email='$email'";
$result = $conn->query($sql);

if($result->num_rows === 1)
{
	if($conn->query($insert_activation) === TRUE)
	{
$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
	->setUsername($gmail)
	->setPassword($gmailpass);

$link = "localhost/templates/newpassword.php?email=" . urlencode($email) . "&activation=$activation";

$body = '<a href="' . $link . '">Click to reset your password</a>';

$message = Swift_Message::newInstance();
$message->setTo(array($email=>"User"));
$message->setSubject("Reset your password");
$message->setBody($body, 'text/html');
$message->setFrom(array($gmail=>"Gary"));
$mailer = Swift_Mailer::newInstance($transport);

if($mailer->send($message))
{
echo 'email was sent.  Follow link from email to reset password.';
}
}//else faile to insert activation
else{
echo 'Please try again something went wrong with the server';
}
}//else failed to find email
else{
echo 'failed to find email';
}
}else{
echo 'email is not set';
}

?>


<table width="25%" border="0" align="center" bgcolor="#CCCCCC">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
<tr>
<td colspan="3">
Please type your email to create a new password
</td>
</tr>
<tr>
<td width="20%">
Email:
</td>
<td width="80%">
<input type="text" name="email"></br>
</td>
</tr>
<tr>
<td>
<input type="submit" value="Send">
</tr>
</td>
</form>
</table>


</body>
</html>
