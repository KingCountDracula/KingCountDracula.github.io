

<?php
session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");
// require("C:\\xampp\htdocs\\new_batch_marketing\\dbOption\Db.class.php");

date_default_timezone_set('Etc/GMT+8');
$current_date = date("Y-m-d");
$delivery_date = '';
$aging = '';


    echo'<title>RUNNING CREDITS</title>';
    echo'<div style = "font-size:12px">';
    echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/reports/receivables.php">';

    $new_batch_marketing = new Db();
   

    echo '<div style = "align:left;;margin-top:6%;margin-left:10%">
          <h1>CREDIT TRANSACTIONS<h1></div>';
        echo '<div><hr style= "width:90%;margin-right:0%;margin-top:-1%;margin-left:5%;"></div></br>';

   

       echo'<div class = "rep" style = "margin-left:20%;width:60%;"><table>';   
     $receivables = $new_batch_marketing->query("SELECT p.balance,co.purchase_order_id, co.customer_id, co.delivery_date, c.customer_firstName, c.customer_lastName
        FROM customer AS c
        INNER JOIN customer_order AS co ON co.customer_id = c.customer_account_id
        INNER JOIN payment AS p ON p.customer_order_id = co.purchase_order_id
        WHERE co.status =  'CREDIT'");

     // print_r($receivables);

        if(empty($receivables)){
            echo'<script>alert("NO RECEIVABLES TODAY.")</script>';
            
             echo '<script type="text/javascript">window.location.href = "/new_batch_marketing/nbm/nbm_index.php";</script>';
                  exit(); 
        }else{
            
            foreach($receivables as $key){
                $delivery_date = $key['delivery_date'];
               
                $aging = (strtotime($current_date) - strtotime($delivery_date))/86400;
                $aging = round(abs($aging));

                  if($aging > 30){
                    $aging = 30;
                  }    
           echo'<tr><td><a href = "http://localhost:8080/new_batch_marketing/reports/receivables_redirect.php?id='.$key['customer_id'].'">'.$key['customer_firstName'].'&nbsp;&nbsp;'.$key['customer_lastName'].'</a></td><td>CURRENT BALANCE:&nbsp;php</td><td>'.$key['balance'].'</td></tr>'; 
           }      
        }
         echo'</table></div>';
  echo '</form>';
  echo'</div>';
  echo' <footer style = "margin-top:16%;"></footer>';
   
?>
