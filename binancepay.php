<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

/**
 * Binance Pay Module for WHMCS.
 * @copyright Copyright (c) AppVZ
 * @license https://appvz.com, https://github.com/appvz/Binance-Pay-Module-for-WHMCS
 */

function binancepay_MetaData()
{
    return array(
        'DisplayName' => 'Binance Pay',
        'APIVersion' => '1.1', // Use API version 1.1
    );
}

function binancepay_config()
{
    return array(
        'FriendlyName' => array(
            'Type' => 'System',
            'Value' => 'Binance Pay',
        ),
        'merchantId' => array(
            'FriendlyName' => 'Merchant ID',
            'Type' => 'text',
            'Size' => '25',
            'Default' => '',
            'Description' => 'Enter your Binance Merchant ID here',
        ),
        'apiKey' => array(
            'FriendlyName' => 'API Key',
            'Type' => 'password',
            'Size' => '25',
            'Default' => '',
            'Description' => 'Enter your Binance API Key here',
        ),
        'apiSecret' => array(
            'FriendlyName' => 'API Secret',
            'Type' => 'password',
            'Size' => '25',
            'Default' => '',
            'Description' => 'Enter your Binance API Secret here',
        ),
    );
}

function binancepay_link($params)
{
    $merchantId = $params['merchantId'];
    $apiKey = $params['apiKey'];
    $apiSecret = $params['apiSecret'];
    $invoiceId = $params['invoiceid'];
    $amount = $params['amount'];
    $currency = $params['currency'];
    $description = $params['description'];

    $postfields = array(
        'merchantId' => $merchantId,
        'apiKey' => $apiKey,
        'apiSecret' => $apiSecret,
        'invoiceId' => $invoiceId,
        'amount' => $amount,
        'currency' => $currency,
        'description' => $description,
    );

    $htmlOutput = '<form method="post" action="https://api.binance.com/pay/gateway">';
    foreach ($postfields as $key => $value) {
        $htmlOutput .= '<input type="hidden" name="' . $key . '" value="' . $value . '">';
    }
    $htmlOutput .= '<input type="submit" value="Pay with Binance Pay">';
    $htmlOutput .= '</form>';

    return $htmlOutput;
}
