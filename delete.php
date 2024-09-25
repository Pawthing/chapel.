<?php
include('../../connection.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        // Prepare and execute the delete query
        $query = $con->prepare("DELETE FROM tbl_event WHERE id = :id");
        $query->bindParam(':id', $id);

        if ($query->execute()) {
            echo "Event deleted successfully.";
        } else {
            echo "Failed to delete the event.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
