
<?php
	
	session_start();
    require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/products/product_update.php">';

	$new_batch_marketing = new Db();
	$_SESSION['product_container'] = array();
	
					echo '<div style = "margin-top:9%;margin-left:10%;">';
					echo '<h1>PRODUCT DASBOARD<h1>';
					echo '</div>';
					echo '<div><hr style= "width:90%;margin-top:-1%;margin-left:5%"></div>';
					echo '<div style = "margin-left:46%;margin-top:4%;">';

					echo'
				     <select class="form-control" id="product_code" name = "product_code"style="width:45%">
				     <option value = "">SELECT PRODUCT</option>';
				     

				$get_product_info = $new_batch_marketing->query("SELECT product_code, product_name, product_type FROM products");
				foreach($get_product_info as $key){
			          echo'<option value = "'.$key['product_code'].'">'.$key['product_name']."&nbsp;&nbsp;&nbsp;(".$key['product_type'].')</option>';
				}
				echo'  
				</select></br>
				<input style = "background:#22ECAC;width: 45%;border-radius:2px;background:#30493D;color:white;" type="submit" class="form-control"name = "search" id = "search" value = "UPDATE"></br>

				<input style = "background:#22ECAC;width: 45%;border-radius:2px;background:#30493D;color:white;" type="submit" class="form-control"name = "view" id = "view" value = "VIEW"></br>
				<div style = "font-size:12px;margin-left:36.5%;"><a href = "product_list.php">VIEW ALL</a></div>';

				if(isset($_POST['search'])){

					$product_code = $_POST['product_code'];
		
					if(empty($product_code)){
						echo '<script>alert("EMPTY field is DETECTED!")</script>';
					}
					else{

			 		$inquire_to_product =  $new_batch_marketing->query("SELECT product_code, product_name, product_type,unit_price, selling_price FROM products where product_code = '$product_code'");

			 			if(empty($inquire_to_product)){
			 				echo '<script>alert("No record found!")</script>';
			 			}
			 			else{
				 			$_SESSION['product_container'] = $inquire_to_product;
				 			echo '<script type="text/javascript">window.location.href = "product_update_redirect.php";</script>';
							exit();	
				 		}
				}
			}

			if(isset($_POST['view'])){

					$product_code = $_POST['product_code'];
		
					if(empty($product_code)){
						echo '<script>alert("EMPTY field is DETECTED!")</script>';
					}
					else{

			 		$inquire_to_product =  $new_batch_marketing->query("SELECT product_code, product_name, product_type, bottle_per_case, unit_price, selling_price FROM products where product_code = '$product_code'");

			 			if(empty($inquire_to_product)){
			 				echo '<script>alert("No record found!")</script>';
			 			}
			 			else{
				 			$_SESSION['product_container'] = $inquire_to_product;
				 			echo '<script type="text/javascript">window.location.href = "product_view_redirect.php";</script>';
							exit();	
				 		}
				}
			}			
	echo '</div>
	</form>';
	echo' <footer style = "margin-top:14%;"></footer>';
?> 
