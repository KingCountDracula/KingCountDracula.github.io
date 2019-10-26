

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

    $_SESSION['customer_id'] = '';
    $_SESSION['transaction_id'] = '';
    $_SESSION['transaction_date'] = '';
    $_SESSION['customer_name'] = '';
    $_SESSION['address'] = '';
    $_SESSION['num'] = '';
    $_SESSION['agent'] = '';
    $_SESSION['agent_num'] = '';

    date_default_timezone_set('Etc/GMT+8');

    $credit_transaction_id = 'O'.date("ymdhis").'C';
    $credit_transaction_date = date("Y-m-d");

    $customer_id = '';
    $lastname = '';
    $customer_address = '';
    $customer_num = '';
    $firstname = '';
    $agent = '';
    $agent_num ='';
    $status = '';
    $active_customer = '';

    echo '<form method = "post" action = "http://localhost:8080/new_batch_marketing/credit_transactions/credit_index.php">';
    echo'<title>CUSOTMER ORDER</title>';
    $new_batch_marketing = new Db();

      $get_active_customer = $new_batch_marketing->query("SELECT * FROM customer WHERE customer_status = 'active' ORDER BY customer_firstName ASC");
        
     echo'<div style = "margin-left:15%;margin-right:-15%;margin-top:10px;">
     <select name = "customer_id" class = "form-control" style = "width:70%;border-radius:2px;">
     <option value = "">SELECT ACCOUNT</option>';
        foreach($get_active_customer as $key){
            
            echo'<option value = "'.$key['customer_account_id'].'">'.$key['customer_firstName']."\t\t".$key['customer_lastName'].'</option>';
        }
    
    echo'</select></br>';

   
        if(isset($_POST['submit'])){

            $active_customer = $_POST['customer_id'];
            if(empty($active_customer)){
              echo'<script>alert("FILL UP FORMS COMPLETELY")</script>';
            }else{
                $get_customer_name = $new_batch_marketing->query("SELECT agent.lastname, agent.firstname,agent.contact_num,customer.customer_lastName, customer.customer_firstName, customer.customer_account_id, customer.barangay, customer.town, customer.customer_contact_number,customer.customer_status
                    FROM customer AS customer
                    INNER JOIN agent AS agent ON agent.area = customer.area
                    WHERE customer.customer_account_id = '$active_customer'");

                if(empty($get_customer_name)){
                    echo '<script>alert("No record/s found.")</script>';
                }
                else{
                  foreach($get_customer_name as $key);
                   {

                    $customer_id = $key['customer_account_id'];
                    $customer_name = $key['customer_firstName']."\t\t".$key['customer_lastName'];
                    $customer_address = $key['barangay'].",\t\t".$key['town'];
                    $customer_num = $key['customer_contact_number'];
                    $agent = $key['firstname']."\t\t".$key['lastname'];
                    $agent_num = $key['contact_num'];
                    $status = $key['customer_status'];
                   }

                   $get_balance = $new_batch_marketing->query("SELECT p.balance
                    FROM payment AS p
                    INNER JOIN customer_order AS co ON co.purchase_order_id = p.customer_order_id
                    WHERE co.customer_id = '$active_customer'
                    AND p.balance > 1 ");

                    if(!(empty($get_balance))){
                        echo '<script>alert("CUSTOMER HAVE UNSETTLED TRANSACTION")</script>';
                    }
                    else if($status == 'inactive'){

                            echo'<script>alert("CUSTOMER IS INACTIVE")</script>';

                    }else{

                        $current_order = $new_batch_marketing->query("SELECT * FROM customer_order WHERE customer_id = '$active_customer' AND status = 'FD'");
                        if(!(empty($current_order))){
                            echo'<script>alert("CUSTOMER HAS CURRENT ORDER")</script>';
                        }else{
                           $_SESSION['customer_id'] = $customer_id;
                           $_SESSION['transaction_id'] = $credit_transaction_id;
                           $_SESSION['transaction_date'] = $credit_transaction_date;
                           $_SESSION['customer_name'] = $customer_name;
                           $_SESSION['address'] = $customer_address;
                           $_SESSION['num'] = $customer_num;
                           $_SESSION['agent'] = $agent;
                           $_SESSION['agent_num'] = $agent_num;
                           echo '<script type="text/javascript">window.location.href = "credit_transaction_redirect.php";</script>';
                                          exit();
                        }
                    }   
                }
            }
        }

    echo'<input type = "submit" name ="submit" value = "SELECT" style = "width:70%;border-radius:2px;background:#30493D;color:white;" class = "form-control"></br>
            <a href = "http://localhost:8080/new_batch_marketing/nbm/nbm_index.php" style = "margin-left:54%;">CANCEL</a>
    </div>';
    echo '</form>';
    echo'</div>';
  echo'<div class="modal-header"></div>';
echo'</div>';

  echo'<div class = "custom_footer" style = "margin-top:21%"></div>';
?>


