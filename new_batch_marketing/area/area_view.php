

<?php
session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");
date_default_timezone_set('Etc/GMT+8');

    echo'<title>VIEW AREA INFORMATION</title>';
    echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/area/area_view.php"?>';

    $new_batch_marketing = new Db();

    $details =  $_SESSION['container'];
    $id = '';
    $area = '';
    $barangay = '';
    $town = '';


    if(isset($_POST['ok'])){

      echo '<script type="text/javascript">window.location.href = "area_index.php";</script>';  
    }

    echo '<div style = "margin-top:8%;margin-left:10%;width:90%;">
          <h1>AREA INFORMATION<h1></div>';
    echo '<div><hr style= "width:90%;margin-right:0%;margin-top:-1%;margin-left:5%;"></div>';

    echo'<div style = "width:100%;margin-left:46%;"></br>';

    foreach($details as $key){
        $id = $key['id'];
        $area = $key['area'];
        $barangay = $key['barangay'];
        $town = $key['town'];
    }
    echo'<td><input type ="text" name = "id" class = "form-control" placeholder = "ID" value= "'.$id.'" style = "width:23%;border-radius:2px;" readonly = "readonly"></td></br>
         <td><input type ="text" name = "area" class = "form-control" placeholder = "Area" value= "'.$area.'" style = "width:23%;border-radius:2px;"readonly = "readonly"></td></br>
         <td><input type ="text" name = "barangay" class = "form-control" placeholder = "Barangay" value= "'.$barangay.'" style = "width:23%;border-radius:2px;" readonly = "readonly"></td></br>
         <td><input type ="text" name = "town" class = "form-control" placeholder = "Town" value= "'.$town.'" style = "width:23%;border-radius:2px;" readonly = "readonly"></td></br>
         <td><input type ="submit" name = "ok" class = "form-control" value= "OK" style = "width:23%;background:#30493D;color:white;border-radius:2px;"></td></br>';
    echo'</div>';
  echo '</form>';
  echo' <footer style = "margin-top:8%;"></footer>';
?>
?>

