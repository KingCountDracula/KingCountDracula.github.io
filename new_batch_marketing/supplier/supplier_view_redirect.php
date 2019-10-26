<?php
	
	session_start();
    require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/supplier/supplier_view_redirect.php">';

	$new_batch_marketing = new Db();
	// $_SESSION['con'] = array();
	
					echo '<div style = "align:right;margin-top:7%;margin-left:10%;">';
					echo '<h1>SUPPLIER INFORMATION<h1>';
					echo '</div>';
					echo '<div><hr style= "width:90%;margin-top:-1%;margin-left:5%"></div>';
					echo '<div style = "align:right;margin-left:47%;margin-top:3%;">';

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
				 			 <input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "supplier_name" value = "'.$supplier_name.'" readonly = "readonly"/></br>
				 			 <input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "supplier_address" id = supplier_address" value = "'.$supplier_address.'" readonly = "readonly"/></br>
				 			 <input style = "width: 45%;border-radius:2px;" type = "text" class = "form-control" name = "supplier_contact_number" id = "supplier_contact_number" value = "'.$supplier_contact_number.'" readonly = "readonly"/></br>
				 			 <input style = "background:#30493D;color:white;width: 45%;border-radius:2px;" type = "submit" name = "cancel" id = "cancel" value = "OK" class = "form-control">
				 			</div>
							</div>
							</fieldset>
							</form>
							</div>
							</div>';
				 	
				 			if(isset($_POST['cancel'])){
						 				
								echo '<script type="text/javascript">window.location.href = "supplier_update.php";</script>';
								exit();	
				 			}
				
					
				
	echo '</form>';
	echo' <footer style = "margin-top:10%;"></footer>';
?> 
