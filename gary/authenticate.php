<?php
if(isset($_GET['email']) && isset($_GET['activation'])){
$conn = new mysqli('localhost', 'root', '', 'gary');



if(mysqli_connect_errno()){
exit('Connect Failed: ' . mysqli_connect_error());
}

$activation = $_GET['activation'];
$email = $_GET['email'];

$sql = "SELECT * FROM members WHERE email='$email'";

$result = $conn->query($sql);

if($result->num_rows > 0){
$row = $result->fetch_assoc();

if($activation === $row['activation'])
{

$expires = time() + 120;
setcookie("userlogin", $row['username'], $expires);
header("location: garyview.php");
}else{
}

}else{
echo 'Failed to login';
}
}
else{
echo 'The form is not complete';
}

?>
