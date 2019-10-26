<?php
	
session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

date_default_timezone_set('Etc/GMT+8');

$new_batch_marketing = new Db();

echo'<div style = "font-size:12px">';
echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/products/product_list.php">';
echo '<div style = "align:right;margin-top:8%;margin-left:10%;">';
echo '<h1>LIST OF OFFICIAL PRODUCTS<h1></div>';
echo '<div><hr style= "width:90%;margin-right:0%;margin-top:-1%;margin-left:5%"></div>';

$infos = $new_batch_marketing->query("SELECT * FROM products ");

		
	 echo'<div style = "margin-left: 40%;width:60%">NEW BATCH MARKETING OFFICIAL PROUDUCT LIST</div></br></br>';
	
	 echo'<div style = "float:left;margin-left:27%">PRODUCT NAME</div>';
	 echo'<div  style = "float:left;margin-left:15%">PRODUCT TYPE</div>';
	 echo'<div  style = "float:left;margin-left:11%">SELLING PRICE</div>';
	 
	 echo'<div class = "rep" style = "float:left;margin-left:20%;margin-top:1%;width:60%;"><table>';
	
	foreach ($infos as $key){	

		echo'<tr><td>'.$key['product_name'].'</td><td>'.$key['product_type'].'</td><td>'.$key['selling_price'].'</td></tr>';	
	}
	echo'</table></div></div></br></br>';
	
	echo'<div style = "margin-top:16%;margin-left:46%;"><input type ="submit" name = "ok" value = "OK" style="width:10%;border-radius:2px;"class = "form-control"></div>';

 if(isset($_POST['ok'])){
 		echo '<script type="text/javascript">window.location.href = "product_update.php";</script>';
		exit();
 }
 echo '</form>';
 echo' <footer style = "margin-top:5%;"></footer>';
echo'</div>';
?>