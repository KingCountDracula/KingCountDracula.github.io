
<?php
session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");
date_default_timezone_set('Etc/GMT+8');
    
    echo'<title>PRODUCT ORDER</title>';

	$order_id = 'O'.date("ymdhis").'S';
	$order_date = date("Y-m-d");
	$supplier_id = '';

	$_SESSION['transaction_id'] = '';
	$_SESSION['transactiond_date'] = '';
	$_SESSION['supplier_id'] = '';
	$_SESSION['supplier_name'] = '';
	$_SESSION['supplier_add'] = '';
	$_SESSION['contact'] = '';

	$product_code = '';
	$case = '';
	$count = '';
	$supplier_id = '';
	$processor = '';
	$quantity = '';
	$supplier_name = '';
	$supplier_address = '';
	$supplier_contact = '';

	echo'<div style = "font-size:12px;">';
	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/order_supplier/order_supplier_index.php">';

	$new_batch_marketing = new Db();
	
				echo '<div style = "align:left;;margin-top:5%;margin-left:10%;">';
				echo '<h1>PRODUCT ORDER<h1>';
				echo '<div><hr style= "width:90%;margin-top:-1%;margin-left:-5%"></div>';
				echo '</div>';

				echo'<div style = "align:left;margin-left:25%;margin-right:0%;float:left;">';
				echo'<div style = "align:left;margin-left:-70%;">TRANSACTION DATE:</div>
				<div style = "align:left;margin-left:-70%;"><input style = "width:  80%;border-radius:2px;" type = "text" class = "form-control" name = "date" value = "'.$order_date.'"readonly = "readonly"></div>
				<div style = "align:left;margin-left:-70%;">PURCHASE ID:</div>
				<div style = "align:left;margin-left:-70%;"><input type = "text" style = "width: 80%;border-radius:2px;"class = "form-control" name = "date" value = "'.$order_id.'"readonly = "readonly"></div></br>';

				echo'<div style = "align:left;margin-left:-70%;"><select style = "width: 80%;border-radius:2px;" class="form-control" id="supplier_account_id" name = "supplier_account_id">
				     <option value = "">SELECT SUPPLIER</option>';

					$get_supplier_info = $new_batch_marketing->query("SELECT * 	FROM supplier");
					foreach($get_supplier_info as $key){
						  $supplier_name = $key['supplier_name'];
						  $supplier_address = $key['supplier_address'];
						  $supplier_contact = $key['supplier_contact_number'];

				          echo'<option value = "'.$key['supplier_account_id'].'">'.$key['supplier_name'].'</option>';
					}
					echo'  
					</select></br>';
					echo'<select style = "width: 80%;border-radius:2px;" class="form-control" id="product_code" name = "product_code" style = "width: 200%;border-radius:2px;">
				     <option value = "">SELECT PRODUCT</option>';
						$get_product_info = $new_batch_marketing->query("SELECT product_code, product_name, product_type FROM products");
						foreach($get_product_info as $key){
								$product_code = $key['product_code'];
				          echo'<option value = "'.$key['product_code'].'">'.$key['product_name'].'&nbsp;&nbsp;('.$key['product_type'].')</option>';        
				}
				echo'  
				</select></br>

				<input style = "width: 80%;border-radius:2px;" type="text" class="form-control"name = "case" id = "case" value = "'.$case.'" placeholder = "NUMBER OF CASE"></br>
				<input style = "width: 80%;border-radius:2px;background:#30493D;color:white;" type="submit" class="form-control"name = "submit" id = "submit" value = "SELECT"></div>';
				echo'</div>';

				if(isset($_POST['submit'])){

					$supplier_id = $_POST['supplier_account_id'];
					$product_code = $_POST['product_code'];
					$case = $_POST['case'];

					if(empty($product_code) || empty($case)){
						echo '<script>alert("EMPTY FIELD IS DETECTED!")</script>';
					}
					else{
								
								$_SESSION['transaction_id'] = $order_id;
								$_SESSION['transaction_date'] = $order_date;
								$_SESSION['supplier_id'] = $supplier_id;
								$_SESSION['supplier_name'] = $supplier_name;
								$_SESSION['supplier_add'] = $supplier_address;
								$_SESSION['contact'] = $supplier_contact;

								$insert_temporary_order_supplier = $new_batch_marketing->query("INSERT INTO temporary_order_supplier(`id`,`product_code`,`quantity`) VALUES(NULL,'$product_code',$case)");

									echo '<script type="text/javascript">window.location.href = "order_supplier_redirect.php";</script>';
								exit();
					}
				}

	echo '</form>';
	echo'</div>';
	echo' <footer style = "margin-top:35%;"></footer>';
?>


