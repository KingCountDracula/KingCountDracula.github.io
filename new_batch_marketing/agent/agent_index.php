

<?php

session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

date_default_timezone_set('Etc/GMT+8');

    
    echo'<title>AGENT DASHBOARD</title>';
    echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/agent/agent_index.php"?>';

    $new_batch_marketing = new Db();

    $lastname = '';
    $firstname = '';
    $_SESSION['container'] = '';

    if(isset($_POST['view'])){

          $lastname = $_POST['lastname'];
          $firstname = $_POST['firstname'];
        
         if(empty($lastname) || empty($firstname)){
            echo'<script>alert("EMPTY FIELD")</script>';
          }
          else{

            $stmt = get_info('lastname','firstname',$new_batch_marketing,'agent',$lastname,$firstname);
              if(empty($stmt)){
                 echo'<script>alert("NO record/s found.")</script>';
              }else{
                    $_SESSION['container'] = $stmt;
                    echo '<script type="text/javascript">window.location.href = "agent_view.php";</script>';
                    exit();
                 }
          }      
    }
       
    if(isset($_POST['update'])){

          $lastname = $_POST['lastname'];
          $firstname = $_POST['firstname'];
        
         if(empty($lastname) || empty($firstname)){
            echo'<script>alert("EMPTY FIELD")</script>';
          }
          else{

            $stmt = get_info('lastname','firstname',$new_batch_marketing,'agent',$lastname,$firstname);
              if(empty($stmt)){
                 echo'<script>alert("NO record/s found.")</script>';
              }else{

                  $_SESSION['container'] = $stmt;
                  
                    echo '<script type="text/javascript">window.location.href = "agent_update.php";</script>';
                    exit();
                 }
          }      
    }


    echo '<div style = "align:left;;margin-top:9%;margin-left:10%;width:90%;">
          <h1>AGENT DASHBOARD<h1></div>';
    echo '<div><hr style= "width:90%;margin-top:-1%;margin-left:5%;"></div>';

    echo'<div style = "width:100%;margin-left:46%;"></br>';
    echo'<td><input type ="text" name = "lastname" class = "form-control" placeholder = "Lastname" value= "'.$lastname.'" style = "width:23%;border-radius:2px;"></td></br>
         <td><input type ="text" name = "firstname" class = "form-control" placeholder = "Firstname" value= "'.$firstname.'" style = "width:23%;border-radius:2px;"></td></br>
         <td><input type ="submit" name = "view" class = "form-control" value= "VIEW" style = "width:23%;border-radius:2px;background:#30493D;color:white;"></td></br>
         <td><input type ="submit" name = "update" class = "form-control" value= "UPDATE" style = "width:23%;border-radius:2px;background:#30493D;color:white;"></td></br>
         <div style = "font-size:12px;margin-left:18.5%;"><a href = "agent_list.php">VIEW ALL</a></div>';

  echo '</div></form>';
  echo' <footer style = "margin-top:9%;"></footer>';
?>

