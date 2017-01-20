<?php
$phonenumber = htmlspecialchars($_POST["postalcode"]);

date_default_timezone_set('Europe/Amsterdam');
$tijd = date('H:i:s', time());
require_once '../app/Mage.php';
Mage::app();
umask(0);


$CustomAddress = Mage::getModel('sales/order_address')->getCollection()->addAttributeToFilter('telephone', $phonenumber)->getLastItem();


$orders = Mage::getModel('sales/order')->getCollection()
    ->addFieldToFilter('shipping_address_id', $CustomAddress->getId())
    ->addAttributeToSelect('*')
    ;


foreach ($orders as $order) {

if($_GET["opnemer"] == '203'){
$_GET["opnemer"] = "Ruthger";
} else if($_GET["opnemer"] == '207'){
$_GET["opnemer"] = "Rita";
} else if($_GET["opnemer"] == '202'){
$_GET["opnemer"] = "Kantoor 2";
} else if($_GET["opnemer"] == '201'){
$_GET["opnemer"] = "Kantoor 1";
} 




$laatste = $order->getId();
$history = $order->addStatusHistoryComment('Klant belde, opgenomen door ' . $_GET["opnemer"] , false);
$history->setIsCustomerNotified(false);

$order->save();

break;
}


if($laatste){
header("Location: http://www.witjesverzendhuis.com/index.php/beheer/sales_order/view/order_id/". $laatste . "/");
die();
} else {

    echo "<script>window.close();</script>";

}
