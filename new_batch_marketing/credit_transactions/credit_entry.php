

<?php
session_start();
require("C:\\xampp\htdocs\\new_batch_marketing\\nbm\\subheader.php");
require("C:\\xampp\htdocs\\new_batch_marketing\credit_entry.css");
echo'
    <link href="templates/dashboard/css/bootstrap.min.css" rel ="stylesheet"/>
	<link href="templates/dashboard/css/bootstrap.css" rel="stylesheet"/>
	<link href="templates/dashboard/css/landing-page.css" rel="stylesheet"/>

	<script src="templates/login template/jquery-1.10.2.min.js"></script>
	<script src="templates/login template/jquery-1.10.2.js"></script>

    <!-- Modal content -->
    <div style = "font-size:12px;">
    <div class="credit_modal" style = "border-radius:2px;margin-top:8%;">
    <div class="credit_header">
    </div>
    <div class="credit_body" >';

    date_default_timezone_set('Etc/GMT+8');

    echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/credit_transactions/credit_entry.php">';
    echo'<title>PAYMENTS</title>';
    $new_batch_marketing = new Db();
    $date = date('Y-m-d');
    $transaction_id = 'CC'.date("ymdhis").'CR';
    $total_amount = $_SESSION['total'];
    $balance = $_SESSION['total'];
    $order_id = $_SESSION['order_id'];
    $tr_id = '';
   
        if(isset($_POST['submit'])){
            $tr_id = $_POST['transaction_id'];
            $order_id = $_POST['purchase_order_id'];
            $total_amount = $_POST['total_amount'];
            $balance = $_POST['balance'];

            if(empty($order_id) || empty($total_amount) || empty($balance)){
                    echo'<script>alert("PLEASE FILL UP THE FIELDS COMPLETELTY")</script>';
            }else{
                $insert_credit=$new_batch_marketing->query("INSERT INTO payment(`transaction_id`,`customer_order_id`,`amount_payable`,`balance`) VALUES('$tr_id','$order_id',$total_amount,$balance)");

                 echo'<script>alert("TRASCATION has been successfully recorded.")</script>';

            $update_order_status = $new_batch_marketing->query("UPDATE `customer_order` SET `status` = 'CREDIT' WHERE `purchase_order_id` = '$order_id'");

             $update_order_status = $new_batch_marketing->query("UPDATE `customer_delivery` SET `status` = 'CREDIT' WHERE `purchase_order_id` = '$order_id'");       
            }  
        }
    echo'
     <div style = "margin-left:15%;margin-right:-15%;margin-top:-5%;">
     <input type ="text" name = "transaction_id" class = "form-control"value="'.$transaction_id.'" placeholder="TRANSACTION ID"style="width:70%;border-radius:2px;"readonly = "readonly"></br>
     <input type ="text" name = "purchase_order_id" class = "form-control"value="'.$order_id.'"style="width:70%;border-radius:2px;"placeholder="ORDER ID"readonly = "readonly"></br>
     <input type ="text" name = "total_amount" class = "form-control"value="'.$total_amount.'"style="width:70%;border-radius:2px;"placeholder="TOTAL AMOUNT"readonly = "readonly"></br>
     <input type ="text" name = "balance" class = "form-control"value="'.$balance.'"style="width:70%;border-radius:2px;"placeholder="BALANCE"readonly = "readonly"></br>';

        echo'<input type = "submit" name ="submit" value = "OK" style = "width:70%;border-radius:2px;background:#30493D;color:white;" class = "form-control"></br>
            <a href = "http://localhost:8080/new_batch_marketing/payments/payment.php" style = "margin-left:54%;">PAYMENTS</a>
            <a href = "http://localhost:8080/new_batch_marketing/nbm/nbm_index.php" style = "margin-left:54%;">CANCEL</a></div>';
    echo '</form>';

  echo'</div>
  <div class="modal-footer">
  </div>';
echo'</div>';
echo' <footer style = "margin-top:6%;"></footer>
</div>';
?>


