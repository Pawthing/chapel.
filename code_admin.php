<?php
session_start();
include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


function sendemail_verify($name,$email,$verify_token)
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
    $mail->Subject = "Email Verification from Chapel";

    $email_template = "
        <h2>You have Registered within the Chapel</h2>
        <h5>Verify your email address to Login with the given link below:</h5>
        <br><br/>
        <a href='http://localhost/chapelupdate104/verify-email_admin.php?token=$verify_token'> Click Me </a>";

    $mail->Body = $email_template;
    $mail->send();
    //echo 'Message has been sent';

}

if (isset($_POST['register_btn'])) {
    try {
        // Retrieve and sanitize input data
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $pass = md5($_POST['password']);
        $admin = $_POST['org_name'];
        $verify_token = md5(rand());
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_img/'.$image;

        // Check if email exists
        $checkEmailQuery = "SELECT email FROM tbl_admin WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($checkEmailQuery);
        $stmt->execute([':email' => $email]);
        $emailExists = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user already exists with the same email and password
        $selectQuery = "SELECT * FROM tbl_admin WHERE email = :email AND password = :password";
        $stmt = $pdo->prepare($selectQuery);
        $stmt->execute([':email' => $email, ':password' => $pass]);
        $userExists = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userExists) {
            $message[] = 'User already exists';
        } 
        else 
        {
            if ($image_size > 2000000) {
                $message[] = 'Image size is too large!';
            } else {
                // Insert new user data
                $insertQuery = "INSERT INTO tbl_admin (name, phone, email, password, org_name, image, verify_token) 
                                VALUES (:name, :phone, :email, :password, :org_name, :image, :verify_token)";
                $stmt = $pdo->prepare($insertQuery);
                $insert = $stmt->execute([
                    ':name' => $name,
                    ':phone' => $phone,
                    ':email' => $email,
                    ':password' => $pass,
                    ':org_name' => $admin,
                    ':image' => $image,
                    ':verify_token' => $verify_token
                ]);

                if ($insert) {
                    move_uploaded_file($image_tmp_name, $image_folder);
                    sendemail_verify($name, $email, $verify_token);
                    $_SESSION['status'] = "Registration successful! Please verify your email address.";
                    header("Location: register_admin.php");
                } else {
                    $_SESSION['status'] = "Registration failed!";
                    header("Location: register_admin.php");
                }
            }
        }

        if ($emailExists) {
            $_SESSION['status'] = "Email ID already exists";
            header("Location: register_admin.php");
        }
    } catch (PDOException $e) {
        // Handle any errors
        $_SESSION['status'] = "Error: " . $e->getMessage();
        header("Location: register_admin.php");
    }

    // Close the PDO connection
    // $pdo = null;
}



?>