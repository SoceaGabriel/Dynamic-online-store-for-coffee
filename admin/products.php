<?php
//include header information and top bar
include "./templates/top.php";

//include navigation bar
include "./templates/menu.php";
?>

<!--Partea principala a panoului de control-->
<section class="main-content">
  <div class="page-name">
    <p>Produse</p>
    <p class="path-link"><a href="dashboard.php">Home</a> <i class="fa fa-chevron-right"></i> Produse</p>
  </div>

  <div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title">
      <h2>Stocul de produse din toate categoriile</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <!--Tabelul de produse-->
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          <div class="card-box table-responsive">
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead class="header-table-prod">
                <tr>
                  <th>Cod produs</th>
                  <th>Nume</th>
                  <th>Tip cafea</th>
                  <th>Grad prăjire</th>
                  <th>Preț</th>
                  <th>Cantitate</th>
                  <th>Bucăți curente</th>
                  <th>Bucăți vândute</th>
                  <th>Promoție</th>
                  <th>Preț promoție</th>
                  <th>Dată actualizare</th>
                  <th>Modificare</th>
                  <th>Ștergere</th>
                </tr>
              </thead>


              <tbody>
                <?php
                //afisarea produselor in tabel
                $cursor = oci_new_cursor($c);
                $query = 'begin produse_func.select_produse( :crsr); end;';
                $parse = oci_parse($c,$query);
                oci_bind_by_name($parse, ":crsr", $cursor, -1, OCI_B_CURSOR);
                oci_execute($parse);
                oci_execute($cursor);
                while(oci_fetch($cursor))
                {
                  echo "<tr>";
                  echo "<td>".oci_result($cursor,'COD_PRODUS')."</td>";
                  echo "<td>".oci_result($cursor,'NUME_CAFEA')."</td>";
                  echo "<td>".oci_result($cursor,'TIP_CAFEA')."</td>";
                  echo "<td>".oci_result($cursor,'GRAD_DE_PRAJIRE')."</td>";
                  echo "<td>".oci_result($cursor,'PRET')."</td>";
                  echo "<td>".oci_result($cursor,'CANTITATE')."</td>";
                  echo "<td>".oci_result($cursor,'NR_BUC_CURENTE')."</td>";
                  echo "<td>".oci_result($cursor,'NR_BUCATI_VANDUTE')."</td>";
                  echo "<td>".oci_result($cursor,'PROCENTAJ_REDUCERE')."</td>";
                  echo "<td>".oci_result($cursor,'PRET_PROMOTIE')."</td>";
                  echo "<td>".oci_result($cursor,'DATA_ACTUALIZARE')."</td>";
                  echo "<td><form method='POST' action='modify_product.php'>
                              <input type='hidden' id='modify-hidden' name='modify-hidden' value='".oci_result($cursor,'COD_PRODUS')."'/>
                              <input type='submit' id='mod' name='mod' class='btn btn-info' style='font-size:16px; color:white;' title='Modificare' aria-hidden='true' value='Modificare&#9998;'/>
                            </form></td>";
                  echo "<td><form method='POST' action='control\delete_product_control.php'>
                              <input type='hidden' id='delete_hidden' name='delete_hidden' value='".oci_result($cursor,'COD_PRODUS')."'/>
                              <input type='submit' id='del' name='del' class='btn btn-danger' style='font-size:16px; color:white;' title='Ștergere' aria-hidden='true' value='Delete&#10007;'/>
                            </form></td>";
                  echo "</tr>";
                }
                oci_free_statement($cursor);
                ?>
              </tbody>
            </table>
            <?php
              //afisare nr de produse
              $query_total = 'begin produse_func.total_produse(:tot); end;';
              $parse_total = oci_parse($c, $query_total);
              oci_bind_by_name($parse_total, ":tot", $total_prd);
              oci_execute($parse_total);

              if($total_prd>0)
              {
                //daca exista produse
                echo "<span class='text-green'>S-au găsit ".$total_prd." produse in baza de date.</span>";
              }
              else
              {
                //daca nu exista produse
                echo "<span class='text-red'>Ne pare rău, nu s-au gasit produse în baza de date!</span>";
              }
            ?>
            <!--Text afisat in urma stergerii unui produs !!! Nu se recomanda-->
            <div id="text-delete"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!--Actualizare stocuri-->
  <div class="col-md-12 col-sm-12" id="actualizare_stocuri">
  <div class="x_panel">
    <div class="x_title">
      <h2>Actualizare stoc pentru un produs</h2>
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
              <!--Cod produs-->
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="cod_pr_input">Introduceți codul produsului <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="cod_pr_input" name="cod_pr_input" required="required" class="form-control">
                </div>
              </div>

              <!--Cantitate-->
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="cant_input">Introduceți cantitatea pe care o adăugați la cea existentă <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="cant_input" name="cant_input" required="required" class="form-control">
                </div>
              </div>

              <!--Noua data de actualizare-->
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="data_mod_stoc">Dată nouă de actualizare <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="date" name="data_mod_stoc" id="data_mod_stoc" class="form-control">
                </div>
              </div>

              <!--Buton de submit-->
              <input class="btn btn-primary" id="act_cant" name="act_cant" type="submit" value="Modifică cantitate" /><br/>
            </form>
            <?php
              //daca este apasat butonul de actualizare stocuri
              if(isset($_POST['act_cant']))
              {
                //verificam daca sunt introduse valori in cele 2 input-uri: if-else
                if(!empty($_POST['cod_pr_input']) && !empty($_POST['cant_input']))
                {
                  $cod_prod = $_POST['cod_pr_input'];
                  $cantitat = $_POST['cant_input'];
                  $new_date = $_POST['data_mod_stoc'];

                  $query_cod = 'select cod_produs, DATA_ACTUALIZARE from produse where cod_produs = '.$cod_prod;
                  $parse_cod = oci_parse($c,$query_cod);
                  oci_execute($parse_cod);
                  if(oci_fetch($parse_cod))
                  {
                    //se stocheaza codul produsului in variabila php
                    $cod_exist = oci_result($parse_cod, 'COD_PRODUS');
                    $old_data = oci_result($parse_cod, 'DATA_ACTUALIZARE');
                  }
                  else {
                    //codul nu exista
                    $cod_exist="";
                  }
                  //se verifica daca data introdusa nu este mai mica decat data deja existenta si nu este mai mare decat data curenta
                  $n_d = date('d-M-Y',strtotime($new_date));
                  $query_dta_2 = 'begin PRODUSE_FUNC.VERIFICARE_DATA_MOD_PROD(:data_old, :data_new, :resu_2); end;';
                  $parse_dta_2 = oci_parse($c, $query_dta_2);
                  oci_bind_by_name($parse_dta_2, ":data_old", $old_data);
                  oci_bind_by_name($parse_dta_2, ":data_new", $n_d);
                  oci_bind_by_name($parse_dta_2, ":resu_2", $resu_2);
                  oci_execute($parse_dta_2);

                  //conditiile pentru actualizarea stocului
                  if($cod_exist != "" && $resu_2==1)
                  {
                    //daca exista codul se actualizeaza stocul
                    $query_actual = 'begin produse_func.actualizare_stoc(:canti, :cod_ccc); end;';
                    $parse_actual = oci_parse($c,$query_actual);
                    oci_bind_by_name($parse_actual,":canti", $cantitat);
                    oci_bind_by_name($parse_actual,":cod_ccc", $cod_prod);;
                    oci_execute($parse_actual);

                    //daca exista codul se actualizeaza si data
                    $query_data = 'begin produse_func.update_data_actualizare(:dat, :codus); end;';
                    $parse_data = oci_parse($c,$query_data);
                    oci_bind_by_name($parse_data, ":dat", $n_d);
                    oci_bind_by_name($parse_data, ":codus", $cod_prod);
                    oci_execute($parse_data);

                    echo "<span class='text-green-left'>S-a modificat cantitatea!</span>";
                  }
                  else
                  {
                    if($cod_exist == "")
                    {
                      //nu exista produsul
                      echo "<span class='text-red-left'>Produsul cu codul introdus nu exista in baza de date!</span>";
                    }
                    else if($resu_2==0)
                    {
                      //data introdusa este mai mica decat data deja existenta sau este mai mare decat data curenta
                      echo "<span class='text-red-left'>Data introdusă este mai mică decât data deja existentă sau este mai mare decât data curentă!</span>";
                    }
                  }
                }
                else {
                  //nu s-a completat formularul
                  echo "<span class='text-red'>Nu ați introdus codul produsului sau cantitatea.</span>";
                }
              }
            ?>
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
