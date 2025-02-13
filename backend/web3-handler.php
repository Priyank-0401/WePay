<?php
require_once 'vendor/autoload.php';  // Load the Composer autoload file
use Web3\Web3;

$alchemyUrl = "https://eth-sepolia.g.alchemy.com/v2/0B2byj9t1i5ng3bCNn-7aQ1ckJzMK_ry";
$web3 = new Web3($alchemyUrl);

// Function to fetch the latest block number (for testing the connection)
function getLatestBlock() {
    global $web3;
    $web3->eth->getBlockNumber(function ($err, $block) {
        if ($err !== null) {
            echo "Error: " . $err->getMessage();
            return;
        }
        echo "Current Block Number: " . $block;
    });
}

// Test connection by fetching the latest block
getLatestBlock();
?>
