<!DOCTYPE>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script src="js/bootstrap/bootstrap.js" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" href="css/bootstrap/bootstrap.css"/>
<link type="text/css" rel="stylesheet" href="css/main_page.css"/>
<title>Gary View</title>


</head>
<?php
$conn = new mysqli('localhost', 'root', '', 'gary');

if(mysql_errno())
{
exit(mysql_connect_error());
}

$get_all_id = "SELECT id FROM postings";
$all_id_result = $conn->query($get_all_id);
$id_array = array();

$row_count = -1;

while($fetched_row = $all_id_result->fetch_row()){
$id_array[] = $fetched_row[0];
$row_count += 1;
}

$rand_id = rand(0, $row_count);

$expire = time() + 6000;
setcookie("initial_id", $id_array[$rand_id], $expire);
?>


<body>
<nav class="navbar-fixed-top">
<ul class="nav nav-pills" id="purple">
  <li class="span2"><a href="about.php">About</a></li>
  <li class="span2"><a href="gary.php">Post a Gary</a></li>
<?php
echo '<li class="span2"><a href="starcheck.php?id=' . $_COOKIE['initial_id']  . '" >Rate a Gary</a></li>';
?>
  <li class="span2"><a href="http://www.howaboutwe.com/dating/gaymen?utm_medium=SEM&utm_source=Gsearch_Dating&utm_campaign=NYC-T01-Beta-Search&utm_content=g&utm_term=%2Bgay%20%2Bdating&utm_position=1t2&utm_matchtype=b&utm_adgroup=gay_dating_%3Cgay%3E&utm_device=c&jadid=42675297928&jap=1t2&jk=%2Bgay%20%2Bdating&jkId=gc:a8a8ae4cd397371df0139a46951321cf0:t1_b_:k_%2Bgay%20%2Bdating:pl_&jp=&js=1&jsid=31539&jt=1&gclid=CJDK6pSb2LkCFU-Z4AodXXYA7w">Meet a Gary</a></li>
<?php

if($_COOKIE['userlogin'])
{
$user = $_COOKIE['userlogin'];
echo  '<li class="span2"><a href="signout.php">Sign Out</a></li>';
echo '<li><a href="#">' . $user . '\'s Info</a></li>';
}else{

echo '<li class="span3"></li>';
echo  '<li class="span2"><a href="signup.php">Sign Up</a></li>';
echo  '<li class="dropdown span2">';
echo '<a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>';
echo '<div class="dropdown-menu">';
echo '<form name="form1" class="bootstrap-form" method="post" action="checklogin.php">';
echo 'Username <input class="input-group" name="myusername" type="text" id="user_username">';
echo 'Password <input name="mypassword" type="password" id="user_password">';
echo '<input class="btn btn-primary" id="btn-center" type="submit" name="Submit" value="Login">';
echo '</form>';

}
?>
</div>
</li>
</ul>
</nav>

<?php
$conn = new mysqli('localhost', 'root', '', 'gary');
if(mysqli_connect_errno()){
exit('Connect failed: ' . mysqli_connect_error());
}
$sql = "SELECT * FROM postings";
$result = $conn->query($sql);
if($result->num_rows > 0){

	while($row = $result->fetch_assoc()){
if($_COOKIE['userlogin'])
{
//echo '<p style="display: inline;">Welcome ' . $_COOKIE['userlogin'] . '</p>';
}
echo '<div id="left-column"></div>';
echo '<div id="content" class="row-fluid">';
echo '<a href="';
echo 'garypics.php?id=' . $row['id'] . '">';
echo ' <h1 class="text-center">' . $row['title'] . '</h1></a>';
echo '<img id="img"  class="img-responsive" src="';
echo $row['picture'];
echo '"';
echo ' alt="image"/>';
echo '<p class="text-center">' . $row['content'] . '</p>'; 
echo '</div>';
echo '<div id="right-column"></div>';
echo '<div id="clear"></div>';


}

}

?>


</body>
</html>
