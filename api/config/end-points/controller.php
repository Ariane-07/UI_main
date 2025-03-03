<?php
include('../class.php');

$db = new global_class();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['requestType'])) {
        if ($_POST['requestType'] == 'PostContent') {


            $post_user_id = $_POST['UserID'] ?? null;
$postInput = $_POST['postInput'] ?? null;

$postFiles = [
    "images" => [],
    "videos" => []
];

// Debug: Check uploaded files
error_log("Uploaded files: " . print_r($_FILES, true));

function handleUpload($files, $uploadDir, &$fileArray, $type) {
    if (!isset($files['tmp_name']) || !is_array($files['tmp_name'])) {
        error_log("handleUpload() received invalid input: " . print_r($files, true));
        return;
    }

    foreach ($files['tmp_name'] as $key => $tmpName) {
        if ($files['error'][$key] === UPLOAD_ERR_OK) {
            $ext = pathinfo($files['name'][$key], PATHINFO_EXTENSION);
            $uniqueFilename = uniqid($type . '_') . '.' . $ext;
            $destination = __DIR__ . "/$uploadDir/" . $uniqueFilename; // ✅ FIX: Added missing "/"

            error_log("Uploading file: " . $destination);

            // Ensure directory exists
            if (!is_dir(__DIR__ . "/$uploadDir")) {
                mkdir(__DIR__ . "/$uploadDir", 0777, true);
            }

            if (move_uploaded_file($tmpName, $destination)) {
                error_log("File uploaded: " . $uniqueFilename);
                $fileArray[] = $uniqueFilename;  // ✅ Ensure filename is added
            } else {
                error_log("Failed to move file: " . $tmpName . " to " . $destination);
            }
        } else {
            error_log("Upload error for file: " . $files['name'][$key] . " Error code: " . $files['error'][$key]);
        }
    }
}

// Debug: Before handling uploads
error_log("Before uploads, postFiles: " . print_r($postFiles, true));

// Handle images separately
if (!empty($_FILES['imageUpload']['name'][0])) {
    handleUpload($_FILES['imageUpload'], '../../../uploads/images', $postFiles["images"], 'img');
}

// Handle videos separately
if (!empty($_FILES['videoUpload']['name'][0])) {
    handleUpload($_FILES['videoUpload'], '../../../uploads/videos', $postFiles["videos"], 'vid');
}

// Debug: After handling uploads
error_log("After uploads, postFiles: " . print_r($postFiles, true));

// Ensure we don't store empty arrays in the database
$postFilesJson = (!empty($postFiles["images"]) || !empty($postFiles["videos"])) ? json_encode($postFiles) : null;

error_log("postFiles JSON before saving to DB: " . $postFilesJson);

// Call database function
$result = $db->PostContent($post_user_id, $postInput, $postFilesJson);


            
        }else if ($_POST['requestType'] == 'Signup') {

            $email=$_POST['email'];
            $username=$_POST['username'];
            $password=$_POST['password'];
          

            echo $db->SignUp($email,$username,$password);
            
        }else if ($_POST['requestType'] == 'Login') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = $db->LogIn($username, $password);

            if ($user) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Login successful',
                    'data' => $user
                ]);
            } else {
                // Return JSON error response
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid Email or password'
                ]);
            }
        }else if ($_POST['requestType'] == 'LoginAdmin') {

           
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $db->LoginAdmin($email, $password);

            // Check if login was successful
            if ($user) {
                // Convert the result to JSON format to echo as a response
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Login successful',
                    'data' => $user
                ]);
            } else {
                // Return JSON error response
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid Email or password'
                ]);
            }
        } else {
            echo 'requestType NOT FOUND';
        }
    } else {
        echo 'Access Denied! No Request Type.';
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
}
?>