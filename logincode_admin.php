<?php
session_start();
include('dbcon.php');

if (isset($_POST['login_now_btn'])) {
    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
        try {
            $email = $_POST['email'];
            $pass = md5($_POST['password']);

            // Prepare the SQL query
            $loginQuery = "SELECT * FROM tbl_admin WHERE email = :email AND password = :password LIMIT 1";
            $stmt = $pdo->prepare($loginQuery);
            $stmt->execute([
                ':email' => $email,
                ':password' => $pass
            ]);

            // Fetch the user data
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                if ($row['verify_status'] == "1") {
                    $_SESSION['admin_id'] = $row['id'];

                    // Organization-specific redirection
                    switch ($row['org_name']) {
                        case 'Admin':
                            $_SESSION['member_name'] = $row['name'];
                            $_SESSION['admin'] = $row['org_name'];
                            header('Location: Admin/dashboard_admin.php');
                            break;
                        default:
                            $_SESSION['status'] = "Unknown organization.";
                            header("Location: login_admin.php");
                            exit(0);
                    }
                } else {
                    $_SESSION['status'] = "Please verify your email address to login.";
                    header("Location: login_admin.php");
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Invalid email or password.";
                header("Location: login_admin.php");
                exit(0);
            }
        } catch (PDOException $e) {
            // Handle any errors
            $_SESSION['status'] = "Error: " . $e->getMessage();
            header("Location: login_admin.php");
            exit(0);
        }

        // Close the PDO connection
        $pdo = null;
    } else {
        $_SESSION['status'] = "All fields are mandatory.";
        header("Location: login_admin.php");
        exit(0);
    }
}
?>
