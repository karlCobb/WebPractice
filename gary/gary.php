<!DOCTYPE>
<head>
<style>

body{
background-color: orange;

}

#large_form{
height: 200px;
width: 300px;
}
#title_form{
margin-left: 21px;
width: 370px;
}
</style>

<title>Gary's blog</title>
</head>
<body>

<?php

$uploadpath = 'upload/';
$max_size = 2000;
$alwidth = 900;
$alheight = 800;
$allowtype = array('bmp', 'gif', 'jpg', 'jpeg', 'png');

if(isset($_FILES['fileup']) && strlen($_FILES['fileup']['name']) > 1) {
  $uploadpath = $uploadpath . basename($_FILES['fileup']['name']);
  $sepext = explode('.', strtolower($_FILES['fileup']['name']));
  $type = end($sepext);
  list($width, $height) = getimagesize($_FILES['fileup']['tmp_name']);
  $err = '';
	if(!in_array($type, $allowtype))
		$err .= 'The file: <b>' . $_FILES['fileup']['name'] . ' </b> does not have the allowed extension type.';
	if($_FILES['fileup']['size'] > $max_size*1000)
		$err .= '<br/>Maximum file size must be: ' . $max_size . ' KB.';
	if(isset($width) && isset($height) && ($width >= $alwidth || $height >= $alheight))
		$err .= '<br/>The maximum Width x Height must be: ' . $alwidth. ' x ' . $alheight;

  if($err == ''){
	if(move_uploaded_file($_FILES['fileup']['tmp_name'], $uploadpath)) {
		echo 'File uploaded successfully';
	}//end if moved
else echo '<b>file has not been uploaded.</b>';
}
else echo $err;
}


if( $_POST )
{
$title = $_POST['title'];
$content = $_POST['content'];
$picture =  $_POST['fileup'];
if(strlen($title) < 1 || strlen($content) < 1)
{
echo '<script type="text/javascript">';
echo 'alert("You must have both fields filled out.")';
echo '</script>';
}else{
$url = "garyphp/insert.php?title=$title&content=$content&picture=$uploadpath";
header("Location: $url");
}}
?>



<form id="postform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
Title:<input id="title_form" type="text" name="title" />
<p style="float: bottom;">Write a desciption</p>
<p>Explain where you were when you took the photo</p>
<p>What went through your head</p>
<textarea rows="10" cols="50" name="content" form="postform">
</textarea></br>
Upload Picture: <input  type="file" name="fileup" /><br/>
<input type="submit" name="submit" value="Upload" />
</form>


</body>
