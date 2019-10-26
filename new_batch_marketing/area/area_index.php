

<?php

session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");
date_default_timezone_set('Etc/GMT+8');

    echo'<title>AREA DASHBOARD</title>';
    echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/area/area_index.php"?>';

    $new_batch_marketing = new Db();

    $_SESSION['container'] = '';
    $area = '';
    $barangay = '';
    $town = '';


    if(isset($_POST['view'])){

          $barangay = $_POST['barangay'];
          $town =  $_POST['town'];
        
         if(empty($barangay) || empty($town)){
            echo'<script>alert("EMPTY FIELD")</script>';
          }
          else{

              $stmt = get_all('barangay','town',$new_batch_marketing,$barangay,$town,'area');

              if(empty($stmt)){
                 echo'<script>alert("No record/s found.")</script>';
              }else{
                 $_SESSION['container'] = $stmt;
                 
                 echo '<script type="text/javascript">window.location.href = "area_view.php";</script>';
                  exit();
              }
          }      
    }

    if(isset($_POST['update'])){

          $barangay = $_POST['barangay'];
          $town =  $_POST['town'];
        
         if(empty($barangay) || empty($town)){
            echo'<script>alert("EMPTY FIELD")</script>';
          }
          else{

              $stmt = get_all('barangay','town',$new_batch_marketing,$barangay,$town,'area');

              if(empty($stmt)){
                 echo'<script>alert("No record/s found.")</script>';
              }else{
                 $_SESSION['container'] = $stmt;
                 echo '<script type="text/javascript">window.location.href = "area_update.php";</script>';
                  exit();
              }
          }      
    }
    echo '<div style = "align:left;;margin-top:9%;margin-left:10%;width:90%;">
          <h1>AREA DASHBOARD<h1></div>';
    echo '<div><hr style= "width:90%;margin-right:0%;margin-top:-1%;margin-left:5%;"></div>';

    echo'<div style = "width:100%;margin-left:50%;"></br>';

    echo'<td><input type ="text" name = "barangay" class = "form-control" placeholder = "Barangay" value= "'.$barangay.'" style = "width:23%;border-radius:2px;"></td></br>
         <td><input type ="text" name = "town" class = "form-control" placeholder = "Town" value= "'.$town.'" style = "width:23%;border-radius:2px;"></td></br>
         <td><input type ="submit" name = "view" class = "form-control" value= "VIEW" style = "width:23%;background:#30493D;color:white;border-radius:2px;"></td></br>
         <td><input type ="submit" name = "update" class = "form-control" value= "UPDATE" style = "width:23%;background:#30493D;color:white;border-radius:2px;"></td></br>
         <div style = "font-size:12px;margin-left:18.5%;"><a href = "area_list.php">VIEW ALL</a></div>';
    echo'</div>';
  echo '</form>';
echo' <footer style = "margin-top:10%;"></footer>';
?>

