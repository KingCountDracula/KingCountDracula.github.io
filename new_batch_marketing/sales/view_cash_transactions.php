<?php
	
	session_start();
	require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");
	date_default_timezone_set('Etc/GMT+8');

	$new_batch_marketing = new Db();
$current_date = Date('Y-m-d');



$quantity = '';
$amount = '';
$transaction_code = '';

echo'<div>';
echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/sales/view_cash_transactions.php">';
echo '<div style = "align:right;margin-top:5%;margin-left:10%;">';
				echo '<h1>DELIVERY&nbsp&nbsp;REPORTS<h1></div>';
				echo '<div><hr style= "width:90%;margin-right:0%;margin-top:-1%;margin-left:5%"></div>';

				echo '<div style = "align:left;margin-left:30px;margin-right:0%;margin-top:5%;">';

echo '<div><td><input style = "width: 30%;"type = "text" name = "delivery_id" class = "form-control" value = "'.$delivery_id.'"></br><input type = "submit" style = "width: 30%;"name = "select" class = "form-control" value = "VIEW DETAILS">&nbsp;<input style = "width: 30%;" type = "submit" name = "cancel" value = "cancel" class = "form-control"></td></div>';


if(isset($_POST['select'])){
	
	
	
	$cash_transactions_view = $new_batch_marketing->query("SELECT * FROM cash_transactions WHERE `transaction_date` = '$selected_date'");
	if(empty($cash_transactions_view)){
			echo '<script>alert("NO RECORDS FOUND")</script>';
			echo '<script type="text/javascript">window.location.href = "view_cash_transactions.php";</script>';
										exit();
	}
	else{
		echo '<table style="width: 400px; height: auto; resize:none;color:black;background:white;border-radius:3px;"readonly = "readonly">';
		echo'<td>TRANSACTION CODE</td>&nbsp;&nbsp;<td>QTY</td><td>TOTAL</td>';
		foreach($cash_transactions_view as $key){	
	    echo '<tr><td>'.$key['transaction_code'].'</td>';
	    echo'<td>'.$key['qty'].'</td>';
	    echo'<td>'.$key['total_amount'].'</td>
	    <td><a href="?view='.$key['transaction_code'].'"<input type = "button" name = "view" class =  "form-control" value ="view" style = "width:70%;">view</a></td>
	    </tr>';
		}
		echo '</table></div>';
	}
	// $date1 = date_create($selected_date);
	// $date2 = date_create($current_date);
	// $period = date_diff($date1,$date2);
	// echo $period->format('%R%a days');
}
 

 if(isset($_POST['view_all'])){

 			$selected_date = $_POST['current_date'];

	 	$view_all_sales_list = $new_batch_marketing->query("SELECT * FROM sales_list WHERE `transaction_date` = '$selected_date'");

	 	if(empty($view_all_sales_list)){
			echo '<script>alert("NO RECORDS FOUND")</script>';
			echo '<script type="text/javascript">window.location.href = "view_cash_transactions.php";</script>';
			exit();
		}
		else{

			echo '<div><hr style= "width:169%;margin-right:0%;margin-top:6%;margin-left:-10%"></div>';
		 	echo'<table <table style="width: 400px; height: auto; resize:none;color:black;background:white;border-radius:3px;"readonly = "readonly">';
		 	echo'<td>TRANSACTION ID</td>&nbsp;<td>PRODUCT NAME</td>&nbsp;&nbsp;<td>QTY</td><td>TOTAL</td>';
		 	foreach($view_all_sales_list as $key){

		 		$amount = $key['amount'];
		 		$quantity = $key['quantity'];
		 		$transaction_code =$key['transaction_code'];

		 			$get_product_name = $new_batch_marketing->query("SELECT product_name,product_type FROM products WHERE product_code = '".$key['product_code']."'");

		 				foreach($get_product_name as $key){
		 					
		 						echo'<tr><td>'.$transaction_code.'</td>';
		 						echo'<td>'.$key['product_name'].'&nbsp;&nbsp;'.$key['product_type'].'</td>';
		 						echo '<td>'.$quantity.'</td>';
		 						echo '<td>'.$amount.'</td></tr>';
		 				}
		 	}

	 	
 		}
 		echo'</table></div>';
}

 if(isset($_GET['view'])){
 	echo '<div><hr style= "width:169%;margin-right:0%;margin-top:6%;margin-left:-10%"></div>';
 	echo'<table <table style="width: 400px; height: auto; resize:none;color:black;background:white;border-radius:3px;"readonly = "readonly">';
 	echo'<td>PRODUCT NAME</td>&nbsp;&nbsp;<td>QTY</td><td>TOTAL</td>';
 	$view_sales_list = $new_batch_marketing->query("SELECT * FROM sales_list WHERE `transaction_code` = '".$_GET['view']."'");
 	foreach($view_sales_list as $key){

 		$amount = $key['amount'];
 		$quantity = $key['quantity'];

 			$get_product_name = $new_batch_marketing->query("SELECT product_name,product_type FROM products WHERE product_code = '".$key['product_code']."'");

 				foreach($get_product_name as $key){
 					
 						echo'<tr><td>'.$key['product_name'].'&nbsp;&nbsp;'.$key['product_type'].'</td>';
 						echo '<td>'.$quantity.'</td>';
 						echo '<td>'.$amount.'</td></tr>';
 				}	
 	}
 	echo'</table></div>';			
 }	
 echo '</form>';
 echo' <footer style = "margin-top:45%;"></footer>';
echo'</div>';
?>