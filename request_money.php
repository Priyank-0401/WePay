<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Request Money Securely with WePay Blockchain">
    <title>WePay - Request Money</title>
    <link rel="stylesheet" href="/WePay/css/request_money.css">
    <link rel="icon" href="images/logo_tab.png" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
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
            </ul>
        </div>
    </nav>

    <div class="page-container">
        <section class="request-money-section">
            <div class="header-section">
                <h1>Request Money</h1>
                <p class="subtitle">Request funds securely using blockchain technology</p>
            </div>

            <div class="form-container">
                <div class="form-header">
                    <i class="fas fa-hand-holding-usd"></i>
                    <h2>Payment Request Details</h2>
                </div>

                <form action="/request_money_action" method="POST" class="request-money-form">
                    <div class="form-group">
                        <label for="payer">
                            <i class="fas fa-user"></i> Payer's Email or Wallet Address
                        </label>
                        <input type="text" id="payer" name="payer" 
                               placeholder="Enter payer's email or wallet address" required>
                    </div>

                    <div class="form-group">
                        <label for="amount">
                            <span id="currency-symbol">
                                <i class="fas fa-rupee-sign"></i> <!-- Default to INR -->
                            </span>
                            Amount
                        </label>
                        <div class="amount-input-container">
                            <input type="number" id="amount" name="amount" 
                                   placeholder="0.00" step="0.01" required>
                            <select id="currency" name="currency">
                                <option value="INR" selected>INR</option>
                                <option value="USD">USD</option>
                            </select>
                        </div>
                    </div>
                    
                    <script>
                        const currencySelect = document.getElementById("currency");
                        const currencySymbol = document.getElementById("currency-symbol");
                    
                        // Update currency symbol based on selection
                        currencySelect.addEventListener("change", function() {
                            const selectedCurrency = currencySelect.value;
                            
                            if (selectedCurrency === "INR") {
                                currencySymbol.innerHTML = '<i class="fas fa-rupee-sign"></i>'; // INR symbol
                            } else if (selectedCurrency === "USD") {
                                currencySymbol.innerHTML = '<i class="fas fa-dollar-sign"></i>'; // USD symbol
                            }
                        });
                    </script>
                    

                    <div class="form-group">
                        <label for="purpose">
                            <i class="fas fa-clipboard"></i> Purpose (Optional)
                        </label>
                        <textarea id="purpose" name="purpose" 
                                placeholder="Enter the reason for this request"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="due-date">
                            <i class="fas fa-calendar"></i> Due Date (Optional)
                        </label>
                        <input type="date" id="due-date" name="due-date">
                    </div>

                    <div class="security-info">
                        <i class="fas fa-shield-alt"></i>
                        <p>Your request is protected by blockchain technology</p>
                    </div>

                    <button type="submit">
                        <i class="fas fa-paper-plane"></i> Send Request
                    </button>
                </form>
            </div>
        </section>
    </div>

    <footer id="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="features.html">Features</a></li>
                    <li><a href="security.html">Security</a></li>
                    <li><a href="contact.html">Contact</a></li>
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