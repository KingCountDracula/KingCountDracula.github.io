

<?php
session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");
require("C:\\xampp\htdocs\\new_batch_marketing\modal.css");
echo'
    <link href="templates/dashboard/css/bootstrap.min.css" rel ="stylesheet"/>
	<link href="templates/dashboard/css/bootstrap.css" rel="stylesheet"/>
	<link href="templates/dashboard/css/landing-page.css" rel="stylesheet"/>

	<script src="templates/login template/jquery-1.10.2.min.js"></script>
	<script src="templates/login template/jquery-1.10.2.js"></script>

    <!-- Modal content -->
    <div style = "font-size:12px;">
    <div class="modal-content" style = "border-radius:2px;">
    <div class="payment_header">
    </div>
    <div class="modal-body">';

    echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/payments/payment.php">';
    echo'<title>CASH TRANSACTION</title>';
    $new_batch_marketing = new Db();
    $OR = '';
    date_default_timezone_set('Etc/GMT+8');
    $date = date('Y-m-d');
    $transaction_id = '';
    $amount = '';
    $received_by = 'ADMIN';
    $new_balance = '';
    $current_balance = '';
    $order_id = '';


    $get_account_balance = $new_batch_marketing->query("SELECT c.customer_account_id,c.customer_firstName, c.customer_lastName, p.transaction_id,p.customer_order_id,p.balance
FROM payment AS p
INNER JOIN customer_order AS co
INNER JOIN customer AS c ON c.customer_account_id = co.customer_id
WHERE co.purchase_order_id = p.customer_order_id
AND p.balance > 0");

   
        if(isset($_POST['submit'])){
            $OR = $_POST['receipt'];
            $transaction_id = $_POST['transaction_id'];
            $amount = $_POST['amount'];

            $_SESSION['payment_transaction_id'] = $transaction_id;

            if(empty($transaction_id) || empty($OR) || empty($amount)){
                echo'<script>alert("PLEASE FILL UP FIELDS PROPERLY.")</script>';
            }else{

              $duplicate_or = $new_batch_marketing->query("SELECT count(`OR`) AS count FROM `payment_details` WHERE `OR` = '$OR'");
 
              foreach($duplicate_or as $key){
                if($key['count'] > 0){
                    echo'<script>alert("OR NUMBER already EXIST.")</script>';
                }else{
                       
                   $selected_account = $new_batch_marketing->query("SELECT * FROM payment WHERE transaction_id = '$transaction_id'");

                foreach($selected_account as $key){
                    $current_balance = $key['balance'];
                    $order_id = $key['customer_order_id'];
                   
                    $_SESSION['payment_order_id'] = $order_id;
                   
                }

                if($amount > $current_balance){
                     echo'<script>alert("CURRENT BALANCE IS ONLY php'.$current_balance.'")</script>';
                }else{

                   $new_balance = round($current_balance - $amount,2,PHP_ROUND_HALF_UP);
                   $new_balance = round($new_balance,2,PHP_ROUND_HALF_UP);
                 if($new_balance < 1){
                    $new_balance = 0;
                    echo '<script>alert("ACCOUNT SETTLED.")</script>';
                 }
                  $insert_into_sales=$new_batch_marketing->query("INSERT INTO sales(`id`,`transaction_id`,`OR`,`order_id`,`amount`,`date`) VALUES(NULL,'$transaction_id','$OR','$order_id',$amount,'$date')");

                 $insert_into_payment_details=$new_batch_marketing->query("INSERT INTO payment_details(`id`,`transaction_id`,`OR`,`date`,`amount_paid`,`received_by`) VALUES(NULL,'$transaction_id','$OR','$date',$amount,'$received_by')");

                 $update_credit_account = $new_batch_marketing->query("UPDATE `payment` SET `balance` = $new_balance WHERE `transaction_id` = '$transaction_id'");

                if($new_balance < 1){
                    $update_order_status = $new_batch_marketing->query("UPDATE `customer_order` SET `status` = 'CLEARED' WHERE `purchase_order_id` = '$order_id'");

                    $update_delivery_status = $new_batch_marketing->query("UPDATE `customer_delivery` SET `status` = 'CLEARED' WHERE `purchase_order_id` = '$order_id'");
                }
                 echo '<script>alert("PAYMENT HAS BEEN RECORDED.")</script>';

                 echo '<script type="text/javascript">window.location.href = "payment_redirect.php";</script>';
                  exit();
                }
                }
              }
          }
        }
 
     echo'<div style = "margin-left:15%;margin-right:-15%;margin-top:10px;">
     <select name = "transaction_id" style="width:70%;border-radius:2px;" class = "form-control">
     <option value "">SELECT ACCOUNT</option>';
        foreach($get_account_balance as $key){
          echo'<option value = "'.$key['transaction_id'].'">'.$key['customer_firstName']."\t\t".$key['customer_lastName'].'</option>';
        }
    echo'</select></br>';
     echo'<input type ="text" name = "receipt" class = "form-control"value="'.$OR.'"style="width:70%;border-radius:2px;"placeholder="Receipt NO."></br>
     <input type ="text" name = "amount" class = "form-control"value="'.$amount.'"style="width:70%;border-radius:2px;"placeholder="AMOUNT"></br>';
        echo'<input type = "submit" name ="submit" value = "OK" style = "width:70%;border-radius:2px;background:#30493D;color:white;" class = "form-control"></br>
            <a href = "http://localhost:8080/new_batch_marketing/nbm/nbm_index.php" style = "margin-left:54%;">CANCEL</a></div>';

    echo '</form>';
  echo'</div>
  <div class="payment_footer">
  </div>';
  echo'</div>';

  echo'<div class = "custom_p_footer style = "margin-top:%"></div></div>';

?>


