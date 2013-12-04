<!DOCTYPE>
<head>
<title>
login
</title>
</head>
<body>
<?php
$host='localhost';
$username='root';
$password='';
$db = 'gary';
$table='members';
$conn = new mysqli($host, $username, $password, $db);

if(mysqli_connect_errno())
{
exit('Connect failed: ' . mysqli_connect_error());
}

$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];
$myusername = $conn->real_escape_string($myusername);
$mypassword = $conn->real_escape_string($mypassword);

$sql = "SELECT * FROM $table WHERE username='$myusername'";
$result = $conn->query($sql);

if($result->num_rows > 0){
$num_rows = $result->num_rows;

if($num_rows > 0){
$row = $result->fetch_assoc();
$password = $row['password'];


if(crypt($mypassword, $password) == $password)
{
$expire_date = time() + 120;
setcookie("userlogin", $myusername, $expiry_date);
header("location: garyview.php");
}
else{ 
header("location: garyview.php");

}
}else{
header("location: garyview.php");
}
}else{
header("location: garyview.php");
}
?>
</body>










