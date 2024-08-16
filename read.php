<?php include 'includes/header.php'; ?>
<?php include 'includes/config.php'; ?>

<h2>Records</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Payment Amount</th>
        <th>With GST</th>
        <th>Total Payable Amount</th>
        <th>Actions</th>
    </tr>
    <?php
    // Fetch records from the database
    $sql = "SELECT * FROM payments";
    $result = $conn->query($sql);

    // Check if there are any records
    if ($result->num_rows > 0) {
        // Loop through each record and display in the table
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["payment_amount"] . "</td>";
            echo "<td>" . ($row["with_gst"] ? 'Yes' : 'No') . "</td>";
            echo "<td>" . $row["total_payable_amount"] . "</td>";
            echo "<td>
                    <a href='update.php?id=" . $row["id"] . "'>Edit</a> |
                    <a href='delete.php?id=" . $row["id"] . "' class='delete-record'>Delete</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        // If no records are found, display a message
        echo "<tr><td colspan='6'>No records found</td></tr>";
    }

    // Close the database connection
    $conn->close();
    ?>
</table>

<!-- Link to add a new record -->
<a href="create.php">Add New Record</a>

<?php include 'includes/footer.php'; ?>
