<?php
	
	session_start();
      require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/supplier/supplier_update.php">';

	$new_batch_marketing = new Db();
	$_SESSION['con'] = array();
	
					echo '<div style = "align:right;margin-right:10%;margin-top:8%;margin-left:10%;">';
					echo '<h1>SUPPLIER DASHBOARD<h1>';
					echo '</div>';
					echo '<div><hr style= "width:87%;margin-right:0%;margin-top:-1%;margin-left:6%"></div>';
					echo '<div style = "align:right;margin-left:47%;margin-top:3%;">';
					echo'<div class="form-group">
				     <select style = "width:45%;"class="form-control" id="supplier_account_id" name = "supplier_account_id">
				     <option value = "">SELECT SUPPLIER</option>';  
					$get_supplier_info = $new_batch_marketing->query("SELECT supplier_account_id, supplier_name FROM supplier");
					foreach($get_supplier_info as $key){
				          echo'<option value = "'.$key['supplier_account_id'].'">'.$key['supplier_name'].'</option>';
					}
					echo'  
					</select></br>
					<input style = "width: 45%;border-radius:2px;background:#30493D;color:white;" type="submit" class="form-control"name = "search" id = "search" value = "UPDATE"></br>
					<input style = "width: 45%;border-radius:2px;background:#30493D;color:white;" type="submit" class="form-control"name = "view" id = "view" value = "VIEW"></br>
					<div style = "font-size:12px;margin-left:36.5%;"><a href = "supplier_list.php">VIEW ALL</a></div>
					</div>
			      	</div>
			      	</li>
			      	</div>';

				if(isset($_POST['search'])){

					$supplier_account_id = $_POST['supplier_account_id'];
		
					if(empty($supplier_account_id)){
						echo '<script>alert("EMPTY field is DETECTED!")</script>';
					}
					else if(!(is_numeric($supplier_account_id))){
						echo '<script>alert("ENTER NUMERIC VALUES ONLY!")</script>';
					}
					else{

			 		$inquire_to_supplier =  $new_batch_marketing->query("SELECT supplier_account_id, supplier_name, supplier_address, supplier_contact_number FROM supplier where supplier_account_id = $supplier_account_id");

			 			if(empty($inquire_to_supplier)){
			 				echo '<script>alert("No record found!")</script>';
			 			}
			 			else{
				 			$_SESSION['con'] = $inquire_to_supplier;
				 			 echo '<script type="text/javascript">window.location.href = "supplier_update_redirect.php";</script>';
                    		 exit();
				 		}
				}
			}

			if(isset($_POST['view'])){

					$supplier_account_id = $_POST['supplier_account_id'];
		
					if(empty($supplier_account_id)){
						echo '<script>alert("EMPTY field is DETECTED!")</script>';
					}
					else if(!(is_numeric($supplier_account_id))){
						echo '<script>alert("ENTER NUMERIC VALUES ONLY!")</script>';
					}
					else{

			 		$inquire_to_supplier =  $new_batch_marketing->query("SELECT supplier_account_id, supplier_name, supplier_address, supplier_contact_number FROM supplier where supplier_account_id = $supplier_account_id");

			 			if(empty($inquire_to_supplier)){
			 				echo '<script>alert("No record found!")</script>';
			 			}
			 			else{
				 			$_SESSION['con'] = $inquire_to_supplier;
				 			echo '<script type="text/javascript">window.location.href = "supplier_view_redirect.php";</script>';
                    		 exit();
				 		}
				}
			}
					
				
	echo '</form>';
	echo' <footer style = "margin-top:16%;"></footer>';
?> 
