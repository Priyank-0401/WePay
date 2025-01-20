<?php
session_start();
include 'db_config.php';
include 'wallet_functions.php';  // Include wallet functions

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch user details from the database
$stmt = $conn->prepare("SELECT wallet_address FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($walletAddress);
$stmt->fetch();
$stmt->close();

// Get the balance for the user's wallet address
$balance = getWalletBalance($walletAddress);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions - WePay</title>
</head>
<body>
    <h1>Your Transactions</h1>
    <p>Wallet Address: <?= $walletAddress; ?></p>
    <p>Balance: <?= $balance; ?> wei</p>
    
    <!-- You can display a list of transactions here once the transaction feature is added -->
    
    <footer>
        <p>&copy; 2025 WePay. All rights reserved.</p>
    </footer>
</body>
</html>
