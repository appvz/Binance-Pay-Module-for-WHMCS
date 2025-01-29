<?php

/**
 * Binance Pay Module for WHMCS.
 * @copyright Copyright (c) AppVZ
 * @license https://appvz.com, https://github.com/appvz/Binance-Pay-Module-for-WHMCS
 */

require_once '../../../init.php';
require_once '../../../includes/gatewayfunctions.php';
require_once '../../../includes/invoicefunctions.php';

$gatewayModuleName = 'binancepay';
$gatewayParams = getGatewayVariables($gatewayModuleName);

if (!$gatewayParams['type']) {
    die("Module Not Activated");
}

$invoiceId = $_POST['invoiceId'];
$transactionId = $_POST['transactionId'];
$paymentAmount = $_POST['amount'];

$invoiceId = checkCbInvoiceID($invoiceId, $gatewayParams['name']);
checkCbTransID($transactionId);

addInvoicePayment($invoiceId, $transactionId, $paymentAmount, 0, $gatewayModuleName);

logTransaction($gatewayParams['name'], $_POST, "Successful");
