<?php
include('connection.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    try {
        // Prepare and execute the update query
        $query = $con->prepare("UPDATE tbl_event SET title = :title, start_date = :start, end_date = :end WHERE id = :id");
        $query->bindParam(':title', $title);
        $query->bindParam(':start', $start);
        $query->bindParam(':end', $end);
        $query->bindParam(':id', $id);

        if ($query->execute()) {
            echo "Event updated successfully.";
        } else {
            echo "Failed to update the event.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
