<?php include 'includes/header.php'; ?>
<?php include 'includes/config.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $payment_amount = $_POST['payment_amount'];
    $with_gst = $_POST['with_gst'] == '1' ? 1 : 0; // Correctly interpret the selected option
    $total_payable_amount = $with_gst ? $payment_amount * 1.18 : $payment_amount;

    $sql = "INSERT INTO payments (name, payment_amount, with_gst, total_payable_amount)
            VALUES ('$name', '$payment_amount', '$with_gst', '$total_payable_amount')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<form method="post" action="create.php">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="payment_amount">Payment Amount:</label>
    <input type="number" id="payment_amount" name="payment_amount" required>

    <label for="with_gst">With GST:</label>
    <input type="radio" id="with_gst_yes" name="with_gst" value="1" required> Yes
    <input type="radio" id="with_gst_no" name="with_gst" value="0" required> No

    <input type="submit" value="Submit">
</form>

<a href="read.php">View Records</a>

<?php include 'includes/footer.php'; ?>
