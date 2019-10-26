

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
    <div class="modal-header">
    </div>
    <div class="modal-body">';


    date_default_timezone_set('Etc/GMT+8');

    echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/credit_transactions/cash.php">';
    echo'<title>CASH TRANSACTION</title>';
    $new_batch_marketing = new Db();
    $OR = '';
    $date = date('Y-m-d');
   
        if(isset($_POST['submit'])){
            $OR = $_POST['OR'];
            $tr_id = $_SESSION['transaction_id'];
            $or_id = $_SESSION['order_id'];
            $cus_id = $_SESSION['c_id'];
            $amt = $_SESSION['total'];
            if(empty($OR)){
                echo'<script>alert("PLEASE PROVIDE OR NO.")</script>';
            }else{
                $filter_duplicate_or = $new_batch_marketing->query("SELECT count(`OR`) AS count FROM `sales` WHERE `OR` = '$OR'");

                foreach($filter_duplicate_or as $key){
                   if($key['count'] > 0){
                     echo'<script>alert("OR NUMBER already EXIST.")</script>';
                    }else{
                        $insert_into_sales=$new_batch_marketing->query("INSERT INTO sales(`id`,`transaction_id`,`OR`,`order_id`,`amount`,`date`) VALUES(NULL,'$tr_id','$OR','$or_id',$amt,'$date')");

                         $update_order_status = $new_batch_marketing->query("UPDATE `customer_order` SET `status` = 'CLEARED' WHERE `purchase_order_id` = '".$_SESSION['order_id']."'");

                         $update_order_status = $new_batch_marketing->query("UPDATE `customer_delivery` SET `status` = 'CLEARED' WHERE `customer_delivery_id` = '".$_SESSION['delivery_id']."'");

                         echo '<script>alert("ORDER IS CLEARED")</script>';

                         echo '<script type="text/javascript">window.location.href = "delivery_reports.php";</script>';
                          exit();
                    }
                }
            }
        }
         echo'
     <div style = "margin-left:15%;margin-right:-15%;margin-top:10px;">
     <input type ="text" name = "" class = "form-control"value="'.$_SESSION['transaction_id'].'"style="width:70%;border-radius:2px;"readonly = "readonly"></br>
     <input type ="text" name = "OR" class = "form-control"value="'.$OR.'"style="width:70%;border-radius:2px;"placeholder="Receipt NO."></br>
     <input type ="text" name = "amount" class = "form-control"value="Php'.$_SESSION['total'].'.00"style="width:70%;border-radius:2px;"placeholder="AMOUNT"></br>';
        echo'<input type = "submit" name ="submit" value = "OK" style = "width:70%;border-radius:2px;background:#30493D;color:white;" class = "form-control"></br>
            <a href = "http://localhost:8080/new_batch_marketing/credit_transactions/delivery_reports.php" style = "margin-left:54%;">CANCEL</a></div>';

    echo '</form>';
  echo'</div>
  <div class="modal-header">
  </div>
</div>';
echo'<div class = "cash_footer" style = "margin-top:14%"></div>';
?>


