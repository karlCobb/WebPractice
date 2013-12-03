<!DOCTYPE>
<html>
<head>
<style>
.rating {
unicode-bidi: bidi-override;
margin-left: 31%;
margin-right: 31%;
padding-right: 3%;
margin-top: 5%;
}

/* :not(:checked) is a filter, so that browsers that don’t support :checked don’t 
   follow these rules. Every browser that supports :checked also supports :not(), so
   it doesn’t make the test unnecessarily selective */
.rating:not(:checked) > input {
    position:absolute;
    top:-9999px;
    clip:rect(0,0,0,0);
}

.rating:not(:checked) > label {
    float: right; 
    width:1em;
    padding: 0.1em;
    padding-right: .5em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size: 300%;
    line-height:1.2;
    color:#ddd;
    text-shadow:1px 1px #bbb, 2px 2px #666, .1em .1em .2em rgba(0,0,0,.5);
}

.rating:not(:checked) > label:before {
    content: url('img/cupcakeTrans.png');
}

.rating > input:checked ~ label {
	content: url('img/checkedCupcakeTrans.png');
}

.rating:not(:checked) > label:hover,
.rating:not(:checked) > label:hover ~ label {
    color: gold;
//    text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
}

.rating > input:checked + label:hover,
.rating > input:checked + label:hover ~ label,
.rating > input:checked ~ label:hover,
.rating > input:checked ~ label:hover ~ label,
.rating > label:hover ~ input:checked ~ label {
    color: #ea0;
  //  text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
}

.rating > label:active {
   position:relative; 
//    top:2px;
//    left:2px;
}
a:hover{
color: red;
}
a{
color: black;
}

h1{
text-align: center;
display: inline;
margin-left: 30%;
}
@media screen
and (min-width: 300px)
and (max-width: 700px){
.rating{
font-size: .6em;
margin-left: 10%;
margin-right: 10%;
}
.rating:not(:checked) > label:before {
    content: url('img/cupcakeTransMobile.png');
}
h1{
margin-left: 0%;

display: block;
}
}

</style>
</head>
<body style="background-color: purple";>

<?php
if(isset($_GET['id'])){
$conn = new mysqli('localhost', 'root', '', 'gary');



if(mysql_errno())
{
exit('Connect Failed: ' . mysqli_connect_error());
}
$id = $_GET['id'];

$expire_time = time() + 120;
setcookie("get_id", $id, $expire_time);

$sql = "SELECT * FROM postings where id=$id";

$result = $conn->query($sql);


if($result->num_rows > 0){
$num_rows = $result->num_rows;

if($num_rows > 0)
{
$rows = $result->fetch_assoc();
$pic = $rows['picture'];
$title = $rows['title'];
$rating = $rows['accum_rating']/$rows['num_ratings'];
echo '<a href="garyview.php">Back to main page</a>';
echo '<h1>' . $title . '</h1>';
echo '<img style="display: block; margin: auto; margin-top: 2%;" src="' . $pic . '">';
}
else{
echo 'There are no rows';
}
}else{
echo 'no rows';
}
}else{
echo 'No search value';
}
?>


<form action="rating.php" method="POST">
<fieldset class="rating" style="text-align: center;">
    <legend>Please rate:</legend>
    <input type="radio" id="star5" name="rating" value="5" />
<label for="star5" title="Meh"></label>
    <input type="radio" id="star4" name="rating" value="4" />
<label for="star4" title="Meh"></label>
    <input type="radio" id="star3" name="rating" value="3" />
<label for="star3" title="Meh"></label>
    <input type="radio" id="star2" name="rating" value="2" />
<label for="star2" title="Meh"></label>
    <input type="radio" id="star1" name="rating" value="1" />
<label for="star1" title="Meh"></label>
</fieldset>
<input type="hidden" name="id" value="<?php if(isset($_GET['id'])){echo $_GET['id'];} ?>">
<input style="margin: auto; display: block; margin-top: 2%;" type="Submit" value="submit">
</form>
</body>
</html>

