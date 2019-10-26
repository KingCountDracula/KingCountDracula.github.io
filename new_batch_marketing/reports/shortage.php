<?php
	
session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

date_default_timezone_set('Etc/GMT+8');

$new_batch_marketing = new Db();
$current_date = date("Y-m-d",strtotime('-1day'));


echo'<div style = "font-size:12px">';
echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/reports/shortage.php">';
echo '<div style = "align:right;margin-top:8%;margin-left:10%;">';
echo '<h1>DEFICIT ORDER OF THE DAY<h1></div>';
echo '<div><hr style= "width:90%;margin-right:0%;margin-top:-1%;margin-left:5%"></div>';

echo'<div style = "margin-left: 37%;width:60%">NEW BATCH MARKETING OFFICIAL LIST OF DEFICIT ORDERS</div></br></br>';

 echo'<div style = "float:left;margin-left:27%">PRODUCT NAME</div>';
 echo'<div  style = "float:left;margin-left:15%">PRODUCT TYPE</div>';
 echo'<div  style = "float:left;margin-left:11%">QUANTTIY</div>';

 echo'<div class = "rep" style = "float:left;margin-left:20%;margin-top:1%;width:60%;"><table>';
echo $current_date;
$getsum = $new_batch_marketing->query("SELECT DISTINCT (prod_code) AS PROD_CODE FROM order_shortage WHERE `date` =  '$current_date '");
if(empty($getsum)){
		echo '<script>alert("NO DEFICIT TODAY!")</script>';
		echo '<script type="text/javascript">window.location.href = "/new_batch_marketing/nbm/nbm_index.php";</script>';
		exit();
}else{
	foreach ($getsum as $key) {
	$p_code = $key['PROD_CODE'];
	$sum = $new_batch_marketing->query("SELECT sum(quantity) AS SUM FROM order_shortage WHERE `prod_code` = '$p_code'");
		foreach($sum as $key){
			$sum_case = $key['SUM'];
			// $count = $count+$sum_case;
				$name = $new_batch_marketing->query("SELECT product_name,product_type FROM products WHERE product_code = '$p_code'");
				foreach($name as $key){
					echo'<tr><td>'.$key['product_name'].'</td><td>'.$key['product_type'].'</td><td>'.$sum_case.'</td></tr>';
				}
		}
 	}
}
echo'</table></div></div></br></br>';
	 
	echo'<div style = "margin-top:16%;margin-left:42%;"><input type ="submit" name = "ok" value = "REORDER" style="background:#30493D;color:white;width:10%;border-radius:2px;width:30%;"class = "form-control"></br>
		<input type ="submit" name = "cancel" value = "CLOSE" style="background:#30493D;color:white;width:10%;border-radius:2px;width:30%;"class = "form-control"></div>';

 if(isset($_POST['ok'])){
 		echo '<script type="text/javascript">window.location.href = "shortage_redirect.php";</script>';
		exit();
 }
 if(isset($_POST['cancel'])){

 		echo '<script type="text/javascript">window.location.href = "/new_batch_marketing/nbm/nbm_index.php";</script>';
		exit();
 }
 echo '</form>';
 echo' <footer style = "margin-top:5%;"></footer>';
echo'</div>';
?>