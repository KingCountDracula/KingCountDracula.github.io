<?php
	
session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

date_default_timezone_set('Etc/GMT+8');

$new_batch_marketing = new Db();

$a = 0;
$x = 0;
$quantity = '';
// $container[] = array();
echo'<div style = "font-size:12px">';
echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/reports/reorder.php">';
echo '<div style = "align:right;margin-top:8%;margin-left:10%;">';
echo '<h1>REORDE ENTRY OF THE DAY<h1></div>';
echo '<div><hr style= "width:90%;margin-right:0%;margin-top:-1%;margin-left:5%"></div>';

echo'<div style = "margin-left: 37%;width:60%">NEW BATCH MARKETING OFFICIAL REORDER ENTRY LIST</div></br></br>';

 echo'<div style = "float:left;margin-left:26%">PRODUCT NAME</div>';
 echo'<div  style = "float:left;margin-left:14%">PRODUCT TYPE</div>';
 echo'<div  style = "float:left;margin-left:11%">QUANTTIY</div>';

 echo'<div class = "rep" style = "float:left;margin-left:20%;margin-top:1%;width:60%;"><table>';

 $check_stock = $new_batch_marketing->query("SELECT p.product_code,p.product_name,p.product_type,s.case FROM stocks AS s
INNER JOIN products AS p ON p.product_code = s.stock_code
WHERE s.case < '16'");
 if(empty($check_stock)){
 	echo'<script>alert("STOCK IS STILL SUFFICIENT")';
 }else{
 	foreach($check_stock as $key){
 		echo'<tr><td style = "padding-left:15%;">'.$key['product_name'].'</td><td style = "padding-left:25%;">'.$key['product_type'].'</td><td style = "padding-left:5%;"><input type = "text" name = "current_stock'.$a.'" value = "'.$key['case'].'" class = "form-control" style = "height:27px;width:95%;border-radius:1.5px;"></td></tr>';
 		$a++;
 	}
 }
echo'</table></div></div></br></br>';
	 
	echo'<div style = "margin-top:16%;margin-left:42%;"><input type ="submit" name = "ok" value = "REORDER" style="background:#30493D;color:white;width:10%;border-radius:2px;width:30%;"class = "form-control"></br>
		<input type ="submit" name = "cancel" value = "CLOSE" style="background:#30493D;color:white;width:10%;border-radius:2px;width:30%;"class = "form-control"></div>';

 if(isset($_POST['ok'])){
 		
 		foreach($check_stock as $key){
 				$quantity = $_POST['current_stock'.$x.''];
 				$p_code = $key['product_code'];
 				
 				$container[$x]= array();
 				$container[$x]['code'] = $p_code;
 				$container[$x]['case'] = $quantity; 

 				$x++;
 		}

 		$_SESSION['entry'] = $container;
 		echo '<script type="text/javascript">window.location.href = "reorder_redirect.php";</script>';
		exit();
 }
// foreach($container as $key){
// 		echo $key['code'].'</br>';
// 		echo $key['case'].'</br>';
// }
// print_r($container);
 if(isset($_POST['cancel'])){

 	
 		echo '<script type="text/javascript">window.location.href = "/new_batch_marketing/nbm/nbm_index.php";</script>';
		exit();
 }
 echo '</form>';
 echo' <footer style = "margin-top:5%;"></footer>';
echo'</div>';
?>