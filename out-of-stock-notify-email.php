<?php
//Hacky a.f. 
//Generates an e-mail to a given e-mail address with the products that went out of stock yesterday

//Just setup a cronjob to this file. 

//The safest way is to put it outside the web root directory
//You can put it in an public folder (for example: /scripts) and put this in your .htaccess:
//Order deny,allow
//Deny from all



//SETTINGS
$since      = strtotime('yesterday'); //Speaks for itself
$mailto     = "mail@mailprovider.com";
$mailfrom   = "mail@mailprovider.com";
$adminurl   = "https://www.youradmin/admin";
$subject    = 'Products out of stock';

date_default_timezone_set('Europe/Amsterdam'); //Change to your own needs

//End of settings

require_once '../app/Mage.php'; //Location of App/Mage.php

Mage::app(); //Load magento

$outOfStockItems = Mage::getModel('cataloginventory/stock_item')
    ->getCollection()
    ->addFieldToFilter('is_in_stock', 0)
    ->addFieldToFilter('low_stock_date', array('date' => true, 'from' => date("Y-m-d", $since)))
;

//Start email message
$message = '<html><body>';
$message .= '<h1>Out of stock:</h1>';


foreach ($outOfStockItems as $item) {
    $product = Mage::getModel('catalog/product')->load($item->getOrigData('product_id'));
    $message .= '<a href="' . $adminurl . '/catalog_product/edit/id/' . $product->getId() . '/"><strong>' .   $product->getName() . ' </strong></a> | SKU:  ' . $product->getSku() . '<br>';
}


$headers = "From: " . $mailto . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message .= '</body></html>';
if(count($outOfStockItems) > 0) {
    mail($mailto, $subject, $message, $headers);
} //Only mail if 1 or more 

