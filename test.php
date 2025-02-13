<?php
require_once __DIR__ . '/wallet_functions.php';

try {
    echo "Testing Ganache connection...\n";
    
    // Try to create a wallet
    $address = createWallet();
    echo "Successfully got wallet address: " . $address . "\n";
    
    // Try to get balance
    $balance = getWalletBalance($address);
    echo "Wallet balance: " . $balance . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}