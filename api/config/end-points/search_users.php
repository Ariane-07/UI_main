<?php 
include('../class.php');

$db = new global_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['query'])) {
    echo $db->search_users($_POST['query']); 
} else {
    echo json_encode([]); // Return an empty array if no query is provided
}
?>
