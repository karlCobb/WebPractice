<?php
//is the post set?
if(isset($_GET['title']) && isset($_GET['content']) && isset($_GET['picture']))
{
$_GET = array_map("strip_tags", $_GET);
$_GET = array_map("trim", $_GET);

//check if there is content
$conn = new mysqli('localhost', 'root', '', 'gary');

if(mysqli_connect_errno())
{
exit('Connect failed: ' . mysqli_connect_error());
}

$adds['title'] = $conn->real_escape_string($_GET['title']);
$adds['content'] = $conn->real_escape_string($_GET['content']);
$adds['picture'] = $conn->real_escape_string($_GET['picture']);

$sql = "INSERT INTO postings(title, content, picture) VALUES('" . $adds['title'] . "', '" . $adds['content'] . "', '" . $adds['picture'] .  "')";

if($conn->query($sql) === TRUE)
{

echo '<p style = "font-size: 20px; text-align: center;">users entry saved successfully</p>';
echo '<a href="/templates/garyview.php">Back to Main Page</a>';
echo '<p style = "font-size: 20px; text-align: center;">' . $_GET['title'] . '</p>';
$image = '<img style = "margin: auto; display:block;" src="/templates/';
$image .= $adds['picture'];
$image .= '"';
$image .= ' alt="image"/>';
echo $image;
echo '<p style = "font-size: 20px; margin-left: 400px;">' .  $_GET['content'] . '</p>';

}
else{
	echo 'Error: ' . $conn->error;
}
$conn->close();
}//errors detected
else{
echo 'No data from form';
}

?>
