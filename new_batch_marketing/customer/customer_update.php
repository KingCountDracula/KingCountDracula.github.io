
<?php
	
	session_start();
    require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");


	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/customer/customer_update.php">';

	$new_batch_marketing = new Db();
	$_SESSION['customer_container'] = array();
	$customer_id = '';
	
					
					echo '<div style = "margin-top:7%;margin-left:10%;">';
					echo '<h1>CUSTOMER DASBOARD<h1>';
					echo '</div>';
					echo '<div><hr style= "width:90%;margin-top:-1%;margin-left:5%;"></div>';
					

				if(isset($_POST['search'])){

					$customer_id = $_POST['customer'];

						if(empty($customer_id)){
							echo'<script>alert("FILL UP FORMS COMPLETELY")</script>';
						}
						else{

				 		$inquire_to_customer =  $new_batch_marketing->query("SELECT * FROM `customer` WHERE `customer_account_id` = $customer_id");

				 			if(empty($inquire_to_customer)){
				 				echo '<script>alert("No record found!")</script>';
				 			}
				 			else{
					 			$_SESSION['costumer_container'] = $inquire_to_customer;
					 			echo '<script type="text/javascript">window.location.href = "customer_view_redirect.php";</script>';
							exit();
					 		}
				 	}
				}

				if(isset($_POST['update'])){

					$customer_id = $_POST['customer'];

						if(empty($customer_id)){
							echo'<script>alert("FILL UP FORMS COMPLETELY")</script>';
						}
						else{


				 		$inquire_to_customer =  $new_batch_marketing->query("SELECT * FROM `customer` WHERE `customer_account_id` = $customer_id");

				 			if(empty($inquire_to_customer)){
				 				echo '<script>alert("No record found!")</script>';
				 			}
				 			else{
					 			$_SESSION['costumer_container'] = $inquire_to_customer;
					 			echo '<script type="text/javascript">window.location.href = "customer_update_redirect.php";</script>';
							exit();
					 		}
				 	}
				}

				$get_customer_info = $new_batch_marketing->query("SELECT * FROM customer ORDER BY customer_firstName ASC");
				echo '<div style = "margin-left:46%;margin-top:5%;">
					<select = name = "customer" class = "form-control" style = "width: 45%;border-radius:2px;">
					<option value = "">SELECT ACCOUNT</option>';
					foreach($get_customer_info as $key){
						echo'<option value = "'.$key['customer_account_id'].'">'.$key['customer_firstName']."\t\t".$key['customer_lastName'].'</option>';
					}
					echo'</select></br>';
					echo'<input style = "width: 45%;border-radius:2px;background:#30493D;color:white;" type="submit" class="form-control"name = "search"value = "VIEW"></br>
					<input style = "width: 45%;border-radius:2px;background:#30493D;color:white;" type="submit" class="form-control"name = "update"value = "UPDATE">
			      	</div></br>
			      	<div style = "font-size:12px;margin-left:66%;"><a href = "customer_list.php">VIEW ALL</a></div>';	
	echo '</form>';
	echo' <footer style = "margin-top:16%;"></footer>';
?> 
