
<?php
	
	session_start();
    require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/products/product_view_redirect.php">';

	$new_batch_marketing = new Db();

	
					echo '<div style = "margin-top:8%;margin-left:10%;">';
					echo '<h1>PRODUCT INFORMATION<h1>';
					echo '</div>';
					echo '<div><hr style= "width:90%;margin-top:-1%;margin-left:5%"></div>';
					echo '<div style = "margin-left:46%;margin-top:4%;font-weight:normal">';

					foreach($_SESSION['product_container'] as $key){
							$product_code = $key['product_code'];
				 			$product_name = $key['product_name'];
				 			$product_type = $key['product_type'];
				 			$bottle_per_case = $key['bottle_per_case'];
				 			$unit_price = $key['unit_price'];
				 			$selling_price = $key['selling_price'];
					}
				 			echo '<div>
			 				<input style = "width: 45%;border-radius:2px;"type="text" class="form-control" name = "product_code" id = "product_code"  placeholder = "Product Code"value = "'.$product_code.'" readonly = "readonly"/></br>
							<input style = "width: 45%;border-radius:2px;" type="text" class="form-control"name = "product_name" id = "product_name"  placeholder = "Product Name" value = "'.$product_name.'" readonly = "readonly"/></br>
							<input style = "width: 45%;border-radius:2px;" type="text" class="form-control" name = "product_type" id = "product_type" placeholder = "Description" value = "'.$product_type.'" readonly = "readonly"/></br>
							<input style = "width: 45%;border-radius:2px;" type="text" class="form-control" name = "bottle" id = "bottle" placeholder = "Bottle per case" value = "'.$bottle_per_case.'" readonly = "readonly"/></br>
							<input style = "width: 45%;border-radius:2px;" type="text" class="form-control" name = "unit_price" id = unit_price" placeholder = "Unit Price" value = "'.$unit_price.'" readonly = "readonly"/></br>
							<input style = "width: 45%;border-radius:2px;" type="text" class="form-control" name = "selling_price" id = "selling_price" placeholder = "Selling Price" value = "'.$selling_price.'" readonly = "readonly"/></br>
				 			
				 			 <input style = "background:#30493D;color:white;width: 45%;border-radius:2px;" type = "submit" name = "cancel" id = "cancel" value = "OK" class = "form-control">
				 			</div>
							</div>';
				 	
							
				 			if(isset($_POST['cancel'])){
						 				
				 						echo '<script type="text/javascript">window.location.href = "product_update.php";</script>';
										exit();
				 			}
				
					echo '</div>';
				
	echo '</form>';
	echo' <footer style = "margin-top:4%;"></footer>';
?> 