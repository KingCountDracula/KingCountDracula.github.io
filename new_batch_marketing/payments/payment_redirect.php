<?php
	
session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

date_default_timezone_set('Etc/GMT+8');

$new_batch_marketing = new Db();
$current_date = date('Y-m-d');
$delivery_date = '';

$processed_by = $_SESSION['user'];
$aging = '';
$principal = '';
$payment = '';
$new_balance = '';
$penalty = '';
$OR = '';
$d_date = $delivery_date;
$new_balance = '';
$interest = '';

echo'<div style = "font-size:12px">';
echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/payments/payment_redirect.php">';
echo '<div style = "align:right;margin-top:8%;margin-left:10%;">';
echo '<h1>STATEMENT OF ACCOUNT<h1></div>';
echo '<div><hr style= "width:90%;margin-right:0%;margin-top:-1%;margin-left:5%"></div>';

$infos = $new_batch_marketing->query("SELECT a.lastname, a.firstname, a.contact_num, c.customer_account_id, c.customer_firstName, c.customer_lastName, c.barangay, c.town, c.customer_contact_number, cd.customer_delivery_id, cd.date, cd.delivered_by, co.order_date, co.purchase_order_id, co.customer_id
FROM customer_order AS co
INNER JOIN customer_delivery AS cd ON cd.purchase_order_id = co.purchase_order_id
INNER JOIN customer AS c ON c.customer_account_id = co.customer_id
INNER JOIN agent AS a ON a.area = c.area
WHERE co.purchase_order_id
 = '".$_SESSION['payment_order_id']."'");

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
		$delivered_by = $key['delivered_by'];
		$c_id = $key['customer_account_id'];
	}

		echo'<div class = "cust" style = "float:left;margin-left:20%;margin-top:1%;width:60%"><table>
	<div style = "margin-left: 40%;">NEW BATCH MARKETING</div>
			<tr><td>Customer Name:</td><td>'.$customer_name.'</td><td colspan = "3">DELIVERY ID:</td><td>'.$delivery_id.'</td></tr>
			<tr><td>Customer Address:</td><td>'.$customer_address.'</td><td colspan = "3">Delivery date:</td><td>'.$delivery_date.'</td></tr>
			<tr><td>Customer No.:</td><td>'.$customer_contact_number.'</td><td colspan = "3">ORDER ID:</td><td>'.$order_id.'</td></tr>
			<tr><td>Agent Name:</td><td>'.$agent_name.'</td><td colspan = "3">ORDER DATE:</td><td>'.$order_date.'</td></tr>
			<tr><td>Customer Name:</td><td>'.$agent_num.'</td><td colspan = "3">Delivered by:</td><td>'.$delivered_by.'</td></tr>
			<tr><td>TRANSACTION ID:</td><td>'.$_SESSION['payment_transaction_id'].'</td><td colspan = "3">Processed by:</td><td>'.$processed_by.'</td></tr>
		</table></div>';

	$get_acoount_details = $new_batch_marketing->query("SELECT pd.OR,pd.date,pd.amount_paid,p.amount_payable,co.delivery_date FROM customer_order AS co
		INNER JOIN payment AS p on p.customer_order_id = co.purchase_order_id
		INNER JOIN payment_details AS pd ON pd.transaction_id = p.transaction_id
		WHERE co.purchase_order_id = '".$_SESSION['payment_order_id']."'");
	foreach($get_acoount_details as $key){
		$delivery_date = $key['delivery_date'];
		$aging = (strtotime($current_date) - strtotime($delivery_date))/86400;
		$aging = round(abs($aging));
		if($aging > 30){
			$aging = 30;
		}
		$principal = $key['amount_payable'];
	}


	 echo'<div class = "cust" style = "float:left;margin-left:20%;margin-top:1%;width:60%"><table>';
	 echo'<div style = "margin-left: 43%;">STATEMENT OF ACCOUNT</div>';
	 echo'<tr><td colspan = "2">AGING:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$aging.'&nbsp;day/s</td><td colspan = "3">PRINCIPAL AMOUNT:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$principal.'</td></tr>';
	 echo'<tr><td>OFFICIAL RECIEPT</td><td>AMOUNT</td><td>BALANCE</td><td>PENALTY</td><td>DATE</td></tr></table></div></br>';
	 
	 echo'<div class = "rep" style = "float:left;margin-left:20%;margin-top:-9%;width:60%;"><table>';

$new_balance = $principal;
$or = '';
$a_paid = '';
$date_flag = '';
$decrementor = 0;
while($aging >0){
	$inc_date = strtotime('+'.$decrementor.' day',strtotime($delivery_date));
	$temp_date = date('Y-m-d',$inc_date);

	$decrementor++;

	if($decrementor == 11){
			$interest = round($new_balance * 0.05,2,PHP_ROUND_HALF_UP);
			$interest = round($interest,2,PHP_ROUND_HALF_UP);
			$new_balance = round($new_balance,2,PHP_ROUND_HALF_UP) + round($interest,2,PHP_ROUND_HALF_UP);
	}else if($decrementor > 25 && $decrementor <= 30){
		$interest = (round($new_balance * 0.05,2,PHP_ROUND_HALF_UP)+(round($new_balance * 0.03,2,PHP_ROUND_HALF_UP)));
		$interest = round($interest,2,PHP_ROUND_HALF_UP);
		$new_balance = round($new_balance + $interest,2,PHP_ROUND_HALF_UP);
		$new_balance = round($new_balance,2,PHP_ROUND_HALF_UP);
	}else{
		$interest = '';
	}
	foreach($get_acoount_details as $key){
		if($key['date'] == $temp_date){
			$or = $key['OR'];
			$a_paid = $key['amount_paid'];
			$new_balance = round($new_balance,2,PHP_ROUND_HALF_UP) - round($a_paid,2,PHP_ROUND_HALF_UP);
			$new_balance = round($new_balance,2,PHP_ROUND_HALF_UP);
			$date_flag = $key['date'];
			if($new_balance < 1){
				$interest = '';
				$new_balance = 0;
			}
			echo'<tr><td>'.$or.'</td><td>'.$a_paid.'</td><td>'.$new_balance.'</td><td>'.$interest.'</td><td>'.$temp_date.'</td></tr>';
		}else{
			$or = '';
			$a_paid = '';

		}
	}
	if($date_flag == $temp_date){
		#do nothing...
	}else{
		if($new_balance < 1){
				$interest = '';
				$new_balance = 0;
		}
		echo'<tr><td>'.$or.'</td><td>'.$a_paid.'</td><td>'.$new_balance.'</td><td>'.$interest.'</td><td>'.$temp_date.'</td></tr>';
	}
	$aging--;
}
	echo'</table></div></br></br>';
		
	echo'<div style = "margin-top:35%;margin-left:45%;width"><input type ="submit" name = "ok" value = "OK" style="background:#30493D;color:white;width:10%;border-radius:2px;"class = "form-control"></div>';

 if(isset($_POST['ok'])){
 		echo '<script type="text/javascript">window.location.href = "payment.php";</script>';
		exit();
 }
 echo '</form>';
 echo' <footer style = "margin-top:7%;"></footer>';
echo'</div>';
?>
