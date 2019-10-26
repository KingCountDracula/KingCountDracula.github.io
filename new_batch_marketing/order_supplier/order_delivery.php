
<?php
	
	session_start();
	require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");
	$_SESSION['poid'] = '';
	date_default_timezone_set('Asia/Manila');

	$transaction_id = '';
	$processor = '';
	$transaction_date = '';
	$supplier = '';
	$count = 0;
	
	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/order_supplier/order_delivery.php">';

	$new_batch_marketing = new Db();
	

				echo'<div style = "font-size:12px">';
				echo '<div style = "margin-top:7%;margin-left:10%">';
				echo '<h1>PRODUCT DELIVERY<h1>';
				echo '<div><hr style= "width:100%;margin-top:-1%;margin-left:-4%"></div>';
				echo '</div>';
		
				echo'<div style = "align:left;margin-left:10%;margin-right:0%;float:left;width:35%;height:0%;">';
				
				echo'<input style = "width: 45%;border-radius:2px;type = "text" name = "transaction_id" class = "form-control" placeholder = "P.O ID"></br>
				<input style = "width: 45%;border-radius:2px;background:#30493D;color:white;" type="submit" class="form-control"name = "search" id = "search" value = "SEARCH"></br>
				<input style = "width: 45%;border-radius:2px;background:#30493D;color:white;" type="submit" class="form-control"name = "cancel" id = "cancel" value = "CANCEL">';
				echo'</div>';

				echo'<div style = "align:left;float:left;margin-left:45%;margin-top:-11%;width:95%;height:70%;">';
							echo'<table style = "align:center;margin-top:10%;width:100%;height:70%;"overflow:scroll;border-size:2px;border-color:white;border-style:solid;"></br>';
				echo'</table></div>';			
				
				if(isset($_POST['search'])){

					$transaction_id = $_POST['transaction_id'];
					if(empty($transaction_id)){
						echo '<script>alert("EMPTY FIELD")</script>';
					}
					else{
						
						$_SESSION['poid'] = $transaction_id;

						$get_order_details = $new_batch_marketing->query("SELECT os.supplier_id,os.order_date,os.processed_by,osl.product_code,osl.quantity FROM order_supplier_list AS osl INNER JOIN order_supplier as os ON os.order_supplier_id = osl.order_supplier_id WHERE osl.order_supplier_id = '$transaction_id'");

						foreach($get_order_details as $key){
								
								$product_code = $key['product_code'];
								$quantity = $key['quantity'];
								
								$temp = $new_batch_marketing->query("INSERT INTO temporary_order_supplier(`id`,`product_code`,`quantity`) VALUES(NULL,'$product_code',$quantity)");

						echo '<script type="text/javascript">window.location.href = "order_delivery_redirect.php";</script>';
						exit();
						}
					}
				}
				if(isset($_POST['cancel'])){
					$clear_temporary_container = $new_batch_marketing->query("TRUNCATE temporary_order_supplier");
					echo '<script type="text/javascript">window.location.href = "order_supplier_index.php";</script>';
							exit();
				}

	echo '</form>';
	echo' <footer style = "margin-top:33%;"></footer>';
	echo'</div>';
?>


