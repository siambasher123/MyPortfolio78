<?php
require 'includes/db.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    $stmt = $pdo->prepare("INSERT INTO contacts (first_name, last_name, email, phone, message) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$first_name, $last_name, $email, $phone, $message]);

    $success = "Your message has been sent successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Me - My Portfolio</title>
    <link rel="stylesheet" href="assets/css/contact.css?v=<?php echo time(); ?>">
    <style>
        /* Back Button */
        .back-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            background: #0a74da;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            transition: background 0.3s, transform 0.3s;
            z-index: 9999;
        }
        .back-btn:hover {
            background: #095bb5;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<!-- Back Button -->
<a href="index.php" class="back-btn">Back</a>

<div class="container">
    <h1>Contact Me</h1>

    <div class="contact-container">
        <?php if (isset($success)) : ?>
            <div class="success-msg"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="row">
                <div class="form-group half">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="form-group half">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone">
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Send Message</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
