<?php
require_once 'wallet_functions.php';

// Test Wallet Creation
$wallet = createWallet();
echo "🔹 Wallet Created:\n";
echo "Private Key: " . $wallet['privateKey'] . "\n";
echo "Public Key: " . $wallet['publicKey'] . "\n";
echo "Ethereum Address: " . $wallet['address'] . "\n";

$testAddress = "0xad64660E506a02960FD9D1EaCF00d1Dac681A183";
getWalletBalance($testAddress, function ($err, $balance) {
    if ($err) {
        echo "❌ Error: " . $err . "\n";
    } else {
        echo "💰 Wallet Balance: " . $balance . "\n";
    }
});
?>