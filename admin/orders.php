<?php
//include header information and top bar
include "./templates/top.php";

//include navigation bar
include "./templates/menu.php";
?>

<!--Partea principala a panoului de control-->
<section class="main-content">
  <div class="page-name">
    <p>Comenzi</p>
    <p class="path-link"><a href="dashboard.php">Home</a> <i class="fa fa-chevron-right"></i> Comenzi</p>
  </div>

  <div class="col-md-12 col-sm-12" id="comenzi">
  <div class="x_panel">
    <div class="x_title">
      <h2>Comenzile curente plasate</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
      </ul>
      <div class="clearfix"></div>
    </div>

    <!--Tabelul cu comenzi-->
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          <div class="card-box table-responsive">
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead class="header-table-orders">
                <tr>
                  <th>ID Comandă</th>
                  <th>ID Utilizator</th>
                  <th>Nume și prenume client</th>
                  <th>Status Comandă</th>
                  <th>Data efectuării comenzii</th>
                  <th>Număr produse comandate</th>
                  <th>Detalii comandă</th>
                </tr>
              </thead>


              <tbody>
                <?php
                //afisarea produselor in tabel
                $cursor_comenzi = oci_new_cursor($c);
                $query_comenzi = 'begin com_crt_func.select_comenzi( :crsr); end;';
                $parse_comenzi = oci_parse($c,$query_comenzi);
                oci_bind_by_name($parse_comenzi, ":crsr", $cursor_comenzi, -1, OCI_B_CURSOR);
                oci_execute($parse_comenzi);
                oci_execute($cursor_comenzi);
                while(oci_fetch($cursor_comenzi))
                {
                  echo "<tr>";
                  echo "<td>".oci_result($cursor_comenzi,'ID_COMANDA')."</td>";
                  echo "<td>".oci_result($cursor_comenzi,'ID_USER')."</td>";
                  //afisare nume utilizator
                  $query_name = 'select nume, prenume from utilizatori where id_user ='.oci_result($cursor_comenzi,'ID_USER');
                  $parse_name = oci_parse($c,$query_name);
                  oci_execute($parse_name);
                  if(oci_fetch($parse_name))
                  {
                    echo "<td>".oci_result($parse_name,'PRENUME')." ".oci_result($parse_name,'NUME')."</td>";
                  }
                  echo "<td>".oci_result($cursor_comenzi,'STATUS_COMANDA')."</td>";
                  echo "<td>".oci_result($cursor_comenzi,'DATA_FORMATATA')."</td>";
                  echo "<td>".oci_result($cursor_comenzi,'NR_PRODUSE')."</td>";
                  echo "<td><form method='POST' action='order_details.php'>
                              <input type='hidden' id='id_com_hidden' name='id_com_hidden' value='".oci_result($cursor_comenzi,'ID_COMANDA')."'/>
                              <input type='submit' id='detalii_com' name='detalii_com' class='btn' style='font-size:18px; color:white; background-color: #eb77ff;' title='detalii_button' aria-hidden='true' value='Vezi detalii&#10149;'/>
                            </form></td>";
                  echo "</tr>";
                }
                oci_free_statement($cursor_comenzi);
                ?>
              </tbody>
            </table>
            <?php
              //afisare nr de produse
              $query_total = 'select count(*) as "NR_TOTAL" from comenzi_curente';
              $parse_total = oci_parse($c, $query_total);
              oci_execute($parse_total);
              if(oci_fetch($parse_total))
              {
                if(oci_result($parse_total,'NR_TOTAL')>0)
                {
                  //daca sunt comenzi
                  echo "<span class='text-green'>Sunt ".oci_result($parse_total,'NR_TOTAL')." comenzi noi plasate.</span>";
                }
                else
                {
                  //daca nu sunt comezi
                  echo "<span class='text-red'>Nu sunt comenzi noi!</span>";
                }
              }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Modificare status pentru o comandă-->
<div class="col-md-12 col-sm-12" id="status_c">
<div class="x_panel">
  <div class="x_title">
    <h2>Modificare status pentru o comandă</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <div class="row">
      <div class="col-sm-12">
          <form method="POST" style="text-align:center;">
            <!--ID-ul comenzii-->
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="id_cmd">Introduceți ID-ul comenzii <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="id_cmd" name="id_cmd" required="required" class="form-control">
              </div>
            </div>

            <!--Status comandă-->
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 label-align">Status comandă <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6">
                <select class="form-control" id="status_cmd" name="status_cmd" style="margin-bottom:50px; color:#17a2b8;">
                  <option value="comanda_neprocesata" style="color:#dc3545;" <?php //if($tip_cafea=='cafea_boabe') echo "selected='selected'"; ?> >comanda_neprocesata</option>
                  <option value="procesare_comanda" style="color:#20c997;"<?php //if($tip_cafea=='cafea_capsule') echo "selected='selected'"; ?> >procesare_comanda</option>
                  <option value="trimisa_la_curier" style="color:#ffc107;"<?php //if($tip_cafea=='cafea_instant') echo "selected='selected'"; ?> >trimisa_la_curier</option>
                  <option value="in_curs_de_livrare" style="color:#e83e8c;"<?php //if($tip_cafea=='cafea_macinata') echo "selected='selected'"; ?> >in_curs_de_livrare</option>
                  <option value="comanda_finalizata" style="color:#007bff;"<?php //if($tip_cafea=='cafea_paduri') echo "selected='selected'"; ?> >comanda_finalizata</option>
                </select>
              </div>
            </div>
            <!--Buton de submit-->
            <input class="btn btn-primary" id="change_status" name="change_status" type="submit" value="Schimbă status" /><br/>
          </form>
          <?php
            //daca este apasat butonul de modifica status
            if(isset($_POST['change_status']))
            {
              //verificam daca sunt introduse valori in cele 2 input-uri: if-else
              if(!empty($_POST['id_cmd']) && !empty($_POST['status_cmd']))
              {
                //daca da, se trec in variabile php
                $id_com = $_POST['id_cmd'];
                $stat = $_POST['status_cmd'];

                $query_cod = 'select id_comanda from comenzi_curente where id_comanda = '.$id_com;
                $parse_cod = oci_parse($c,$query_cod);
                oci_execute($parse_cod);
                if(oci_fetch($parse_cod))
                {
                  //daca exista codul
                  $cod_exist = oci_result($parse_cod, 'ID_COMANDA');
                }
                else {
                  //daca nu exista codul
                  $cod_exist="";
                }
                if($cod_exist != "")
                {
                  //daca exista codul se sterge comanda si se adauga in istoric comenzi
                  $query_status = 'begin com_crt_func.update_status_comanda(:status, :id_comanda); end;';
                  $parse_status = oci_parse($c,$query_status);
                  oci_bind_by_name($parse_status, ":status", $stat);
                  oci_bind_by_name($parse_status, ":id_comanda", $id_com);
                  oci_execute($parse_status);
                  //STERGERE COMANDA DACA STATUSUL ESTE COMANDA FINALIZATA
                  $query_final = 'begin com_crt_func.status_comanda_finalizata(:status, :id_comanda, :idddd); end;';
                  $parse_final = oci_parse($c,$query_final);
                  oci_bind_by_name($parse_final, ":status", $stat);
                  oci_bind_by_name($parse_final, ":id_comanda", $id_com);
                  oci_bind_by_name($parse_final, ":idddd", $_SESSION['admin_id']);
                  oci_execute($parse_final);

                  //daca statusul a devenit comanda finalizata se afiseaza mesaj dupa stergere
                  if($stat == "comanda_finalizata")
                  {
                    echo "<span class='text-green'>Comanda s-a finalizat cu succes</span>";
                  }
                  else
                  {
                    echo "<span class='text-green'>S-a actualizat statusul!</span>";
                  }
                }
                else
                {
                  echo "<span class='text-red'>Comanda cu ID-ul introdus nu exista in baza de date!</span>";
                }
              }
              else {
                echo "<span class='text-red'>Nu ați introdus ID-ul comenzii!</span>";
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
