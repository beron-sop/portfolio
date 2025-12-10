<?php
require "db.php";

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password !== $confirm) {
        echo "<p style='color:red; text-align:center;'>Passwords do not match.</p>";
    } else {

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password)
                VALUES ('$username', '$email', '$hashed')";

        if (mysqli_query($conn, $sql)) {
            header("Location: login.php?registered=1");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/auth.css?v=3">
    <title>Register</title>
</head>
<body class="fade-in">

    <div class="container reveal">
        <div class="box glass">
            <h2 class="title">Create an Account</h2>
            <p class="subtitle">Join to create a Portfolio!</p>

            <form action="register.php" method="post">

                <div class="field">
                    <label>Username</label>
                    <input type="text" name="username" required>
                </div>

                <div class="field">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="field">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>

                <div class="field">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" required>
                </div>

                <button type="submit" name="submit" class="btn">Register</button>

                <p class="links">
                    Already have an account? <a href="login.php">Login here</a>
                </p>
            </form>
        </div>
    </div>
    <script src="js/auth.js?v=3"></script>
</body>
</html>
