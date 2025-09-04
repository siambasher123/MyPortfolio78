<?php
require 'includes/db.php';

// Counter for numbering
$counter = 1;

// Inline CSS for About page
echo '<style>
:root {
    --accent: #0a74da;
    --bg: #121212;
    --card-bg: #1e1e1e;
    --text: #fff;
    --text-muted: #ccc;
}

body {
    background: var(--bg);
    font-family: "Poppins", sans-serif;
    margin: 0;
    padding: 0;
    color: var(--text);
}

.about-section {
    max-width: 1200px;
    margin: 50px auto;
    padding: 0 20px;
    display: flex;
    gap: 50px;
    align-items: flex-start;
    flex-wrap: wrap;
}

/* Left Column: About Cards */
.about-cards-container {
    flex: 2 1 650px;
}

.about-card {
    background: var(--card-bg);
    padding: 20px 25px; /* smaller padding for compact boxes */
    margin-bottom: 20px;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.5);
    transition: transform 0.3s, box-shadow 0.3s;
    opacity: 0;
    transform: translateY(30px);
}

.about-card.visible {
    opacity: 1;
    transform: translateY(0);
}

.about-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.6);
}

.about-card h2 {
    display: inline-block;       /* Makes the underline match text width */
    position: relative;
    padding-bottom: 6px;         /* space for underline */
    color: #f0f0f0;              /* light gray text */
    font-weight: 700;
    font-size: 1.8rem;
    margin-bottom: 10px;
}

/* Underline only under text */
.about-card h2::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;                  /* underline matches text width */
    height: 4px;
    background: linear-gradient(120deg, #ff6b6b, #f5c518, #0a74da, #ff6b6b); /* vibrant gradient */
    border-radius: 4px;
}

.about-card p {
    font-size: 1rem;
    line-height: 1.5;
    color: var(--text-muted);
}

/* Right Column: GIF */
.about-gif-container {
    flex: 1 1 350px;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    margin-top: 50px;
}

.about-gif-container img {
    width: 100%;
    max-width: 280px;
    border-radius: 16px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.5);
    animation: float 4s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

/* Back Button */
.back-btn {
    position: fixed;
    top: 20px;
    left: 20px;
    background: var(--accent);
    color: #fff;
    padding: 12px 24px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    box-shadow: 0 6px 20px rgba(0,0,0,0.5);
    transition: background 0.3s, transform 0.3s;
    z-index: 9999;
}
.back-btn:hover {
    background: #095bb5;
    transform: translateY(-2px);
}

/* Responsive */
@media(max-width: 1000px) {
    .about-section { flex-direction: column; }
    .about-gif-container { margin-top: 30px; align-items: center; }
}
</style>';
?>

<!-- Back Button -->
<a href="index.php" class="back-btn">Back</a>

<section class="about-section">
    <!-- Left Column: About Cards -->
    <div class="about-cards-container">
        <?php
        $stmt = $pdo->query("SELECT * FROM about_info ORDER BY created_at DESC");
        $abouts = $stmt->fetchAll();
        ?>
        <?php foreach($abouts as $about): ?>
            <div class="about-card">
                <h2 data-number="<?= $counter; ?>"><?= htmlspecialchars($about['title']); ?></h2>
                <p><?= nl2br(htmlspecialchars($about['description'])); ?></p>
            </div>
            <?php $counter++; ?>
        <?php endforeach; ?>
    </div>

    <!-- Right Column: Floating GIF -->
    <div class="about-gif-container">
        <img src="assets/images/about.gif" alt="About GIF">
    </div>
</section>

<!-- Scroll animation -->
<script>
const cards = document.querySelectorAll(".about-card");
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if(entry.isIntersecting) {
            entry.target.classList.add("visible");
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.2 });

cards.forEach(card => observer.observe(card));
</script>
