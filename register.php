<?php
    require_once "connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/jquery-3.6.0.js"></script>
</head>

<body>
    <div class="d-flex flex-column justify-content-center container w-50">
        <h1 class="mt-5 text-center mb-3">Register</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="form d-flex flex-column justify-content-center">

            <div class="mt-3">
                <label for="username" class="form-label">Username: </label>
                <input type="text" class="form-control" placeholder="Freak1234" id="username" name="username">
            </div>
            <?php
            if (isset($_POST['register'])) {
                $username = $_POST['username'];
                $isUsername = true;

                $user_exist = "SELECT * FROM users WHERE username = '$username';";
                $username_sql = mysqli_query($connect, $user_exist);
                $user_row = mysqli_num_rows($username_sql);

                if (empty(trim($username))) {
                    echo "<span class='text-danger'>Username should not be empty</span>";
                    $isUsername = false;
                } else if (strlen(trim($username)) <= 5) {
                    echo "<span class='text-danger'>Username should have more than 5 characters</span>";
                    $isUsername = false;
                } else if($user_row > 0){
                    echo "<span class='text-danger'>Username already exists</span>";
                    $isUsername = false;
                }
            }
            ?>

            <div class="mt-3">
                <label for="password" class="form-label">Password: </label>
                <input type="password" class="form-control" placeholder="********" id="password" name="password">
            </div>
            <?php
            if (isset($_POST['register'])) {
                $password = $_POST['password'];
                $isPassword = true;
                if (empty(trim($password))) {
                    echo "<span class='text-danger'>Password should not be empty</span>";
                    $isPassword = false;
                } else if (strlen(trim($password)) < 8) {
                    echo "<span class='text-danger'>Password should have 8 characters or more</span>";
                    $isPassword = false;
                }
            }
            ?>

            <div class="mt-3">
                <label for="confirm_password" class="form-label">Confirm Password: </label>
                <input type="password" class="form-control" placeholder="********" id="confirm_password" name="confirm_password">
            </div>
            <?php
                if (isset($_POST['register'])) {
                    $confirm_password = $_POST['confirm_password'];
                    $isConfirm = true;
                    if (empty(trim($confirm_password))) {
                        echo "<span class='text-danger'>Confirm password is required</span>";
                        $isConfirm = false;
                    } else if ($confirm_password !== $password) {
                        echo "<span class='text-danger'>Password Confirmation doesn't match</span>";
                        $isConfirm = false;
                    }
                }
                ?>

            <button class="btn btn-primary mt-3 justify-self-center" type="submit" name="register">Register</button>
            <p class="mt-3">Already have an account? <a href="login.php">Log in</a></p>
        </form>

        <?php
            if(isset($_POST['register'])){
                $hashed = hash('SHA256',$password);
                if($isUsername === true && $isPassword === true && $isConfirm === true){
                    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed');";
                    mysqli_query($connect, $sql);
                    echo "<script>alert('Account Created')</script>";
                    Header("Location: login.php");
                } else {
                    echo "<script>alert('Account NOT Created')</script>";
                }
            }
        ?>
    </div>

</body>

</html>