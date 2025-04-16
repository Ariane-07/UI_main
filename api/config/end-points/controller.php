<?php

require '../../../vendor/autoload.php';
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Color\Color;


include('../class.php');

$db = new global_class();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['requestType'])) {
        if($_POST['requestType'] == 'UpdatePetStatus'){

            
            $pet_id=$_POST['modal-pet_id'];
            $status=$_POST['status'];

            echo $db->UpdatePetStatus($pet_id,$status);
           
            
        }else if($_POST['requestType'] =='DeletePet'){

            $pet_id = $_POST['pet_id'];
          
    
            $result = $db->DeletePet($pet_id);
    
            if ($result == "success") {
                echo json_encode(["status" => 200, "message" => "Delete Successfully"]);
            } else {
                echo json_encode(["status" => 400, "message" => $result]);
            }
            
        } else if ($_POST['requestType'] == 'PostContent') {
            $post_user_id = $_POST['UserID'] ?? null;
            $postInput = trim($_POST['postInput'] ?? '');
        
            // Check if there's either text content or files
            $hasImages = !empty($_FILES['imageUpload']['name'][0]);
            $hasVideos = !empty($_FILES['videoUpload']['name'][0]);
            
            if (empty($postInput) && !$hasImages && !$hasVideos) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Please enter some text or attach media to post'
                ]);
                exit;
            }
        
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
            $bio = $_POST['bio'] ?? '';
            $owner_name = $_POST['owner_name'] ?? '';
            $username = $_POST['username'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $birthdate = $_POST['birthdate'] ?? '';
            $contact = $_POST['contact'] ?? '';
            $address = $_POST['address'] ?? '';
            $link_address = $_POST['Link_address'] ?? '';
            $UserID = $_SESSION['UserID'];
            
            // Call UpdateProfile function with the updated parameters
            $updateSuccess = $db->UpdateProfile($profilePicName, $email, $owner_name, $username, $gender, $birthdate, $contact, $address, $link_address, $UserID,$bio);
            
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
            

            
            
        }else if ($_POST['requestType'] == 'petRegistration') {

            $qrCodeDir = "../../../qrcodes/";
            $uploadDir = "../../../uploads/images/";

            function generateUniqueFilename($file) {
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                return uniqid() . '.' . $ext;
            }

            function handleFileUpload($file, $uploadDir) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                $maxFileSize = 10 * 1024 * 1024; // 10MB
            
                if ($file['error'] !== UPLOAD_ERR_OK) {
                    return null;
                }
            
                // Ensure the temp file exists before checking MIME type
                if (!file_exists($file['tmp_name'])) {
                    return null;
                }
            
                if (!in_array(mime_content_type($file['tmp_name']), $allowedTypes)) {
                    return null;
                }
            
                if ($file['size'] > $maxFileSize) {
                    return null;
                }
            
                $fileName = generateUniqueFilename($file);
                $destination = $uploadDir . $fileName;
            
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    return $fileName;
                }
                return null;
            }
            
            if (!is_dir($qrCodeDir)) {
                mkdir($qrCodeDir, 0777, true);
            }
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
          
           
            // Handle file uploads
            $userPhoto = $_FILES['userPhoto'] ?? null;
            $ValidID = $_FILES['ValidID'] ?? null;
            $ownerSignature = $_FILES['ownerSignature'] ?? null;
            $antiRabPic = $_FILES['antiRabPic'] ?? null;

            $userPhotoName = $userPhoto ? handleFileUpload($userPhoto, $uploadDir) : null;
            $ValidIDName = $ValidID ? handleFileUpload($ValidID, $uploadDir) : null;
            $ownerSignatureName = $ownerSignature ? handleFileUpload($ownerSignature, $uploadDir) : null;
            $antiRabPicName = $antiRabPic ? handleFileUpload($antiRabPic, $uploadDir) : null;

            // Collect form data
            $dateApplication = $_POST['dateApplication'] ?? '';
            $nameApplicant = $_POST['nameApplicant'] ?? '';
            $age = $_POST['age'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $birthday = $_POST['birthday'] ?? '';
            $telephone = $_POST['telephone'] ?? '';
            $emailApplicant = $_POST['emailApplicant'] ?? '';
            $homeAddress = $_POST['homeAddress'] ?? '';
            $barangay = $_POST['barangay'] ?? '';
            $petName = $_POST['petName'] ?? '';
            $petAge = $_POST['petAge'] ?? '';
            $petGender = $_POST['petGender'] ?? '';
            $species = $_POST['species'] ?? '';
            $breed = $_POST['breed'] ?? '';
            $petWeight = $_POST['petWeight'] ?? '';
            $petColor = $_POST['petColor'] ?? '';
            $distinguishingMarks = $_POST['distinguishingMarks'] ?? '';
            $petBirthday = $_POST['petBirthday'] ?? '';
            $vaccinationDate = $_POST['vaccinationDate'] ?? '';
            $vaccinationExpiry = $_POST['vaccinationExpiry'] ?? '';
            $vetClinic = $_POST['vetClinic'] ?? '';
            $vetName = $_POST['vetName'] ?? '';
            $vetAddress = $_POST['vetAddress'] ?? '';
            $vetContact = $_POST['vetContact'] ?? '';
            $dateSigned = $_POST['dateSigned'] ?? '';

            session_start();
            $UserID=$_SESSION['UserID'];

                    // ✅ Step 1: Insert pet data and get the returned array
            $petData = $db->petRegistration(
                $dateApplication, $nameApplicant, $age, $gender, $birthday, $telephone,
                $emailApplicant, $homeAddress,$barangay, $petName, $petAge, $petGender, $species,
                $breed, $petWeight, $petColor, $distinguishingMarks, $petBirthday,
                $vaccinationDate, $vaccinationExpiry, $vetClinic, $vetName, $vetAddress,
                $vetContact, $dateSigned, $userPhotoName,$ValidIDName, $ownerSignatureName,"",$antiRabPicName,$UserID
            );

            // ✅ Extract the pet ID from the returned array
            if (isset($petData['PET ID']) && is_numeric($petData['PET ID'])) {
                $petID = $petData['PET ID'];
            } else {
                
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to register pet. Please try again.'
                ]);
                exit;
            }

            // ✅ Step 2: Generate QR Code 
            
            $qrData = '';
            foreach ($petData as $key => $value) {
                $qrData .= "{$key}: {$value}\n";
            }
            
            $qrCode = new QrCode(
                data: $qrData,
                encoding: new Encoding('UTF-8'),
                errorCorrectionLevel: ErrorCorrectionLevel::High,
                size: 300,
                margin: 10,
                roundBlockSizeMode: RoundBlockSizeMode::Margin,
                foregroundColor: new Color(0, 0, 0),
                backgroundColor: new Color(255, 255, 255)
            );
            

            $writer = new PngWriter();
            $qrCodeResult = $writer->write($qrCode);

            // ✅ Step 3: Define QR Code file path using pet_id
            $qrCodeFileName = "PET_" . $petID . ".png";
            $qrCodeFilePath = $qrCodeDir . $qrCodeFileName;

            // ✅ Step 4: Save QR Code to file
            file_put_contents($qrCodeFilePath, $qrCodeResult->getString());

            // ✅ Step 5: Update pet's QR code in the database
            $db->updatePetQRCode($petID, $qrCodeFileName);

            // ✅ Step 6: Return response with all pet data and QR code
            $petData['qr_code'] = $qrCodeFileName; // Add QR code filename to response

            echo json_encode([
                'status' => 'success',
                'message' => 'Pet registration successful!',
                'pet_data' => $petData, // Return all pet data including pet_id & qr_code
            ]);


            
            
        }else if ($_POST['requestType'] == 'AddImpoundPets') {

       
            $uploadDir = "../../../uploads/images/";

            function generateUniqueFilename($file) {
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                return uniqid() . '.' . $ext;
            }

            function handleFileUpload($file, $uploadDir) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                $maxFileSize = 10 * 1024 * 1024; // 10MB
            
                if ($file['error'] !== UPLOAD_ERR_OK) {
                    return null;
                }
            
                // Ensure the temp file exists before checking MIME type
                if (!file_exists($file['tmp_name'])) {
                    return null;
                }
            
                if (!in_array(mime_content_type($file['tmp_name']), $allowedTypes)) {
                    return null;
                }
            
                if ($file['size'] > $maxFileSize) {
                    return null;
                }
            
                $fileName = generateUniqueFilename($file);
                $destination = $uploadDir . $fileName;
            
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    return $fileName;
                }
                return null;
            }
            
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
          
            $petPhoto = $_FILES['add-image-upload'] ?? null;

            $petPhotoName = $petPhoto ? handleFileUpload($petPhoto, $uploadDir) : null;

            // Collect form data
            $addDateCaught = $_POST['addDateCaught'] ?? '';
            $addLocationFound = $_POST['addLocationFound'] ?? '';
            $addImpoundLocation = $_POST['addImpoundLocation'] ?? '';
            $addDaysRemaining = $_POST['addDaysRemaining'] ?? '';
          

            $response = $db->AddImpoundPets( $addDateCaught,$addLocationFound,$addImpoundLocation,$addDaysRemaining,$petPhotoName);

            echo json_encode([
                'status' => 'success',
                'message' => 'Impound Pet Successfully',
                'pet_data' => $response, 
            ]);


            
            
        }else if ($_POST['requestType'] == 'updateImpound') {

       
            $uploadDir = "../../../uploads/images/";

function generateUniqueFilename($file) {
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    return uniqid() . '.' . $ext;
}

function handleFileUpload($file, $uploadDir) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    $maxFileSize = 10 * 1024 * 1024; // 10MB

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    // Ensure the temp file exists before checking MIME type
    if (!file_exists($file['tmp_name'])) {
        return null;
    }

    if (!in_array(mime_content_type($file['tmp_name']), $allowedTypes)) {
        return null;
    }

    if ($file['size'] > $maxFileSize) {
        return null;
    }

    $fileName = generateUniqueFilename($file);
    $destination = $uploadDir . $fileName;

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return $fileName;
    }
    return null;
}

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$petPhoto = $_FILES['image'] ?? null;

// Collect form data
$imp_id = $_POST['id'];
$updateNotes = $_POST['notes'];
$addDateCaught = $_POST['dateCaught'];
$addLocationFound = $_POST['locationFound'];
$updateImpoundLocation = $_POST['impoundLocation'];
$updateDaysRemaining = $_POST['daysRemaining'];
$updatePetStatus = $_POST['petStatus'];

// Initialize $petPhotoName to null
$petPhotoName = null;

// If there is a photo to upload, handle the upload first
if ($petPhoto) {
    $petPhotoName = handleFileUpload($petPhoto, $uploadDir);
}

// Now, perform the database update
$response = $db->UpdateImpoundPets($imp_id, $updateNotes, $addDateCaught, $addLocationFound, $updateImpoundLocation, $updateDaysRemaining, $updatePetStatus, $petPhotoName);

// Check if the database update was successful
if ($response == "success") {
    // If successful, send the response with a success message
    echo json_encode([
        'status' => 'success',
        'message' => 'Impound Pet Updated Successfully',
        'pet_data' => $response,
    ]);
} else {
    // If the database update failed, delete the file if it was uploaded
    if ($petPhotoName) {
        $filePath = $uploadDir . $petPhotoName;
        if (file_exists($filePath)) {
            unlink($filePath); // Delete the file
        }
    }

    // Send error response
    echo json_encode([
        'status' => 'error',
        'message' => 'Error updating impound pet details.',
    ]);
}



            
            
        }else if ($_POST['requestType'] == 'SentMessagge') {

            session_start();
            $imageUpload = isset($_FILES['file-upload']) ? $_FILES['file-upload'] : null;
            $message = $_POST['message-input'];
            $reciever_id = $_POST['reciever_id'];
            $sender_id = $_SESSION['UserID'];
            
            // Set unique file name only if an image is uploaded
            if ($imageUpload && $imageUpload['error'] === UPLOAD_ERR_OK) {
                $uniqueFileName = uniqid() . "_" . basename($imageUpload['name']);
            } else {
                $uniqueFileName = null; // Set to null if no file is uploaded
            }
            
            // Call the SentMessagge method
            $response = json_decode($db->SentMessagge($sender_id, $reciever_id, $message, $uniqueFileName), true);
            
            // Check if the message was successfully inserted before uploading the image
            if ($response && isset($response['status']) && $response['status'] === 'success') {
                if ($uniqueFileName) {
                    $uploadDir = "../../../uploads/images/"; // Directory to save images
                    $uploadPath = $uploadDir . $uniqueFileName;
            
                    if (move_uploaded_file($imageUpload['tmp_name'], $uploadPath)) {
                        // Only return the status, not the message content
                        echo json_encode(array('status' => 'success', 'message' => 'Message sent and image uploaded.'));
                    } else {
                        // Only return the status, not the message content
                        echo json_encode(array('status' => 'error', 'message' => 'Message sent but image upload failed.'));
                    }
                } else {
                    // Only return the status, not the message content
                    echo json_encode(array('status' => 'success', 'message' => 'Message sent without an image.'));
                }
            } else {
                // Only return the status, not the message content
                echo json_encode(array('status' => 'error', 'message' => 'Message sending failed.'));
            }
        }
            
            
            
        }else if ($_POST['requestType'] == 'ClaimPet') {
            session_start();
            
            $imp_id=$_POST['imp_id'];
            $UserID=$_SESSION['UserID'];
          

            echo $db->ClaimPet($imp_id,$UserID);
            
        }else if ($_POST['requestType'] == 'updatePetInfo') {

            $vaccine_due=$_POST['update_client-vaccine-due'];
            $vaccine_given=$_POST['update_client-vaccine-given'];
            $pet_id=$_POST['pet_id'];
            
            $client_name=$_POST['client_name'];
            $client_contact=$_POST['client_contact'];
            $client_email=$_POST['client_email'];
            $client_address=$_POST['client_address'];
            $client_barangay=$_POST['client_barangay'];
            $pet_petname=$_POST['pet_petname'];
            $pet_birthdate=$_POST['pet_birthdate'];
            $pet_breed=$_POST['pet_breed'];
            $pet_gender = $_POST['pet_gender'];
            $pet_species = $_POST['pet_species'];
            $pet_color= $_POST['pet_color'];
            $pet_marks= $_POST['pet_marks'];
          

            echo $db->updatePetInfo($pet_id,$vaccine_given,$vaccine_due,$client_name,$client_contact,$client_email,$client_address, $client_barangay, $pet_petname,$pet_birthdate,$pet_breed,$pet_gender, $pet_species,$pet_color,$pet_marks);
            
        }else if ($_POST['requestType'] == 'VerifiedVet') {
            session_start();
            
            $vet_id=$_POST['vet_id'];
            $status=$_POST['status'];
          

            echo $db->VerifiedVet($vet_id,$status);
            
        }else if ($_POST['requestType'] == 'Signup') {


           
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $vet_license_filename = null; // Default to NULL for non-vet users
            
            // Handle Vet ID Upload
            if ($role === 'vet' && isset($_FILES['vet_license_id']) && $_FILES['vet_license_id']['error'] == 0) {
                $fileTmpPath = $_FILES['vet_license_id']['tmp_name'];
                $fileName = $_FILES['vet_license_id']['name'];
            
                // Ensure filename is not empty
                if (!empty($fileName)) {
                    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
                    
                    // Generate unique filename
                    $uniqueFileName = "vet_id_" . uniqid() . "." . $fileExt;
                    $uploadDir = "../../../uploads/images/";
                    $destination = $uploadDir . $uniqueFileName;
            
                    // Move uploaded file
                    if (move_uploaded_file($fileTmpPath, $destination)) {
                        $vet_license_filename = $uniqueFileName; // Store only the filename (without the path)
                    } else {
                        echo json_encode(["status" => "error", "message" => "Failed to upload Vet ID."]);
                        exit;
                    }
                }
            }
            
            // Ensure `$vet_license_filename` is `NULL` if no file was uploaded
            $vet_license_filename = $vet_license_filename ?? null;
            
            // Call signup function and include vet_license_filename if available
            echo $db->SignUp($email, $username, $password, $role, $vet_license_filename);
            


            
        }else if ($_POST['requestType'] == 'AddlguAccount') {


           
         
            $username = $_POST['username'];
            $fullName = $_POST['fullName'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $password = $_POST['password'];

            // Call signup function and include vet_license_filename if available
            echo $db->AddlguAccount($username,$fullName,$email,$address,$password);
            


            
        }else if ($_POST['requestType'] == 'UpdatelguAccount') {
            $lguId = $_POST['lguId'];
            $username = $_POST['username'];
            $fullName = $_POST['fullName'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $password = $_POST['password'];
            echo $db->UpdatelguAccount($lguId,$username,$fullName,$email,$address,$password);

        }else if ($_POST['requestType'] == 'DeletelguAccount') {
            $lguId = $_POST['lguId'];
            echo $db->DeletelguAccount($lguId);
            
        }else if ($_POST['requestType'] == 'DeletePost') {

            $deletepostid=$_POST['deletepostid'];
          

            echo $db->DeletePost($deletepostid);
            
        }else if ($_POST['requestType'] == 'deleteImpound') {

            $imp_id=$_POST['id'];
          

            echo $db->deleteImpound($imp_id);
            
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
                    'message' => 'Invalid Username or password'
                ]);
            }
        }else if ($_POST['requestType'] == 'EditPost') {


            $editpostid = $_POST['editpostid'] ?? null;
            $postInput = $_POST['editPostText'] ?? null;

            $postFiles = [
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

            if (!empty($_FILES['images']['name'][0])) {
                handleUpload($_FILES['images'], '../../../uploads/images', $postFiles["images"], 'img');
            }

            // Handle videos separately
            if (!empty($_FILES['videos']['name'][0])) {
                handleUpload($_FILES['videos'], '../../../uploads/videos', $postFiles["videos"], 'vid');
            }
            // Ensure we don't store empty arrays in the database
            $postFilesJson = (!empty($postFiles["images"]) || !empty($postFiles["videos"])) ? json_encode($postFiles) : null;
            // Call database function
            $result = $db->EditPost($editpostid, $postInput, $postFilesJson);


        } else {
            echo 'requestType NOT FOUND';
        }
    } else {
        echo 'Access Denied! No Request Type.';
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
}
?>