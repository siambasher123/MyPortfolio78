<?php
session_start(); // Start the session at the very top of the file
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="stylesheet" href="/myportfolio/assets/css/style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        /* Visit Info Box */
        .visit-info {
            margin: 20px 0;
            padding: 15px 20px;
            background: #111; /* Dark background */
            border-left: 4px solid #555; /* Gray accent */
            border-radius: 8px;
            max-width: 500px;
            font-family: 'Poppins', sans-serif;
        }
        .visit-info p {
            font-size: 1.1rem;
            color: #fff;
            margin: 8px 0;
            font-weight: 600; /* Bold */
        }
    </style>
</head>

<body>

<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-text">
        <h1>Hey, I'm <span id="typed-name">Srabon</span></h1>
        <p>I’m a Web developer & I’m very passionate and dedicated to my work. 
        I have acquired the skills and knowledge necessary to make your project a success.</p>
        <a href="#" class="btn">About Me</a>
    </div>

    <div class="hero-image">
        <img src="assets/images/profile.gif" alt="Hevin GIF">
    </div>
</section>

<!-- Visit Info Section -->
<div class="visit-info">
<?php
// --- COOKIE: Visit Counter ---
if (!isset($_COOKIE['visits'])) {
    $visits = 1;
} else {
    $visits = (int)$_COOKIE['visits'] + 1;
}
setcookie('visits', $visits, time() + (30 * 24 * 60 * 60), "/");

// --- SESSION: Last Visit Time ---
if (isset($_SESSION['last_visit'])) {
    echo "<p><strong>Your last visit was on:</strong> " . $_SESSION['last_visit'] . "</p>";
} else {
    echo "<p><strong>This is your first session visit!</strong></p>";
}
$_SESSION['last_visit'] = date("d M Y, h:i A");

// --- Welcome Message ---
if ($visits === 1) {
    echo "<p><strong>Welcome!</strong> This is your first visit.</p>";
} elseif ($visits === 2) {
    echo "<p><strong>Welcome back!</strong> This is your second visit.</p>";
} elseif ($visits === 3) {
    echo "<p><strong>Welcome back!</strong> This is your third visit.</p>";
} else {
    echo "<p><strong>Welcome back!</strong> You have visited $visits times.</p>";
}
?>
</div>

<!-- Info Section -->
<section class="info">
    <div class="info-item">
        <h3>Born In</h3>
        <p>Dhaka</p>
    </div>
    <div class="info-item">
        <h3>Experience</h3>
        <p>2+ Years</p>
    </div>
    <div class="info-item">
        <h3>Date of Birth</h3>
        <p>16 August 2001</p>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/main.js?v=<?php echo time(); ?>"></script>

</body>
</html>
