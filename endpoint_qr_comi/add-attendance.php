<?php
include("../dbcon.php"); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['qr_code'])) {
        $qrCode = trim($_POST['qr_code']);

        // Prepare the SQL statement using PDO
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare and execute the select statement
            $selectStmt = $pdo->prepare("SELECT * FROM users WHERE generate_code = :qr_code");
            $selectStmt->bindParam(':qr_code', $qrCode);
            $selectStmt->execute();

            // Fetch the result
            if ($selectStmt->rowCount() > 0) {
                $row = $selectStmt->fetch(PDO::FETCH_ASSOC);
                $memberID = $row['id'];
                $memberName = $row['name'];
                $orgName = $row['org_name'];
                $timeIn = date("Y-m-d H:i:s");

                if ($orgName == 'COMI') {
                    // Prepare and execute the insertion statement
                    $insertStmt = $pdo->prepare("INSERT INTO tbl_att_comi (tbl_member_id, name, org_name, time_in) VALUES (:memberID, :memberName, :orgName, :timeIn)");

                    // Bind parameters
                    $insertStmt->bindParam(':memberID', $memberID);
                    $insertStmt->bindParam(':memberName', $memberName);
                    $insertStmt->bindParam(':orgName', $orgName);
                    $insertStmt->bindParam(':timeIn', $timeIn);

                    if ($insertStmt->execute()) {
                        // Redirect on success
                        header("Location: http://localhost/chapelupdate104/Admin/att_comi.php");
                        exit();
                    } else {
                        echo "Error executing insert.";
                    }
                } else {
                    echo "No member found with the provided QR Code.";
                }
            } else {
                echo "Failed to execute the select statement.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "
            <script>
                alert('Please fill in all fields!');
                window.location.href = 'http://localhost/chapelupdate104/Organizations/COMI/qr_code_comi.php';
            </script>
        ";
    }
}

// Close the database connection
$pdo = null;
?>
