<?php
require 'includes/db.php';

// Check for project ID
if (!isset($_GET['id'])) {
    header("Location: projects.php");
    exit;
}

$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM projects1 WHERE id = ?");
$stmt->execute([$id]);
$project = $stmt->fetch();

if (!$project) {
    echo "Project not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($project['title']) ?></title>
<link rel="stylesheet" href="/myportfolio/assets/style.css?v=<?= time(); ?>">
<style>
body {
    background: #0d0d0d;
    color: #fff;
    font-family: 'Poppins', sans-serif;
    margin:0;
    padding:0;
}

.back-btn {
    position: fixed;
    top: 20px;
    left: 20px;
    background: #6c63ff;
    color: #fff;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    z-index: 9999;
    transition: 0.3s;
}
.back-btn:hover { background: #5146d9; transform: translateY(-2px); }

.project-details {
    max-width: 900px;
    margin: 80px auto;
    padding: 0 20px;
    text-align: center;
    background: #1a1a1a;
    border-radius: 16px;
    padding: 40px 30px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.5);
}

.project-details h1 {
    font-size: 2rem;
    color: #6c63ff;
    margin-bottom: 30px;
}

.project-details p {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #ccc;
    margin-bottom: 40px;
    text-align: justify;
}

.project-details a.github-btn {
    display: inline-block;
    margin-top: 10px;
    padding: 14px 28px;
    background: #6c63ff;
    color: #fff;
    text-decoration: none;
    font-weight: 700;
    border-radius: 8px;
    transition: 0.3s;
}
.project-details a.github-btn:hover { background: #5146d9; }
</style>
</head>
<body>

<a href="projects.php" class="back-btn">← Back</a>

<div class="project-details">
    <h1><?= htmlspecialchars($project['title']) ?></h1>
    <p><?= nl2br(htmlspecialchars($project['description'])) ?></p>
    <?php if (!empty($project['git_link'])): ?>
        <a href="<?= htmlspecialchars($project['git_link']) ?>" target="_blank" class="github-btn">Go to GitHub</a>
    <?php endif; ?>
</div>

</body>
</html>
