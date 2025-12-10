<?php
session_start();

if (isset($_SESSION['guest_id'])) {
    header("Location: rate.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $guest_name = $_POST['guest_name'];

    $conn = new mysqli("localhost", "root", "", "portfolio");

    $stmt = $conn->prepare("INSERT INTO guests (name) VALUES (?)");
    $stmt->bind_param("s", $guest_name);
    $stmt->execute();

    $guest_id = $stmt->insert_id;

    $_SESSION['guest_id'] = $guest_id;
    $_SESSION['guest_name'] = $guest_name;

    $stmt->close();
    $conn->close();

    header("Location: rate.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Guest Login</title>
    <link rel="stylesheet" href="style/auth.css?v=3">
</head>
<body class="fade-in">

<div class="container">
    <div class="glass">
        <h2 class="title">Guest Login</h2>
        <p class="subtitle">Just visiting? Enter your name!</p>

        <form method="POST">
            <div class="field">
                <label>Name</label>
                <input type="text" name="guest_name" required>
            </div>

            <button class="btn">Continue</button>
        </form>
    </div>
</div>

</body>
</html>
