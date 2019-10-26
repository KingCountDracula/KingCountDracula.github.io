
<?php
	
	session_start();
    require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/customer/customer_view_redirect.php">';

	$new_batch_marketing = new Db();

					echo '<div style = "margin-top:8%;margin-left:10%;">';
					echo '<h1>CUSTOMER NFORMATION<h1>';
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
				 			 <input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "customer_lastName" id = "customer_lastName" value = "'.$customer_lastName.'" readonly = "readonly"/></br>
				 			 <input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "customer_firstName" id = "customer_firstName" value = "'.$customer_firstName.'" readonly = "readonly"/></br>
				 			 <input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "barangay" value = "'.$barangay.'" readonly = "readonly"/></br>
				 			 <input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "town" value = "'.$town.'" readonly = "readonly"//></br>
				 			 <input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "customer_contact_number" id = "customer_contact_number" value = "'.$customer_contact_number.'" readonly = "readonly"/></br>
				 			<input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "customer_status" id = "customer_status" value = "'.$customer_status.'" readonly = "readonly" readonly = "readonly"/></br>
				 			
				 			 <input style = "width: 45%;border-radius:2px;background:#30493D;color:white;" type = "submit" name = "cancel" id = "cancel" value = "OK" class = "form-control">
				 			</div>
							</div>
							</fieldset>
							</form>
							</div>';
				 	
							
				 			if(isset($_POST['cancel'])){
						 				
										echo '<script type="text/javascript">window.location.href = "customer_update.php";</script>';
										exit();
				 			}
				
					echo '</div>';
				
	echo '</form>';
	echo' <footer style = "margin-top:4%;"></footer>';
?> 
