<?php
include("../dbcon.php"); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name']) && isset($_POST['org_name']) && isset($_POST['generate_code'])) {
        // Capture the POST data
        $memberName = trim($_POST['name']);
        $orgName = trim($_POST['org_name']);
        $generateCode = trim($_POST['generate_code']);

        // Use try-catch style for error handling
        try {
            // Prepare the SQL statement using PDO
            $stmt = $pdo->prepare("INSERT INTO users (name, org_name, generate_code) VALUES (:name, :org_name, :generate_code)");

            if ($stmt === false) {
                throw new Exception("Error preparing the statement.");
            }

            // Bind the parameters
            $stmt->bindParam(':name', $memberName, PDO::PARAM_STR);
            $stmt->bindParam(':org_name', $orgName, PDO::PARAM_STR);
            $stmt->bindParam(':generate_code', $generateCode, PDO::PARAM_STR);

            // Execute the prepared statement
            if ($stmt->execute()) {
                // Redirect upon success
                header("Location: http://localhost/chapelupdate104/Organizations/LecCom/qr_code_leccom.php");
                exit();
            } else {
                // Handle execution failure
                throw new Exception("Error executing the query.");
            }
        } catch (PDOException $e) {
            // Display the error message for debugging
            echo "Database Error: " . $e->getMessage();
        } catch (Exception $e) {
            // Display other errors
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Handle the case where some POST fields are missing
        echo "
            <script>
                alert('Please fill in all fields!');
                window.location.href = 'http://localhost/chapelupdate104/Organizations/LecCom/qr_code_leccom.php';
            </script>
        ";
    }
}

// Close the database connection
$pdo = null;
?>
