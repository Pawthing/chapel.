<?php
session_start();
include('dbcon.php');

if (isset($_GET['token'])) {
    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $token = $_GET['token'];

        // Check if the token exists and retrieve its verify_status
        $verifyQuery = "SELECT verify_token, verify_status FROM tbl_admin WHERE verify_token = :token LIMIT 1";
        $stmt = $pdo->prepare($verifyQuery);
        $stmt->execute([':token' => $token]);

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row['verify_status'] == "0") {
                // Update the user's verify_status to 1
                $updateQuery = "UPDATE tbl_admin SET verify_status = '1' WHERE verify_token = :token LIMIT 1";
                $stmt = $pdo->prepare($updateQuery);
                $updateSuccess = $stmt->execute([':token' => $token]);

                if ($updateSuccess) {
                    $_SESSION['status'] = "Your Account has been Verified Successfully!";
                    header("Location: login_admin.php");
                    exit();
                } else {
                    $_SESSION['status'] = "Verification Failed!";
                    header("Location: login_admin.php");
                    exit();
                }
            } else {
                $_SESSION['status'] = "Email Already Verified. Please Login";
                header("Location: login_admin.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "This Token does not Exist";
            header("Location: login_admin.php");
            exit();
        }
    } catch (PDOException $e) {
        // Handle any potential errors
        $_SESSION['status'] = "Error: " . $e->getMessage();
        header("Location: login_admin.php");
        exit();
    }

    // Close the PDO connection
    $pdo = null;
} else {
    $_SESSION['status'] = "Not Allowed";
    header("Location: login_admin.php");
    exit();
}


?>