<?php
session_start();
include('dbcon.php');

if (isset($_POST['login_now_btn'])) {
    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
        try {
            $email = $_POST['email'];
            $pass = md5($_POST['password']);

            // Prepare the SQL query
            $loginQuery = "SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1";
            $stmt = $pdo->prepare($loginQuery);
            $stmt->execute([
                ':email' => $email,
                ':password' => $pass
            ]);

            // Fetch the user data
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                if ($row['verify_status'] == "1") {
                    $_SESSION['user_id'] = $row['id'];

                    // Organization-specific redirection
                    switch ($row['org_name']) {
                        case 'Usherette':
                            $_SESSION['member_name'] = $row['name'];
                            $_SESSION['user_type'] = $row['org_name'];
                            header('Location: Organizations/Usherette/dashboard_usherette.php');
                            break;
                        case 'Choir':
                            $_SESSION['member_name'] = $row['name'];
                            $_SESSION['user_type'] = $row['org_name'];
                            $_SESSION['id'] = $row['id'];
                            header('Location: Organizations/Choir/dashboard_choir.php');
                            break;
                        case 'COMI':
                            $_SESSION['member_name'] = $row['name'];
                            $_SESSION['user_type'] = $row['org_name'];
                            header('Location: Organizations/COMI/dashboard_comi.php');
                            break;
                        case 'Knights':
                            $_SESSION['member_name'] = $row['name'];
                            $_SESSION['user_type'] = $row['org_name'];
                            header('Location: Organizations/Knights/dashboard_knights.php');
                            break;
                        case 'LecCom':
                            $_SESSION['member_name'] = $row['name'];
                            $_SESSION['user_type'] = $row['org_name'];
                            header('Location: Organizations/LecCom/dashboard_leccom.php');
                            break;
                        case 'Multimedia':
                            $_SESSION['member_name'] = $row['name'];
                            $_SESSION['user_type'] = $row['org_name'];
                            header('Location: Organizations/Multimedia/dashboard_multimedia.php');
                            break;
                        case 'Admin':
                            $_SESSION['member_name'] = $row['name'];
                            $_SESSION['user_type'] = $row['org_name'];
                            header('Location: Admin/dashboard_admin.php');
                            break;
                        default:
                            $_SESSION['status'] = "Unknown organization.";
                            header("Location: login.php");
                            exit(0);
                    }
                } else {
                    $_SESSION['status'] = "Please verify your email address to login.";
                    header("Location: login.php");
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Invalid email or password.";
                header("Location: login.php");
                exit(0);
            }
        } catch (PDOException $e) {
            // Handle any errors
            $_SESSION['status'] = "Error: " . $e->getMessage();
            header("Location: login.php");
            exit(0);
        }

        // Close the PDO connection
        $pdo = null;
    } else {
        $_SESSION['status'] = "All fields are mandatory.";
        header("Location: login.php");
        exit(0);
    }
}
?>
