<!DOCTYPE>
<html>
<head>
<title>Gary Pics</title>
<link type="text/css" rel="stylesheet" href="css/bootstrap/bootstrap.css"/>
<style>
#date{
font-size: 1em;
margin-left: 72%;
display: inline;
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
background-image: url('http://i26.photobucket.com/albums/c123/meche05/250px-Gay_flag.png');
background-repeat: repeat;
color: black;
max-heigth: 100%;
}

#text{
display: block;
background-color: purple;
text-align: center;
border: 5px solid black;
padding: 2% 0% 2% 0%;"
}

h1{
font-size: 6em;
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
color: black;
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
echo '<a href="garyview.php">Back to Main Page</a>';
echo '<p id="date">Uploaded: ' . $row['post_date'] . '</p>';
echo '<h1 id="text">' . $row['title'] . '</h1>';
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
