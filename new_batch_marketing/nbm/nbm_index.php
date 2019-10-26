
      <?php

      session_start();

      //require('opt\lampp\\new_batch_marketing\\nbm\\header.php');
      //require("xampp\htdocs\\new_batch_marketing\\nbm\\footer.php");
      require("\htdocs\\new_batch_marketing\dbOption\Db.class.php");

      date_default_timezone_set('Etc/GMT+8');

      $new_batch_marketing = new Db();
      $current_date = Date('Y-m-d');

      $current_balance = '';

      echo'<form method = "post" action = "http://localhost:8080/nbm/nbm_index.php">';

           $receivables = $new_batch_marketing->query("SELECT p.balance,co.purchase_order_id, co.customer_id, co.delivery_date, co.status, co.flag, c.customer_firstName, c.customer_lastName
        FROM customer AS c
        INNER JOIN customer_order AS co ON co.customer_id = c.customer_account_id
         INNER JOIN payment AS p ON p.customer_order_id = co.purchase_order_id
        WHERE co.status =  'CREDIT'");

        echo'<div style = "width:47.1%;height:55.56%;margin-right;0%;background:white;margin-top:-30.12%;float:right;">';
           echo '<div style = "align:left;;margin-top:6%;margin-left:10%;color:#BC0D1D;">
          <h1>RECEIVABLES OF THE DAY<h1></div>';
              echo'<div class = "rep" style = "margin-left:20%;width:60%;"><table>';   
    
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
                 // echo $aging.'</br>';
                  if($aging > 30){
                    $aging = 30;
                  }    

           echo'<tr><td><a href = "http://localhost:8080/new_batch_marketing/reports/receivables_redirect.php?id='.$key['customer_id'].'">'.$key['customer_firstName'].'&nbsp;&nbsp;'.$key['customer_lastName'].'</a></td><td>CURRENT BALANCE:&nbsp;php</td><td>'.$key['balance'].'</td></tr>'; 
           }      
        }
         echo'</table></div>';

        echo'</div>';

        $update_running_credit = $new_batch_marketing->query("SELECT co.purchase_order_id,co.delivery_date,co.status,co.flag,p.balance FROM payment as p
          INNER JOIN customer_order AS co ON co.purchase_order_id = p.customer_order_id WHERE co.status = 'CREDIT'");

        if(empty($update_running_credit)){
          #do nothing...
        }else{
          foreach($update_running_credit as $key){
              $d_date = $key['delivery_date'];
              $p_id = $key['purchase_order_id'];
              
              $current_balance = $key['balance'];
                $age = (strtotime($current_date) - strtotime($d_date))/86400;
                $age = round(abs($age));
                // echo $age.'</br>';
                if($age > 30){
                  $age = 30;
                }

                if($age > 10 && $key['flag'] == 0){
                    $new_balance =round($key['balance'],2,PHP_ROUND_HALF_UP) + round($key['balance'] * 0.05,2,PHP_ROUND_HALF_UP);
                    
                    $update_flag = $new_batch_marketing->query("UPDATE customer_order SET `flag` = 1 WHERE purchase_order_id = '$p_id'");
                    $update_balance = $new_batch_marketing->query("UPDATE payment SET balance = $new_balance WHERE customer_order_id = '$p_id'");

                    $new_balance = 0;
                }
                
                $cycle = $age - 25;

                if($key['flag'] > 5){
                  #do nothing..
                }else{
                   if($cycle > 0 && $key['flag'] == 1){

                    $xyz = 0;

                  while($cycle !=0){

                       $interest =round($current_balance * 0.05,2,PHP_ROUND_HALF_UP);
                       $penalty = round($current_balance * 0.03,2,PHP_ROUND_HALF_UP);
                       $new_balance = round($current_balance + ($interest + $penalty),2,PHP_ROUND_HALF_UP);  
                       $current_balance = $new_balance;

                       $cycle--;
                       $xyz++;    
                  }
                    $xyz = $xyz+1;

                    $update_flag = $new_batch_marketing->query("UPDATE customer_order SET `flag` = $xyz WHERE purchase_order_id = '$p_id'");
                    $update_balance = $new_batch_marketing->query("UPDATE payment SET balance = $current_balance WHERE customer_order_id = '$p_id'");

                    $xyz = 0;
                    $current_balance = 0;
                    $interest = 0;
                    $penalty = 0;
                    $new_balance = 0;

                }

                if($cycle == $key['flag']){

                       $abc = $key['flag'] + 1;

                       $interest =round($current_balance * 0.05,2,PHP_ROUND_HALF_UP);
                       $penalty = round($current_balance * 0.03,2,PHP_ROUND_HALF_UP);
                       $new_balance = round($current_balance + ($interest + $penalty),2,PHP_ROUND_HALF_UP);  
                       $current_balance = $new_balance;

                      $update_flag = $new_batch_marketing->query("UPDATE customer_order SET `flag` = $abc WHERE purchase_order_id = '$p_id'");
                      $update_balance = $new_batch_marketing->query("UPDATE payment SET balance = $current_balance WHERE customer_order_id = '$p_id'");

                      $abc = 0;
                      $current_balance = 0;
                      $interest = 0;
                      $penalty = 0;
                      $new_balance = 0;
                }

                if($cycle == 3 && $key['flag'] == 2){

                        $xyz = $key['flag'] + 2;
                        $aaa = 2;

                     while($aaa !=0){

                       $interest =round($current_balance * 0.05,2,PHP_ROUND_HALF_UP);
                       $penalty = round($current_balance * 0.03,2,PHP_ROUND_HALF_UP);
                       $new_balance = round($current_balance + ($interest + $penalty),2,PHP_ROUND_HALF_UP);  
                       $current_balance = $new_balance;

                       $aaa--;   
                  }

                    $update_flag = $new_batch_marketing->query("UPDATE customer_order SET `flag` = $xyz WHERE purchase_order_id = '$p_id'");
                    $update_balance = $new_batch_marketing->query("UPDATE payment SET balance = $current_balance WHERE customer_order_id = '$p_id'");

                    $xyz = 0;
                    $current_balance = 0;
                    $interest = 0;
                    $penalty = 0;
                    $new_balance = 0;
                    $aaa = 0;
                }

                if($cycle == 4 && $key['flag'] == 2){

                        $xyz = $key['flag'] + 3;
                        $aaa = 3;

                     while($aaa !=0){

                       $interest =round($current_balance * 0.05,2,PHP_ROUND_HALF_UP);
                       $penalty = round($current_balance * 0.03,2,PHP_ROUND_HALF_UP);
                       $new_balance = round($current_balance + ($interest + $penalty),2,PHP_ROUND_HALF_UP);  
                       $current_balance = $new_balance;

                       $aaa--;   
                  }

                    $update_flag = $new_batch_marketing->query("UPDATE customer_order SET `flag` = $xyz WHERE purchase_order_id = '$p_id'");
                    $update_balance = $new_batch_marketing->query("UPDATE payment SET balance = $current_balance WHERE customer_order_id = '$p_id'");

                    $xyz = 0;
                    $current_balance = 0;
                    $interest = 0;
                    $penalty = 0;
                    $new_balance = 0;
                    $aaa = 0;
                }

                if($cycle == 4 && $key['flag'] == 3){

                        $xyz = $key['flag'] + 2;
                        $aaa = 2;

                     while($aaa !=0){

                       $interest =round($current_balance * 0.05,2,PHP_ROUND_HALF_UP);
                       $penalty = round($current_balance * 0.03,2,PHP_ROUND_HALF_UP);
                       $new_balance = round($current_balance + ($interest + $penalty),2,PHP_ROUND_HALF_UP);  
                       $current_balance = $new_balance;

                       $aaa--;   
                  }

                    $update_flag = $new_batch_marketing->query("UPDATE customer_order SET `flag` = $xyz WHERE purchase_order_id = '$p_id'");
                    $update_balance = $new_batch_marketing->query("UPDATE payment SET balance = $current_balance WHERE customer_order_id = '$p_id'");

                    $xyz = 0;
                    $current_balance = 0;
                    $interest = 0;
                    $penalty = 0;
                    $new_balance = 0;
                    $aaa = 0;
                }

                if($cycle == 5 && $key['flag'] == 2){

                        $xyz = $key['flag'] + 4;
                        $aaa = 4;

                     while($aaa !=0){

                       $interest =round($current_balance * 0.05,2,PHP_ROUND_HALF_UP);
                       $penalty = round($current_balance * 0.03,2,PHP_ROUND_HALF_UP);
                       $new_balance = round($current_balance + ($interest + $penalty),2,PHP_ROUND_HALF_UP);  
                       $current_balance = $new_balance;

                       $aaa--;   
                  }

                    $update_flag = $new_batch_marketing->query("UPDATE customer_order SET `flag` = $xyz WHERE purchase_order_id = '$p_id'");
                    $update_balance = $new_batch_marketing->query("UPDATE payment SET balance = $current_balance WHERE customer_order_id = '$p_id'");

                    $xyz = 0;
                    $current_balance = 0;
                    $interest = 0;
                    $penalty = 0;
                    $new_balance = 0;
                    $aaa = 0;
                }

                if($cycle == 5 && $key['flag'] == 3){

                        $xyz = $key['flag'] + 3;
                        $aaa = 3;

                     while($aaa !=0){

                       $interest =round($current_balance * 0.05,2,PHP_ROUND_HALF_UP);
                       $penalty = round($current_balance * 0.03,2,PHP_ROUND_HALF_UP);
                       $new_balance = round($current_balance + ($interest + $penalty),2,PHP_ROUND_HALF_UP);  
                       $current_balance = $new_balance;

                       $aaa--;   
                  }

                    $update_flag = $new_batch_marketing->query("UPDATE customer_order SET `flag` = $xyz WHERE purchase_order_id = '$p_id'");
                    $update_balance = $new_batch_marketing->query("UPDATE payment SET balance = $current_balance WHERE customer_order_id = '$p_id'");

                    $xyz = 0;
                    $current_balance = 0;
                    $interest = 0;
                    $penalty = 0;
                    $new_balance = 0;
                    $aaa = 0;
                }

                if($cycle == 5 && $key['flag'] == 4){

                        $xyz = $key['flag'] + 2;
                        $aaa = 2;

                     while($aaa !=0){

                       $interest =round($current_balance * 0.05,2,PHP_ROUND_HALF_UP);
                       $penalty = round($current_balance * 0.03,2,PHP_ROUND_HALF_UP);
                       $new_balance = round($current_balance + ($interest + $penalty),2,PHP_ROUND_HALF_UP);  
                       $current_balance = $new_balance;

                       $aaa--;   
                  }

                    $update_flag = $new_batch_marketing->query("UPDATE customer_order SET `flag` = $xyz WHERE purchase_order_id = '$p_id'");
                    $update_balance = $new_batch_marketing->query("UPDATE payment SET balance = $current_balance WHERE customer_order_id = '$p_id'");

                    $xyz = 0;
                    $current_balance = 0;
                    $interest = 0;
                    $penalty = 0;
                    $new_balance = 0;
                    $aaa = 0;
                }


              }
          }
        }
      
      echo'</form>';
      ?>
     