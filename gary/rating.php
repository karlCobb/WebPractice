<?php
if(isset($_POST['rating']) && isset($_POST['id'])){
$conn = new mysqli('localhost', 'root', '', 'gary');

if(mysql_errno())
{
exit('Connection failed: ' . mysql_connect_error());
}

$rating = $_POST['rating'];
$id = $_POST['id'];

$get_rating_stats = "SELECT accum_rating, num_ratings FROM postings WHERE id=$id";

$rating_row = $conn->query($get_rating_stats);

if($rating_row->num_rows === 1)
{
$row = $rating_row->fetch_assoc();
$num_ratings = $row['num_ratings'];
$updated_num_ratings = $num_ratings + 1;
$accum_rating = $row['accum_rating']+$rating;
$new_rating = $accum_rating/$updated_num_ratings;
}

$update_rating = "UPDATE postings SET rating=$new_rating, num_ratings=$updated_num_ratings, accum_rating=$accum_rating WHERE id=$id";

if($conn->query($update_rating)){

$get_all_id = "SELECT id FROM postings";
$all_id_result = $conn->query($get_all_id);
$id_array = array();
$row_count = -1;

while($fetched_row = $all_id_result->fetch_row()){
$id_array[] = $fetched_row[0];
$row_count += 1;
}

$rand_id = rand(0, $row_count);


header("location: starcheck.php?id=$id_array[$rand_id]");
}
else{
echo 'Sorry no result';
}
}
else{
echo 'There was no rating';
}

?>
