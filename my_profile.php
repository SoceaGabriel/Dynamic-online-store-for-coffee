<?php
  //includem headerul
  include('fisiereDeAdaugat/header.php');

  session_start();
?>

<!--Partea principala a panoului de control-->
<div class="container" style="margin-top:90px;">
<section class="main-content">
  <div class="all-profile">

    <?php
    //se salveaza datele utilizatorului din baza de date in variabile php
    $id_adm = $_SESSION['user_id'];
    $cursor_ad = oci_new_cursor($c);
    $query_ad = 'begin utilizatori_func.select_admin_profile(:adm,:id_adm); end;';
    $parse_ad = oci_parse($c,$query_ad);
    oci_bind_by_name($parse_ad, ":adm", $cursor_ad, -1, OCI_B_CURSOR);
    oci_bind_by_name($parse_ad, ":id_adm", $id_adm);
    oci_execute($parse_ad);
    oci_execute($cursor_ad);
    if(oci_fetch($cursor_ad))
    {
      $var1 = oci_result($cursor_ad,'NUME');
      $var2 = oci_result($cursor_ad,'PRENUME');
      $var3 = oci_result($cursor_ad,'TELEFON');
      $var4 = oci_result($cursor_ad,'EMAIL');
      $var5 = oci_result($cursor_ad,'LOCALITATE');
      $var6 = oci_result($cursor_ad,'JUDET');
      $var7 = oci_result($cursor_ad,'COD_POSTAL');
      $var8 = oci_result($cursor_ad,'ADRESA');
    }
    oci_free_statement($cursor_ad);
    ?>

    <!--chenar cu poza, nume, rang-->
    <div class="profile-section">
      <div class="card rounded">
      <img class="card-img-top" src="imagini/avatar.png" alt="Card image" style="width:100%">
      <div class="card-body">
        <h4 class="card-title text-center"><?php echo $var2." ".$var1; ?></h4>
        <h6 class="card-text text-center">Rang utilizator: cumpărator</h6>
      </div>
    </div>
    </div>

    <!--Se afiseaza informatiile extrase din baza de date-->
    <div class="info-profile">
      <!--Nume si prenume-->
      <div class="profile_item">
        <div class="profile_header">Nume și prenume</div>
        <div class="text_profile"><?php echo $var1." ".$var2; ?></div>
      </div>
      <hr class="hr_profile"/>

      <!--Email-->
      <div class="profile_item">
        <div class="profile_header">Email</div>
        <div class="text_profile"><?php echo $var4; ?></div>
      </div>
      <hr class="hr_profile"/>

      <!--Telefon-->
      <div class="profile_item">
        <div class="profile_header">Telefon</div>
        <div class="text_profile">0<?php echo $var3; ?></div>
      </div>
      <hr class="hr_profile"/>

      <!--Localitate-->
      <div class="profile_item">
        <div class="profile_header">Localitate</div>
        <div class="text_profile"><?php echo $var5; ?></div>
      </div>
      <hr class="hr_profile"/>

      <!--Judet-->
      <div class="profile_item">
        <div class="profile_header">Județ</div>
        <div class="text_profile"><?php echo $var6; ?></div>
      </div>
      <hr class="hr_profile"/>

      <!--Cod postal-->
      <div class="profile_item">
        <div class="profile_header">Cod poștal</div>
        <div class="text_profile"><?php echo $var7; ?></div>
      </div>
      <hr class="hr_profile"/>

      <!--Adresa-->
      <div class="profile_item">
        <div class="profile_header">Adresa</div>
        <div class="text_profile"><?php echo $var8; ?></div>
      </div>

      <!--Butoane de actualizare profil, schimbare parola si deconectare-->
      <hr class="style-eight"/>
      <div class="col-md-6 offset-md-2">
      <a class="buton btn-success" href="cos.php"><i class="fa fa-shopping-basket"></i> Cos cumpărături</a>
      <a class="buton btn-warning" href="control/logout_control.php"><i class="fa fa-sign-out"></i> Deconectare</a>
    </div>
      </div>
    </div>
  </div>
<!--includem footerul-->
<?php include('fisiereDeAdaugat/footer.php');?>
