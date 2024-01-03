<?php
require("db.php");

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $passwordhash = password_hash($password, PASSWORD_DEFAULT);
    $access = $_POST['access'];

    $query = "INSERT INTO user (email, password, access) VALUES ('$email', '$passwordhash', '$access')";
    // ".md5($password)."

    $result = mysqli_query($conn, $query);

    if ($result) {
        header("location: index.php");
    } else {
        echo "Failed";
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
        <h4>Register</h4>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Akses</label>
                <select name="access" class="form-control" id="">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="form-group form-check">
                <span>Already have account? </span>

                <a href="../register-form/index.php">Sign In</a>
            </div>
            <button type="submit" value="login" name="submit" class="btn btn-primary">Register</button>
        </form>
    </div>

</body>

</html>