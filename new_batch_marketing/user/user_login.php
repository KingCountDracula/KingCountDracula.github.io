
<?php
	
	session_start();
    require("C:\\xampp\htdocs\\new_batch_marketing\login_header.php");

	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/user/user_login.php">';

	$new_batch_marketing = new Db();
	
	
	$username = '';
	$password = '';
	
				if(isset($_POST['submit'])){

					$username = $_POST['username'];
					$password = $_POST['password'];
					
					if(empty($username) || empty($password)){ 
						echo '<script>alert("EMPTY FIELD!")</script>';
					}
					else{
							
						$register = check_exist_name('username','password',$new_batch_marketing,'user',$username,$password);
							if($register == 0){
								echo '<script>alert("USERNAME AND PASSWORD MISMATCH!")</script>';
							}else{
								$_SESSION['user'] = $username;	
										echo '<script type="text/javascript">window.location.href = "http://localhost:8080/new_batch_marketing/nbm/nbm_index.php";</script>';
										exit();		
							}
						}
				}	
						
				echo '<div style = "margin-top:13%;margin-left:10%;">';
						echo '<h1><h1>';
				echo '</div>';

				// echo '<div><hr style= "width:90%;margin-top:-1%;margin-left:5%"></div>';

				echo '<div style = "margin-left:47%;margin-top:4%;">';

				echo '<input style = "width:45%;border-radius:2px;" type="text" class="form-control"name = "username" placeholder = "USERNAME" value = "'.$username.'"/></br>
				<input style = "width:45%;border-radius:2px;" type="password" class="form-control"name = "password" placeholder = "PASSWORD" value = "'.$password.'"/></br>
				<input style = "width: 45%;border-radius:2px;background:#30493D;color:white;" type="submit" class="form-control"name = "submit" id = "submit" value = "LOG IN"></br>';	
				echo '</div>';
				
	echo '</form>';
	echo' <footer style = "margin-top:19.2%;"></footer>';
?>
<!-- <div style = "margin-left: 36%;font-size:12px;"><a href = "http://localhost:8080/new_batch_marketing/user/user_registration.php">REGISTER</a></div>'; -->