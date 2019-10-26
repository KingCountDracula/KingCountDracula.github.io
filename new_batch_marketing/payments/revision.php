

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

    echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/payments/revision.php">';
    echo'<title>PAYMENTS</title>';
    $new_batch_marketing = new Db();
    $date = date('Y-m-d');
    $transaction_id = 'CC'.date("ymdhis").'CR';
    $_SESSION['credit_id'] = $transaction_id;
    $total_amount = '';
    $balance = '';
    $order_id = '';
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

        $credit_accounts = $new_batch_marketing->query("SELECT c.customer_firstName, c.customer_lastName,co.purchase_order_id,co.amount FROM customer_order AS co
          INNER JOIN customer AS c ON c.customer_account_id = co.customer_id WHERE co.status = 'CREDIT'");
    echo'
     <div style = "margin-left:15%;margin-right:-15%;margin-top:-5%;">
      <select style = "width:70%;border-radius:2px;"class="form-control" id="customer_order_id" name = "customer_order_id"onchange = "getDetails()">
             <option value = "">SELECT ACCOUNT</option>';  
          foreach($credit_accounts as $key){
            $utang_id = $key['purchase_order_id'];
            $name = $key['customer_firstName']."\t\t".$key['customer_lastName'];
            $blee = '<a href="?utang='.$utang_id.'">'.$name.'</a>';
                  echo'<option value = "'.$utang_id.'"><a href="?utang='.$utang_id.'">'.$name.'</a></option>';

             //       echo'<a href="?utang='.$utang_id.'">'.$name.'</a>';

             // if(isset($_GET['utang'])){
             //     $utang_details = $new_batch_marketing->query("SELECT * FROM customer_order WHERE purchase_order_id = '".$_GET['utang']."'");    
             //    }
          }
          echo'  
          </select></br>';

            echo'<a href="?utang='.$utang_id.'">'.$name.'</a>';

             if(isset($_GET['utang'])){
                 $utang_details = $new_batch_marketing->query("SELECT * FROM customer_order WHERE purchase_order_id = '".$_GET['utang']."'");

                 $order_id = $key['purchase_order_id'];
                 $total_amount = $key['amount'];
                 $balance = $key['amount'];
            }

          echo'<input type ="text" name = "transaction_id" class = "form-control"value="'.$transaction_id.'" placeholder="TRANSACTION ID"style="width:70%;border-radius:2px;"></br>
         <input type ="text" name = "purchase_order_id" class = "form-control"value="'.$order_id.'"style="width:70%;border-radius:2px;"placeholder="ORDER ID"></br>
         <input type ="text" name = "total_amount" class = "form-control"value="'.$total_amount.'"style="width:70%;border-radius:2px;"placeholder="TOTAL AMOUNT"></br>
         <input type ="text" name = "balance" class = "form-control"value="'.$balance.'"style="width:70%;border-radius:2px;"placeholder="BALANCE"></br>';   
        echo'<input type = "submit" name ="submit" value = "OK" style = "width:70%;border-radius:2px;background:#30493D;color:white;" class = "form-control"></br>
            <a href = "http://localhost:8080/new_batch_marketing/payments/payment.php" style = "margin-left:54%;">PAYMENTS</a>
            <a href = "http://localhost:8080/new_batch_marketing/nbm/nbm_index.php" style = "margin-left:54%;">CANCEL</a></div>';


           
    echo '</form>';
      echo'<p id = "con"></p>';
  echo'</div>
  <div class="modal-footer">
  </div>';
echo'</div>';
// echo' <footer style = "margin-top:4%;"></footer>
echo'</div>';

function getDetails(){
   $utang_details = $new_batch_marketing->query("SELECT * FROM customer_order WHERE customer_order_id = '$utang_id' AND status = 'CREDTI'");

   print_r($utang_details);
}
?>

 