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
    <p class="path-link"><a href="dashboard.php">Home</a> <i class="fa fa-chevron-right"></i> Profilul meu</p>
  </div>

  <div class="all-profile">

    <?php
    //se salveaza datele utilizatorului din baza de date in variabile php
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

    <!--chenar cu poza, nume, rang-->
    <div class="profile-section">
      <div class="card">
      <img class="card-img-top" src="../images/logo/avatar.png" alt="Card image" style="width:100%">
      <div class="card-body">
        <h4 class="card-title"><?php echo $var2." ".$var1; ?></h4>
        <h6 class="card-text">Rang utilizator: Admin</h6>
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
        <div class="form-group" >
          <div class="col-md-12 col-sm-12" style="padding-bottom:30px; text-align:center; padding-top:20px; display:inline;">
            <!--Actualizare informatii-->
            <form method="POST" action="modify_profile.php">
              <button type="submit" id="actualizare_info" name="actualizare_info" class="btn btn-success" value="<?php echo $_SESSION['admin_id']; ?>">Actualizare informații</button>
            </form>

            <!--Schimbare parola-->
            <a href="profile.php#actualizare_parola" class="btn btn-info" onclick="show_change_pass()">Schimbă parola</a>

            <!--Deconectare-->
            <form method="POST" action="control/logout_control.php">
              <button type="submit" id="deconectare" name="deconectare" class="btn btn-primary">Deconectare</button>
            </form>
          </div>
        </div>

        <!--Schimbare parola-->
        <?php
          //daca este apasat butonul de actualizare stocuri
          if(isset($_POST['schimb_parl']))
          {
            //verificam daca sunt introduse valori in campuri
            if(!empty($_POST['parola_veche']))
            {
              //selectam parola veche
              $id_user = $_SESSION['admin_id'];
              $cursor_passw = oci_new_cursor($c);
              $query_passw = 'begin utilizatori_func.select_admin_profile(:adm,:id_adm); end;';
              $parse_passw = oci_parse($c,$query_passw);
              oci_bind_by_name($parse_passw, ":adm", $cursor_passw, -1, OCI_B_CURSOR);
              oci_bind_by_name($parse_passw, ":id_adm", $id_user);
              oci_execute($parse_passw);
              oci_execute($cursor_passw);
              if(oci_fetch($cursor_passw))
              {
                $old_passw = oci_result($cursor_passw, 'PAROLA');
              }
              oci_free_statement($cursor_passw);

              //verificam daca parola veche introdusa e cea din baza de date
              if($_POST['parola_veche'] == $old_passw)
              {//daca parola veche introdusa e cea din baza de date
                if($_POST['nueve_parola_1'] == $_POST['nueve_parola_2'])
                {
                  //echo $_POST['parola_veche']."<br/>";
                  //echo $_POST['nueve_parola_1']."<br/>";
                  //echo $_POST['nueve_parola_2']."<br/>";
                  //daca parola noua si cea reintrodusa corespund
                  $query_passw_new = 'begin utilizatori_func.update_parola(:pass,:id_adm); end;';
                  $parse_passw_new = oci_parse($c,$query_passw_new);
                  oci_bind_by_name($parse_passw_new, ":pass", $_POST['nueve_parola_1']);
                  oci_bind_by_name($parse_passw_new, ":id_adm", $id_user);
                  oci_execute($parse_passw_new);
                  $committed = oci_commit($c);
                  echo "<span class='text-green'>Parola a fost schimbata cu succes!</span>";
                }
                else
                {
                  //daca parola noua si cea reintrodusa NU corespund
                    echo "<span class='text-red'>Parola reintrodusă nu corespunde!</span>";
                }
              }
              else
              {
                //daca parola veche introdusa NU e cea din baza de date
                echo "<span class='text-red'>Parola veche e greșită!</span>";
              }
            }
            else {
              //daca nu sunt introduse parolele
              echo "<span class='text-red'>Nu ați introdus parolele!</span>";
            }
          }
        ?>

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
