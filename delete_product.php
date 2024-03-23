<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "activity10";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['delete_product'])) {
    $id = $_POST['id'];

    // Delete the product based on the ID
    $sql = "DELETE FROM activity10 WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header('Location: activity.php');
        exit();
    } else {
        echo 'Error deleting product: ' . $conn->error;
    }
}

$conn->close();
?>
