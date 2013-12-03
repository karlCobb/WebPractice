<!DOCTYPE html>
<html>
<head>
<style>
p{
display: block;
font-size: 40px;
text-align: center;
color: black;
background-color: purple;
background-image: url('http://i26.photobucket.com/albums/c123/meche05/250px-Gay_flag.png');
border: 5px, solid, black;
}
body{
background-color: purple;
}
</style>
<title>
Sign out
</title>
</head>
<body>
<p>You have successfully signed out<p>
<p>Please come back soon!!!</p>
<?php
$user = $_COOKIE['userlogin'];
$end_session = time() - 120;
setcookie('userlogin', $user, $end_session);
header("location: garyview.php");
?>
</body>
</html>
