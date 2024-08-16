<?php include 'includes/header.php'; ?>
<?php include 'includes/config.php'; ?>

<?php
// Check if the id is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the record to be updated
    $sql = "SELECT * FROM payments WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $payment_amount = $row['payment_amount'];
        $with_gst = $row['with_gst'];
    } else {
        echo "Record not found!";
        exit;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $payment_amount = $_POST['payment_amount'];
    $with_gst = $_POST['with_gst'] == '1' ? 1 : 0;
    $total_payable_amount = $with_gst ? $payment_amount * 1.18 : $payment_amount;

    // Update the record in the database
    $sql = "UPDATE payments SET name='$name', payment_amount='$payment_amount', with_gst='$with_gst', total_payable_amount='$total_payable_amount' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: read.php"); // Redirect to read.php after successful update
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>

<h2>Update Record</h2>

<form method="post" action="update.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>

    <label for="payment_amount">Payment Amount:</label>
    <input type="number" id="payment_amount" name="payment_amount" value="<?php echo $payment_amount; ?>" required>

    <label for="with_gst">With GST:</label>
    <input type="radio" id="with_gst_yes" name="with_gst" value="1" <?php if($with_gst == 1) echo 'checked'; ?> required> Yes
    <input type="radio" id="with_gst_no" name="with_gst" value="0" <?php if($with_gst == 0) echo 'checked'; ?> required> No

    <input type="submit" value="Update">
</form>

<a href="read.php">Back to Records</a>

<?php include 'includes/footer.php'; ?>
