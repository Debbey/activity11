<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "activity10";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function addProduct($conn, $name, $price, $category) {
    $sql = "INSERT INTO activity10 (name, price, category) VALUES ('$name', '$price', '$category')";
    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if(isset($_POST['add_product'])) {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $category = $_POST["category"];

    addProduct($conn, $name, $price, $category);
    header("Location: activity.php");
    exit();
}
?>

<!-- Add CSS styles directly within the PHP file -->
<style>
    .container {
        width: 80%;
        margin: 0 auto;
    }

    .form-container {
        margin-top: 20px;
    }

    form {
        display: inline-block;
    }

    input {
        margin-bottom: 10px;
    }

    button {
        padding: 5px 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .table-container {
        margin-top: 20px;
    }

    .table-container table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table-container table tr:hover {
        background-color: #e9ecef;
    }
</style>

<div class="container">
    <!-- HTML form for adding a new product with animation -->
    <div class="form-container form-animation">
        <form method="post" action="activity.php">
            <input type="text" name="name" placeholder="Product Name"><br>
            <input type="text" name="price" placeholder="Price"><br>
            <input type="text" name="category" placeholder="Category"><br>
            <button type="submit" name="add_product">Add Product</button>
        </form>
    </div>

    <?php
    echo '<div class="table-container table-animation">';
    echo '<table>';
    echo '<tr>';
    echo '<th>Product Name</th>';
    echo '<th>Price</th>';
    echo '<th>Category</th>';
    echo '<th>Actions</th>'; // Add a new column for actions
    echo '</tr>';

    $result = $conn->query("SELECT * FROM activity10");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['price'] . '</td>';
            echo '<td>' . $row['category'] . '</td>';
            // Add edit and delete buttons with form for each row
            echo '<td>';
            echo '<form method="post" action="edit_product.php">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<button type="submit" name="edit_product">Edit</button>';
            echo '</form>';
            echo '<form method="post" action="delete_product.php">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<button type="submit" name="delete_product">Delete</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
    }

    echo '</table>';
    echo '</div>';
    ?>
</div>

<?php $conn->close(); ?>
