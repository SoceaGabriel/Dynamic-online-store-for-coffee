<?php
//include header information and top bar
include "./templates/top.php";

//include navigation bar
include "./templates/menu.php";
?>

<!--Partea principala a panoului de control-->
<section class="main-content">
  <div class="page-name">
    <p>Modificare produs</p>
    <p class="path-link"><a href="dashboard.php">Home</a>  <i class="fa fa-chevron-right"></i> <a href="products.php">Produse</a> <i class="fa fa-chevron-right"></i> Modificare produs</p>
  </div>

  <!--Formularul de completare a informatiilor despre produse-->
  <div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title">
      <h2>Modificare câmp/câmpuri pentru produsul selectat</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <!--Continut - campurile din baza de date pentru un anumit produs-->
    <?php $cod = $_POST['modify-hidden']; ?>
    <div class="x_content">
      <form method="GET" action="control/modify_product_control.php">
            <?php
              //preluare cod produs din post si afisarea campurilor produsului in inputuri
              $cursor_prod = oci_new_cursor($c);
              $query_prod = 'begin produse_func.select_produs_cod(:codus, :curso); end;';
              $parse_prod = oci_parse($c,$query_prod);
              oci_bind_by_name($parse_prod, ":codus", $cod);
              oci_bind_by_name($parse_prod, ":curso", $cursor_prod, -1, OCI_B_CURSOR);
              oci_execute($parse_prod);
              oci_execute($cursor_prod);
              if(oci_fetch($cursor_prod))
              {
                //setare variabile php cu datele produsului din baza de date
                $nume_cafea = oci_result($cursor_prod, 'NUME_CAFEA');
                $tip_cafea = oci_result($cursor_prod, 'TIP_CAFEA');
                $grad_prajire= oci_result($cursor_prod, 'GRAD_DE_PRAJIRE');
                $descriere = oci_result($cursor_prod, 'DESCRIERE_PRODUS');
                $pret = oci_result($cursor_prod, 'PRET');
                $cantitate = oci_result($cursor_prod, 'CANTITATE');
                $nr_paduri = oci_result($cursor_prod, 'NR_PADURI');
                $nr_capsule = oci_result($cursor_prod, 'NR_CAPSULE');
                $nr_buc_crt = oci_result($cursor_prod, 'NR_BUC_CURENTE');
                $promotie = oci_result($cursor_prod, 'PROMOTIE');
                $procentaj_reducere = oci_result($cursor_prod, 'PROCENTAJ_REDUCERE');
                $data_act = oci_result($cursor_prod, 'DATA_ACTUALIZARE');
              }
            ?>

            <!--Nume cafea-->
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="nume_cafea">Nume cafea <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="nume_cafea" name="nume_cafea" required="required" class="form-control" value="<?php echo $nume_cafea; ?>">
              </div>
            </div>

            <!--Pret-->
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="pret">Preț <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="pret" name="pret" required="required" class="form-control" value="<?php echo htmlspecialchars($pret); ?>">
              </div>
            </div>

            <!--Cantitate-->
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="cantitate">Cantitate <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="cantitate" name="cantitate" required="required" class="form-control" value="<?php echo htmlspecialchars($cantitate); ?>">
              </div>
            </div>
            <!--Nr paduri-->
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="nr_paduri">Număr paduri</label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="nr_paduri" name="nr_paduri" required="required" class="form-control" value="<?php echo htmlspecialchars($nr_paduri); ?>">
              </div>
            </div>
            <!--Nr capsule-->
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="nr_capsule">Număr capsule</label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="nr_capsule" name="nr_capsule" required="required" class="form-control" value="<?php echo htmlspecialchars($nr_capsule); ?>">
              </div>
            </div>
            <!--Nr bucati curente-->
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="nr_buc_crt">Număr bucăți curente <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="nr_buc_crt" name="nr_buc_crt" required="required" class="form-control" value="<?php echo htmlspecialchars($nr_buc_crt); ?>">
              </div>
            </div>
            <!--Promotie-->
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 label-align">Promoție <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6">
                <select class="form-control" id="promotie" name="promotie">
                  <option value="yes" <?php if($promotie=='yes') echo "selected='selected'"; ?> >yes</option>
                  <option value="no" <?php if($promotie=='no') echo "selected='selected'"; ?> >no</option>
                </select>
              </div>
            </div>

            <!--Pret promotie - nu se afiseaza - se calculeaza automat-->

            <!--Procentaj reducere-->
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="procentaj_reducere">Procentaj promoție </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="procentaj_reducere" name="procentaj_reducere" required="required" class="form-control" value="<?php echo htmlspecialchars($procentaj_reducere); ?>">
              </div>
            </div>

            <!--Tip cafea-->
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 label-align">Tip de cafea <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6">
                <select class="form-control" id="tip_cafea" name="tip_cafea">
                  <option value="cafea_boabe" <?php if($tip_cafea=='cafea_boabe') echo "selected='selected'"; ?> >cafea_boabe</option>
                  <option value="cafea_capsule" <?php if($tip_cafea=='cafea_capsule') echo "selected='selected'"; ?> >cafea_capsule</option>
                  <option value="cafea_instant" <?php if($tip_cafea=='cafea_instant') echo "selected='selected'"; ?> >cafea_instant</option>
                  <option value="cafea_macinata" <?php if($tip_cafea=='cafea_macinata') echo "selected='selected'"; ?> >cafea_macinata</option>
                  <option value="cafea_paduri" <?php if($tip_cafea=='cafea_paduri') echo "selected='selected'"; ?> >cafea_paduri</option>
                </select>
              </div>
            </div>
            <!--Grad de prajire-->
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 label-align">Grad de prajire <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6">
                <select class="form-control" id="grad_prajire" name="grad_prajire">
                  <option value="intens" <?php if($grad_prajire=='intens') echo "selected='selected'"; ?> >intens</option>
                  <option value="mediu" <?php if($grad_prajire=='mediu') echo "selected='selected'"; ?> >mediu</option>
                  <option value="mediu-intens" <?php if($grad_prajire=='mediu-intens') echo "selected='selected'"; ?> >mediu-intens</option>
                  <option value="slab" <?php if($grad_prajire=='slab') echo "selected='selected'"; ?> >slab</option>
                  <option value="slab-mediu" <?php if($grad_prajire=='slab-mediu') echo "selected='selected'"; ?> >slab-mediu</option>
                </select>
              </div>
            </div>
            <!--Vechea data de actualizare-->
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="data_old">Vechea dată</label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" readonly="readonly" value="<?php echo $data_act; ?>" class="form-control">
              </div>
            </div>
            <!--Noua data de actualizare-->
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="data_ad">Dată nouă de actualizare </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="date" name="data_ad" id="data_ad" class="form-control">
              </div>
            </div>

            <!--Descrierea cafelei-->
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 label-align">Descriere</label>
              <div class="col-md-6 col-sm-6 ">
                <textarea class="form-control" rows="10" id="descriere" name="descriere"><?php echo $descriere; ?></textarea>
              </div>
            </div>

            <!--Linie orizontală și butoane-->
            <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6  offset-md-5">
                  <a href="products.php" class="btn btn-primary">Înapoi</a>
                  <?php
                    $variable_cod = $cod;
                  ?>
                  <input type="hidden" id="cod_prod" name="cod_prod" value="<?php echo $variable_cod; ?>">
                  <button type="submit" id="subm" name="subm" class="btn btn-success">Modifică</button>
                </div>
              </div>
            </form>

          </div>
        </div>
  </div>

</section>

<?php
//include footer and scripts
include "./templates/footer.php";
?>
