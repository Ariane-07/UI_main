<?php 

include('../class.php');
$db = new global_class();

session_start();
$UserID=$_SESSION['UserID'];
$postId=$_POST['postId'];
$action=$_POST['action'];

$post = $db->ToggleLike($UserID, $postId, $action);

?>