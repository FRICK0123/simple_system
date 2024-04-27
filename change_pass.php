<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/jquery-3.6.0.js"></script>
</head>

<body>
    <div class="d-flex flex-column justify-content-center container w-50">
        <h1 class="mt-5 text-center mb-3">Change Password</h1>
        <form action="#" method="post" class="form d-flex flex-column justify-content-center">

            <div class="mt-3">
                <label for="password" class="form-label">New Password: </label>
                <input type="password" class="form-control" placeholder="********" id="password" name="password" required>
            </div>

            <div class="mt-3">
                <label for="confirm_password" class="form-label">Confirm Password: </label>
                <input type="password" class="form-control" placeholder="********" id="confirm_password" name="confirm_password" required>
            </div>

            <button class="btn btn-primary mt-3 justify-self-center" type="submit">Save Changes</button>

        </form>
    </div>

</body>

</html>