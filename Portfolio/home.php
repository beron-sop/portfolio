<?php
session_start();
require_once 'db.php';

// Display name (optional)
$displayName = $_SESSION['displayName'] ?? "Admin";

// Check if admin is logged in
$isAdmin = isset($_SESSION['username']);

// Fetch comments ONLY if admin
$comments = null;
if ($isAdmin) {
    $comments = $conn->query("
        SELECT g.name, r.rating, r.comment, r.created_at
        FROM guest_ratings r
        JOIN guests g ON r.guest_id = g.guest_id
        ORDER BY r.rating_id DESC
    ");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home | <?php echo $displayName; ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/home.css?v=3">
</head>

<body class="fade-in">

    <div class="profile-wrapper">
        <img src="m3.png" alt="My Photo" class="profile-photo">
        <div class="intro-text">
            <h1 id="typing-text"></h1>
            <p>Aspiring Developer || IT Student || Web Designer</p>
        </div>
    </div>

    <div class="subnav">
        <a href="#home">Home</a> |
        <a href="#projects">Projects</a> |
        <a href="#contact">Contact</a> |
        <?php if ($isAdmin): ?>
            <a href="#feedbacks">Feedbacks</a>
        <?php endif; ?>
    </div>

    <!-- HOME SECTION -->
    <section class="section glass reveal" id="home">
        <h2>About Me</h2>
        <p>
            A responsible and dedicated individual who strives for perfection, organization,
            and continuous learning. I am passionate about technology, solving problems,
            and creating digital solutions that are simple, functional, and user‑friendly.
            I adapt quickly, enjoy working with people, and handle tasks with honesty,
            discipline, and attention to detail. Whether working independently or with a
            team, I always aim to give my best.
        </p>
    </section>

    <!-- SKILLS -->
    <section class="section glass reveal">
        <h2>Skills</h2>
        <ul>
            <li>PHP • HTML & CSS • JavaScript</li>
            <li>Responsive Web Design • Basic UI/UX</li>
            <li>MySQL • Data Encoding & Documentation</li>
            <li>Customer Service • Time Management</li>
            <li>Attention to detail • Organization</li>
        </ul>
    </section>

    <!-- PROJECTS -->
    <section class="section glass projects reveal" id="projects">
        <h2>Featured Projects</h2>

        <article class="project-card reveal parallax-card">
            <a href="http://localhost/moodmate" target="_blank">Project 1 — Mood Tracking Web App</a>
            <p>A simple web application for tracking a user's mood using PHP.</p>
        </article>

        <article class="project-card reveal parallax-card">
            <a href="https://github.com/beron-sop/GR6-ROCK-PAPER-SCISSORS" target="_blank">
                Project 2 — Rock, Paper, Scissors
            </a>
            <p>A simple game web application built using HTML, CSS, and JavaScript.</p>
        </article>

        <article class="project-card reveal parallax-card">
            <a href="https://github.com/beron-sop/WaterTracker" target="_blank">Project 3 — Water Tracker App</a>
            <p>An Android application designed to track a user's daily water intake.</p>
        </article>

        <article class="project-card reveal parallax-card">
            <a href="https://github.com/beron-sop/WeatherApp" target="_blank">Project 4 — Weather App</a>
            <p>An Android application developed with Android Studio to check the weather of a specific location.</p>
        </article>
    </section>

    <!-- CONTACT -->
    <section class="section glass reveal" id="contact">
        <h2>Contact Information</h2>
        <p>Email: <b>beronjane559@gmail.com</b></p>
        <p>Phone: <b>+63912-3450-7899</b></p>

        <div class="contact-buttons">
            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=beronjane559@gmail.com"
               target="_blank"
               class="contact-btn email-btn">📧 Email Me</a>

            <a href="https://messenger.com/sopiyuh.b"
               target="_blank"
               class="contact-btn">💬 Message Me</a>
        </div>
    </section>

    <div class="footer">
        <div>© 2025</div>
        <div>My Website. All rights reserved.</div>
    </div>

    <!-- FEEDBACKS — ONLY ADMIN CAN SEE -->
    <?php if ($isAdmin): ?>
        <section class="section glass reveal" id="feedbacks">
            <h2>Visitor Feedback ⭐</h2>

            <?php if ($comments->num_rows === 0): ?>
                <p>No feedback yet.</p>

            <?php else: ?>
                <?php while ($row = $comments->fetch_assoc()): ?>
                    <div class="project-card">
                        <strong><?= htmlspecialchars($row['name']); ?></strong><br>
                        ⭐ Rating: <?= $row['rating']; ?>/5<br>
                        <p><?= htmlspecialchars($row['comment']); ?></p>
                        <small><?= $row['created_at']; ?></small>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <button id="backToTop">↑</button>

    <script src="js/home.js?v=2"></script>
</body>
</html>
