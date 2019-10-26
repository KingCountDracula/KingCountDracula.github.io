
<?php
	
	session_start();
    require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/customer/customer_index.php">';

	$new_batch_marketing = new Db();
	$customer_lastName = '';
	$customer_firstName = '';
	$barangay = '';
	$town = '';
	$customer_contact_number = '';
	$area = '';

	// $table = 'customer';
	// $column = 'customer_account_id';
				

				if(isset($_POST['submit'])){

					$customer_lastName = $_POST['customer_lastName'];
					$customer_firstName = $_POST['customer_firstName'];
					$barangay = $_POST['barangay'];
					$town = $_POST['town'];
					$customer_contact_number =$_POST['customer_contact_number'];

					$check_exist = check_exist_name('customer_lastName','customer_firstName',$new_batch_marketing,'customer',$customer_lastName,$customer_firstName);

					if(empty($customer_lastName) || empty($customer_firstName) || empty($barangay)  || empty($town)  || empty($customer_contact_number)){ 
						echo '<script>alert("empty field!")</script>';
					}
					else{

							if(!(is_numeric($customer_contact_number))){
							echo '<script>alert("ID and Contact Number accepts NUMERIC entries only!")</script>';
							}
							else if($check_exist > 0){
								echo '<script>alert("ID already EXIST!")</script>';
							}
							else{
	
							$get_area = get_info('barangay','town',$new_batch_marketing,'area',$barangay,$town);
							foreach ($get_area as $key) {
								$area = $key['area'];
							}

                    if(empty($get_area)){

                         echo'<script>alert("Area is no registered yet.")</script>';
                    }
                    else{
                      
						$insert_into_customer = $new_batch_marketing->query("INSERT INTO customer (customer_account_id,customer_lastName,customer_firstName,barangay,town,area,customer_contact_number) VALUES(NULL,'$customer_lastName','$customer_firstName','$barangay','$town',$area,$customer_contact_number)");

							echo '<script>alert("Cusotomer is successfully registered.")</script>';

							echo '<script type="text/javascript">window.location.href = "customer_index.php";</script>';
							exit();		
							}					
						}
				}
			}
				echo '<div style = "margin-top:6%;margin-left:10%;">';
						echo '<h1>CUSTOMER REGISTRATION<h1>';
				echo '</div>';

				echo '<div><hr style= "width:90%;margin-top:-1%;margin-left:5%"></div>';

				echo '<div style = "margin-left:47%;margin-top:4%;">';

				echo '
				<input style = "width:45%;border-radius:2px;" type="text" class="form-control"name = "customer_lastName" id = "customer_lastName"  placeholder = "Lastname" value = "'.$customer_lastName.'"/></br>
				<input style = "width: 45%;border-radius:2px;" type="text" class="form-control" name = "customer_firstName" id = "customer_firstName" placeholder = "Firstname" value = "'.$customer_firstName.'"/></br>
				<input style = "width: 45%;border-radius:2px;" type="text" class="form-control" name = "barangay" placeholder = "Barangay" value = "'.$barangay.'"/></br>
				<input style = "width: 45%;border-radius:2px;" type="text" class="form-control" name = "town" placeholder = "Town" value = "'.$town.'"/></br>
				<input style = "width: 45%;border-radius:2px;" type="text" class="form-control" name = "customer_contact_number" id = "customer_contact_number" placeholder = "Contanct Number" value = "'.$customer_contact_number.'"/></br>
				<input style = "width: 45%;border-radius:2px;background:#30493D;color:white;" type="submit" class="form-control"name = "submit" id = "submit" value = "REGISTER"></br>
				<div style = "font-size:12px;margin-left:36.5%;"><a href = "customer_list.php">VIEW ALL</a></div>
				</div>';
				
	echo '</form>';
	echo' <footer style = "margin-top:6.5%;"></footer>';
?>
