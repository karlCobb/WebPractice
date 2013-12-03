<!DOCTYPE>
<html>
<head>
<title>
</title>
</head>

<body>
<?php
if(isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['email']) && isset($_POST['activation']))
{
$conn = new mysqli('localhost', 'root', '', 'gary');

if(mysql_errno())
{
exit('Connect failed: ' . mysqli_connect_error());
}


$password = mysql_real_escape_string($_POST['password']);
$password2 = mysql_real_escape_string($_POST['password2']);
$email = mysql_real_escape_string($_POST['email']);
$activation = mysql_real_escape_string($_POST['activation']);

$sql = "SELECT * FROM members WHERE email='$email'";
$update = "UPDATE members SET password='$password' WHERE email='$email'";

$result = $conn->query($sql);



if($result->num_rows === 1){
	$row = $result->fetch_assoc();
if($row['activation'] === $activation){

if($password === $password2){
	if($conn->query($update))
	{
		
		header("location: main_login.php");
	}else{
	echo 'could not update';
}
}else{
echo 'The passwords do not match';
}
}
else{
echo 'Sorry something went wrong on our end. Please try again';
}
}else{
echo 'Sorry try again';
}
}
?>


<table width="20%" align="center" bgcolor="#CCCCCC">
<form action="<?php $_SERVER['SELF_PHP']; ?>" method="POST" enctype="multipart/form-data">
<tr>
<td colspan="2">
Please type in your new password
</td>
</tr>
<tr>
<td width="20%">
Password:
</td>
<td width="80%">
<input type="password" name="password">
</td>
</tr>
<tr>
<td width="20%">
Retype:
</td>
<td width="80%">
<input type="password" name="password2">
</td>
</tr>
<tr>
<td>
<input value="send" type="submit">
</td>
<td>
<input value="<?php $email=$_GET['email']; echo $email; ?>" name="email" type="hidden">
</td>
<td>
<input value="<?php $activation=$_GET['activation']; echo $activation; ?>" name="activation" type="hidden">
</td>
</tr>
</table>
</form>

</body>
</html>

