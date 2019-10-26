

<?php

session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");
date_default_timezone_set('Etc/GMT+8');

    echo'<title>AREA ENTRY</title>';
    echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/area/area_entry.php"?>';

    $new_batch_marketing = new Db();

    $area = '';
    $barangay = '';
    $town = '';


    if(isset($_POST['submit'])){

          $area = $_POST['area'];
          $barangay = $_POST['barangay'];
          $town =  $_POST['town'];
        
         if(empty($area) || empty($barangay) || empty($town)){
            echo'<script>alert("EMPTY FIELD")</script>';
          }
          else if(!(is_numeric($area))){
              echo'<script>alert("Area code accepts numeric values only.")</script>';
          }
          else{

            $stmt = check_exist_name('barangay','town',$new_batch_marketing,'area',$barangay,$town);

              if($stmt > 0){
                 echo'<script>alert("Area already exist.")</script>';
              }else{
                  $area_entry = $new_batch_marketing->query("INSERT INTO area(`id`,`area`,`barangay`,`town`) VALUES(NULL,$area,'$barangay','$town')");

                 echo'<script>alert("Area has been entried successfully.")</script>';

                  echo '<script type="text/javascript">window.location.href = "area_entry.php";</script>';
                  exit();
              }
          }      
    }
       


    echo '<div style = "margin-top:8%;margin-left:10%;width:90%;">
          <h1>ENTRY OF AREA<h1></div>';
    echo '<div><hr style= "width:90%;margin-top:-1%;margin-left:5%;"></div>';

    echo'<div style = "width:100%;margin-left:46%;"></br>';

    echo'<td><input type ="text" name = "barangay" class = "form-control" placeholder = "Barangay" value= "'.$barangay.'" style = "width:23%;border-radius:2px;"></td></br>
         <td><input type ="text" name = "town" class = "form-control" placeholder = "Town" value= "'.$town.'" style = "width:23%;border-radius:2px;"></td></br>
         <td><input type ="text" name = "area" class = "form-control" placeholder = "Area CODE" value= "'.$area.'" style = "width:23%;border-radius:2px;"></td><br>
         <td><input type ="submit" name = "submit" class = "form-control" value= "REGISTER" style = "width:23%;background:#30493D;color:white;border-radius:2px;"></td></br>
        <div style = "font-size:12px;margin-left:18.5%;"><a href = "area_list.php">VIEW ALL</a></div>';
    echo'</div>';
  echo '</form>';
  echo' <footer style = "margin-top:12%;"></footer>';
?>

