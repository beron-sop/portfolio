<?php
session_start();
require "db.php";

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header("Location: home.php");
        exit;
    } else {
        echo "<p style='color:red; text-align:center;'>Invalid login.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/auth.css?v=3">
    <title>Login</title>
</head>
<body class="fade-in">

    <div class="container reveal">
        <div class="box glass">
            <h2 class="title">Login</h2>

            <form action="login.php" method="post">

                <div class="field">
                    <label>Username</label>
                    <input type="text" name="username" required>
                </div>

                <div class="field">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>

                <button type="submit" name="submit" class="btn">Login</button>

                <p class="links">
                    Don’t have an account? <a href="register.php">Register here</a>
                </p>
            </form>
        </div>
    </div>

    <script src="js/auth.js?v=3"></script>
</body>
</html>
