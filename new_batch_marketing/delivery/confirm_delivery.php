

<?php


session_start();
date_default_timezone_set('Etc/GMT+8');

$delivery_id = $_SESSION['delivery_id'];
$orders = $_SESSION['order'];
$date = date('Y-m-d');
$customer_order_id = '';
$product_code = '';
$quantity = '';
$amount = '';
$selling_price = '';
$total = '';
$count = '';
$customer_name = '';
$order_date = '';
$delivery_date = '';
$poid = '';
$_SESSION['order'] = '';
$delivered_by = $_SESSION['user'];
$order_id = '';

require("C:\\xampp\htdocs\\new_batch_marketing\bootstrap.css");
require("C:\\xampp\htdocs\\new_batch_marketing\bootstrap.min.css");
require("C:\\xampp\htdocs\\new_batch_marketing\landing-page.css");
require("C:\\xampp\htdocs\\new_batch_marketing\dbOption\Db.class.php");
require("C:\\xampp\htdocs\\new_batch_marketing\methods.php");
require("C:\\xampp\htdocs\\new_batch_marketing\modal.css");

    
    echo'<title>ORDER DETAILS</title>';
    echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/delivery/show_delivery_details.php"?>';

    $new_batch_marketing = new Db();
    
   foreach($orders as $key){

   	$order_id = $key['purchase_order_id'];
   	$product_code = $key['product_code'];
   	$quantity = $key['quantity'];
   	
   		$insert_into_customer_delivery_details = $new_batch_marketing->query("INSERT INTO customer_delivery_details(`id`,`customer_delivery_id`,`product_code`,`quantity`) VALUES(NULL,'$delivery_id','$product_code',$quantity)");
   }
   	$insert_into_customer_delivery = $new_batch_marketing->query("INSERT INTO customer_delivery(`customer_delivery_id`,`date`,`purchase_order_id`,`delivered_by`) VALUES('$delivery_id','$date','$order_id','$delivered_by')");

    $update_order_status = $new_batch_marketing->query("UPDATE `customer_order` SET `delivery_date` = '$date', `status` = 'OFD' WHERE `purchase_order_id` = '$order_id'");
   	echo'<script>alert("DELIVERY CONFIRMED")</script>';

   	echo '<script type="text/javascript">window.location.href = "deliveries_of_the_day.php";</script>';
	exit();
  echo '</form>';
?>
