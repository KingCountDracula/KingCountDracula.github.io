

<?php

session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

date_default_timezone_set('Etc/GMT+8');

    echo'</br><title>AGENT REGISTRATION</title>';
    echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/agent/agent_registration.php"?>';

    $new_batch_marketing = new Db();

    $lastname = '';
    $firstname = '';
    $contact = '';
    $area = '';



    if(isset($_POST['submit'])){

          $lastname = $_POST['lastname'];
          $firstname = $_POST['firstname'];
          $contact =  $_POST['contact'];
          $area = $_POST['area'];

         if(empty($lastname) || empty($firstname) || empty($contact) || empty($area)){
            echo'<script>alert("EMPTY FIELD")</script>';
          }
          else if(!(is_numeric($contact)) || !(is_numeric($area))){
              echo'<script>alert("Contact number and Area code accepts numeric values only.")</script>';
          }
          else{

            $stmt = check_exist_name('lastname','firstname',$new_batch_marketing,'agent',$lastname,$firstname);
              if($stmt > 0){
                 echo'<script>alert("Account already exist.")</script>';
              }else{

                  $result = area_check('area',$new_batch_marketing,'agent',$area);
                  if($result > 0){
                        echo'<script>alert("Area code is already taken.")</script>';
                  }
                  else{
                   
                      $register_agent = $new_batch_marketing->query("INSERT INTO agent(`agent_id`,`lastname`,`firstname`,`contact_num`,`area`) VALUES(NULL,'$lastname','$firstname',$contact,$area)");

                       echo'<script>alert("Agent has been registered successfully.")</script>';

                        echo '<script type="text/javascript">window.location.href = "agent_registration.php";</script>';
                    exit();
                         
                  }
              }
          }      
    }
       


    echo '<div style = "align:left;;margin-top:6%;margin-left:10%;width:90%;">
          <h1>AGENT REGISTRATION<h1></div>';
    echo '<div><hr style= "width:90%;margin-right:0%;margin-top:-1%;margin-left:5%;"></div>';

    echo'<div style = "width:100%;margin-left:46%;"></br>';

    echo'<td><input type ="text" name = "lastname" class = "form-control" placeholder = "Lastname" value= "'.$lastname.'" style = "width:23%;border-radius:2px;"></td></br>
         <td><input type ="text" name = "firstname" class = "form-control" placeholder = "Firstname" value= "'.$firstname.'" style = "width:23%;border-radius:2px;"></td></br>
         <td><input type ="text" name = "contact" class = "form-control" placeholder = "contact" value= "'.$contact.'" style = "width:23%;border-radius:2px;"></td><br>
         <td><input type ="text" name = "area" class = "form-control" placeholder = "area" value= "'.$area.'" style = "width:23%;border-radius:2px;"></td></br>
         <td><input type ="submit" name = "submit" class = "form-control" value= "REGISTER" style = "width:23%;background:#30493D;color:white;border-radius:2px;"></td></br>
         <div style = "font-size:12px;margin-left:18.5%;"><a href = "agent_list.php">VIEW ALL</a></div>';
    echo'</div>';

   
  echo '</form>';
  echo' <footer style = "margin-top:10%;"></footer>';
?>

