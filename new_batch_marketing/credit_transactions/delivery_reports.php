<?php
	
session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

date_default_timezone_set('Etc/GMT+8');

$new_batch_marketing = new Db();
$current_date = date('m-d-Y');
$transaction_id = 'CA'.date('ymdhis').'SH';
$_SESSION['transaction_id'] = $transaction_id;
$quantity = '';
$amount = '';
$delivery_id = '';
$delivery_date = '';
$order_id = '';
$order_date ='';
$customer_name = '';
$customer_address = '';
$customer_contact_number = '';
$agent_name = '';
$agent_num = '';
$customer_id = '';
$delivery_by = '';
$total = '';
$case = '';
$code = '';
$processed_by = $_SESSION['user'];
$c_id = '';

echo'<div style = "font-size:12px">';
echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/credit_transactions/delivery_reports.php">';
echo '<div style = "align:right;margin-top:8%;margin-left:10%;">';
echo '<h1>DELIVERY&nbsp&nbsp;REPORTS<h1></div>';
echo '<div><hr style= "width:90%;margin-right:0%;margin-top:-1%;margin-left:5%"></div>';

$deliveries_of_the_day = $new_batch_marketing->query("SELECT c.customer_firstName, c.customer_lastName,d.customer_delivery_id FROM customer_delivery AS d
INNER JOIN customer_order AS co
INNER JOIN customer AS c ON c.customer_account_id = co. customer_id
WHERE co.purchase_order_id = d.purchase_order_id AND d.status = ''");

echo '<div style = "margin-left:10%;">
	  <select name = "delivery_id" style = "width: 23%;background:#30493D;color:white;border-radius:2px;" class = "form-control">
	  <option value = "">SELECT DELIVERY</option>';
	  foreach($deliveries_of_the_day as $key){
	  	echo'<option value = "'.$key['customer_delivery_id'].'">'.$key['customer_firstName']."\t\t".$key['customer_lastName'].'</option>';
	  }
	 echo'</select><br>';
	echo'<input type = "submit" style = "width: 23%;background:#30493D;color:white;border-radius:2px;"name = "select" class = "form-control" value = "VIEW DETAILS"></br>
	<input style = "width: 23%;background:#30493D;color:white;border-radius:2px;" type = "submit" name = "cancel" value = "CANCEL" class = "form-control">';
echo'</div>';


if(isset($_POST['select'])){
	
	$delivery_id = $_POST['delivery_id'];
	$_SESSION['delivery_id'] = $delivery_id;
	
	$infos = $new_batch_marketing->query("SELECT a.lastname, a.firstname, a.contact_num,c.customer_account_id,c.customer_firstName, c.customer_lastName, c.barangay, c.town, c.customer_contact_number, cd.customer_delivery_id, cd.date, cd.delivered_by, co.order_date, co.purchase_order_id, co.customer_id
FROM customer_order AS co
INNER JOIN customer_delivery AS cd ON cd.purchase_order_id = co.purchase_order_id
INNER JOIN customer AS c ON c.customer_account_id = co.customer_id
INNER JOIN agent AS a ON a.area = c.area
WHERE cd.customer_delivery_id = '$delivery_id'");

	foreach($infos as $key){
		$delivery_id = $key['customer_delivery_id'];
		$delivery_date = $key['date'];
		$order_id = $key['purchase_order_id'];
		$order_date = $key['order_date'];
		$customer_name = $key['customer_firstName'].'&nbsp;&nbsp;'.$key['customer_lastName'];
		$customer_address = $key['barangay'].'&nbsp;&nbsp;'.$key['town'];
		$customer_contact_number = $key['customer_contact_number'];
		$agent_name = $key['firstname'].'&nbsp;&nbsp;'.$key['lastname'];
		$agent_num = $key['contact_num'];
		// $delivered_by = $key['delivered_by'];
		$c_id = $key['customer_account_id'];
	}
$_SESSION['order_id'] = $order_id;
$_SESSION['c_id'] = $c_id;
	$details = $new_batch_marketing->query("SELECT * FROM customer_order_list WHERE purchase_order_id = '$order_id'");
	// print_r($details);

	if(empty($details)){
			echo '<script>alert("NO RECORDS FOUND")</script>';
	}
	else{

		echo'<div style = "margin-left: 60%;margin-top:-9%;">NEW BATCH MARKETING</div>';


		echo'<div class = "cust" style = "float:left;margin-left:35%;margin-top:1%;width:60%;"><table>
			<tr><td>Customer Name:</td><td>'.$customer_name.'</td><td colspan = "3">DELIVERY ID:</td><td>'.$delivery_id.'</td></tr>
			<tr><td>Customer Address:</td><td>'.$customer_address.'</td><td colspan = "3">Delivery date:</td><td>'.$delivery_date.'</td></tr>
			<tr><td>Customer No.:</td><td>'.$customer_contact_number.'</td><td colspan = "3">ORDER ID:</td><td>'.$order_id.'</td></tr>
			<tr><td>Agent Name:</td><td>'.$agent_name.'</td><td colspan = "3">ORDER DATE:</td><td>'.$order_date.'</td></tr>
			<tr><td>Customer Name:</td><td>'.$agent_num.'</td><td colspan = "3">Delivered by:</td><td>'.$agent_name.'</td></tr>
			<tr><td>TRANSACTION ID:</td><td>'.$_SESSION['transaction_id'].'</td><td colspan = "3">Processed by:</td><td>'.$processed_by.'</td></tr>
		</table></div>';


	echo'<div style = "margin-left: 62%;margin-top:16%;">DELIVERY DETAILS</div>';

	echo'<div class = "cust" style = "float:left;margin-left:35%;margin-top:1%;width:60%;"><table>';
	echo'<tr><td>PRODUCT NAME</td><td style = "padding-right:15%;">PRODUCT TYPE</td><td style = "padding-right:15%;">PRICE</td><td style = "padding-right:15%;">QTY</td><td>AMOUNT</td></tr></table></div>';


	echo'<div class = "rep" style = "float:left;margin-left:35%;margin-top:-12.43%;width:60%;"><table>';
		foreach($details as $key){
			$code = $key['product_code'];
			$sp = $key['selling_price'];
			$qty = $key['quantity'];
			$amt = $key['amount'];
			$total = $total+=$amt;
			$case = $case+=$qty;
			$get_prod_specs = $new_batch_marketing->query("SELECT product_name,product_type FROM products WHERE product_code = '$code'");
			foreach($get_prod_specs as $key){
				echo'<tr><td>'.$key['product_name'].'</td><td>'.$key['product_type'].'</td><td>'.$sp.'</td><td>'.$qty.'</td><td>'.$amt.'</td></tr>';
			}
		}
		echo'</table></div>';
		echo'<div style = "margin-top:20%;margin-left:80%;"><label>CASE:'.$case.'&nbsp;&nbsp;&nbsp;TOTAL:'.$total.'</label></div>';
		echo'<div style = "margin-top:1%;margin-left:50%;border-radius:2px;width:100%;">
				<input type = "submit" name = "cash" class = "form-control" value = "CASH" style = "width:10%;float:left;background:#30493D;color:white;border-radius:2px;">

				<input type = "submit" name = "credit" class = "form-control" value = "CREDIT" style = "width:10%;float:left;background:#30493D;color:white;border-radius:2px;">

				<input type = "submit" name = "cancelled" class = "form-control" value = "CANCELLED" style = "width:10%;float:left;background:#30493D;color:white;border-radius:2px;">

		</div>';
	}
	$_SESSION['total'] = $total;
}
 

 if(isset($_POST['cancel'])){
 		echo '<script type="text/javascript">window.location.href = "delivery_reports.php";</script>';
		exit();
 }
 if(isset($_POST['cash'])){
 		echo '<script type="text/javascript">window.location.href = "cash.php";</script>';
 		exit();
 }
 if(isset($_POST['credit'])){
 	echo '<script type="text/javascript">window.location.href = "credit_entry.php";</script>';
 		exit();
 }
 if(isset($_POST['cancelled'])){

 	$stmt = $new_batch_marketing->query("SELECT * FROM customer_order_list WHERE purchase_order_id = '".$_SESSION['order_id']."'");
	// print_r($details);
 	foreach ($stmt as $key) {
 		$code = $key['product_code'];
 		$case = $key['quantity'];

 		$get_stock = $new_batch_marketing->query("SELECT `case` FROM `stocks` WHERE `stock_code` = '$code'");
 		foreach($get_stock as $key){
 			$qty = $case + $key['case'];
 			$update_stock = $new_batch_marketing->query("UPDATE `stocks` SET `case` = $qty WHERE `stock_code` = '$code'");
 		}
 	}
 		$update_order_status = $new_batch_marketing->query("UPDATE `customer_order` SET `status` = 'CANCELLED' WHERE `purchase_order_id` = '".$_SESSION['order_id']."'");

 		$update_order_status = $new_batch_marketing->query("UPDATE `customer_delivery` SET `status` = 'CANCELLED' WHERE `customer_delivery_id` = '".$_SESSION['delivery_id']."'");

 		echo'<script>alert("Stocks has been successfully updated.")</script>';
 		echo '<script type="text/javascript">window.location.href = "delivery_reports.php";</script>';
		exit();
 }
 echo '</form>';
 echo' <footer style = "margin-top:21%;"></footer>';
echo'</div>';
?>