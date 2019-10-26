<?php
	
session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

date_default_timezone_set('Etc/GMT+8');

$new_batch_marketing = new Db();

$date = date('Y-m-d',strtotime("-1day"));


echo'<div style = "font-size:12px">';
echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/reports/customer_order_list.php">';
echo '<div style = "align:right;margin-top:8%;margin-left:10%;">';
echo '<h1>LIST OF OFFICIAL CUSTOMER ORDER<h1></div>';
echo '<div><hr style= "width:90%;margin-right:0%;margin-top:-1%;margin-left:5%"></div>';

$infos = $new_batch_marketing->query("SELECT c.customer_firstName, c.customer_lastName, co.purchase_order_id, co.case, co.amount
FROM customer_order AS co
INNER JOIN customer AS c ON c.customer_account_id = co.customer_id
AND  co.delivery_date ='$date'");

		
	 echo'<div style = "margin-left: 40%;width:60%">NEW BATCH MARKETING OFFICIAL CUSTOMER ORDER LIST</div></br></br>';
	
	 echo'<div style = "float:left;margin-left:20%;">CUSTOMER NAME</div>';
	 echo'<div  style = "float:left;margin-left:13%;">PURCHASE ORDER ID</div>';
	 echo'<div  style = "float:left;margin-left:13%;">TOTAL QTY</div>';
	  echo'<div  style = "float:left;margin-left:4%;">AMOUNT</div>';
	 
	 echo'<div class = "rep" style = "float:left;margin-left:20%;margin-top:1%;width:60%;"><table>';
	
	foreach ($infos as $key){	
		$name = $key['customer_firstName']."\t\t".$key['customer_lastName'];
		echo'<tr><td style = "padding-left:-30px;">'.$name.'</td><td>'.$key['purchase_order_id'].'</td><td>'.$key['case'].'</td><td>'.$key['amount'].'</td></tr>';	
	}
	// echo $date;
	echo'</table></div></div></br></br>';
	
	// echo'<div style = "margin-top:16%;margin-left:46%;"><input type ="submit" name = "ok" value = "OK" style="width:10%;border-radius:2px;"class = "form-control"></div>';

 // if(isset($_POST['ok'])){
 // 		echo '<script type="text/javascript">window.location.href = "http://localhost/new_batch_marketing/reports/order_supplier_list.php";</script>';
	// 	exit();
 // }
 echo '</form>';
 echo' <footer style = "margin-top:25%;"></footer>';
echo'</div>';
?>