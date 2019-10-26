

<?php
session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");
// require("C:\\xampp\htdocs\\new_batch_marketing\\dbOption\Db.class.php");

date_default_timezone_set('Etc/GMT+8');
$current_date = date("Y-m-d");
$delivery_date = '';
$aging = '';
$total_credit_sales = '';


    echo'<title>DELIVERIES OF THE DAY</title>';
    echo'<div style = "font-size:12px">';
    echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/reports/receivables.php">';

    $new_batch_marketing = new Db();
   

    echo '<div style = "align:left;;margin-top:6%;margin-left:10%">
          <h1>RECEIVABLES OF THE DAY<h1></div>';
        echo '<div><hr style= "width:90%;margin-right:0%;margin-top:-1%;margin-left:5%;"></div></br>';

   

       echo'<div class = "rep" style = "margin-left:20%;width:60%;"><table>';   
     $credits_of_the_day = $new_batch_marketing->query("SELECT co.purchase_order_id, co.customer_id, co.amount, co.delivery_date, c.customer_firstName, c.customer_lastName
FROM customer AS c
INNER JOIN customer_order AS co ON co.customer_id = c.customer_account_id
WHERE co.status =  'CREDIT'");

     // print_r($receivables);

        if(empty($credits_of_the_day)){
            echo'<script>alert("NO CREDIT TRANSACTION TODAY.")</script>';
            
             // echo '<script type="text/javascript">window.location.href = "/new_batch_marketing/nbm/nbm_index.php";</script>';
             //      exit(); 
        }else{
            
            foreach($credits_of_the_day as $key){
                echo'<tr><td>'.$key['customer_firstName'].'&nbsp;&nbsp;'.$key['customer_lastName'].'</td><td>'.$key['amount'].'</td></tr>'; 
                $total_credit_sales = $total_credit_sales + $key['amount'];
            }
        }
         echo'</table></div></br>';
          echo'<div style = "margin-top:1%;margin-left:70%;float;">TOTAL CREDIT:php&nbsp;'.$total_credit_sales.'</div>';
          // echo'<div style = "margin-top:16%;margin-left:73%;float;"><a href = "all_credit.php">VIEW ALL CREDITS</a></div>';

  echo '</form>';
  echo'</div>';
  echo' <footer style = "margin-top:16%;"></footer>';
   
?>
