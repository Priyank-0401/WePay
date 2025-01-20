<?php
include 'db_config.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user inputs and sanitize
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Sanitize username to prevent XSS
    $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
    
    // Prepare and execute query to check if user exists
    $stmt = $conn->prepare("SELECT id, password_hash FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // If user exists, verify the password
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password_hash);
        $stmt->fetch();

        // Verify the password with the hash in the database
        if (password_verify($password, $password_hash)) {
            // Set session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;

            // Redirect to the homepage or protected page
            header("Location: index.php");
            exit();
        } else {
            // Password is incorrect
            $error = "Invalid username or password.";
        }
    } else {
        // User doesn't exist
        $error = "User not found.";
    }

    // Close the statement
    $stmt->close();
}

// Include the login form and display error if exists
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WePay</title>
    <link rel="stylesheet" href="/WePay/css/signup.css">
    <link rel="stylesheet" href="/css/home.css"> <!-- Ensures consistent color scheme -->
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

    <!-- Login Form Section -->
    <section class="form-section">
        <div class="form-container">
            <h2>Login to WePay</h2>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="username"><i class="fas fa-envelope"></i> Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
            </form>

            <!-- Display the error message if exists -->
            <?php if (isset($error)): ?>
                <p style="color:red; text-align:center;"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
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
