

<?php
session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

date_default_timezone_set('Etc/GMT+8');
$delivery_date = date("Y-m-d");
$delivery_id = 'D'.date("ymdhis").'C';
$_SESSION['delivery_id'] = '';
$customer_order_id = '';
$product_code = '';
$quantity = '';
$amount = '';
$total = '';

    echo'<title>DELIVERIES OF THE DAY</title>';
    echo'<div style = "font-size:12px">';
    echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/delivery/deliveries_of_the_day.php">';

    $new_batch_marketing = new Db();
    $_SESSION['delivery_id'] = $delivery_id;
    echo '<div style = "align:left;;margin-top:6%;margin-left:10%">
          <h1>DELIVERABLES OF THE DAY<h1></div>';
        echo '<div><hr style= "width:90%;margin-right:0%;margin-top:-1%;margin-left:5%;"></div></br>';

       echo'<div class = "rep" style = "margin-left:20%;width:60%;"><table>';   
     $get_deliveries_of_the_day = $new_batch_marketing->query("SELECT c_order.purchase_order_id,c_order.customer_id,c_order.order_date,c_order.delivery_date,c_order.amount,cust.customer_firstName, cust.customer_lastName FROM customer as cust INNER JOIN customer_order AS c_order ON c_order.customer_id = cust.customer_account_id WHERE c_order.status = 'FD'");

        if(empty($get_deliveries_of_the_day)){
            echo'<script>alert("NO DELIVERABLES TODAY.")</script>';
            echo '<script type="text/javascript">window.location.href = "/new_batch_marketing/nbm/nbm_index.php";</script>';
                  exit(); 
        }else{
            
            foreach($get_deliveries_of_the_day as $key){
           echo'<tr><td><a href = "http://localhost:8080/new_batch_marketing/delivery/show_delivery_details.php?id='.$key['purchase_order_id'].'">'.$key['customer_firstName'].'&nbsp;&nbsp;'.$key['customer_lastName'].'</a></td></tr>'; 
           }      
        }
         echo'</table></div>';
  echo '</form>';
  echo'</div>';
  echo' <footer style = "margin-top:16%;"></footer>';
   
?>
