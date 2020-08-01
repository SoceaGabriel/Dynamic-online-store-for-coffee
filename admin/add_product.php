<?php
//include header information and top bar
include "./templates/top.php";

//include navigation bar
include "./templates/menu.php";
?>

<!--Partea principala a panoului de control-->
<section class="main-content">
  <div class="page-name">
    <p>Adăugare Produs</p>
    <p class="path-link"><a href="dashboard.php">Home</a> <i class="fa fa-chevron-right"></i> <a href="products.php"> Produse </a> <i class="fa fa-chevron-right"></i> Adăugare Produs</p>
  </div>

  <div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title">
      <h2>Adăugați un produs nou</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <!--Continut - campurile din formular pentru un anumit produs-->
    <div class="x_content">
        <form method="get" action="control/add_product_control.php">
            <!--Nume cafea-->
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="nume_cafea">Nume cafea <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="nume_cafea" name="nume_cafea" required="required" class="form-control">
              </div>
            </div>

            <!--Pret-->
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="pret">Preț <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="pret" name="pret" required="required" class="form-control">
              </div>
            </div>

            <!--Cantitate-->
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="cantitate">Cantitate <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="cantitate" name="cantitate" required="required" class="form-control ">
              </div>
            </div>
            <!--Nr paduri-->
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="nr_paduri">Număr paduri</label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="nr_paduri" name="nr_paduri" required="required" class="form-control">
              </div>
            </div>
            <!--Nr capsule-->
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="nr_capsule">Număr capsule</label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="nr_capsule" name="nr_capsule" required="required" class="form-control ">
              </div>
            </div>
            <!--Nr bucati curente-->
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="nr_buc_crt">Număr bucăți curente <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="nr_buc_crt" name="nr_buc_crt" required="required" class="form-control ">
              </div>
            </div>

            <!--Nr bucati vandute-->
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="nr_buc_vnd">Număr bucăți vândute <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="nr_buc_vnd" name="nr_buc_vnd" required="required" class="form-control ">
              </div>
            </div>

            <!--Promotie-->
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 label-align">Promoție <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6">
                <select class="form-control" id="promotie" name="promotie">
                  <option>yes</option>
                  <option>no</option>
                </select>
              </div>
            </div>

            <!--Pret promotie-->
            <!--Se calculeaza intr-o procedura-->

            <!--Procentaj reducere-->
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="procentaj_reducere">Procentaj promoție </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="procentaj_reducere" name="procentaj_reducere" required="required" class="form-control ">
              </div>
            </div>

            <!--Tip cafea-->
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 label-align">Tip de cafea <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6">
                <select class="form-control" id="tip_cafea" name="tip_cafea">
                  <option>cafea_boabe</option>
                  <option>cafea_capsule</option>
                  <option>cafea_instant</option>
                  <option>cafea_macinata</option>
                  <option>cafea_paduri</option>
                </select>
              </div>
            </div>

            <!--Grad de prajire-->
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 label-align">Grad de prajire <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6">
                <select class="form-control" id="grad_prajire" name="grad_prajire">
                  <option>intens</option>
                  <option>mediu</option>
                  <option>mediu-intens</option>
                  <option>slab</option>
                  <option>slab-mediu</option>
                </select>
              </div>
            </div>

            <!---Data actualizare-->
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="data_ad">Data adăugare <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 ">
                <input type="date" name="data_ad" id="data_ad" required="required" class="form-control">
              </div>
            </div>

            <!--Descrierea cafelei-->
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 label-align">Descriere</label>
              <div class="col-md-6 col-sm-6 ">
                <textarea class="form-control" rows="12" placeholder="Descriere..." id="descriere" name="descriere"></textarea>
              </div>
            </div>

            <!--Selectare fotografii-->
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 label-align">Selectează o fotografie</label>
              <div class="col-md-6 col-sm-6 ">
                <input type="file" id="upload[]" name="upload[]" required="required" class="form-control " multiple>
              </div>
          </div>

            <!--Linie orizontală și butoane-->
            <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6  offset-md-5">
                  <a href="products.php" class="btn btn-primary">Înapoi</a>
                  <button type="submit" id="sbm" name="sbm" class="btn btn-success">Adaugă produs</button>
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
