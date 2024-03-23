<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "activity10";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['edit_product'])) {
    $id = $_POST['id'];

    // Fetch the product data based on the ID
    $result = $conn->query("SELECT * FROM activity10 WHERE id = $id");
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Display a form to edit the product details with CSS styling
        echo '<style>
                form {
                    margin: 20px;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    background-color: #f9f9f9;
                    width: 300px;
                }
                input, button {
                    margin: 5px;
                    padding: 5px;
                    width: 100%;
                    box-sizing: border-box;
                }
                button {
                    background-color: #007bff;
                    color: white;
                    border: none;
                    border-radius: 3px;
                    cursor: pointer;
                }
              </style>';
        echo '<form method="post" action="update_product.php">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '<input type="text" name="name" value="' . $row['name'] . '"><br>';
        echo '<input type="text" name="price" value="' . $row['price'] . '"><br>';
        echo '<input type="text" name="category" value="' . $row['category'] . '"><br>';
        echo '<button type="submit" name="update_product">Update</button>';
        echo '</form>';
    } else {
        echo 'Product not found.';
    }
}

$conn->close();
?>