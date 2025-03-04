<?php 

include('../class.php');
$db = new global_class();

session_start();
$sender_id = $_SESSION['UserID'];
$receiver_id = $_POST['receiver_id'];

if (!$receiver_id) {
    echo json_encode(['status' => 'error', 'message' => 'Receiver ID is missing']);
    exit;
}

$messages = $db->fetchUserChats($sender_id, $receiver_id);

if (!empty($messages)) {
    echo json_encode(['status' => 'success', 'messages' => $messages]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No messages found.']);
}
?>
