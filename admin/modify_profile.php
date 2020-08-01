<?php
//include header information and top bar
include "./templates/top.php";

//include navigation bar
include "./templates/menu.php";
?>

<!--Partea principala a panoului de control-->
<section class="main-content">
  <div class="page-name">
    <p>Profilul meu</p>
    <p class="path-link"><a href="dashboard.php">Home</a> <i class="fa fa-chevron-right"></i><a href="profile.php"> Profilul meu </a><i class="fa fa-chevron-right"></i> Actualizare profil</p>
  </div>

  <div class="all-profile">

    <?php
    //setam variabilele php ale profilului din baza de date pentru modificarea lor
    $id_adm = $_SESSION['admin_id'];
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
    <!--Chenar cu poza si numele adminului-->
    <div class="profile-section">
      <div class="card">
      <img class="card-img-top" src="../images/logo/avatar.png" alt="Card image" style="width:100%">
      <div class="card-body">
        <h4 class="card-title"><?php echo $var1." ".$var2; ?></h4>
        <h6 class="card-text">Rang utilizator: Admin</h6>
      </div>
    </div>
    </div>
    <div class="info-profile">
      <form method="POST" action="control/modify_profile_control.php">
        <!--Nume-->
        <div class="item form-group">
          <div class="profile_header">Nume</div>
          <div class="col-md-8 col-sm-8 ">
            <input type="text" id="nume_ad" name="nume_ad" required="required" class="form-control" value="<?php echo $var2; ?>">
          </div>
        </div>
        <hr class="hr_profile"/>

        <!--Prenume-->
        <div class="item form-group">
          <div class="profile_header">Prenume</div>
          <div class="col-md-8 col-sm-8 ">
            <input type="text" id="prenume_ad" name="prenume_ad" required="required" class="form-control" value="<?php echo $var1; ?>">
          </div>
        </div>
        <hr class="hr_profile"/>

        <!--Email-->
        <div class="item form-group">
          <div class="profile_header">Email</div>
          <div class="col-md-8 col-sm-8 ">
            <input type="text" id="email_ad" name="email_ad" required="required" class="form-control" value="<?php echo $var4; ?>">
          </div>
        </div>
        <hr class="hr_profile"/>

        <!--Telefon-->
        <div class="item form-group">
          <div class="profile_header">Telefon</div>
          <div class="col-md-8 col-sm-8 ">
            <input type="text" id="telefon_ad" name="telefon_ad" required="required" class="form-control" value="0<?php echo $var3; ?>">
          </div>
        </div>
        <hr class="hr_profile"/>

        <!--Localitate-->
        <div class="item form-group">
          <div class="profile_header">Localitate</div>
          <div class="col-md-8 col-sm-8 ">
            <input type="text" id="localitate_ad" name="localitate_ad" required="required" class="form-control" value="<?php echo $var5; ?>">
          </div>
        </div>
        <hr class="hr_profile"/>

        <!--Judet-->
        <div class="item form-group">
          <div class="profile_header">Județ</div>
          <div class="col-md-8 col-sm-8 ">
            <input type="text" id="judet_ad" name="judet_ad" required="required" class="form-control" value="<?php echo $var6; ?>">
          </div>
        </div>
        <hr class="hr_profile"/>

        <!--Cod postal-->
        <div class="item form-group">
          <div class="profile_header">Cod Postal</div>
          <div class="col-md-8 col-sm-8 ">
            <input type="text" id="cod_postal_ad" name="cod_postal_ad" required="required" class="form-control" value="<?php echo $var7; ?>">
          </div>
        </div>
        <hr class="hr_profile"/>

        <!--Adresa-->
        <div class="item form-group">
          <div class="profile_header">Adresa</div>
          <div class="col-md-8 col-sm-8 ">
            <input type="text" id="adresa_ad" name="adresa_ad" required="required" class="form-control" value="<?php echo $var8; ?>">
          </div>
        </div>

        <!--Butoane de actualizare profil, schimbare parola si deconectare-->
        <hr class="style-eight"/>
          <div class="form-group">
            <div class="col-md-12 col-sm-12" style="padding-bottom:30px;text-align: center;padding-top:20px;">

        <!--Actualizare informatii-->
        <button type="submit" id="actualizeaza" name="actualizeaza" class="btn btn-success" value="<?php echo $_SESSION['admin_id']; ?>">Actualizează</button>
      </form>
            <!--Schimbare parola-->
            <a href="profile.php" class="btn btn-info">Înapoi la profil</a>

          </div>
        </div>
    </div>
  </div>

  <!--Schimbare parola-->
  <div class="schimba_parola" id="actualizare_parola">
  <div class="x_panel">
    <div class="x_title">
      <h2>Schimbați parola curentă cu una nouă</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          <!--Formular pentru a adauga cele 3 parole-->
            <form method="post" style="text-align:center;">
              <!--Parola veche-->
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="parola_veche">Introduceți parola veche <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="password" id="parola_veche" name="parola_veche" required="required" class="form-control">
                </div>
              </div>

              <!--Parola noua - unu-->
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nueve_parola_1">Introduceți noua parolă <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="password" id="nueve_parola_1" name="nueve_parola_1" required="required" class="form-control">
                </div>
              </div>

              <!--Parola noua - doi-->
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nueve_parola_2">Reintroduceți noua parolă <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="password" id="nueve_parola_2" name="nueve_parola_2" required="required" class="form-control">
                </div>
              </div>
              <!--Buton de submit-->
              <input class="btn btn-info" id="schimb_parl" name="schimb_parl" type="submit" value="Schimbă parola" /><br/>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>


</section>

<?php
//include footer and scripts
include "./templates/footer.php";
?>
