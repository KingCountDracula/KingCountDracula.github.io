<?php
	
session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

date_default_timezone_set('Etc/GMT+8');

$new_batch_marketing = new Db();

echo'<div style = "font-size:12px">';
echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/area/area_list.php">';
echo '<div style = "align:right;margin-top:8%;margin-left:10%;">';
echo '<h1>LIST OF OFFICIAL AREAS<h1></div>';
echo '<div><hr style= "width:90%;margin-right:0%;margin-top:-1%;margin-left:5%"></div>';

$infos = $new_batch_marketing->query("SELECT * FROM area ORDER BY area ASC");

		
	 echo'<div style = "margin-left: 40%;width:60%">NEW BATCH MARKETING OFFICIAL AREA LIST</div></br></br>';
	
	 echo'<div style = "float:left;margin-left:27%;">AREA CODE</div>';
	 echo'<div  style = "float:left;margin-left:14%;">BARANGAY</div>';
	 echo'<div  style = "float:left;margin-left:17%;">TOWN</div>';
	 
	 echo'<div class = "rep" style = "float:left;margin-left:20%;margin-top:1%;width:60%;"><table>';
	
	foreach ($infos as $key){	
		echo'<tr><td style = "padding-left:45px;">'.$key['area'].'</td><td>'.$key['barangay'].'</td><td>'.$key['town'].'</td></tr>';	
	}
	echo'</table></div></div></br></br>';
	
	echo'<div style = "margin-top:16%;margin-left:46%;"><input type ="submit" name = "ok" value = "OK" style="width:10%;border-radius:2px;"class = "form-control"></div>';

 if(isset($_POST['ok'])){
 		echo '<script type="text/javascript">window.location.href = "area_index.php";</script>';
		exit();
 }
 echo '</form>';
 echo' <footer style = "margin-top:5%;"></footer>';
echo'</div>';
?>