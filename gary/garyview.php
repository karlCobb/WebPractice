<!DOCTYPE>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
<div class="row-fluid">
<nav class="navbar-fixed-top">
<ul class="nav nav-tabs" id="purple">
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
echo '<li class="span2"><a href="#">' . $user . '\'s Info</a></li>';
}else{
echo  '<li class="span2"><a href="signup.php">Sign Up</a></li>';
echo  '<li class="span2"><a href="main_login.php">Sign In</a></li>';
}
?>
</ul>
</nav>
</div>

<?php
$conn = new mysqli('localhost', 'root', '', 'gary');
if(mysqli_connect_errno()){
exit('Connect failed: ' . mysqli_connect_error());
}
$sql = "SELECT * FROM postings";
$result = $conn->query($sql);
if($result->num_rows > 0){
echo '<div id="first-post" class="row-fluid">';
	while($row = $result->fetch_assoc()){
if($_COOKIE['userlogin'])
{
//echo '<p style="display: inline;">Welcome ' . $_COOKIE['userlogin'] . '</p>';
}
echo '<a href="';
echo 'garypics.php?id=' . $row['id'] . '">';
echo ' <h1>' . $row['title'] . '</h1></a>';
echo '<img id="img" class="img-responsive" src="';
echo $row['picture'];
echo '"';
echo ' alt="image"/>';
echo '<p>' . $row['content'] . '</p>'; 
echo '</div>';
echo '<div id="posts" class="row-fluid">';
}

}

?>


</body>
</html>
