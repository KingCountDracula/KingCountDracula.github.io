

<?php

session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");

date_default_timezone_set('Etc/GMT+8');
$delivery_date = date("Y-m-d");
$customer_order_id = '';
$product_code = '';
$quantity = '';
$amount = '';
$selling_price = '';
$total = '';
$count = '';
$customer_name = '';
$order_date = '';
$delivery_date = '';
$poid = '';
$_SESSION['order'] = '';
$procesed_by = $_SESSION['user'];
$delivered_by = '';
// $_SESSION['user'] =  $delivered_by;
$delivery_id = '';
$delivery_id = $_SESSION['delivery_id'];
$agent_name = '';
    
    echo'<title>ORDER DETAILS</title>';
    echo'<div style = "font-size:12px">';
    echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/delivery/show_delivery_details.php"?>';

    $new_batch_marketing = new Db();
    $poid = $_GET['id'];

    echo '<div style = "align:left;;margin-top:6%;margin-left:10%">
          <h1>DELIVERY &nbsp;&nbsp;DETAILS<h1></div>';
    echo '<div><hr style= "width:90%;margin-right:0%;margin-top:-1%;margin-left:5%;"></div>';

    $get_deliveries= $new_batch_marketing->query("SELECT a.lastname,a.firstname,co.purchase_order_id,co.delivery_date,co.order_date,co.amount AS TOTAL,cod.product_code,cod.quantity, cod.selling_price, cod.amount, prod.product_name, prod.product_type, cust.customer_lastName, cust.customer_firstName
        FROM customer AS cust
        INNER JOIN customer_order AS co ON co.customer_id = cust.customer_account_id
        INNER JOIN customer_order_list AS cod
        INNER JOIN products AS prod ON prod.product_code = cod.product_code
        INNER JOIN agent AS a ON a.area = cust.area
        WHERE cod.purchase_order_id = co.purchase_order_id
        AND co.purchase_order_id = '$poid'");

     // echo'<pre>';
     // print_r($get_deliveries);
     // echo'

    $_SESSION['order'] = $get_deliveries;
    foreach($get_deliveries as $key){
      $customer_name = $key['customer_firstName'].'&nbsp;&nbsp;'.$key['customer_lastName'];
      $order_date = $key['order_date'];
      $delivery_date = $key['delivery_date'];
      $delivered_by = $key['firstname']."\t\t".$key['lastname'];
      $_SESSION['agent'] = $delivered_by;

    }

    echo'<div style = "align:center;margin-top:1%;margin-left:53%;"><td style = "margin-left:3%;">NEW BATCH MARKETING</td></div>';

    echo'<div class = "cust" style = "float:left;margin-left:27%;margin-top:-1%;width:60%"><table>';
        echo'<tr><td>CUSTOMER NAME:</td>&nbsp;&nbsp;<td>'.$customer_name.'</td><td>PURCHASE ORDER ID:</td>&nbsp;&nbsp;<td>'.$poid.'</td></tr>';
        echo'<tr><td>PROCESSED BY:</td>&nbsp;&nbsp;<td>'.$procesed_by.'</td><td>ORDER DATE:</td>&nbsp;&nbsp;<td>'.$order_date.'</td></tr>';
        echo'<tr><td>DELIVERY ID:</td>&nbsp;&nbsp;<td>'.$delivery_id.'</td><td>DELIVERY DATE:</td>&nbsp;&nbsp;<td>'.$delivery_date.'</td></tr>';
        echo'<tr><td colspan = "3">DELIVERED BY:</td>&nbsp;&nbsp;<td>'.$delivered_by.'</td></tr>';
        echo'</table></div></br>';
    
    echo'<div class = "cust" style = "float:left;margin-left:27%;margin-top:-3%;width:60%"><table>';
    echo '<tr><td>PRODUCT NAME</td><td style = "padding-left:5%;">QTY</td><td>PRICE</td><td>AMOUNT</td></tr></table></div>';

    echo'<div class = "rep" style = "float:left;margin-left:27%;margin-top:-12.5%;width:60%"><table>';
        foreach($get_deliveries as $key){
          $quantity = $key['quantity'];
          $selling_price = $key['selling_price'];
          $amount =  $key['amount'];
           $total = $total+$key['amount'];
           $count = $count+$key['quantity'];
              $product_name = $key['product_name'].'&nbsp;&nbsp;'.$key['product_type'];
              echo '<tr><td>'.$product_name.'</td><td style = "padding-right:3%;">'.$quantity.'</td><td>'.$selling_price.'</td><td>'.$amount.'</td></tr>';    
       }  
     echo'</table></div>';

     echo'<div style = "margin-left:48%;float:left;margin-top:5px;"><td>TOTAL CASE:&nbsp;&nbsp;&nbsp;</td><td>'.$count.'</td></div>
     <div style = "margin-left:10%;float:left;margin-top:5px;"><td>TOTAL AMOUNT:&nbsp;&nbsp;&nbsp;</td><td>'.$total.'.00</td></div></br>';
    
     echo'</br><div style = "margin-left:52%;margin-top:28.5%;border-radius:2px;"><a href = "http://localhost:8080/new_batch_marketing/delivery/confirm_delivery.php?id='.$poid.'">CONFIRM DELIVERY</a></div>';

  echo '</form>';
   echo' <footer style = "margin-top:4%;"></footer>';
echo'</div>';   
?>
