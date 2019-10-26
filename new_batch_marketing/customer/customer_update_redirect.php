
<?php
	
	session_start();
    require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/customer/customer_update_redirect.php">';

	$new_batch_marketing = new Db();
	$customer_status = '';
	$area = '';
	$c_order = '';

					echo '<div style = "margin-top:8%;margin-left:10%;">';
					echo '<h1>UPDATE CUSTOMER<h1>';
					echo '</div>';
					echo '<div><hr style= "width:90%;margin-top:-1%;margin-left:5%"></div>';
					echo '<div style = "margin-left:46%;margin-top:4%;font-weight:normal">';

					foreach($_SESSION['costumer_container'] as $key){
							$customer_id = $key['customer_account_id'];
				 			$customer_lastName = $key['customer_lastName'];
				 			$customer_firstName = $key['customer_firstName'];
				 			$barangay = $key['barangay'];
				 			$town = $key['town'];
				 			$customer_contact_number = $key['customer_contact_number'];
				 			$customer_status = $key['customer_status'];
					}
				 			echo '<div>
							<form class="form-horizontal">
							<fieldset>
							<div class="form-group">
							<div class="col-lg-60">
			 				<input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "customer_id" id = "customer_id" value = "'.$customer_id.'" readonly = "readonly"/></br>
				 			 <input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "customer_lastName" id = "customer_lastName" value = "'.$customer_lastName.'"placeholder="LASTNAME"/></br>
				 			 <input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "customer_firstName" id = "customer_firstName" value = "'.$customer_firstName.'" placeholder="FIRSTNAME"/></br>
				 			 <input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "barangay" value = "'.$barangay.'"placeholder="BARANGAY"/></br>
				 			 <input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "town" value = "'.$town.'" placeholder="TOWN"/></br>
				 			 <input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "customer_contact_number" id = "customer_contact_number" value = "'.$customer_contact_number.'" placeholder="CONTACT NUMBER"/></br>
				 			<input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "customer_status" id = "customer_status" value = "'.$customer_status.'" readonly = "readonly"/></br>
				 			<div class="form-group">
						      <div class="col-lg-10">
						        <div class="radio">';
						          
						        if($customer_status == 'active'){
						        	 echo'<label><input type="radio" name="status" id="status" value="active" checked = "checked">ACTIVE</label></br>
 									 <label><input type="radio" name="status" id="status" value="inactive">INACTIVE</label>';
						        }else{
						        	 echo'<label><input type="radio" name="status" id="status" value="active">ACTIVE</label></br>
 									 <label><input type="radio" name="status" id="status" value="inactive" checked = "checked">INACTIVE</label>';
						        }
						       echo'</div>
						      </div>
						    </div>
				 			 <input style = "width: 45%;border-radius:2px;background:#30493D;color:white;" type = "submit" name = "update" id = "update" value = "UPDATE" class = "form-control"></br>
				 			 <input style = "width: 45%;border-radius:2px;background:#30493D;color:white;" type = "submit" name = "cancel" id = "cancel" value = "CANCEL" class = "form-control">
				 			</div>
							</div>
							</fieldset>
							</form>
							</div>';
				 	
							if(isset($_POST['update'])){

								$customer_id = $_POST['customer_id'];
							 	$customer_lastName = $_POST['customer_lastName'];
								$customer_firstName =$_POST['customer_firstName'];
								$barangay = $_POST['barangay'];
								$town = $_POST['town'];
								$customer_contact_number = $_POST['customer_contact_number'];
								$status = $_POST['status'];
				 		
								if(empty($customer_lastName) || empty($customer_firstName) || empty($barangay) || empty($town) || empty($customer_contact_number)){
									echo '<script>alert("empty field!")</script>';
								}
					 			else if(!(is_numeric($customer_contact_number))){
					 				echo '<script>alert("Number accepts NUMERIC entries only!")</script>';
					 			}
					 			else{
					 				if(empty($status) && $customer_status == 'inactive'){
					 					$status = 'inactive';
					 				}
					 				if(empty($status) && $customer_status == 'active'){
					 					$status = 'active';
					 				}

					 				$get_area = get_info('barangay','town',$new_batch_marketing,'area',$barangay,$town);
									foreach ($get_area as $key) {
										$area = $key['area'];
									}
									if(empty($get_area)){

				                         echo'<script>alert("Area is not registered yet.")</script>';
				                    }
				                    else{

				                    	if($status == 'inactive'){
				                    		$check_order = $new_batch_marketing->query("SELECT purchase_order_id FROM customer_order where customer_id = '$customer_id'");

						                    	foreach($check_order as $key){
						                    		$c_order = $key['purchase_order_id'];
						                    	}

						                    	if(!(empty($check_order))){
						                    		echo'<script>alert("EXISTING ORDER.")</script>';

						                    		$stmt = $new_batch_marketing->query("SELECT * FROM customer_order_list WHERE purchase_order_id = '".$c_order."'");
												// print_r($stmt);
											 	foreach ($stmt as $key) {
											 		$code = $key['product_code'];
											 		$case = $key['quantity'];

											 		$get_stock = $new_batch_marketing->query("SELECT `case` FROM `stocks` WHERE `stock_code` = '$code'");
											 		foreach($get_stock as $key){
											 			$qty = $case + $key['case'];
											 			$update_stock = $new_batch_marketing->query("UPDATE `stocks` SET `case` = $qty WHERE `stock_code` = '$code'");
											 		}
											 	}
											 		$update_order_status = $new_batch_marketing->query("UPDATE `customer_order` SET `status` = 'CANCELLED' WHERE `purchase_order_id` = '".$c_order."'");

											 		echo'<script>alert("Stocks has been successfully updated.")</script>';


											 		$update_customer = $new_batch_marketing->query("UPDATE customer SET customer_account_id = $customer_id, customer_lastName = '$customer_lastName', customer_firstName = '$customer_firstName', barangay = '$barangay', town = '$town', area = '$area', customer_contact_number = $customer_contact_number, customer_status = '$status'  WHERE customer_account_id = $customer_id");	

										echo'<script>alert("CUSTOMER HAS BEEN UPDATED SUCCESSFULLY.")</script>';
										echo '<script type="text/javascript">window.location.href = "customer_update.php";</script>';
										exit();

						                    }else{
						                    	#do_nothing....
						                    }
				                    	}else{
				                    		$update_customer = $new_batch_marketing->query("UPDATE customer SET customer_account_id = $customer_id, customer_lastName = '$customer_lastName', customer_firstName = '$customer_firstName', barangay = '$barangay', town = '$town', area = '$area', customer_contact_number = $customer_contact_number, customer_status = '$status'  WHERE customer_account_id = $customer_id");
						                echo'<script>alert("CUSTOMER HAS BEEN UPDATED SUCCESSFULLY.")</script>';	
										echo '<script type="text/javascript">window.location.href = "customer_update.php";</script>';
										exit();
				                    	}
					 				
									}
					 			}
				 			}
				 			if(isset($_POST['cancel'])){
						 				
										echo '<script type="text/javascript">window.location.href = "customer_update.php";</script>';
										exit();
				 			}
				
					echo '</div>';
				
	echo '</form>';
	echo' <footer style = "margin-top:4%;"></footer>';
?> 
