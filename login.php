<?php
    require_once "connect.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/jquery-3.6.0.js"></script>
</head>

<body>
    <div class="d-flex flex-column justify-content-center container w-50">
        <h1 class="mt-5 text-center mb-3">Log in</h1>
        <form action="#" method="post" class="form d-flex flex-column justify-content-center">
            <div class="mt-3">
                <label for="username" class="form-label">Username: </label>
                <input type="text" class="form-control" placeholder="Freak1234" id="username" name="username" required>
            </div>

            <div class="mt-3">
                <label for="password" class="form-label">Password: </label>
                <input type="password" class="form-control" placeholder="********" id="password" name="password" required>
            </div>

            <button class="btn btn-primary mt-3 justify-self-center" type="submit" name="login">Log in</button>
            <p class="mt-3">Don't have an account? <a href="register.php">Register here</a></p>

            <?php
                if(isset($_POST['login'])){
                    $username = $_POST['username'];
                    $password = hash('SHA256',$_POST['password']);

                    $sql_login = "SELECT * FROM users WHERE username = '$username' AND password = '$password';";
                    $result = mysqli_query($connect, $sql_login);
                    $rows = mysqli_num_rows($result);

                    $data = mysqli_fetch_assoc($result);

                    if($rows > 0){
                        Header("Location: welcome.php");
                        $_SESSION['isLoggedin'] = true;
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['password'] = $data['password'];

                    } else {
                        echo "<script>alert('Account Not Found')</script>";
                    }
                };
            ?>

        </form>
    </div>

</body>

</html>