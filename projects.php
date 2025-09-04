<?php
require 'includes/db.php';

// Fetch all projects
$stmt = $pdo->query("SELECT * FROM projects1 ORDER BY created_at DESC");
$projects = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Projects</title>
<link rel="stylesheet" href="/myportfolio/assets/style.css?v=<?= time(); ?>">
<style>
body {
    background: #0d0d0d; /* Match homepage */
    color: #fff;
    font-family: 'Poppins', sans-serif;
    margin:0;
    padding:0;
}

/* Back Button */
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
    box-shadow: 0 6px 20px rgba(0,0,0,0.5);
    transition: background 0.3s, transform 0.3s;
    z-index: 9999;
}
.back-btn:hover { background:#5146d9; transform: translateY(-2px); }

h1 {
    text-align: center;
    margin: 80px 0 40px;
    font-size: 2.2rem;
    color: #6c63ff;
}

/* Projects Grid */
.projects-container {
    max-width: 1200px;
    margin: 0 auto 60px;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
    padding: 0 20px;
}

.project-card {
    background: #1a1a1a;
    border-radius: 12px;
    overflow: hidden;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.project-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.5);
}

/* Title in Blue */
.project-card h2 {
    font-size: 1.2rem;
    margin: 12px 0 8px 0;
    color: #6c63ff; /* Blue title */
    text-transform: capitalize;
}

/* Project Images */
.project-card img {
    width: 100%;
    height: 266px;
    object-fit: cover;
    cursor: pointer;
    transition: opacity 0.3s ease;
}
.project-card img:hover { opacity: 0.85; }

.no-image {
    padding: 60px 0;
    color: #bbb;
    font-size: 0.95rem;
}

/* GitHub Button */
.project-card .github-btn {
    margin-bottom: 15px;
    padding: 10px 20px;
    background: #6c63ff;
    color: #fff;
    text-decoration: none;
    font-weight: 600;
    border-radius: 6px;
    transition: background 0.3s;
}
.project-card .github-btn:hover { background: #5146d9; }

/* Responsive */
@media(max-width: 1000px) { .projects-container { grid-template-columns: repeat(2, 1fr); } }
@media(max-width: 700px) { .projects-container { grid-template-columns: 1fr; } }
</style>
</head>
<body>

<a href="index.php" class="back-btn">← Back</a>
<h1>My Projects</h1>

<div class="projects-container">
    <?php foreach ($projects as $project): ?>
        <div class="project-card">
            <?php if (!empty($project['image'])): ?>
                <a href="project_details.php?id=<?= $project['id'] ?>">
                    <img src="uploads/<?= htmlspecialchars($project['image']) ?>" alt="<?= htmlspecialchars($project['title']) ?>">
                </a>
            <?php else: ?>
                <div class="no-image">No image available</div>
            <?php endif; ?>

            <h2><?= htmlspecialchars($project['title']) ?></h2>

            <?php if (!empty($project['git_link'])): ?>
                <a href="<?= htmlspecialchars($project['git_link']) ?>" target="_blank" class="github-btn">Go to GitHub</a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
