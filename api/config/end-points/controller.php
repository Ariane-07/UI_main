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

            function handleUpload($files, $uploadDir, &$fileArray, $type) {
                if (!isset($files['tmp_name']) || !is_array($files['tmp_name'])) {
                    error_log("handleUpload() received invalid input: " . print_r($files, true));
                    return;
                }
                
                foreach ($files['tmp_name'] as $key => $tmpName) {
                    if ($files['error'][$key] === UPLOAD_ERR_OK) {
                        $ext = pathinfo($files['name'][$key], PATHINFO_EXTENSION);
                        $uniqueFilename = uniqid($type . '_') . '.' . $ext;
                        $destination = __DIR__ . "/$uploadDir/" . $uniqueFilename; 
                        // Ensure directory exists
                        if (!is_dir(__DIR__ . "/$uploadDir")) {
                            mkdir(__DIR__ . "/$uploadDir", 0777, true);
                        }

                        if (move_uploaded_file($tmpName, $destination)) {
                            error_log("File uploaded: " . $uniqueFilename);
                            $fileArray[] = $uniqueFilename;  
                        } else {
                            error_log("Failed to move file: " . $tmpName . " to " . $destination);
                        }
                    } else {
                        error_log("Upload error for file: " . $files['name'][$key] . " Error code: " . $files['error'][$key]);
                    }
                }
            }

            if (!empty($_FILES['imageUpload']['name'][0])) {
                handleUpload($_FILES['imageUpload'], '../../../uploads/images', $postFiles["images"], 'img');
            }

            // Handle videos separately
            if (!empty($_FILES['videoUpload']['name'][0])) {
                handleUpload($_FILES['videoUpload'], '../../../uploads/videos', $postFiles["videos"], 'vid');
            }
            // Ensure we don't store empty arrays in the database
            $postFilesJson = (!empty($postFiles["images"]) || !empty($postFiles["videos"])) ? json_encode($postFiles) : null;
            // Call database function
            $result = $db->PostContent($post_user_id, $postInput, $postFilesJson);


            
        }else if ($_POST['requestType'] == 'petRegistration') {
                function generateUniqueFilename($file) {
                    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                    return uniqid() . '.' . $ext;
                }
                
                $userPhoto = $_FILES['userPhoto'];
                $ownerSignature = $_FILES['ownerSignature'];

                // Generate unique filenames
                $userPhotoName = generateUniqueFilename($userPhoto);
                $ownerSignatureName = generateUniqueFilename($ownerSignature);

                // Set upload directory
                $uploadDir = "../../../uploads/images/";

                // Move uploaded files
                move_uploaded_file($userPhoto['tmp_name'], $uploadDir . $userPhotoName);
                move_uploaded_file($ownerSignature['tmp_name'], $uploadDir . $ownerSignatureName);

                // Collect form data
                $dateApplication = $_POST['dateApplication'];
                $nameApplicant = $_POST['nameApplicant'];
                $age = $_POST['age'];
                $gender = $_POST['gender'];
                $birthday = $_POST['birthday'];
                $telephone = $_POST['telephone'];
                $emailApplicant = $_POST['emailApplicant'];
                $homeAddress = $_POST['homeAddress'];
                $petName = $_POST['petName'];
                $petAge = $_POST['petAge'];
                $petGender = $_POST['petGender'];
                $species = $_POST['species'];
                $breed = $_POST['breed'];
                $petWeight = $_POST['petWeight'];
                $petColor = $_POST['petColor'];
                $distinguishingMarks = $_POST['distinguishingMarks'];
                $petBirthday = $_POST['petBirthday'];
                $vaccinationDate = $_POST['vaccinationDate'];
                $vaccinationExpiry = $_POST['vaccinationExpiry'];
                $vetClinic = $_POST['vetClinic'];
                $vetName = $_POST['vetName'];
                $vetAddress = $_POST['vetAddress'];
                $vetContact = $_POST['vetContact'];
                $dateSigned = $_POST['dateSigned'];

                $result= $db->petRegistration(
                    $dateApplication, $nameApplicant, $age, $gender, $birthday, $telephone, 
                    $emailApplicant, $homeAddress, $petName, $petAge, $petGender, $species, 
                    $breed, $petWeight, $petColor, $distinguishingMarks, $petBirthday, 
                    $vaccinationDate, $vaccinationExpiry, $vetClinic, $vetName, $vetAddress, 
                    $vetContact, $dateSigned, $userPhotoName, $ownerSignatureName
                );

                if ($result) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Pet registration successful!',
                        'data' => $result
                    ]);
                }
            
        }else if ($_POST['requestType'] == 'Signup') {

            $email=$_POST['email'];
            $username=$_POST['username'];
            $password=$_POST['password'];
            $role=$_POST['role'];
          

            echo $db->SignUp($email,$username,$password,$role);
            
        }else if ($_POST['requestType'] == 'UpdateProfile') {


            session_start();
            $uploadDir = "../../../uploads/images/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            // Get the current profile picture filename from the session
            $currentProfilePic = $_SESSION['ProfilePic'] ?? null;
            
            // Handle profile picture upload
            $profilePic = $_FILES['profile-pic-input'] ?? null;
            $profilePicName = $currentProfilePic; // Default to the existing profile picture
            $newProfileUploaded = false; // Track if a new profile pic is uploaded
            
            if ($profilePic && $profilePic['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($profilePic['name'], PATHINFO_EXTENSION);
                $newProfilePicName = uniqid("Profile_") . "." . $ext;
                $profilePicPath = $uploadDir . $newProfilePicName;
            
                if (move_uploaded_file($profilePic['tmp_name'], $profilePicPath)) {
                    $profilePicName = $newProfilePicName; // Set new profile picture if upload succeeds
                    $newProfileUploaded = true; // Mark as uploaded
                }
            }
            
            // Get user input
            $email = $_POST['email'] ?? '';
            $owner_name = $_POST['owner_name'] ?? '';
            $username = $_POST['username'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $birthdate = $_POST['birthdate'] ?? '';
            $contact = $_POST['contact'] ?? '';
            $address = $_POST['address'] ?? '';
            $link_address = $_POST['Link_address'] ?? '';
            $UserID = $_SESSION['UserID'];
            
            // Call UpdateProfile function with the updated parameters
            $updateSuccess = $db->UpdateProfile($profilePicName, $email, $owner_name, $username, $gender, $birthdate, $contact, $address, $link_address, $UserID);
            
            if ($updateSuccess) {
                // Only unlink the old profile pic if a new one was uploaded
                if ($newProfileUploaded && $currentProfilePic && file_exists($uploadDir . $currentProfilePic)) {
                    unlink($uploadDir . $currentProfilePic);
                }
            
                // Update session with the new profile picture
                $_SESSION['ProfilePic'] = $profilePicName;
            
                echo json_encode([
                    "status" => "success",
                    "message" => "Profile updated successfully!",
                    "profilePic" => $profilePicName
                ]);
            } else {
                // If update fails and a new profile pic was uploaded, delete it to prevent unused files
                if ($newProfileUploaded && file_exists($profilePicPath)) {
                    unlink($profilePicPath);
                }
            
                echo json_encode([
                    "status" => "error",
                    "message" => "Failed to update profile."
                ]);
            }
            

            
            
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