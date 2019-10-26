
<?php

	session_start();
	require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");
	date_default_timezone_set('Etc/GMT+8');
		
    echo'<title>PRODUCT ORDER</title>';

	$delivery_date = date('Y-m-d', strtotime("+3 days"));

	$product_code = '';
	$case = '';
	$count = '';
	$supplier_id = '';
	$processor = 'ADMIN';
	$quantity = '';	

	echo'<div style = "font-size:12%;">';
	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/order_supplier/order_supplier_redirect.php">';

	$new_batch_marketing = new Db();
	
				echo'<div style = "font-size:12px">';
				echo '<div style = "align:right;margin-right:0%;margin-top:6%;margin-left:10%">';
				echo '<h1>PRODUCT ORDER<h1>';
				echo '<div><hr style= "width:100%;margin-right:0%;margin-top:-1%;margin-left:-5%"></div>';
				echo '</div>';
		
				echo'<div style = "align:left;margin-left:10%;float:left;width:20%;height:0%;">';
				
					echo'<select style = "width: 70%;border-radius:2px;" class="form-control" id="product_code" name = "product_code" style = "width: 200%;border-radius:2px;">
				     <option value = "">SELECT PRODUCT</option>';
						$get_product_info = $new_batch_marketing->query("SELECT product_code, product_name, product_type FROM products");
						foreach($get_product_info as $key){
								$product_code = $key['product_code'];
				          echo'<option value = "'.$key['product_code'].'">'.$key['product_name'].'&nbsp;&nbsp;('.$key['product_type'].')</option>';        
				}
				echo'  
				</select></br>

				<input style = "width: 70%;border-radius:2px;" type="text" class="form-control"name = "case" id = "case" value = "'.$case.'" placeholder = "number of case"></br>
				<input style = "width: 70%;border-radius:2px;background:#30493D;color:white;" type="submit" class="form-control"name = "submit" id = "submit" value = "SELECT"></br>
				<input style = "width: 70%;border-radius:2px;background:#30493D;color:white;" type="submit" class="form-control"name = "cancel" id = "cancel" value = "CANCEL">';
				echo'</div>';


		$print ='<script>
function printpage()
  {
  window.print()
  }
</script>';

				$print.='<label style = "margin-left:22%;">PURCHASE ORDER DETAILS</label></br></br></br>';

				$print.='<div class = "cust" style = "float:left;margin-left:27%;margin-top:-9%;width:60%"><table>';
				$print.='<tr><td>SUPPLIER ID:&nbsp;&nbsp;&nbsp;'.$_SESSION['supplier_id'].'</td><td>ORDER DATE:'.$_SESSION['transaction_date'].'</td></tr>';
				$print.='<tr><td>SUPPLIER:SUPPLIER NAME:&nbsp;&nbsp;&nbsp;'.$_SESSION['supplier_name'].'</td><td>PURCHASE ORDER ID:&nbsp;&nbsp;&nbsp;'.$_SESSION['transaction_id'].'</td></tr>';
				$print.='<tr><td>SUPPLIER:SUPPLIER CONTACT NO.:&nbsp;&nbsp;&nbsp;'.$_SESSION['contact'].'</td><td>PROCESS BY:&nbsp;&nbsp;&nbsp;&nbsp;'.$processor.'</td></tr>';
				$print.='<tr><td colspan = "2">SUPPLIER ADDRESS:&nbsp;&nbsp;&nbsp;'.$_SESSION['supplier_add'].'</td></tr>';
				$print.='</table></div></br>';

				$print.='<div class = "cust" style = "float:left;margin-left:27%;margin-top:-9%;width:60%"><table>';
				$print.='<tr><td>PRODUCT NAME</td><td style = "padding-right:8.76%;">QTY</td></tr></table></div>';

				$print.='<div class = "rep" style = "float:left;margin-left:27%;margin-top:-13.5%;width:60%"><table>';

				$get_order_supplier_entries = $new_batch_marketing->query("SELECT products.product_code,products.product_name, products.product_type, orders.id,orders.product_code,orders.quantity FROM temporary_order_supplier AS orders INNER JOIN products AS products ON products.product_code = orders.product_code ORDER BY orders.id DESC");  

			            if(empty($get_order_supplier_entries)){
			               #do nothing
			            }
			            else{
			          		  	
			            	foreach($get_order_supplier_entries as $key){
		                    $selected_product = $key['product_code'];
		                    $count = $count+$key['quantity'];
		                    $quantity = $key['quantity'];
							$print.='<tr>';
		                    $print.='<td>'.$key['product_name'].'&nbsp;&nbsp;'.$key['product_type'].'</td>';
		                    $print.='<td>'.$key['quantity'].'</td>
		                    <td><a href="?remove='.$selected_product.'"name = "remove"><img style = "height:20px;"src="../img/2.png"></a></td>
		                    </tr>';
		               		 }
            			}

				$print.='</table></div>';
						$print.='<div style="margin-left:76.5%;width:30%;margin-top:24%;"><p>TOTAL CASE:&nbsp;&nbsp;&nbsp;'.$count.'</p></div>';
			               echo $print;
		                echo'</br></br>';
		                echo'<div style = "margin-left:50%;align:center;margin-top:10%:">
		                
						<input type="button" value="CONFIRM" onclick="printpage()"style = "width: 20%;border-radius:2px;background:#30493D;color:white;"class = "form-control" name = "confirm"></br>
		              
	                    <input style = "width: 20%;border-radius:2px;background:#30493D;color:white;" type = "submit" id = "cancel" name = "cancel" value = "CANCEL " class = "form-control">';
	                    echo'</div>';
				echo'</div>';

					if(isset($_GET['remove'])){ 
		               	$remove = $new_batch_marketing->query("DELETE FROM temporary_order_supplier WHERE product_code = '".$_GET['remove']."' "); 
		               	echo '<script type="text/javascript">window.location.href = "order_supplier_redirect.php";</script>';
						exit();
		               }

				
					if(isset($_POST['confirm'])){

							$order_id = $_SESSION['transaction_id'];
							$supplier_id = $_SESSION['supplier_id'];
							$order_date = $_SESSION['transaction_date'];

							$insert_into_order_supplier = $new_batch_marketing->query("INSERT INTO order_supplier(`order_supplier_id`,`supplier_id`,`order_date`,`processed_by`,`total_case`) VALUES('$order_id','$supplier_id','$order_date','$processor',$count)");

							foreach($get_order_supplier_entries as $key){
								$product_code = $key['product_code'];
								$quantity = $key['quantity'];
							$insert_into_order_supplier_list = $new_batch_marketing->query("INSERT INTO order_supplier_list(`id`,`order_supplier_id`,`product_code`,`quantity`) VALUES(NULL,'$order_id','$product_code',$quantity)");
							}

							$clear_temporary_container = $new_batch_marketing->query("TRUNCATE temporary_order_supplier");
							echo'<script>alert("DONE")</script>';
							echo '<script type="text/javascript">window.location.href = "order_supplier_index.php";</script>';
									exit();	
					}

				if(isset($_POST['submit'])){
					$product_code = $_POST['product_code'];
					$case = $_POST['case'];
					
					if(empty($product_code) || empty($case)){
						echo '<script>alert("EMPTY FIELD IS DETECTED!")</script>';
					}
					else{
								
								$trap = check_exist($product_code,$new_batch_marketing,'temporary_order_supplier','product_code');
								if($trap > 0){
									$quantity = get_quantity($new_batch_marketing,'temporary_order_supplier','quantity','product_code',$product_code);
									$new_quantity = $quantity + $case;

									$update_order_supplier = $new_batch_marketing->query("UPDATE `temporary_order_supplier` SET `quantity` = '$new_quantity' WHERE `product_code` = '$product_code'");

									echo '<script type="text/javascript">window.location.href = "order_supplier_redirect.php";</script>';
									exit();
								}else{
								$insert_temporary_order_supplier = $new_batch_marketing->query("INSERT INTO temporary_order_supplier(`id`,`product_code`,`quantity`) VALUES(NULL,'$product_code',$case)");

									echo '<script type="text/javascript">window.location.href = "order_supplier_redirect.php";</script>';exit();
								}
					}
				}

				if(isset($_POST['cancel'])){
								$clear_temporary_container = $new_batch_marketing->query("TRUNCATE temporary_order_supplier");
								echo '<script type="text/javascript">window.location.href = "order_supplier_index.php";</script>';
										exit();
				}

	echo '</form>';
	echo'</div>';
	echo' <footer style = "margin-top:5%;"></footer>';
	echo'</div>';
?>
