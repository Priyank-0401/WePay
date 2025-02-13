<?php
require __DIR__ . '/vendor/autoload.php';

use Web3\Web3;

function getWeb3Instance() {
    return new Web3('http://127.0.0.1:7545');
}

function createWallet() {
    try {
        $web3 = getWeb3Instance();
        
        // Create a promise to handle the async call
        $result = null;
        $error = null;
        
        $web3->eth->accounts(function($err, $accounts) use (&$result, &$error) {
            if ($err !== null) {
                $error = $err->getMessage();
                return;
            }
            
            if (empty($accounts)) {
                $error = 'No accounts found in Ganache';
                return;
            }
            
            $result = $accounts[0];
        });
        
        if ($error !== null) {
            throw new Exception($error);
        }
        
        if ($result === null) {
            throw new Exception('Failed to get account from Ganache');
        }
        
        return $result;
    } catch (Exception $e) {
        throw new Exception('Error creating wallet: ' . $e->getMessage());
    }
}

// Add a function to check balance
function getWalletBalance($address) {
    try {
        $web3 = getWeb3Instance();
        
        $balance = null;
        $error = null;
        
        $web3->eth->getBalance($address, function($err, $bal) use (&$balance, &$error) {
            if ($err !== null) {
                $error = $err->getMessage();
                return;
            }
            $balance = $bal;
        });
        
        if ($error !== null) {
            throw new Exception($error);
        }
        
        return $balance;
    } catch (Exception $e) {
        throw new Exception('Error getting balance: ' . $e->getMessage());
    }
}