
<?php
	
	
	session_start();
	require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");
	date_default_timezone_set('Etc/GMT+8');

	$petsa_deliver = date('F-d-Y',strtotime("+3days"));
	$delivery_date = date('Y-m-d',strtotime("+3days"));
	$current_date = date('Y-m-d');

    echo'<title>CUSTOMER ORDER</title>';
    

	$product_code = '';
	$case = '';
	$count = '';
	$supplier_id = '';
	$processor = $_SESSION['user'];
	$quantity = '';
	$amount = '';
	$total = '';
	$case_shortage = '';	
	$new_quantity = '';
	$case = '';
	$product_name = '';
	$product_type = '';
	$selling_price = '';
	$stock = '';

	echo'<div style = "font-size:12px;">';
	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/credit_transactions/credit_transaction_redirect.php">';

	$new_batch_marketing = new Db();
	
				
				echo'<div style = "font-size:12px">';
				echo '<div style = "align:right;margin-right:0%;margin-top:5%;margin-left:10%">';
				echo '<h1>CUSTOMER&nbsp;&nbsp;ORDER</h1>';
				echo '<div><hr style= "width:103%;margin-right:0%;margin-top:-1%;margin-left:-10%"></div>';
				echo '<div style = "width: 11%;margin-left:78%;border-radius:2%;"><td>DELIVERY DATE:<input type = "text" name = "delivery_date" class = "form-control" value = "'.$petsa_deliver.'" readonly="readonly"style = "width:130%;"></td></div></br>';
				echo '</div>';
		
				echo'<div style = "align:left;margin-left:10%;margin-right:0%;float:left;width:40%;height:0%;">';
				
					echo'<select style = "width: 35%;border-radius:2px;" class="form-control" id="product_code" name = "product_code" style = "width: 200%;border-radius:2px;">
				     <option value = "">SELECT PRODUCT</option>';
						$get_product_info = $new_batch_marketing->query("SELECT product_code, product_name, product_type FROM products");
						foreach($get_product_info as $key){
								$product_code = $key['product_code'];
				          echo'<option value = "'.$key['product_code'].'">'.$key['product_name'].'&nbsp;&nbsp;('.$key['product_type'].')</option>';        
				}
				echo'  
				</select></br>

				<input style = "width: 35%;border-radius:2px;" type="text" class="form-control"name = "case" id = "case" value = "'.$case.'" placeholder = "number of case"></br>
				<input style = "width: 35%;border-radius:2px;background:#30493D;color:white;" type="submit" class="form-control"name = "submit" id = "submit" value = "SELECT"></br>
				<input style = "width: 35%;border-radius:2px;background:#30493D;color:white;" type="submit" class="form-control"name = "cancel" id = "cancel" value = "CANCEL">';
				echo'</div>';
				
				echo '<h4 style = "margin-left:20%;font-size:12px;">&nbsp;&nbsp;&nbsp;PURCHASE ORDER DETAILS</h4></br>';
			
				echo'<div class = "cust" style = "float:left;margin-left:27%;margin-top:-11%;width:60%"><table>';
				echo'<tr><td>Customer ID:&nbsp&nbsp;&nbsp;'.$_SESSION['customer_id'].'</td><td>Date:&nbsp&nbsp;&nbsp;'.$_SESSION['transaction_date'].'</td></tr>';
				echo'<tr><td>Customer name:&nbsp&nbsp;&nbsp;'.$_SESSION['customer_name'].'</td><td>Purchase Order ID:&nbsp&nbsp;&nbsp;'.$_SESSION['transaction_id'].'</td></tr>';
				echo'<tr><td>Customer address:&nbsp&nbsp;&nbsp;'.$_SESSION['address'].'</td><td>Agent:&nbsp&nbsp;&nbsp;'.$_SESSION['agent'].'</td></tr>';
				echo'<tr><td>Contact number:&nbsp&nbsp;&nbsp;'.$_SESSION['num'].'</td><td>Agent contact num.:&nbsp&nbsp;&nbsp;'.$_SESSION['agent_num'].'</td></tr>';
				echo'<tr><td colspan = "2">Process by.:&nbsp&nbsp;&nbsp;'.$processor.'</td></tr>';
				echo'</table></div></br>';

				echo'<div class = "cust" style = "float:left;margin-left:27%;margin-top:-1%;width:60%"><table>';
			    echo'<tr><td>PRODUCT NAME</td><td style = "padding-right:5%;">PRICE</td><td style = "padding-right:15%;">QTY</td><td colspan = "2" style = "padding-right:25%;">AMT</td></tr>';
			    echo'</table></div></br>';


			    echo'<div class = "rep" style = "float:left;margin-left:27%;margin-top:-11%;width:60%"><table>';

				$get_order_customer_entries = $new_batch_marketing->query("SELECT * FROM temporary_customer_order ORDER BY `id` DESC");  

			            if(empty($get_order_customer_entries)){
			               #do nothing
			            }
			            else{
			            	foreach($get_order_customer_entries as $key){
		                    $selected_product = $key['product_code'];
		                    $count = $count+$key['case'];
		                    $quantity = $key['case'];
		                    $total = $total + $key['amount'];
							echo '<tr>';
		                    echo '<td>'.$key['product_name'].'&nbsp;&nbsp;'.$key['product_type'].'</td><td style = "padding-right:5%;">'.$key['selling_price'].'</td><td style = "padding-right:10%;">'.$key['case'].'</td><td style = "padding-right:10%;">'.$key['amount'].'</td>';
		                    
		                    echo'<td><a href="?remove='.$selected_product.'"><img style = "height:20px;"src="../img/2.png"></a></td>
		                    </tr>';
		               		 }
            			}
            			echo'</table></div>';
						echo '</br>
						<div  style="float:left;margin-left:64%;margin-top:1%;font-size:12px;"><td><h5>CASE:&nbsp;&nbsp;&nbsp;'.$count.'</h5></td></div>
						<div style="float:left;margin-left:5%;margin-top:1%;font-size:12px;"><td><h5>TOTAL:&nbsp;&nbsp;&nbsp;'.$total.'</h5></td></div>';
			               
		                echo'</br></br>';
		                echo'<div style = "margin-left:46%;margin-top:30%">
		                <input style = "width: 30%;border-radius:2px;background:#30493D;color:white;" type = "submit" name = "confirm" value = "CONFIRM" class = "form-control"></br>
	                    <input style = "width: 30%;border-radius:2px;background:#30493D;color:white;" type = "submit" id = "cancel" name = "cancel" value = "CANCEL " class = "form-control">';
	                    echo'</div>';				

					if(isset($_GET['remove'])){ 
		               	$remove = $new_batch_marketing->query("DELETE FROM temporary_customer_order WHERE product_code = '".$_GET['remove']."' "); 
		               	echo '<script type="text/javascript">window.location.href = "credit_transaction_redirect.php";</script>';
						exit();
		               }

				
				if(isset($_POST['confirm'])){
						if(empty($get_order_customer_entries )){
							echo'<script>alert("EMPTY ORDER!")</script>';
						}else{
					
							$transaction_id = $_SESSION['transaction_id'];
							$transaction_date = $_SESSION['transaction_date'];
							$customer_id = $_SESSION['customer_id'];
							foreach($get_order_customer_entries as $key){
								$quantity = $key['case'];
								$amount = $key['amount'];
								$product_code = $key['product_code'];
								$selling_price = $key['selling_price'];

								$insert_into_customer_order_list = $new_batch_marketing->query("INSERT INTO customer_order_list(id,`purchase_order_id`,	`product_code`,`quantity`,`selling_price`,`amount`) VALUES(NULL,'$transaction_id','$product_code',$quantity,$selling_price,$amount)");

								$check_stock = $new_batch_marketing->query("SELECT `case` FROM `stocks` WHERE `stock_code` = '$product_code'");
								foreach($check_stock as $key){
									$stock = $key['case'] - $quantity;
									if($stock < 0){
										$stock = 0;
									}
									$update_stock = $new_batch_marketing->query("UPDATE `stocks` SET `case` = '$stock' WHERE stock_code = '$product_code'");
								}
							}
							$insert_into_customer_order = $new_batch_marketing->query("INSERT INTO customer_order(`purchase_order_id`,`customer_id`,`order_date`,`case`,`amount`,`delivery_date`,`processor`) VALUES('$transaction_id','$customer_id','$transaction_date',$count,$total,'$delivery_date','$processor')");

							$shortage = $new_batch_marketing->query("SELECT * FROM temporary_order_shortage");
							foreach($shortage as $key){
								$p_code = $key['prod_code'];
								$qty = $key['quantity'];

								$insert_into_shortage = $new_batch_marketing->query("INSERT INTO order_shortage(`prod_code`,`quantity`,`date`) VALUES('$p_code',$qty,'$current_date')");
							}

							$clear_temporary_container = $new_batch_marketing->query("TRUNCATE temporary_customer_order");
							$clear_temporary_container = $new_batch_marketing->query("TRUNCATE temporary_order_shortage");

							echo'<script>alert("ORDER has been processed SUCCESSFULLY!")</script>';
								echo '<script type="text/javascript">window.location.href = "credit_index.php";</script>';
										exit();
						}
						
				}

				if(isset($_POST['submit'])){
					$product_code = $_POST['product_code'];
					$case = $_POST['case'];
					
					if(empty($product_code) || empty($case)){
						echo '<script>alert("EMPTY FIELD IS DETECTED!")</script>';
					}
					else{

							$available_stock = $new_batch_marketing->query("SELECT product.product_name,product.product_type,product.selling_price, stock.case FROM stocks as stock INNER JOIN products as product on product.product_code = stock.stock_code where stock.stock_code = '$product_code'");
							foreach($available_stock as $key){
								$product_name = $key['product_name'];
								$product_type = $key['product_type'];
								$selling_price = $key['selling_price'];
								$stock = $key['case'];
								$amount = $selling_price * $case;
							}
							
							$trap = $new_batch_marketing->query("SELECT * FROM `temporary_order_shortage` WHERE `prod_code` = '$product_code'");
							if(empty($trap)){
								if($stock == 0){
								$case_shortage = $case;
								// echo'<script>alert("'.$product_name.'\t\t('.$product_type.')\t\t is out of stock")</script>';

								$insert_into_temporary_shortage = $new_batch_marketing->query("INSERT INTO `temporary_order_shortage`(`id`,`prod_code`,`quantity`) VALUES(NULL,'$product_code','$case_shortage')");	

								}
								else if($key['case'] < $case){
									$case_shortage = $case - $key['case'];
									// echo'<script>alert("available stock of '.$product_name.'\t\t('.$product_type.')\t\t is only '.$stock.'")</script>';
									$insert_into_temporary_shortage = $new_batch_marketing->query("INSERT INTO `temporary_order_shortage`(`id`,`prod_code`,`quantity`) VALUES(NULL,'$product_code','$case_shortage')");
								}
								else{}
							}else{
								foreach ($trap as $key) {
									$update_quantity = $key['quantity'] + $case;
								}
								$update_order_shortage = $new_batch_marketing->query("UPDATE `temporary_order_shortage` SET `quantity` = '$update_quantity' WHERE `prod_code` = '$product_code'");
							}
							
							$check = $new_batch_marketing->query("SELECT * FROM `temporary_customer_order` WHERE `product_code` = '$product_code'");
							if(!(empty($check))){
										foreach($check as $key){
											$new_quantity = $key['case'] + $case;
											$amount = $key['selling_price'] * $new_quantity;
										}
										$update_temp_order = $new_batch_marketing->query("UPDATE `temporary_customer_order` SET `case` = '$new_quantity', `amount` = '$amount' WHERE `product_code` = '$product_code'");
											echo '<script type="text/javascript">window.location.href = "credit_transaction_redirect.php";</script>';
											exit();	
							}else{
								$insert_into_temporary_customer_order = $new_batch_marketing->query("INSERT INTO `temporary_customer_order`(`id`,`product_code`,`product_name`,`product_type`,`selling_price`,`amount`,`case`) values(NULL,'$product_code','$product_name','$product_type','$selling_price','$amount','$case')");
								echo '<script type="text/javascript">window.location.href = "credit_transaction_redirect.php";</script>';
								exit();
							}
					}
				}

				if(isset($_POST['cancel'])){
								$clear_temporary_container = $new_batch_marketing->query("TRUNCATE temporary_customer_order");
								$clear_temporary_container = $new_batch_marketing->query("TRUNCATE temporary_order_shortage");
								echo '<script type="text/javascript">window.location.href = "credit_index.php";</script>';
										exit();
				}

	echo '</form>';
	echo'</div>';
	echo' <footer style = "margin-top:3%;"></footer>';
?>
