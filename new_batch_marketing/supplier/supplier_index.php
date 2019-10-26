
<?php
	
	session_start();
    require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/supplier/supplier_index.php">';

	$new_batch_marketing = new Db();

	$supplier_name = '';
	$supplier_address = '';
	$supplier_contact_number = '';

	$table = 'supplier';
	$column = 'supplier_account_id';
				

				if(isset($_POST['submit'])){

					$supplier_name = $_POST['supplier_name'];
					$supplier_address = $_POST['supplier_address'];
					$supplier_contact_number =$_POST['supplier_contact_number'];

					
					if(empty($supplier_name) || empty($supplier_address)|| empty($supplier_contact_number)){
						echo '<script>alert("empty field!")</script>';
					}else{
					
							if(!(is_numeric($supplier_contact_number))){
							echo '<script>alert("ID and Contact Number accepts NUMERIC entries only!")</script>';
							}
							else{
	
								$insert_into_supplier = $new_batch_marketing->query("INSERT INTO supplier (supplier_account_id,supplier_name,supplier_address,supplier_contact_number) VALUES(NULL,'$supplier_name','$supplier_address',$supplier_contact_number)");

									echo '<script>alert("DONE")</script>';
									echo '<script type="text/javascript">window.location.href = "supplier_index.php";</script>';
									exit();		
							}
					}					
				}
				echo '<div style = "align:right;margin-right:90%;margin-top:6%;margin-left:10%;width:40%;">';
						echo '<h1>SUPPLIER REGISTRATION<h1>';
				echo '</div>';

				echo '<div><hr style= "width:85%;margin-top:-1%;margin-left:6%;"></div>';

				echo '<div style = "align:right;margin-left:47%;margin-top:5%;">';

				echo'<form class="form-horizontal">
				<fieldset>
				<div class="form-group">
				<div class="col-lg-60">
				<input style = "width: 45%;border-radius:2px;" type="text" class="form-control"name = "supplier_name"  placeholder = "Company Name" value = "'.$supplier_name.'"/></br>
				<input style = "width: 45%;border-radius:2px;" type="text" class="form-control" name = "supplier_address" id = supplier_address" placeholder = "Address" value = "'.$supplier_address.'"/></br>
				<input style = "width: 45%;border-radius:2px;" type="text" class="form-control" name = "supplier_contact_number" id = "supplier_contact_number" placeholder = "Contanct Number" value = "'.$supplier_contact_number.'"/></br>
				<input style = "width: 45%;border-radius:2px;background:#30493D;color:white;" type="submit" class="form-control"name = "submit" id = "submit" value = "REGISTER"></br>
				<div style = "font-size:12px;margin-left:36.5%;"><a href = "supplier_list.php">VIEW ALL</a></div>
				</div>
				</div>
				</fieldset>
				</form>
				</li>';
				echo '</div>';

	echo '</form>';
	echo' <footer style = "margin-top:11.5%;"></footer>';    
?>               

