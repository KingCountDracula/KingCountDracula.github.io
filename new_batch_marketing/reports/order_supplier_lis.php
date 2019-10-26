<?php
	
session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

date_default_timezone_set('Etc/GMT+8');

$new_batch_marketing = new Db();

echo'<div style = "font-size:12px">';
echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/reports/order_supplier_list.php">';
echo '<div style = "align:right;margin-top:8%;margin-left:10%;">';
echo '<h1>LIST OF OFFICIAL ORDERS TO SUPPLIER<h1></div>';
echo '<div><hr style= "width:90%;margin-right:0%;margin-top:-1%;margin-left:5%"></div>';

$infos = $new_batch_marketing->query("SELECT s.supplier_name,os.order_supplier_id,os.total_case from order_supplier as os
inner join supplier as s on s.supplier_account_id = os.supplier_id");

		
	 echo'<div style = "margin-left: 40%;width:60%">NEW BATCH MARKETING OFFICIAL ORDER TO SUPPLIER LIST</div></br></br>';
	
	 echo'<div style = "float:left;margin-left:27%;">ORDER ID</div>';
	 echo'<div  style = "float:left;margin-left:26%;">SUPPLIER NAME</div>';
	 echo'<div  style = "float:left;margin-left:6%;">TOTAL QTY</div>';
	 
	 echo'<div class = "rep" style = "float:left;margin-left:20%;margin-top:1%;width:60%;"><table>';
	
	foreach ($infos as $key){	
		$name = $key['supplier_name'];
		echo'<tr><td style = "padding-left:-30px;">'.$key['order_supplier_id'].'</td><td>'.$name.'</td><td>'.$key['total_case'].'</td></tr>';	
	}
	echo'</table></div></div></br></br>';
	
	// echo'<div style = "margin-top:16%;margin-left:46%;"><input type ="submit" name = "ok" value = "OK" style="width:10%;border-radius:2px;"class = "form-control"></div>';

 // if(isset($_POST['ok'])){
 // 		echo '<script type="text/javascript">window.location.href = "http://localhost/new_batch_marketing/reports/order_supplier_list.php";</script>';
	// 	exit();
 // } // if(isset($_POST['ok'])){
 // 		echo '<script type="text/javascript">window.location.href = "http://localhost/new_batch_marketing/reports/order_supplier_list.php";</script>';
	// 	exit();
 // }
 echo '</form>';
 echo' <footer style = "margin-top:25%;"></footer>';
echo'</div>';
?>