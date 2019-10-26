<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIEW STOCKS</title>
<link href="templates/dashboard/css/bootstrap.min.css" rel ="stylesheet"/>
<link href="templates/dashboard/css/bootstrap.css" rel="stylesheet"/>
<link href="templates/dashboard/css/landing-page.css" rel="stylesheet"/>

<script src="templates/login template/jquery-1.10.2.min.js"></script>
<script src="templates/login template/jquery-1.10.2.js"></script>
</head>

<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="description" content=""/>
<meta name="author" content="">

<div class="container">
<body>
<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
<div class="container topnav">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
<span class="sr-only"></span>
</button>
<a class="navbar-brand topnav">Welcome</a>
</div>
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav navbar-right">
<li class="active">
<a href="http://localhost:8080/kuya/dashboard.php">NEW</a>
</li>
<li>
<a href="http://localhost:8080/kuya/signup.php">INVENTORY</a>
</li>
<li>
<a href="http://localhost:8080/kuya/signup.php">DELIVERIES</a>
</li>
<li>
<a href="http://localhost:8080/kuya/signup.php">RECEIVABLES</a>
</li>
</ul>
</div>
<!-- /.navbar-collapse -->
</div>
<!-- /.container -->
</nav>


<!-- Header -->
<a name="about"></a>
<div class="intro-header">
<div class="container">

<div class="row">
<div class="col-lg-12">
<div class="intro-message">
<ul class="list-inline intro-social-buttons">
<li>
<?php
	
	require("dbOption/Db.class.php");
	require("C:\\xampp\htdocs\\new_batch_marketing\methods.php");

	session_start();
	$p_code = $_SESSION['id'];

	echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/stocks/view_stocks.php">';

	$new_batch_marketing = new Db();
	$case = '';
	$bottle = '';
	$product_name = '';
	$product_code = '';
	$product_type = '';

				echo '<div style = "align:right;margin-right:150%;margin-top:-43%;margin-left:-149%;">';
				echo '<h1>VIEW STOCKS<h1>';
				echo '</div>';
				echo '<div><hr style= "width:400%;margin-right:0%;margin-top:-2%;margin-left:-155%"></div>';
				echo '<div style = "align:right;margin-right:-50px;margin-left:40%;margin-top:15%;">';

				$get_product_info = $new_batch_marketing->query("SELECT stocks.case, stocks.bottle, products.product_name, products.product_type, products.selling_price FROM products AS products inner join stocks AS stocks on stocks.stock_code = products.product_code WHERE products.product_code = '$p_code'");
				foreach($get_product_info as $key){

			          $product_name = $key['product_name'];
			          $product_type = $key['product_type'];
			          $selling_price = $key['selling_price'];
			          $case = $key['case'];
			          $bottle = $key['bottle'];
				}
				echo'<input type = "text" style = "width: 100%;border-radius:2px;" value = "'.$product_name.'&nbsp;('.$product_type.')"readonly =  "readonly" class = "form-control" readonly =  "readonly"></br>';
				echo' <input style = "width: 100%;border-radius:2px;"type="text" class="form-control" name = "case" id = "case"  placeholder = "Case"value = "'.$case.'&nbsp;&nbsp;cases" readonly =  "readonly"/></br>
				<input style = "width: 100%;border-radius:2px;"type="text" class="form-control" name = "bottle" id = "bottle"  placeholder = "Bottle"value = "'.$bottle.'&nbsp;&nbsp;bottles" readonly =  "readonly"/></br>
				<input style = "width: 100%;border-radius:2px;"type="text" class="form-control" name = "selling_price" id = "selling_price"  placeholder = "selling_price"value = "Php&nbsp;&nbsp;'.$selling_price.'" readonly =  "readonly"/></br>
				<input style = "width: 100%;border-radius:2px;" type="submit" class="form-control"name = "ok" id = "ok" value = "OK">
				</div>
				</div>';
				echo '</div>';

				if(isset($_POST['ok'])){
					header("location: stocks_index.php");
				}

	echo '</form>';
?>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</body>
<footer>
<hr/>
<div class="row"><font size="1">
<div class="col-lg-12 footer-below">
<p style="margin-left:8%;">"Boostrap CDN by"
<a href="http://tracking.maxcdn.com/c/99191/3982/378">
<img src ="templates/login template/maxcdn-logo.png"/></a>.</p>
<hr/>
<p  style="margin-left:8%;">Themes and templates licensed under the <a href="http://www.apache.org/licenses/LICENSE-2.0">Apache License v2.0</a>.
Based on <a href="http://getbootstrap.com/">Bootstrap</a>.</p>
</div>
</font></div>
</footer>
</div>
</html>


