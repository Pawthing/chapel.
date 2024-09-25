<?php
include('../dbcon.php'); 

if (isset($_GET['attendance'])) {
    // Get the attendance ID from the GET request
    $attendance = trim($_GET['attendance']);

    // Prepare the query using PDO
    try {
        $query = "DELETE FROM tbl_att_leccom WHERE tbl_attendance_id = :attendance";
        $stmt = $pdo->prepare($query);

        // Bind the parameter (attendance ID) to the prepared statement
        $stmt->bindParam(':attendance', $attendance, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            echo "
                <script>
                    alert('Attendance deleted successfully!');
                    window.location.href = 'http://localhost/chapelupdate104/Admin/qr_index_leccom.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Failed to delete attendance!');
                    window.location.href = 'http://localhost/chapelupdate104/Admin/qr_index_leccom.php';
                </script>
            ";
        }
    } catch (PDOException $e) {
        // If the preparation of the statement fails, output the error
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $pdo = null;
}
?>
