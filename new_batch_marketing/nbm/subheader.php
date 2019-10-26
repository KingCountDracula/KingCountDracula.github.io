
<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>NEW BATCH MARKETING</title>
      <link rel="stylesheet" href="../css/components.css">
      <link rel="stylesheet" href="../css/responsee.css">
      <?php
      require("C:\\xampp\htdocs\\new_batch_marketing\bootstrap.css");
      require("C:\\xampp\htdocs\\new_batch_marketing\bootstrap.min.css");
      require("C:\\xampp\htdocs\\new_batch_marketing\landing-page.css");
      require("C:\\xampp\htdocs\\new_batch_marketing\dbOption\Db.class.php");
      require("C:\\xampp\htdocs\\new_batch_marketing\methods.php");
      require("C:\\xampp\htdocs\\new_batch_marketing\modal.css");
      ?>
      <link rel="stylesheet" href="../owl-carousel/owl.carousel.css">
      <link rel="stylesheet" href="../owl-carousel/owl.theme.css">
      <!-- CUSTOM STYLE -->  
      <link rel="stylesheet" href="/new_batch_marketing/css/template-style.css">
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
      <script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="../js/jquery-ui.min.js"></script>    
      <script type="text/javascript" src="../js/modernizr.js"></script>
      <script type="text/javascript" src="../js/responsee.js"></script>   
   </head>
   <body background="black" style = "font-size:12px;font:Helvetica;">
      <!-- TOP NAV WITH LOGO -->  
      <div style="margin-top:1%;background:#040606;">
         <img src="/new_batch_marketing/img/nbm_cover_jpeg.jpg"style = "height:1%;width:200px;margin-left:10%;"> 
      </div>
       <header>
         <nav style ="margin-top:5.5%;background:#00191C;">
            <div class="line">
               <div class="top-nav">              
                  <div class="top-nav s-11 1-6">
                     <ul class="right top-ul chevron">
                        <li><a href="/new_batch_marketing/nbm/nbm_index.php">HOME</a></li>
                        <li><a>REGISTRATIONS</a>
                            <ul class="right top-ul chevron">
                                 <li><a>SUPPLIER</a>
                                    <ul class="right top-ul chevron">
                                       <li><a href = "/new_batch_marketing/supplier/supplier_index.php">ADD</a></li>
                                       <li><a href = "/new_batch_marketing/supplier/supplier_update.php">SEARCH</a></li>
                                       <li><a href = "/new_batch_marketing/supplier/supplier_list.php">VIEW ALL</a></li>
                                    </ul>
                                 </li>
                                 <li><a>CUSTOMER</a>
                                    <ul class="right top-ul chevron">
                                       <li><a href = "/new_batch_marketing/customer/customer_index.php">ADD</a></li>
                                       <li><a href = "/new_batch_marketing/customer/customer_update.php">SEARCH</a></li>
                                       <li><a href = "/new_batch_marketing/customer/customer_list.php">VIEW ALL</a></li>
                                    </ul>
                                 </li>
                                  <li><a>PRODUCT</a>
                                    <ul class="right top-ul chevron">
                                       <li><a href = "/new_batch_marketing/products/product_index.php">ADD</a></li>
                                       <li><a href = "/new_batch_marketing/products/product_update.php">SEARCH</a></li>
                                       <li><a href = "/new_batch_marketing/products/product_list.php">VIEW ALL</a></li>
                                    </ul>
                                 </li>
                                  <li><a>AGENT</a>
                                    <ul class="right top-ul chevron">
                                       <li><a href = "/new_batch_marketing/agent/agent_registration.php">ADD</a></li>
                                       <li><a href = "/new_batch_marketing/agent/agent_index.php">SEARCH</a></li>
                                       <li><a href = "/new_batch_marketing/agent/agent_list.php">VIEW ALL</a></li>
                                    </ul>
                                 </li>
                                  <li><a>AREA</a>
                                    <ul class="right top-ul chevron">
                                       <li><a href = "/new_batch_marketing/area/area_entry.php">ADD</a></li>
                                       <li><a href = "/new_batch_marketing/area/area_index.php">SEARCH</a></li>
                                       <li><a href = "/new_batch_marketing/area/area_list.php">VIEW ALL</a></li>
                                    </ul>
                                 </li>
                           </ul>
                        </li>
                        <li><a>TRANSACTIONS</a>
                           <ul class="right top-ul chevron">
                              <li><a>SUPPLIER</a>
                                 <ul class="right top-ul chevron">
                                       <li><a href = "/new_batch_marketing/order_supplier/order_supplier_index.php">ORDER</a></li>
                                       <li><a href = "/new_batch_marketing/order_supplier/order_delivery.php">DELIVERY</a></li>
                                 </ul>
                              </li>
                              <li><a>CUSTOMER</a>
                                   <ul class="right top-ul chevron">
                                       <li><a href="/new_batch_marketing/credit_transactions/credit_index.php">ORDER</a></li>
                                       <li><a href = "/new_batch_marketing/delivery/deliveries_of_the_day.php">DELIVERY</a></li>
                                 </ul>
                              </li>
                              <li><a href="/new_batch_marketing/credit_transactions/delivery_reports.php">SALES</a>
                                 <!-- <ul class="right top-ul chevron">
                                    <li><a href="/new_batch_marketing/credit_transactions/delivery_reports.php">CASH</a></li>
                                    <li><a href="/new_batch_marketing/payments/credit_entry.php">CREDIT</a></li>
                                 </ul> -->
                              </li>
                              <li><a href="/new_batch_marketing/payments/payment.php">PAYMENTS</a>
                              </li>
                           </ul>
                        </li>
                        <li><a>REPORTS</a>
                           <ul class="right top-ul chevron">
                              <li><a >SALES</a>
                                 <ul class="right top-ul chevron">
                                       <li><a href="/new_batch_marketing/reports/sales_report.php">CASH</a></li>
                                       <li><a href="/new_batch_marketing/reports/daily_credits.php">CREDIT</a></li>
                                 </ul>
                              </li>
                              <li><a href="/new_batch_marketing/reports/shortage.php">SHORTAGE</a>
                              <li><a href="/new_batch_marketing/reports/reorder.php">REORDER ENTRY</a>
                              <li><a href="/new_batch_marketing/reports/stock_inventory.php">INVENTORY</a></li>
                              <li><a href="/new_batch_marketing/reports/order_supplier_lis.php">ORDER-SUPPLIER</a></li>
                               <li><a href="/new_batch_marketing/reports/custome_order_list.php">CUSOTOMER ORDER</a></li>
                               <li><a href="/new_batch_marketing/reports/receivables.php">CUSTOMER CREDIT</a></li>
                           </ul>
                        </li>
                        <li><a href = "http://localhost:8080/new_batch_marketing/user/user_login.php">LOG OUT</a></li>
                  </div>
               </div>
            </div>
         </nav>
      </header>