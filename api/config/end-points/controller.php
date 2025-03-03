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

            
                // Ensure the required folders exist
            $qrCodeDir = "../../../qrcodes/";
            $uploadDir = "../../../uploads/images/";

            // Function to generate a unique filename for uploaded files
            function generateUniqueFilename($file) {
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                return uniqid() . '.' . $ext;
            }

            function handleFileUpload($file, $uploadDir) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                $maxFileSize = 2 * 1024 * 1024; // 2MB
            
                if ($file['error'] !== UPLOAD_ERR_OK) {
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
            $ownerSignature = $_FILES['ownerSignature'] ?? null;

            $userPhotoName = $userPhoto ? handleFileUpload($userPhoto, $uploadDir) : null;
            $ownerSignatureName = $ownerSignature ? handleFileUpload($ownerSignature, $uploadDir) : null;

            // Collect form data
            $dateApplication = $_POST['dateApplication'] ?? '';
            $nameApplicant = $_POST['nameApplicant'] ?? '';
            $age = $_POST['age'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $birthday = $_POST['birthday'] ?? '';
            $telephone = $_POST['telephone'] ?? '';
            $emailApplicant = $_POST['emailApplicant'] ?? '';
            $homeAddress = $_POST['homeAddress'] ?? '';
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

            // ✅ Step 1: Insert pet data first and get the actual pet_id
            $petID = $db->petRegistration(
                $dateApplication, $nameApplicant, $age, $gender, $birthday, $telephone,
                $emailApplicant, $homeAddress, $petName, $petAge, $petGender, $species,
                $breed, $petWeight, $petColor, $distinguishingMarks, $petBirthday,
                $vaccinationDate, $vaccinationExpiry, $vetClinic, $vetName, $vetAddress,
                $vetContact, $dateSigned, $userPhotoName, $ownerSignatureName, "" // Placeholder for QR Code
            );

            if (!is_numeric($petID)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to register pet. Please try again.'
                ]);
                exit;
            }

            // ✅ Step 2: Generate QR Code using the real pet_id
            $qrData = $petID; // QR Code contains the actual pet_id

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
            $qrCodeFileName_directory = $qrCodeDir . "PET_" . $petID . ".png";
            
            $qrCodeFileName = "PET_" . $petID . ".png";
            // Save QR Code to file
            file_put_contents($qrCodeFileName_directory, $qrCodeResult->getString());


            $petID = $db->updatePetQRCode($petID, $qrCodeFileName);
            
            // ✅ Step 5: Return response
            echo json_encode([
                'status' => 'success',
                'message' => 'Pet registration successful!',
                'pet_id' => $petID,
                'qr_code' => $qrCodeFileName
            ]);

            
            
        }else if ($_POST['requestType'] == 'Signup') {

            $email=$_POST['email'];
            $username=$_POST['username'];
            $password=$_POST['password'];
            $role=$_POST['role'];
          

            echo $db->SignUp($email,$username,$password,$role);
            
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