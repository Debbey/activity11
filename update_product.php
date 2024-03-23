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

if (isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Update the product details in the database
    $sql = "UPDATE activity10 SET name='$name', price='$price', category='$category' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        header('Location: activity.php');
        exit();
    } else {
        echo 'Error updating product details: ' . $conn->error;
    }
}

$conn->close();
?>
