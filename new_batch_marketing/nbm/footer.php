<?php
?>
<section>
         <!-- CAROUSEL -->    
         <div id="carousel" style = "width:60%;height:30%;margin-top:4.70%;float:left;background:transparent;">
            <div id="owl-demo" class="owl-carousel owl-theme">
               <div class="item">
                  <img src="../img/first.jpg" alt="">       
               </div>
                <div class="item">
                  <img src="../img/14.jpg" alt="">      
               </div>
               <div class="item">
                  <img src="../img/second.jpg" alt="">      
               </div>
               <div class="item">
                  <img src="../img/8.jpg" alt="">      
               </div>
                <div class="item">
                  <img src="../img/11.jpg" alt="">      
               </div>
                <div class="item">
                  <img src="../img/10.jpg" alt="">      
               </div>
                <div class="item">
                  <img src="../img/9.jpg" alt="">      
               </div>
                <div class="item">
                  <img src="../img/13.jpg" alt="">      
               </div>
            </div>
         </div>     
      </section>
      <!-- FOOTER -->   
      <footer style = "margin-top:32.99%">
        
      </footer>
      <script type="text/javascript" src="../owl-carousel/owl.carousel.js"></script>   
      <script type="text/javascript">
         jQuery(document).ready(function($) {  
           $("#owl-demo").owlCarousel({
            slideSpeed : 300,
            autoPlay : true,
            navigation : false,
            pagination : false,
            singleItem:true
           });
           $("#owl-demo2").owlCarousel({
            slideSpeed : 300,
            autoPlay : true,
            navigation : false,
            pagination : true,
            singleItem:true
           });
         });   
          
      </script> 
   </body>
</html>
