<?php include 'includes/config.php'; ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL to delete a record
    $sql = "DELETE FROM payments WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}

// Redirect to the read.php after deletion
header('Location: read.php');
?>
