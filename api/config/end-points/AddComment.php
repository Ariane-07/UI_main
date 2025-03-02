<?php 

include('../class.php');
$db = new global_class();

session_start();
$UserID=$_SESSION['UserID'];
$postId=$_POST['postId'];
$commentText=$_POST['commentText'];

$post = $db->AddComment($UserID, $postId, $commentText);

?>