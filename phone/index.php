<?php
//Load up Magento
require_once '../app/Mage.php';
Mage::app();
umask(0);


//SETTINGS
$apikey         = "9rxP28m90F64oLAJ7dM4Qxy05q9bQXWm";
$phonenumber    = htmlspecialchars($_GET["phonenumber"]);
$leavecomment   = 1; //1 for yes, 0 for no
$comment        = "Customer called!";
$adminurl       = "https://www.magentoadminurl.com/admin";
$time           = date('H:i:s', time());

//If invalid API Key, 404.
//If no AdminHTML cookie, 404
//Not 100% secure, but enough for our purpose
//You need to be logged in in the admin to view the order
//So only thing they can get is OrderID from a phonenumber, IF they know this page.

if($apikey != $_POST["apikey"]){
    header("HTTP/1.1 404 Not Found");
    header("Location: /404.php" );
    die();
}
$sesId = isset($_COOKIE['adminhtml']) ? $_COOKIE['adminhtml'] : false ;
if(!$sesId){
   header("HTTP/1.1 404 Not Found");
   header("Location: /404.php" );
   die();
}


//Get order by order address phonenumber
$address = Mage::getModel('sales/order_address')->getCollection()->addAttributeToFilter('telephone', $phonenumber)->getLastItem();

$order = Mage::getModel('sales/order')->getCollection()
    ->addFieldToFilter('shipping_address_id', $address->getId())
    ->addAttributeToSelect('*')->getLastItem()
    ;


if(!$order->getId()){
     //Close window if order not found
    //Not ideal, since it will pull you away from your current tab
    //Pull request with a better solution will get you a virtual cookie
    if($_GET["exe"] != 1){
    echo "<script>window.close();</script>";
    }
    die();
} else {
    //Leave comment in Admin, dont notify customer
    if($leavecomment){
        $history = $order->addStatusHistoryComment($comment , false);
        $history->setIsCustomerNotified(false);
        $order->save();
    }
    
    //Redirect to admin sales page
    if($_GET["exe"] == 1){
        echo $adminurl . "/sales_order/view/order_id/". $order->getId() . "/";
    }
    header("Location: " . $adminurl . "/sales_order/view/order_id/". $order->getId() . "/");
    die();
}
