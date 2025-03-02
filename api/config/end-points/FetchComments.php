<?php 

include('../class.php');
$db = new global_class();




session_start();
$UserID=$_SESSION['UserID'];
$postId=$_GET['postId'];

$post = $db->FetchComments($UserID, $postId);

?>