<?php
require_once "connect.php";
session_start();

if (isset($_SESSION['isLoggedin']) !== true) {
    Header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/jquery-3.6.0.js"></script>
</head>

<body>
    <div class="container text-center mt-5">
        <?php echo "<h1>Welcome " . $_SESSION['username'] . ", Have a Good Day</h1>"; ?>
        <div class="container d-flex justify-content-center mt-3">
            <form action="change_pass.php" method="POST" class="me-5">
                <button class="btn btn-primary" type="submit">Change Password</button>
            </form>

            <form action="#" method="POST">
                <button class="btn btn-danger" type="submit" name="logout">Log out</button>
            </form>

            <?php
            if (isset($_POST['logout'])) {
                session_destroy();
                Header("Location: login.php");
            }
            ?>
        </div>
    </div>

    <br><br><br>

    <?php
    $sql_prods = "SELECT * FROM products;";
    $products = mysqli_query($connect, $sql_prods);
    ?>
    <p class="text-center">==========================================================================================================</p>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($results = mysqli_fetch_assoc($products)) {
                    echo "<tr>";
                    echo "<td>" . $results['prodID'] . "</td>";
                    echo "<td>" . $results['product'] . "</td>";
                    echo "<td>" . $results['quantity'] . "</td>";
                    echo "</tr>";
                }
                ?>

                <?php
                    $sql_total = "SELECT SUM(quantity) AS total FROM products;";
                    $total = mysqli_query($connect, $sql_total);
                    $totality = mysqli_fetch_assoc($total);

                    echo "<tr>";
                    echo "<th>Total</th>";
                    echo "<td></td>";
                    echo "<td>" . $totality['total'] . "</td>";
                    echo "</tr>";
                ?>
            </tbody>
        </table>
    </div>

    <br><br>

    <?php
    $distinct_sql = "SELECT DISTINCT product FROM products;";
    $distinct = mysqli_query($connect, $distinct_sql);
    ?>

    <div class="d-flex flex-column justify-content-center container mb-5 w-50">
        <form action="#" method="post" class="form d-flex flex-column justify-content-center">
            <div class="mt-3">
                <label for="products" class="form-label">Select Products:</label>
                <select name="products" id="products" class="form-select" required style="cursor: pointer;">
                    <option value="">Products</option>
                    <?php
                    $distinct_products = "SELECT DISTINCT prodID, product FROM products";
                    $row_result = mysqli_query($connect, $distinct_products);
                    while ($rows = mysqli_fetch_assoc($row_result)) {
                        echo "<option value='" . $rows['prodID'] . "|" . $rows['product'] . "'>" . $rows['product'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mt-3">
                <label for="quantity" class="form-label">Quantity: </label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>

            <button class="btn btn-primary mt-3 text-center" type="submit" name="add_item">Add</button>

            <?php
            if (isset($_POST['add_item'])) {
                $products = $_POST['products'];
                $quantity = $_POST['quantity'];

                $separated_values = explode('|', $products);

                $prodUnique = $separated_values[0];
                $productName = $separated_values[1];

                $prod_insert = "INSERT INTO products (prodID,product,quantity) VALUES ($prodUnique ,'$productName', $quantity);";
                mysqli_query($connect, $prod_insert);

                Header("Location: welcome.php");
            }
            ?>
        </form>
    </div>
</body>

</html>