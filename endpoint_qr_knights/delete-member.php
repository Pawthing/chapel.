<?php
include('../dbcon.php'); 

if (isset($_GET['member'])) {
    // Get the member ID from the GET request
    $member = trim($_GET['member']);

    // Prepare the query using PDO
    try {
        $query = "DELETE FROM tbl_att_knights WHERE tbl_member_id = :member";
        $stmt = $pdo->prepare($query);

        // Bind the parameter (member ID) to the prepared statement
        $stmt->bindParam(':member', $member, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            echo "
                <script>
                    alert('Member deleted successfully!');
                    window.location.href = 'http://localhost/chapelupdate104/Admin/att_knights.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Failed to delete member!');
                    window.location.href = 'http://localhost/chapelupdate104/Admin/att_knights.php';
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
