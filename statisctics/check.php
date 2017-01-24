<?php
//Gets the total of processing orders
//Will be displayed by processing.html via AJAX

require_once '../app/Mage.php';
Mage::app();
umask(0);

$fromDate = date('Y-m-d H:i:s', strtotime("-1 week")); //in our case one week, because otherwise backorders are counted aswell
$toDate = date('Y-m-d H:i:s', strtotime("now"));


$processingOrders = Mage::getModel('sales/order')->getCollection()
        ->addFieldToFilter('state', 'processing') 
        ->addAttributeToFilter('created_at', array('from'=>$fromDate, 'to'=>$toDate))
        ->addAttributeToSelect('created_at');
        
echo $processingOrders->count();
