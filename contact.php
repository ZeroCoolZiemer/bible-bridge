<?php
require_once('init.php');
require_once('functions.php');
require_once('vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check captcha
    $captcha = isset($_POST['captcha']) ? $_POST['captcha'] : '';
    $captcha = strtolower($captcha);

    if ($captcha == "pure") { //Captcha CORRECT ANSWER
        // Collect form data
        $name = $_POST['name'];
	$from_email = $_POST['email'];
        $email = ""; //Email to receive messages.
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        // Initialize PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = ''; //SMTP
            $mail->SMTPAuth = true;
            $mail->Username = ''; //USERNAME
            $mail->Password = ''; //PASSWORD
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress(''); //Email

            // Content
            $mail->isHTML(false);  // Set email format to plain text
            $mail->Subject = 'Contact Form Submission: ' . $subject;
            $mail->Body    = "Name: $name\nEmail: $from_email\nSubject: $subject\nMessage:\n$message";
	    
            // Send the email
            $mail->send();
            $success_message = 'Email sent successfully!';
        } catch (Exception $e) {
            $error_message = "Error sending email: {$mail->ErrorInfo}";
        }
    } else {
        $error_message = 'Incorrect answer to the sixth word challenge.';
    }
}

// Check if the request is an AJAX request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // AJAX request
    if ($success_message) {
        echo json_encode(['status' => 'success', 'message' => $success_message]);
    } else {
        echo json_encode(['status' => 'error', 'message' => $error_message]);
    }
    exit;
} else {
    // Non-AJAX request, generate the HTML page
    $smarty->assign('activePage', 'contact');
    $smarty->assign('website', $website);
    echo $smarty->fetch('contact.tpl');
}
?>
