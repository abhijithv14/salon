<?php
$pageTitle = "About Us | Nandhu's Beauty Salon";
$pageDescription = "Learn the story behind Nandhu's Beauty Salon — our mission, vision, and why we're the most trusted luxury salon.";
$currentPage = 'about';
require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/">Home</a> <span>›</span> <span>About Us</span></div>
        <h1>Our Story</h1>
        <p>Passion, artistry, and love for beauty — the heart of everything we do.</p>
    </div>
</section>

<!-- Story Section -->
<section style="background: var(--white);">
    <div class="container">
        <div class="about-story">
            <div class="about-img-box">🌸</div>
            <div class="about-content">
                <span class="section-tag">Who We Are</span>
                <h2>Born from a Love of Beauty</h2>
                <p>Nandhu's Beauty Salon was founded with a simple yet powerful vision — to create a sanctuary where every woman feels celebrated, pampered, and beautiful. What began as a small, passionate team has grown into one of the most trusted luxury salons in the region.</p>
                <p>With over 6 years of experience, we've had the privilege of creating thousands of beautiful moments — from everyday glam to once-in-a-lifetime bridal transformations. Our expert team stays ahead of trends through continuous training and a deep commitment to their craft.</p>
                <p>At Nandhu's, we believe beauty is not just about looks — it's about how you feel. Every treatment is designed to nurture your confidence and let your inner radiance shine through.</p>
                <a href="/booking.php" class="btn btn-primary" style="margin-top:12px;">Book Your Experience</a>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section style="background:var(--gray-100);">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Our Purpose</span>
            <h2>Mission &amp; Vision</h2>
            <div class="divider"></div>
        </div>
        <div class="mission-grid">
            <div class="mission-card">
                <div class="mission-icon">🎯</div>
                <h3>Our Mission</h3>
                <p>To deliver exceptional beauty experiences that celebrate individuality. We combine premium products, skilled artistry, and warm hospitality to make every client feel extraordinary.</p>
            </div>
            <div class="mission-card">
                <div class="mission-icon">🌟</div>
                <h3>Our Vision</h3>
                <p>To be the most loved and trusted beauty destination — a brand synonymous with luxury, innovation, and genuine care for every woman who walks through our doors.</p>
            </div>
            <div class="mission-card">
                <div class="mission-icon">💎</div>
                <h3>Our Values</h3>
                <p>Excellence in every treatment. Transparency in pricing. Hygiene above all. Continuous learning. And most importantly — making you feel like the most beautiful version of yourself.</p>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section style="background:var(--white);">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Why Nandhu's</span>
            <h2>Why Choose Us?</h2>
            <div class="divider"></div>
            <p>Hundreds of clients trust us every month. Here's what makes the difference.</p>
        </div>
        <div class="why-grid">
            <div class="why-item"><div class="icon">👩‍🎨</div><h4>Expert Artists</h4><p>Certified professionals with 5+ years experience each.</p></div>
            <div class="why-item"><div class="icon">✨</div><h4>Premium Products</h4><p>International brands only — safe, tested, and effective.</p></div>
            <div class="why-item"><div class="icon">🧴</div><h4>Hygienic Standards</h4><p>Single-use tools, sterilised equipment, immaculate space.</p></div>
            <div class="why-item"><div class="icon">📱</div><h4>Easy Booking</h4><p>Book online 24/7 — no calls, no waiting.</p></div>
            <div class="why-item"><div class="icon">💬</div><h4>Personalised Care</h4><p>Every treatment tailored to your unique needs.</p></div>
            <div class="why-item"><div class="icon">⭐</div><h4>500+ Happy Clients</h4><p>Our 5-star reviews speak for themselves.</p></div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <h2>Experience the Nandhu's Difference</h2>
        <p>Join hundreds of happy clients who've made us their beauty home.</p>
        <a href="/booking.php" class="btn btn-outline-white">Book Your Appointment ✨</a>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
