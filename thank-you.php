<?php
$pageTitle = "Booking Confirmed | Nandhu's Beauty Salon";
$currentPage = '';
require_once __DIR__ . '/includes/header.php';
?>
<section class="thankyou-section">
    <div class="container">
        <div class="thankyou-box">
            <div class="thankyou-icon">🌸</div>
            <h1>Booking Received!</h1>
            <p>Thank you for booking with <strong>Nandhu's Beauty Salon</strong>. We've received your appointment request and will confirm it shortly.</p>
            <p>A confirmation email has been sent to your inbox. Please check your spam folder if you don't see it.</p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-top:8px;">
                <a href="/" class="btn btn-secondary">🏠 Back to Home</a>
                <a href="/services.php" class="btn btn-primary">✨ Explore Services</a>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
