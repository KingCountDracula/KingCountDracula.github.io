

<?php

session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");
date_default_timezone_set('Etc/GMT+8');

$details = $_SESSION['container'];

    echo'<title>AGENT VIEW</title>';
    echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/agent/agent_view.php"?>';

    $new_batch_marketing = new Db();

    $lastname = '';
    $firstname = '';
    $contact ='';
    $id = '';
    $area = '';
   
    foreach($details as $key){
        $lastname = $key['lastname'];
        $firstname = $key['firstname'];
        $contact = $key['contact_num'];
        $area = $key['area'];
        $id = $key['agent_id'];
    }

    if(isset($_POST['ok'])){
         echo '<script type="text/javascript">window.location.href = "agent_index.php";</script>';
          exit();
     }
       


    echo '<div style = "margin-top:8%;margin-left:10%;width:90%;">
          <h1>AGENT INFORMATION<h1></div>';
    echo '<div><hr style= "width:90%;margin-top:-1%;margin-left:5%;"></div>';

    echo'<div style = "width:100%;margin-left:46%;"></br>';

    echo'<td><input type ="text" name = "id" class = "form-control" placeholder = "id" value= "'.$id.'" style = "width:23%;border-radius:2px;" readonly = "readonly"></td></br>
        <td><input type ="text" name = "lastname" class = "form-control" placeholder = "Lastname" value= "'.$lastname.'" style = "width:23%;border-radius:2px;" readonly = "readonly"></td></br>
         <td><input type ="text" name = "firstname" class = "form-control" placeholder = "Firstname" value= "'.$firstname.'" style = "width:23%;border-radius:2px;" readonly = "readonly"></td></br>
         <td><input type ="text" name = "contact" class = "form-control" placeholder = "contact" value= "'.$contact.'" style = "width:23%;border-radius:2px;" readonly = "readonly"></td><br>
         <td><input type ="text" name = "area" class = "form-control" placeholder = "area" value= "'.$area.'" style = "width:23%;border-radius:2px;" readonly = "readonly"></td></br>
         <td><input type ="submit" name = "ok" class = "form-control" value= "OK" style = "width:23%;background:#30493D;color:white;border-radius:2px;"></td></br>';
    echo'</div>';
  echo '</form>';
  echo' <footer style = "margin-top:4.5%;"></footer>';
?>

