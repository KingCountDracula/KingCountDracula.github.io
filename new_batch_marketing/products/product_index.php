
<?php
	
	session_start();
    require("\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/products/product_index.php">';

	$new_batch_marketing = new Db();

	$product_code = '';
	$product_name = '';
	$product_type = '';
	$unit_price = '';
	$selling_price = '';

	$table = 'products';
	$column = 'product_code';
				

				if(isset($_POST['submit'])){

					$product_code = $_POST['product_code'];
					$product_name = $_POST['product_name'];
					$product_type = $_POST['product_type'];
					$unit_price = $_POST['unit_price'];
					$selling_price =$_POST['selling_price'];

					$check_exist = check_exist('product_code',$new_batch_marketing,'products',$product_code);

					if($product_code == '' || $product_name == '' || $product_type == '' || $unit_price == '' || $selling_price == ''){
						echo '<script>alert("empty field!")</script>';
					}
					else{

							if(!(is_numeric($unit_price)) || (!(is_numeric($selling_price)))){
							echo '<script>alert("Price accepts NUMERIC entries only!")</script>';
							}
							else if($check_exist > 0){
								echo '<script>alert("PRODUCT CODE already EXIST!")</script>';
							}
							else{
								// echo $check_exist;
								$insert_into_product = $new_batch_marketing->query("INSERT INTO `products` (`product_code`,`product_name`,`product_type`,`unit_price`,`selling_price`) VALUES('$product_code','$product_name','$product_type',$unit_price,$selling_price)");

								$insert_into_stocks = $new_batch_marketing->query("INSERT INTO stocks (stock_code) values ('$product_code')");

								echo '<script>alert("PRODUCT SUCCESSFULLY ADDED.")</script>';

									echo '<script type="text/javascript">window.location.href = "product_index.php";</script>';
									exit();	
							}					
						}
				}
				echo '<div style = "margin-top:8%;margin-left:10%;">';
						echo '<h1>PRODUCT ENTRY<h1>';
				echo '</div>';

				echo '<div><hr style= "width:90%;margin-top:-1%;margin-left:5%"></div>';

				echo '<div style = "margin-left:46%;margin-top:4%;">';

				echo '
				<input style = "width: 45%;border-radius:2px;"type="text" class="form-control" name = "product_code" id = "product_code"  placeholder = "Product Code"value = "'.$product_code.'"/></br>
				<input style = "width: 45%;border-radius:2px;" type="text" class="form-control"name = "product_name" id = "product_name"  placeholder = "Product Name" value = "'.$product_name.'"/></br>
				<input style = "width: 45%;border-radius:2px;" type="text" class="form-control" name = "product_type" id = "product_type" placeholder = "Description" value = "'.$product_type.'"/></br>
				<input style = "width: 45%;border-radius:2px;" type="text" class="form-control" name = "unit_price" id = unit_price" placeholder = "Unit Price" value = "'.$unit_price.'"/></br>
				<input style = "width: 45%;border-radius:2px;" type="text" class="form-control" name = "selling_price" id = "selling_price" placeholder = "Selling Price" value = "'.$selling_price.'"/></br>
				<input style = "width: 45%;border-radius:2px;background:#30493D;color:white;" type="submit" class="form-control"name = "submit" id = "submit" value = "ADD"></br>
				<div style = "font-size:12px;margin-left:36.5%;"><a href = "product_list.php">VIEW ALL</a></div>';
				echo '</div>';

	echo '</form>';
	echo' <footer style = "margin-top:4%;"></footer>';
?>               
