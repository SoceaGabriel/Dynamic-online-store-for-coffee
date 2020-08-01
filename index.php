<?php
  //includem headerul
  include('fisiereDeAdaugat/header.php');
 ?>

 <p><br/></p>
 <p><br/></p>
 <p><br/></p>
 <div class="container-fluid">
   <div class="row">
     <div class="col-md-1"></div>
     <div class="col-md-2 col-xs-12">

       <!--Sectiune clienti logati-->
       <?php
          if(isset($_SESSION['user_id']))
          {
              echo "<div class=\"aside_box\">
                <div class=\"aside_text\">Profilul meu</div>
                <div class=\"aside_content\">
                  <img src=\"imagini/avatar.png\" width=\"150px\" height=\"150px\"/>
                  <h3>Bună ziua,<br/> ".$_SESSION['user_name']." ".$_SESSION['user_prenume']."!</h3>
                  <a class=\"btn btn-success\" href=\"my_profile.php\"><i class=\"fa fa-vcard-o\"></i> Contul meu</a>
                </div>
              </div>";
          }
       ?>

       <!--Menu section-->
       <div class="aside_box">
         <div class="aside_text">Meniu</div>
         <div class="aside_content">
           <ul class="aside_content_ul">
             <li><a href="index.php">Acasă</a></li>
             <li><a href="aboutUs.php">Despre noi</a></li>
           </ul>
         </div>
       </div>

       <!--Admin dashboard section-->
       <div class="aside_box">
         <div class="aside_text">Panou de control</div>
         <div class="aside_content">Dacă esti admin poți accesa panoul de control din link-ul urmator<br/>
           <a href="dashboard/admin/dashboard.php" class="btn btn-success" style="text-align:center;">Dashboard</a>
         </div>
       </div>
       <div class="aside_box">
         <div class="aside_text">Sorteaza dupa </div>
         <div class="aside_content" id="ordonare">
           <div class='nav nav-pills nav-stacked'>
              <li><a href='#' class='ordonare_dupa' tip='pret_cresc'>Pret Crescator</a></li>
              <li><a href='#' class='ordonare_dupa' tip='pret_desc'>Pret Descrescator</a></li>
              <li><a href='#' class='ordonare_dupa' tip='pret_redus'>Produse Reduse</a></li>
           </div>
         </div>
       </div>  
       <!--Filtrare dupa categorie-->
       <div class="aside_box">
         <div class="aside_text">Categorii produse</div>
         <div class="aside_content" id="categorii_produse">
           <div class='nav nav-pills nav-stacked'>
              <li><a href='#' class='tip_cafea' tip='cafea_boabe'>Cafea Boabe</a></li>
              <li><a href='#' class='tip_cafea' tip='cafea_capsule'>Cafea Capsule</a></li>
              <li><a href='#' class='tip_cafea' tip='cafea_macinata'>Cafea Macinata</a></li>
              <li><a href='#' class='tip_cafea' tip='cafea_paduri'>Cafea Paduri</a></li>
              <li><a href='#' class='tip_cafea' tip='cafea_instant'>Cafea Instant</a></li>
           </div>
         </div>
       </div>

       <!--Filtrare dupa gread de prajire-->
       <div class="aside_box">
         <div class="aside_text">Grad de prăjire</div>
         <div class="aside_content" id="grad_prajire">
           <div class='nav nav-pills nav-stacked'>
              <li><a href='#' class='grad_de_prajire' grad='intens'>Intens</a></li>
              <li><a href='#' class='grad_de_prajire' grad='mediu'>Mediu</a></li>
              <li><a href='#' class='grad_de_prajire' grad='mediu-intens'>Mediu-Intens</a></li>
              <li><a href='#' class='grad_de_prajire' grad='slab'>Slab</a></li>
              <li><a href='#' class='grad_de_prajire' grad='slab-mediu'>Slab-mediu</a></li>
           </div>
         </div>
       </div>

       <!--Filtrare dupa promotie-->
       <!--
       <div class="aside_box">
         <div class="aside_text">Promoție</div>
         <div class="aside_content" id="promo">
         </div>
       </div>
       -->
     </div>
     <div class="col-md-8 col-xs-12">
       <div class="row">
         <div class="col-md-12 col-xs-12" id="mesaj_succes">
         </div>
       </div>
       <div class="panel panel-info">
         <div class="panel-heading"><b>Rasfățați-vă cu o cafea de calitate - alegeți-vă cafeaua dorita din produsele noastre</b></div>
         <div class="panel-body" style="box-sizing: border-box;">
           <div id="get_product">

           </div>
         </div>
         <div id="pageno" style="text-align:center;"></div>
         <div class="panel-footer" style="text-align:center;"><hr class="style-eight"/></div>
       </div>
     </div>
     <div class="col-md-1"></div>
   </div>
 </div>

<?php include('fisiereDeAdaugat/footer.php');?>
