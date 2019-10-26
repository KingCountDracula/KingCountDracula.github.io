<?php
	
session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

date_default_timezone_set('Etc/GMT+8');

$new_batch_marketing = new Db();
$pdate = date('Y-m-d');
// $pdate = '2016-09-13';
$total_sales = '';

echo'<div style = "font-size:12px">';
echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/reports/sales_report.php">';
echo '<div style = "align:right;margin-top:8%;margin-left:10%;">';
echo '<h1>SALES OF THE DAY<h1></div>';
echo '<div><hr style= "width:90%;margin-right:0%;margin-top:-1%;margin-left:5%"></div>';

$infos = $new_batch_marketing->query("SELECT * FROM `sales`");

	 echo'<div style = "margin-left: 40%;width:60%">NEW BATCH MARKETING LIST OF OFFICIAL LIST</div></br></br>';
	
	
	 echo'<div  style = "float:left;margin-left:34%;">OFFICIAL RECEIPT</div>';
	 echo'<div  style = "float:left;margin-left:12%;">AMOUNT</div>';
	  echo'<div  style = "float:left;margin-left:10%;">DATE</div>';
	 
	 echo'<div class = "rep" style = "float:left;margin-left:20%;margin-top:1%;width:60%;"><table>';
	
	if(empty($infos)){
		echo'<script>alert("NO SALES TODAY")</script>';
		echo '<script type="text/javascript">window.location.href = "/new_batch_marketing/nbm/nbm_index.php";</script>';
		exit();
	}else{

			foreach ($infos as $key){

				echo'<tr><td style = "padding-left:45px;">'.$key['OR'].'</td><td>'.$key['amount'].'</td><td>'.$key['date'].'</td></tr>';	
				$total_sales = $total_sales + $key['amount'];
			}		
	}

	echo'</table></div></div></br></br>';
	echo'<div style = "margin-top:16%;margin-left:70%;float;">TOTAL SALES:pph&nbsp;'.$total_sales.'</a></div>';
	echo'<div style = "margin-top:3%;margin-left:46%;"><input type ="submit" name = "ok" value = "OK" style="width:10%;border-radius:2px;"class = "form-control"></div>';

 if(isset($_POST['ok'])){
 		echo '<script type="text/javascript">window.location.href = "/new_batch_marketing/nbm/nbm_index.php";</script>';
		exit();
 }
 echo '</form>';
 echo' <footer style = "margin-top:5%;"></footer>';
echo'</div>';
?>