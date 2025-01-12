<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="WePay - Secure and seamless blockchain transactions">
    <title>WePay - Secure Blockchain Transactions</title>
    <link rel="stylesheet" href="/WePay/css/home.css">
    <link rel="icon" href="images/logo_tab.png" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<?php
    session_start(); // Start the session to check login status
?>

    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <a href="index.php">
                    <img src="images/logo.png" alt="WePay Logo">
                </a>
            </div>
            <ul class="menu">
                <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="transactions.php"><i class="fas fa-exchange-alt"></i> Transactions</a></li>
                <li><a href="#footer"><i class="fas fa-envelope"></i> Contact</a></li>

                <?php if (!isset($_SESSION['user_id'])): ?>
                    <!-- Display Login and Sign Up options if user is not logged in -->
                    <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                    <li><a href="signup.php"><i class="fas fa-user-plus"></i> Sign Up</a></li>
                <?php else: ?>
                    <!-- Display Logout option if user is logged in -->
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>


    <section class="hero">
        <div class="hero-content">
            <h1>Secure Blockchain Transactions Made Simple</h1>
            <p>Experience the future of digital payments with WePay's blockchain technology. Fast, secure, and reliable transactions at your fingertips.</p>
            <div class="cta-buttons">
                <a href="send_money.php" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Send Money
                </a>
                <a href="request_money.php" class="btn btn-secondary">
                    <i class="fas fa-hand-holding-usd"></i> Request Money
                </a>
            </div>
        </div>
    </section>

    <section class="features">
        <h2>Why Choose WePay?</h2>
        <div class="feature-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Blockchain Security</h3>
                <p>Advanced encryption and blockchain technology ensuring your transactions are always secure.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3>Instant Transfers</h3>
                <p>Lightning-fast transactions processed within seconds, anywhere in the world.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>Smart Analytics</h3>
                <p>Track your spending patterns and manage your transactions with detailed insights.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <h3>Digital Wallet</h3>
                <p>Store and manage multiple currencies in your secure digital wallet.</p>
            </div>
        </div>
    </section>

    <section class="recent-transactions">
        <h2>Recent Transactions</h2>
        <div class="transaction-grid">
            <div class="transaction-card outgoing">
                <div class="transaction-icon">
                    <i class="fas fa-arrow-up"></i>
                </div>
                <div class="transaction-details">
                    <h3>Sent to John Doe</h3>
                    <p class="timestamp">2 minutes ago</p>
                    <p class="amount">-$500.00</p>
                </div>
            </div>
            <div class="transaction-card incoming">
                <div class="transaction-icon">
                    <i class="fas fa-arrow-down"></i>
                </div>
                <div class="transaction-details">
                    <h3>Received from Jane Smith</h3>
                    <p class="timestamp">1 hour ago</p>
                    <p class="amount">+$200.00</p>
                </div>
            </div>
            <div class="transaction-card outgoing">
                <div class="transaction-icon">
                    <i class="fas fa-arrow-up"></i>
                </div>
                <div class="transaction-details">
                    <h3>Sent to Alice Johnson</h3>
                    <p class="timestamp">3 hours ago</p>
                    <p class="amount">-$150.00</p>
                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="faq.html">FAQ</a></li>
                    <li><a href="privacy.html">Privacy Policy</a></li>
                    <li><a href="terms.html">Terms of Service</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <div class="social-links">
                    <a href="https://github.com/Priyank-0401"><i class="fab fa-github"></i></a>
                    <a href="https://www.instagram.com/priyank.0401/"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 WePay. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
