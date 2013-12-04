<!DOCTYPE>
<html>
<head>
<title>Gary Pics</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script src="js/bootstrap/bootstrap.js" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" href="css/bootstrap/bootstrap.css"/>
<link type="text/css" rel="stylesheet" href="css/main_page.css"/>
<style>

#date{
font-size: 1em;
float: right;
border: none;
}
#cupcake{
content: url(img/cupcakeTrans.png);
display: inline;
margin-right: 3%;
}
#cupcakeChecked{
content: url(img/checkedCupcakeTrans.png);
display: inline;
margin-right: 3%;
}
#empty-star{
-webkit-text-fill-color: grey;
}


#rating{
height: 5%;
display: block;
margin-top: 2%;
margin-left: 35%;
padding-bottom: 0%;
}

img{
display: block;
margin: auto;
max-height: 100%;
}


body{
width: 100%;
margin-top: 1.5%;
}

#text{
background-color: purple;
text-align: center;
border: 5px solid black;
padding: 2% 0% 2% 0%;"
}


h1{
font-size: 6em;
margin-bottom: 5%;
text-align: center;
}

p{
margin-top: 2%;
line-height: 1em;
font-size: 3em;
}

a:hover{
color: black;
text-decoration: underline;
}

a{
font-size: 1em;
//color: black;
hover: none;
}



@media screen and
(min-width: 300px)
and (max-width: 700px)
{
#date{
position: relative;
width: 100%;
margin-left: 0%;
text-align: left;
display: block;
}
#cupcake{
content: url(img/cupcakeTransMobile.png);
display: inline;
margin-right: 3%;
}
#cupcakeChecked{
content: url(img/checkedCupcakeTransMobile.png);
display: inline;
margin-right: 3%;
}
.rating{
font-size: 4em;
margin-left: 25%;
padding-top: 5%;
}
p{
font-size: 1em;
}
h1{
line-height: 1em;
font-size: 1em;
}
#text{
font-size: 2em;
}
}


</style>


</head>
<body>


<nav class="navbar-fixed-top">
<ul class="nav nav-pills" id="purple">
  <li class="span2"><a href="garyview.php">Main Page</a></li>
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
echo '<li class="span2"></li>';
echo  '<li class="span2"><a href="signout.php">Sign Out</a></li>';
echo '<li><a href="#">' . $user . '\'s Info</a></li>';
}else{
echo '<li class="span1"></li>';
echo  '<li class="span2"><a href="signup.php">Sign Up</a></li>';
echo  '<li class="dropdown span2">';
echo '<a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>';
echo '<div class="dropdown-menu">';
echo '<form name="form1" method="post" action="checklogin.php">';
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
if(isset($_GET['id'])){
$conn = new mysqli('localhost', 'root', '', 'gary');

if(mysqli_connect_errno())
{
exit('Connect failed: ' . mysqli_connect_error());
}
$sql = "SELECT * FROM postings WHERE id='" . $_GET['id'] . "'";
$result = $conn->query($sql);

if($result->num_rows > 0)
{
$row = $result->fetch_assoc();
echo '<div id="left-column"></div>';
echo '<div id="content">';
echo '<p id="date">Uploaded: ' . $row['post_date'] . '</p>';
echo '<div id="clear"></div>';
echo '<h1>' . $row['title'] . '</h1>';
$image = '<img src="/templates/';
$image .= $row['picture'];
$image .= '"';
$image .= ' alt="image"/>';
echo $image;
$rating = round($row['accum_rating']/$row['num_ratings']);
console.log($rating);
echo '<div id="rating">';

for($i = 0; $i < $rating; $i++)
{
echo '<div id="cupcakeChecked">&nbsp</div>';
}
for($j = 5; $j > $rating; $j--)
{
echo '<div id="cupcake">&nbsp</div>';
}

echo '</div>';
echo '<p id="text">' .  $row['content'] . '</p>';
echo '</div>';
echo '<div id="right-column"></div>';

}else{
	echo 'ERROR: ' . $conn->error;
}
}
else{
echo 'No data from form';
}
?>
</body>
</html>
