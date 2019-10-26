<?php
	
session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

date_default_timezone_set('Etc/GMT+8');

$new_batch_marketing = new Db();

echo'<div style = "font-size:12px">';
echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/reports/stock_inventory.php">';
echo '<div style = "align:right;margin-top:8%;margin-left:10%;">';
echo '<h1>INVENTORY OF PRODUCTS<h1></div>';
echo '<div><hr style= "width:90%;margin-right:0%;margin-top:-1%;margin-left:5%"></div>';

$infos = $new_batch_marketing->query("SELECT p.product_name, p.product_type, s.stock_code, s.case FROM stocks AS s
	INNER JOIN products AS p ON p.product_code = s.stock_code");

		
	 echo'<div style = "margin-left: 40%;width:60%">NEW BATCH MARKETING PRODUCT INVENTORY</div></br></br>';
	
	 echo'<div style = "float:left;margin-left:32%;">PRODUCT NAME</div>';
	 echo'<div  style = "float:left;margin-left:16%;">PRODUCT TYPE</div>';
	 echo'<div  style = "float:left;margin-left:8.5%;">STOCKS</div>';
	 
	 echo'<div class = "rep" style = "float:left;margin-left:20%;margin-top:1%;width:60%;"><table>';
	
	foreach ($infos as $key){

		echo'<tr><td style = "padding-left:45px;">'.$key['product_name'].'</td><td>'.$key['product_type'].'</td><td>'.$key['case'].'</td></tr>';	
	}
	echo'</table></div></div></br></br>';
	
	echo'<div style = "margin-top:16%;margin-left:46%;"><input type ="submit" name = "ok" value = "OK" style="width:10%;border-radius:2px;"class = "form-control"></div>';

 if(isset($_POST['ok'])){
 		echo '<script type="text/javascript">window.location.href = "/new_batch_marketing/nbm/nbm_index.php";</script>';
		exit();
 }
 echo '</form>';
 echo' <footer style = "margin-top:5%;"></footer>';
echo'</div>';
?>