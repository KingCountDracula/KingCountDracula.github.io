

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
    <div class="modal-header"></div>
    <div class="modal-body">';

    date_default_timezone_set('Etc/GMT+8');

    $new_batch_marketing = new Db();

    $order_entry = $_SESSION['entry'];

    $order_id = 'O'.date("ymdhis").'S';
    $date = Date("Y-m-d");

    $sum_case = '';
    $processed_by = $_SESSION['user'];
    $a = 0;

    
    echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/reports/reorder_redirect.php">';
    echo'<title>REORDER ENTRY</title>';
   
        if(isset($_POST['go'])){

        $supplier_id = $_POST['supplier_account_id'];
          
        if(empty($supplier_id)){
                echo'<script>alert("SELECT SUPPLIER")</script>';
        }else{

          foreach($order_entry as $key){

           $code = $key['code'];
           $case = $key['case'];

              $sum_case = $sum_case + $case;
                  $insert_into_order_supplier_list = $new_batch_marketing->query("INSERT INTO order_supplier_list(`id`,`order_supplier_id`,`product_code`,`quantity`) VALUES(NULL,'$order_id','$code',$case)");     
          }
               
             $insert_into_order_supplier = $new_batch_marketing->query("INSERT INTO order_supplier(`order_supplier_id`,`supplier_id`,`order_date`,`processed_by`,`total_case`) VALUES('$order_id',$supplier_id,'$date','$processed_by',$sum_case)");
              
              echo'<script>alert("SUCCESSFUL!")</script>';
               
               echo '<script type="text/javascript">window.location.href = "/new_batch_marketing/nbm/nbm_index.php";</script>';
                exit();
        }
    }
        
      echo'<div style = "margin-left:15%;margin-right:-15%;margin-top:10px;">
     <input type = "text" name = "order_id" value = "'.$order_id.'" class = "form-control" style = "width: 70%;border-radius:2px;" readonly = "readonly" placeholder = "ORDER ID"></br>
     <select style = "width: 70%;border-radius:2px;" class="form-control" id="supplier_account_id" name = "supplier_account_id">
     <option value = "">SELECT SUPPLIER</option>';

                    $get_supplier_info = $new_batch_marketing->query("SELECT *  FROM supplier");
                    foreach($get_supplier_info as $key){
                          $supplier_name = $key['supplier_name'];
                          $supplier_address = $key['supplier_address'];
                          $supplier_contact = $key['supplier_contact_number'];

                          echo'<option value = "'.$key['supplier_account_id'].'">'.$key['supplier_name'].'</option>';
                    }
                    echo'  
                    </select></br>';

        echo'<input type = "submit" name ="go" value = "SUBMIT" style = "width:70%;border-radius:2px;background:#30493D;color:white;" class = "form-control"></br>
            <a href = "http://localhost:8080/new_batch_marketing/nbm/nbm_index.php" style = "margin-left:54%;">CANCEL</a>
    </div>';
    echo '</form>';
    echo'</div>';
 echo'<div class="modal-header"></div>';
echo'</div>';

  echo'<div class = "credit_index" style = "margin-top:18%"></div>';
?>


