<?php
include('../class.php');
$db = new global_class();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../vendor/autoload.php'; // Install PHPMailer via Composer

date_default_timezone_set('Asia/Manila');


// echo "<pre>";
// print_r($_POST);    
// echo "</pre>";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'send_otp') {
        $email = $_POST['email'];

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["status" => "error", "message" => "Invalid email address."]);
            exit;
        }

        // Check if email exists in the database
        if (!$db->checkEmailExists($email)) {
            echo json_encode(["status" => "error", "message" => "Email not found in our records."]);
            exit;
        }

        // Generate a 5-digit OTP
        $otp = rand(10000, 99999);
        
        // Store OTP securely in the database without expiration
        $db->storeOtp($email, $otp);

        // Send OTP via email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'angeladeniseflores199@gmail.com'; 
        $mail->Password = 'rpbm yjls katl wcrt'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('no-reply@mypets.com', 'MyPets');
        $mail->addAddress($email);
        $mail->Subject = 'Your OTP Code';
        $mail->Body = "Your OTP code is: $otp.";

        if ($mail->send()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to send OTP"]);
        }
        exit;
    }

    if ($action === 'verify_otp') {
        $email = $_POST['email'] ?? null;
        $userOTP = $_POST['otp'] ?? null; // Prevent "Undefined array key" error
    
        if (!$email || !$userOTP) {
            echo json_encode(["status" => "error", "message" => "Missing email or OTP."]);
            exit;
        }
    
        // Validate OTP from the database
        $otpData = $db->getOtp($email);
    
        if (!$otpData || $otpData['otp_code'] != $userOTP) {
            echo json_encode(["status" => "error", "message" => "Invalid OTP."]);
        } else {
            echo json_encode(["status" => "success"]);
        }
        exit;
    }

    if ($action === 'reset_password') {
        $email = $_POST['email'] ?? null;
        $newPassword = $_POST['new_password'] ?? null;
    
       
    
        // Enforce strong password policy
        if (strlen($newPassword) < 8 || !preg_match('/[A-Z]/', $newPassword) || !preg_match('/[\W]/', $newPassword)) {
            echo json_encode(["status" => "error", "message" => "Password must be at least 8 characters long and include an uppercase letter and a special character."]);
            exit;
        }
    
        // Hash the new password
        $hashedPassword = hash('sha256', $newPassword);
        $updateResult = $db->UpdatePassword($hashedPassword, $email);
    
        if ($updateResult === "success") {
            $db->clearOtp($email);
            echo json_encode(["status" => "success", "message" => "Password updated successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => $updateResult['error']]);
        }
        exit;
    }
    
}

?>
