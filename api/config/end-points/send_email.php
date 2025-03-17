<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../vendor/autoload.php'; // Install PHPMailer via Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'angeladeniseflores199@gmail.com'; 
        $mail->Password = 'rpbm yjls katl wcrt'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email Headers
        $mail->setFrom($email, $firstName . " " . $lastName);
        $mail->addAddress("dummy.mypet@gmail.com"); // Recipient

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission";
        $mail->Body = "
            <h2>Contact Form Details</h2>
            <p><strong>Name:</strong> $firstName $lastName</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Message:</strong> $message</p>
        ";

        // Send Email
        $mail->send();
        echo json_encode(["status" => "success"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $mail->ErrorInfo]);
    }
}
?>
