
<?php
	
	session_start();
    require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/supplier/supplier_update_redirect.php">';

	$new_batch_marketing = new Db();
	// $_SESSION['con'] = array();
	
					echo '<div style = "align:right;margin-right:10%;margin-top:7%;margin-left:10%;">';
					echo '<h1>UPDATE SUPPLIER<h1>';
					echo '</div>';
					echo '<div><hr style= "width:90%;margin-top:-1%;margin-left:5%"></div>';
					echo '<div style = "align:right;margin-left:47%;margin-top:5%;">';

					foreach($_SESSION['con'] as $key){
							$supplier_id = $key['supplier_account_id'];
				 			$supplier_name = $key['supplier_name'];
				 			$supplier_address = $key['supplier_address'];
				 			$supplier_contact_number = $key['supplier_contact_number'];
					}
				 			echo '<div>
				 			
							<form class="form-horizontal">
							<fieldset>
							<div class="form-group">
							<div class="col-lg-60">
			 				<input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "supplier_id" id = "supplier_id" value = "'.$supplier_id.'" readonly = "readonly"/></br>
				 			 <input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "supplier_name" value = "'.$supplier_name.'"/></br>
				 			 <input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "supplier_address" id = supplier_address" value = "'.$supplier_address.'"/></br>
				 			 <input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "supplier_contact_number" id = "supplier_contact_number" value = "'.$supplier_contact_number.'"/></br>
				 			 <input style = "background:#22ECAC;width: 45%;border-radius:2px;background:#30493D;color:white;" type = "submit" name = "update" id = "update" value = "UPDATE" class = "form-control"></br>
				 			 <input style = "background:#22ECAC;width: 45%;border-radius:2px;background:#30493D;color:white;" type = "submit" name = "cancel" id = "cancel" value = "CANCEL" class = "form-control">
				 			</div>
							</div>
							</fieldset>
							</form>
							
							</div>
							</div>';
				 	
							if(isset($_POST['update'])){

								$supplier_id = $_POST['supplier_id'];
							 	$supplier_name = $_POST['supplier_name'];
								$supplier_address = $_POST['supplier_address'];
								$supplier_contact_number = $_POST['supplier_contact_number'];
				 		
								if(empty($supplier_name) || empty($supplier_address) || empty($supplier_contact_number)){
									echo '<script>alert("empty field!")</script>';
								}
					 			else if(!(is_numeric($supplier_contact_number))){
					 				echo '<script>alert("Number accepts NUMERIC entries only!")</script>';
					 			}
					 			else{
					 				$update_supplier = $new_batch_marketing->query("UPDATE supplier SET supplier_account_id = $supplier_id, supplier_name = '$supplier_name',supplier_address = '$supplier_address', supplier_contact_number = $supplier_contact_number  WHERE supplier_account_id = $supplier_id");
								
						 		 		
									echo '<script>alert("UPDATE SUCESSFUL")</script>';
									echo '<script type="text/javascript">window.location.href = "supplier_update.php";</script>';
									exit();	
					 			}
				 			}
				 			if(isset($_POST['cancel'])){
						 				
									echo '<script type="text/javascript">window.location.href = "supplier_update.php";</script>';
									exit();	
				 			}
				
					
				
	echo '</form>';
	echo' <footer style = "margin-top:5%;"></footer>';
?> 
