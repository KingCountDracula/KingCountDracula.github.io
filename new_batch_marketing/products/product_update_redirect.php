
<?php
	
	session_start();
    require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/products/product_update_redirect.php">';

	$new_batch_marketing = new Db();

	
					echo '<div style = "margin-top:8%;margin-left:10%;">';
					echo '<h1>UPDATE PRODUCT<h1>';
					echo '</div>';
					echo '<div><hr style= "width:90%;margin-top:-1%;margin-left:5%"></div>';
					echo '<div style = "margin-left:46%;margin-top:4%;font-weight:normal">';

					foreach($_SESSION['product_container'] as $key){
							$product_code = $key['product_code'];
				 			$product_name = $key['product_name'];
				 			$product_type = $key['product_type'];
				 			$unit_price = $key['unit_price'];
				 			$selling_price = $key['selling_price'];
					}
				 			echo '<div>
							<form class="form-horizontal">
							<fieldset>
							<div class="form-group">
							<div class="col-lg-60">
			 				<input style = "width: 45%;border-radius:2px;"type="text" class="form-control" name = "product_code" id = "product_code"  placeholder = "Product Code"value = "'.$product_code.'" readonly = "readonly"/></br>
							<input style = "width: 45%;border-radius:2px;" type="text" class="form-control"name = "product_name" id = "product_name"  placeholder = "Product Name" value = "'.$product_name.'"/></br>
							<input style = "width: 45%;border-radius:2px;" type="text" class="form-control" name = "product_type" id = "product_type" placeholder = "Description" value = "'.$product_type.'"/></br>
							<input style = "width: 45%;border-radius:2px;" type="text" class="form-control" name = "unit_price" id = unit_price" placeholder = "Unit Price" value = "'.$unit_price.'"/></br>
							<input style = "width: 45%;border-radius:2px;" type="text" class="form-control" name = "selling_price" id = "selling_price" placeholder = "Selling Price" value = "'.$selling_price.'"/></br>
				 			 <input style = "background:#30493D;color:white;width: 45%;border-radius:2px;" type = "submit" name = "update" id = "update" value = "UPDATE" class = "form-control"></br>
				 			 <input style = "background:#30493D;color:white;width: 45%;border-radius:2px;" type = "submit" name = "cancel" id = "cancel" value = "CANCEL" class = "form-control">
				 			</div>
							</div>
							</fieldset>
							</form>
							</div>';
				 	
							if(isset($_POST['update'])){

								$product_code = $_POST['product_code'];
							 	$product_name = $_POST['product_name'];
								$product_type =$_POST['product_type'];
								$unit_price = $_POST['unit_price'];
								$selling_price = $_POST['selling_price'];
						
								if($product_code == '' || $product_name == '' || $product_type == '' || $unit_price == '' || $selling_price == ''){
									echo '<script>alert("empty field!")</script>';
								}
					 			else if(!(is_numeric($selling_price)) || (!(is_numeric($unit_price)))){
					 				echo '<script>alert("Number accepts NUMERIC entries only!")</script>';
					 			}
					 			else{
					 				$update_product = $new_batch_marketing->query("UPDATE products SET product_code = '$product_code', product_name = '$product_name', product_type = '$product_type', unit_price = $unit_price, selling_price = $selling_price WHERE product_code = '$product_code'");
								
						 		 		
										echo '<script type="text/javascript">window.location.href = "product_update.php";</script>';
										exit();
					 			}
				 			}
				 			if(isset($_POST['cancel'])){
						 				
				 						echo '<script type="text/javascript">window.location.href = "product_update.php";</script>';
										exit();
				 			}
				
					echo '</div>';		
	echo '</form>';
	echo' <footer style = "margin-top:7%;"></footer>';
?> 
