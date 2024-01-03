<?php
session_start();
require("db.php");

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
        if ($user) {
            $hashed_password = $user['password']; // Assuming the password is stored as a hashed value in the database

            // Verify the entered password using password_verify()
            if (password_verify($password, $hashed_password)) {
                $access = $user['access'];
                $_SESSION['email'] = $email;

                if ($access == 'admin') {
                    header("location: dashboardAdmin.php");
                    exit();
                } else {
                    header("location: dashboardUser.php");
                    exit();
                }
            } else {
                // Incorrect password
                echo "Login failed. Incorrect password.";
            }
        } else {
            // User not found
            echo "Login failed. User not found.";
        }
    } else {
        // Query execution failed
        echo "Login failed. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container" style="padding: 130px;">
        <h4>Sign In</h4>
        <form action="" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group form-check">
                <span>Don't have account? </span>
                <a href="../register-form/register.php">Register Account</a>
            </div>
            <button type="submit" value="login" name="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

</body>

</html>