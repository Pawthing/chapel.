<?php
session_start();
include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

function resend_email_verify($name, $email, $verify_token)
{
    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = 2;                    
    $mail->isSMTP();    
    $mail->SMTPAuth   = true; 

    $mail->Host  = 'smtp.gmail.com';       
    $mail->Username   = 'samplecode062024@gmail.com';                     
    $mail->Password   = 'jjza mybo eykq zccd';

    $mail->SMTPSecure = "tls"; // PHPMailer::ENCRYPTION_SMTPS;  //         
    $mail->Port = 587;   // 465; //                        

    $mail->setFrom('samplecode062024@gmail.com',$name);
    $mail->addAddress($email);   

    $mail->isHTML(true);                                 
    $mail->Subject = "Resend - Email Verification from Chapel";

    $email_template = "
        <h2>You have Registered with Chapel</h2>
        <h5>Verify your email address to Login with the below given link</h5>
        <br><br/>
        <a href='http://localhost/chapelupdate104/verify-email.php?token=$verify_token'> Click Me </a>";

    $mail->Body = $email_template;
    $mail->send();
    //echo 'Message has been sent';
}

if(isset($_POST['resend_email_verify_btn'])) {
    if(!empty(trim($_POST['email']))) {
        $email = trim($_POST['email']);
        try {
            // Prepare and execute the query
            $checkemail_query = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $stmt = $pdo->prepare($checkemail_query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if($row['verify_status'] == "0") {
                    $name = $row['name'];
                    $email = $row['email'];
                    $verify_token = $row['verify_token'];

                    resend_email_verify($name, $email, $verify_token);

                    $_SESSION['status'] = "Verification Email Link has been sent to your Email Address.!";
                    header("Location: login.php");
                    exit(0);
                } else {
                    $_SESSION['status'] = "Email already verified. Please Login";
                    header("Location: resend-email-verification.php");
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Email is not registered. Please Register Now.!";
                header("Location: resend-email-verification.php");
                exit(0);
            }
        } catch(PDOException $e) {
            // Handle connection errors
            $_SESSION['status'] = "Database error: " . $e->getMessage();
            header("Location: resend-email-verification.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "Please enter the email field";
        header("Location: resend-email-verification.php");
        exit(0);
    }
}


?>