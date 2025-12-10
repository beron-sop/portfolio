<?php
session_start();

if (!isset($_SESSION['guest_id'])) {
    header("Location: guest.php");
    exit;
}

$guest_id = $_SESSION['guest_id'];
$guest_name = $_SESSION['guest_name'] ?? "Guest";

$conn = new mysqli("localhost", "root", "", "portfolio");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $rating = $_POST["rating"] ?? 0;
    $comment = $_POST["comment"] ?? "";

    $stmt = $conn->prepare("INSERT INTO guest_ratings (guest_id, rating, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $guest_id, $rating, $comment);
    $stmt->execute();
    $stmt->close();

    header("Location: rate.php?success=1");
    exit;
}

$ratings = $conn->query("
    SELECT r.*, g.name 
    FROM guest_ratings r
    JOIN guests g ON r.guest_id = g.guest_id
    ORDER BY r.created_at DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rate My Portfolio</title>

    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style/rate.css?v=1">
</head>
<body class="fade-in">

<div class="container glass">

    <a href="home.php" class="portfolio-btn">← View Portfolio</a>

    <h1>Rate My Portfolio</h1>
    <p class="subtitle">Hello, <b><?php echo $guest_name; ?></b>! I’d love to hear your thoughts 💙</p>

    <?php if (isset($_GET['success'])): ?>
        <div class="success-msg">Thank you! Your rating has been submitted. ✨</div>
    <?php endif; ?>

    <form method="POST" class="rating-form">
        
        <label>Your Rating:</label>
        <div class="stars" id="starBox">
            <span data-value="1">★</span>
            <span data-value="2">★</span>
            <span data-value="3">★</span>
            <span data-value="4">★</span>
            <span data-value="5">★</span>
        </div>

        <input type="hidden" name="rating" id="ratingValue" required>

        <label>Your Comment:</label>
        <textarea name="comment" placeholder="Write something..." required></textarea>

        <button type="submit" class="submit-btn">Submit Rating</button>
    </form>

    <hr>

    <h2>All Ratings</h2>

    <div class="ratings-list">
        <?php while ($row = $ratings->fetch_assoc()): ?>
            <div class="rating-card glass">
                <div class="rating-header">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <span class="stars-display"><?php echo str_repeat("★", $row['rating']); ?></span>
                </div>
                <p class="comment"><?php echo nl2br(htmlspecialchars($row['comment'])); ?></p>
                <p class="date"><?php echo $row['created_at']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>

</div>

<script src="js/rate.js?v=1"></script>
</body>
</html>
