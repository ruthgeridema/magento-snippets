<?php

//SETTINGS
$phonenumber    = htmlspecialchars($_POST["postalcode"]);
$leavecomment   = 1; //1 for yes, 0 for no
$comment        = "Customer called!";
$adminurl       = "https://magentoadmin.com/admin";
$time           = date('H:i:s', time());


require_once '../app/Mage.php';
Mage::app();
umask(0);


$CustomAddress = Mage::getModel('sales/order_address')->getCollection()->addAttributeToFilter('telephone', $phonenumber)->getLastItem();

$orders = Mage::getModel('sales/order')->getCollection()
    ->addFieldToFilter('shipping_address_id', $CustomAddress->getId())
    ->addAttributeToSelect('*')
    ;

foreach ($orders as $order) {
    $laatste = $order->getId();
    $history = $order->addStatusHistoryComment($comment , false);
    $history->setIsCustomerNotified(false);
    $order->save();
    break;
}


if($laatste){
    header("Location: " . $adminurl . "/sales_order/view/order_id/". $laatste . "/");
    die();
} else {
    echo "<script>window.close();</script>";
}
