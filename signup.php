<?php
include 'db_config.php';
include 'wallet_functions.php';
require_once 'wallet_functions.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Username already exists.";
        } else {
            // Generate a new wallet address using the wallet function
            try {
                $walletAddress = createWallet(); // Function that generates a new wallet address
            } catch (Exception $e) {
                $error = "Error creating wallet: " . $e->getMessage();
            }

            // Hash the password before storing
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user into the database, including the wallet address
            if (!isset($error)) {
                $stmt = $conn->prepare("INSERT INTO users (name, username, password_hash, wallet) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $name, $username, $passwordHash, $walletAddress);
                if ($stmt->execute()) {
                    $_SESSION['user_id'] = $conn->insert_id;
                    $_SESSION['username'] = $username;
                    header("Location: index.php");
                    exit();
                } else {
                    $error = "Error registering user.";
                }
                $stmt->close();
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - WePay</title>
    <link rel="stylesheet" href="/WePay/css/signup.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="icon" href="images/logo_tab.png" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
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

    <!-- Sign Up Form Section -->
    <section class="form-section">
        <div class="form-container">
            <h2>Create an Account on WePay</h2>
            <form action="signup.php" method="POST">
                <div class="form-group">
                    <label for="name"><i class="fas fa-user"></i> Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="form-group">
                    <label for="username"><i class="fas fa-envelope"></i> Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password"><i class="fas fa-lock"></i> Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Account</button>
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </form>

            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

        </div>
    </section>

    <!-- Footer -->
    <footer id="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="faq.html">FAQ</a></li>
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
