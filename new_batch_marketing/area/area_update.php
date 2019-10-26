

<?php

session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");
date_default_timezone_set('Etc/GMT+8');
    
    echo'<title>UPDATE AREA INFORMATION</title>';
    echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/area/area_update.php"?>';

    $new_batch_marketing = new Db();

    $details =  $_SESSION['container'];
    $id = '';
    $area = '';
    $barangay = '';
    $town = '';

     foreach($details as $key){
        $id = $key['id'];
        $area = $key['area'];
        $barangay = $key['barangay'];
        $town = $key['town'];
    }

    if(isset($_POST['update'])){
          $area_id = $_POST['id'];
          $area_code = $_POST['area'];
          $brgy = $_POST['barangay'];
          $town_code = $_POST['town'];

         $stmt = get_all('barangay','town',$new_batch_marketing,$brgy,$town_code,'area');

              if(empty($stmt)){
                 echo'<script>alert("Area is not recognized.")</script>';
              }else{
                $update = update_area($new_batch_marketing,'area','area','barangay','town','id',$area_code,$brgy,$town_code,$area_id);
                 echo '<script type="text/javascript">window.location.href = "area_index.php";</script>';
                 exit();
              }
    }
    if(isset($_POST['ok'])){
      
      echo '<script type="text/javascript">window.location.href = "area_index.php";</script>';
      exit(); 
    }
    echo '<div style = "margin-top:9%;margin-left:10%;width:90%;">
          <h1>UPDATE AREA INFORMATION<h1></div>';
    echo '<div><hr style= "width:90%;margin-top:-1%;margin-left:5%;"></div>';

    echo'<div style = "width:100%;margin-left:46%;"></br>';

    echo'<td><input type ="text" name = "id" class = "form-control" placeholder = "ID" value= "'.$id.'" style = "width:23%;border-radius:2px;" readonly = "readonly"></td></br>
         <td><input type ="text" name = "area" class = "form-control" placeholder = "Area" value= "'.$area.'" style = "width:23%;border-radius:2px;"></td></br>
         <td><input type ="text" name = "barangay" class = "form-control" placeholder = "Barangay" value= "'.$barangay.'" style = "width:23%;border-radius:2px;"readonly = "readonly"></td></br>
         <td><input type ="text" name = "town" class = "form-control" placeholder = "Town" value= "'.$town.'" style = "width:23%;border-radius:2px;" readonly = "readonly"></td></br>
         <td><input type ="submit" name = "update" class = "form-control" value= "UPDATE" style = "width:23%;background:#30493D;color:white;border-radius:2px;"></td></br>
         <td><input type ="submit" name = "ok" class = "form-control" value= "CANCEL" style = "width:23%;background:#30493D;color:white;border-radius:2px;"></td></br>';
    echo'</div>';
  echo '</form>';
  echo' <footer style = "margin-top:3%;"></footer>';
?>

