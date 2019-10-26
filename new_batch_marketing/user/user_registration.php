
<?php
	
	session_start();
    require("C:\\xampp\htdocs\\new_batch_marketing\login_header.php");

	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/user/user_registration.php">';

	$new_batch_marketing = new Db();
	
	$firstname = '';
	$lastname = '';
	$username = '';
	$password = '';
	$user_type = '';
				

				if(isset($_POST['submit'])){

					$firstname = $_POST['firstname'];
					$lastname = $_POST['lastname'];
					$username = $_POST['username'];
					$password = $_POST['password'];
					
					if(empty($lastname) || empty($firstname) || empty($username) || empty($password)){ 
						echo '<script>alert("EMPTY FIELD!")</script>';
					}
					else{
							
						$register = check_exist_name('firstname','lastname',$new_batch_marketing,'user',$firstname,$lastname);
							if($register > 0){
								echo '<script>alert("NAME EXIST!")</script>';
							}
							else{

								$username_check = check_username('username',$new_batch_marketing,'user',$username);

								if($username_check > 0){
									echo '<script>alert("USERNAME EXIST!")</script>';
								}else{

									if($username != 'admin'){
										$user_type = 'user';
									}
									else{
										$user_type = 'admin';
									}

									$insert_into_user = $new_batch_marketing->query("INSERT INTO user(`id`,	`firstname`,`lastname`,`username`,`password`,`user_type`) VALUES(NULL,'$firstname','$lastname','$username','$password','$user_type')");

										echo '<script>alert("REGISTRATION SUCCESSFUL.")</script>';

										echo '<script type="text/javascript">window.location.href = "user_login.php";</script>';
										exit();		
								}
							}
				}	
						
			}
				echo '<div style = "margin-top:6%;margin-left:10%;">';
						echo '<h1>USER REGISTRATION<h1>';
				echo '</div>';

				echo '<div><hr style= "width:90%;margin-top:-1%;margin-left:5%"></div>';

				echo '<div style = "margin-left:47%;margin-top:4%;">';

				echo '
				<input style = "width:45%;border-radius:2px;" type="text" class="form-control"name = "firstname" placeholder = "FIRSTNAME" value = "'.$firstname.'"/></br>
				<input style = "width:45%;border-radius:2px;" type="text" class="form-control"name = "lastname" placeholder = "LASTNAME" value = "'.$lastname.'"/></br>
				<input style = "width:45%;border-radius:2px;" type="text" class="form-control"name = "username" placeholder = "USERNAME" value = "'.$username.'"/></br>
				<input style = "width:45%;border-radius:2px;" type="password" class="form-control"name = "password" placeholder = "PASSWORD" value = "'.$password.'"/></br>
				<input style = "width: 45%;border-radius:2px;background:#30493D;color:white;" type="submit" class="form-control"name = "submit" id = "submit" value = "REGISTER"></br>
				<div style = "margin-left: 38.5%;font-size:12px;"><a href = "http://localhost:8080/new_batch_marketing/user/user_login.php">LOG IN</a></div>';
				echo '</div>';
				
	echo '</form>';
	echo' <footer style = "margin-top:10%;"></footer>';
?>
