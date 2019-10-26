
<?php
	
	session_start();
	require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

	date_default_timezone_set('Etc/GMT+8');

	$transaction_id = '';
	$processor = '';
	$transaction_date = '';
	$supplier_name;
	$supplier_contact_nubmer = '';
	$supplier_address= '';
	$supplier = '';
	$count = 0;
	$total_quantity = '';
	$delivery_id = 'D'.date("ymdhis").'S';
	$delivery_date = date("Y-m-d");
	$d[] = '';
	$quantity = '';
	$x = 0;
	$a = 0;
	$actual_quantity = '';
	
	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/order_supplier/order_delivery_redirect.php">';

	$new_batch_marketing = new Db();
	
				echo'<div style = "font-size:12px">';
				echo '<div style = "margin-top:7%;margin-left:10%">';
				echo '<h1>ORDER&nbsp;&nbsp;DELIVERY<h1></div>';
				echo '<div><hr style= "width:90%;margin-top:-1%;margin-left:4%"></div>';	

				echo '<div style = "align:center;width:150%;height:70%;margin-left:40%"><h4 style = "align:left;">&nbsp;&nbsp;&nbsp;SUPPLIER DELIVERY DETAILS</h4></div></br>';

					$transaction_id = $_SESSION['poid'];
					
						$get_order_details = $new_batch_marketing->query("SELECT prod.product_name, prod.product_type, stock.case, os.supplier_id, os.order_date, os.processed_by, s.supplier_name, s.supplier_address, s.supplier_contact_number, osl.product_code, osl.quantity
						FROM order_supplier_list AS osl
						INNER JOIN order_supplier AS os ON os.order_supplier_id = osl.order_supplier_id
						INNER JOIN products AS prod ON prod.product_code = osl.product_code
						INNER JOIN supplier AS s ON s.supplier_account_id = os.supplier_id
						INNER JOIN stocks AS stock ON stock.stock_code = prod.product_code
						WHERE osl.order_supplier_id = '$transaction_id'");

						if(empty($get_order_details)){
							echo'<script>alert("TRANSACTION DOES NOT EXIST!")</script>';
							echo '<script type="text/javascript">window.location.href = "order_delivery.php";</script>';
							exit();		
						}else{

							foreach($get_order_details as $key){
								$transaction_date = $key['order_date'];
								$supplier = $key['supplier_id'];
								$processor = $key['processed_by'];
								$supplier_address = $key['supplier_address'];
								$supplier_name = $key['supplier_name'];
								$supplier_contact_nubmer = $key['supplier_contact_number'];
							}
							
							echo'<div class = "cust" style = "float:left;margin-left:20%;margin-top:-1%;width:60%"><table>';
							echo'<tr><td>SUPPLIER:'.$supplier.'</td><td>ORDER DATE:'.$transaction_date.'</td></tr>';
							echo'<tr><td>SUPPLIER:'.$supplier_name.'</td><td>P.O. ID:'.$transaction_id.'</td></tr>';
							echo'<tr><td>SUPPLIER:'.$supplier_address.'</td><td>P.O. ID:'.$transaction_id.'</td></tr>';
							echo'<tr><td>SUPPLIER:'.$supplier_name.'</td><td>By:'.$processor.'</td></tr>';
							echo'<tr><td colspan = "2">SUPPLIER NO.:'.$supplier_contact_nubmer.'</td></tr>';
							echo'</table></div></br>';


					echo'<div class = "cust" style = "margin-left:20%;margin-top:1%;width:60%;""><table>';
					echo'<tr><td>PRODUCT NAME</td><td>PRODUCT TYPE</td><td colspan = "2">QTY</td></tr></table></div>';

					echo'<div class = "rep" style = "margin-left:20%;margin-top:-12.2%;width:60%;"><table>';
					foreach($get_order_details as $key){
								
								$product_code = $key['product_code'];
								$quantity = $key['quantity'];
									echo'<tr><td>'.$key['product_name'].'</td><td  style = "padding-left:40.3%;">'.$key['product_type'].'</td><td><input type="text" name = "delivered'.$x.'" class = "form-control" value = "'.$quantity.'"style="width:50px;height:15px;border-radius:2px;"></td>';
									$x++;	
							}			
						}	
					echo'</table></div>';
					echo'<div style = "margin-left: 40%;">';
					echo '</br><input type = "submit" name = "confirm" value = "CONFIRM DELIVERY" class = "form-control" style = "width:30%;border-radius:2px;background:#30493D;color:white;"></br>';
					echo '<input type = "submit" name = "cancel" value = "CANCEL" class = "form-control" style = "width:30%;border-radius:2px;background:#30493D;color:white;">';
					echo'</div>';

				if(isset($_POST['confirm'])){	
						foreach($get_order_details as $key){
							$case = $key['case'];
							$product_code = $key['product_code'];
							$actual_quantity = $_POST['delivered'.$a.''];
							$total_quantity = $case + $actual_quantity;

							$update_stocks = $new_batch_marketing->query("UPDATE `stocks` SET `case` = '$total_quantity' WHERE `stock_code` = '$product_code'");
						
						$insert_into_delivery_details = $new_batch_marketing->query("INSERT INTO delivery_details(`id`,`delivery_id`,`product_id`,`quantity_delivered`) VALUES(NULL,'$delivery_id','$product_code',$actual_quantity)");

						$a++;
					}

					$insert_into_delivery = $new_batch_marketing->query("INSERT INTO delivery(`delivery_id`,`delivery_date`,`purchase_id`) VALUES('$delivery_id','$delivery_date','$transaction_id')");

					echo'<script>alert("STOCKS has been updated successfully!")</script>';
					echo '<script type="text/javascript">window.location.href = "order_delivery.php";</script>';
							exit();		
				}
				if(isset($_POST['cancel'])){
					$clear_temporary_container = $new_batch_marketing->query("TRUNCATE temporary_order_supplier");
					echo '<script type="text/javascript">window.location.href = "order_delivery.php";</script>';
							exit();
				}

	echo '</form>';
	echo' <footer style = "margin-top:4%;"></footer>';
	echo'</div>';
?>


