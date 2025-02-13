<?php
require_once __DIR__ . '/vendor/autoload.php';
use Web3\Web3;
use Web3\Utils;
use Web3\Providers\HttpProvider;
use kornrunner\Keccak;

$alchemyUrl = "https://eth-sepolia.g.alchemy.com/v2/0B2byj9t1i5ng3bCNn-7aQ1ckJzMK_ry";

try {
    $provider = new HttpProvider($alchemyUrl, 60);  // Timeout set to 60 seconds
    $web3 = new Web3($provider);
    echo "Web3 initialized successfully!";
} catch (Exception $e) {
    die("Failed to initialize Web3: " . $e->getMessage());
}

// Function to get Web3 instance
function getWeb3Instance() {
    global $alchemyUrl;
    $provider = new HttpProvider($alchemyUrl);
    return new Web3($provider);
}

// Function to Create a Wallet
function createWallet() {
    try {
        // Generate a new Ethereum private key
        $privateKey = bin2hex(random_bytes(32));
        
        // Derive the public key
        $publicKey = "04" . bin2hex(random_bytes(64));
        
        // Derive the Ethereum address
        $ethAddress = "0x" . substr(Keccak::hash(hex2bin($publicKey), 256), -40);
        
        return [
            "privateKey" => $privateKey,
            "publicKey" => $publicKey,
            "address" => $ethAddress
        ];
    } catch (Exception $e) {
        throw new Exception('Error creating wallet: ' . $e->getMessage());
    }
}

// Function to Get Wallet Balance
function getWalletBalance($address, $callback) {
    try {
        $web3 = getWeb3Instance();
        $web3->eth->getBalance($address, function ($err, $bal) use ($callback) {
            if ($err !== null) {
                $callback($err->getMessage(), null);
                return;
            }
            
            // Convert balance from wei to ETH
            if (is_array($bal)) {
                $bal = $bal[0]; // Get the first element if it's an array
            }
            
            try {
                $balanceInWei = (string) $bal; // Convert to string
                $balanceInEth = bcdiv($balanceInWei, "1000000000000000000", 18); // Manual conversion to ETH
                $callback(null, $balanceInEth . " ETH");
            } catch (Exception $e) {
                $callback("Error converting balance: " . $e->getMessage(), null);
            }
        });
    } catch (Exception $e) {
        $callback($e->getMessage(), null);
    }
}

// Test connection function (optional)
function testConnection($callback) {
    global $web3;
    $web3->clientVersion(function ($err, $version) use ($callback) {
        if ($err !== null) {
            $callback("Error: " . $err->getMessage(), null);
        } else {
            $callback(null, "Connected to Ethereum Client: " . $version);
        }
    });
}
?>