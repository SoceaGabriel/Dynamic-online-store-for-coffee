<?php
//include header information and top bar
include "./templates/top.php";

//include navigation bar
include "./templates/menu.php";
?>

<!--Partea principala a panoului de control-->
<section class="main-content">
  <div class="page-name">
    <p>Home page - Dashboard</p>
  </div>

  <!--Dashboard-->
  <div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title">
      <h2>Panoul de control</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
          <!--Calendar-->
          <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <form>
              <select onChange="updatecalendar(this.options)">
              <script src="js/basic_calendar.js" type="text/javascript"></script>
              </select>

              <!--Write calendar-->
              <div id="calendarspace">
              <script type="text/javascript">
                //write out current month's calendar to start
                document.write(buildCal(curmonth, curyear, "main", "month", "daysofweek", "days", 0))
              </script>
              </div>
            </form>
          </div>

          <!--Profilul adminului-->
          <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <div class="widget_tally_box">
                        <div class="x_panel">
                          <div class="x_content">

                            <div class="flex">
                              <ul class="list-inline widget_profile_box">
                                <li>
                                  <a href="#">
                                    <i class="fa fa-facebook"></i>
                                  </a>
                                </li>
                                <li>
                                  <img src="../images/logo/user_icon_100.png" alt="..." class="img-circle profile_img">
                                </li>
                                <li>
                                  <a href="#">
                                    <i class="fa fa-twitter"></i>
                                  </a>
                                </li>
                              </ul>
                            </div>

                            <h3 class="name"><a href="profile.php"><?php echo $_SESSION['admin_name']." ".$_SESSION['admin_prenume']; ?></a></h3>

                            <?php
                              $query_nr_com = 'select telefon, nr_comenzi from utilizatori where id_user = '. $_SESSION['admin_id'];
                              $parse_nr_com = oci_parse($c,$query_nr_com);
                              oci_execute($parse_nr_com);
                              while(oci_fetch($parse_nr_com))
                              {
                                $tel = oci_result($parse_nr_com, 'TELEFON');
                                $nr_com = oci_result($parse_nr_com, 'NR_COMENZI');
                              }
                            ?>
                            <div class="flex">
                              <ul class="list-inline count2">
                                <li>
                                  <h4>Administrator</h4>
                                  <span>Rol</span>
                                </li>
                                <li>
                                  <h4>0<?php echo $tel; ?></h4>
                                  <span>Telefon</span>
                                </li>
                                <li>
                                  <h4><?php echo $nr_com; ?></h4>
                                  <span>Nr. comenzi procesate</span>
                                </li>
                              </ul>
                            </div>
                            <b style="color:#9c9c2a;"><q>
                              Pentru a avea succes trebuie sa gasesti ceva de care sa te agati, ceva care sa te motiveze, care sa te inspire.
                            </q></b>
                          </div>
                        </div>
                      </div>
          </div>

          <div class="col-md-12">
            <div class="row">
              <!--Nr de comenzi de procesat-->
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">

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
                      $var_com = "<span class='text-green'>Sunt ".oci_result($parse_total,'NR_TOTAL')." comenzi noi plasate.</span>";
                    }
                    else
                    {
                      //daca nu sunt comezi
                      $var_com = "<span class='text-red'>Nu sunt comenzi noi!</span>";
                    }
                  }
                ?>

                <div class="info-box orange-bg">
                  <i class="fa  fa-truck"></i>
                  <div class="count"><?php echo $var_com; ?></div>
                  <div class="title">Numărul de comenzi nefinalizate</div>
                </div>
              </div>

              <!--Top 5 utilizatori-->
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div class="info-box lime-bg">
                  <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead class="orange-bg">
                        <div class="title">Top clienți după numărul de comenzi</div>
                        <tr>
                          <th>Nr curent</th>
                          <th>Nume client</th>
                          <th>Numar comenzi</th>
                        </tr>
                      </thead>


                      <tbody>
                        <?php
                        //AFISARE TOT 5 CLIENTI DUPA NR COMENZI
                        $cursor_ad = oci_new_cursor($c);
                        $query_ad = 'begin utilizatori_func.SELECT_TOP_CUSTOMERS(:adm); end;';
                        $parse_ad = oci_parse($c,$query_ad);
                        oci_bind_by_name($parse_ad, ":adm", $cursor_ad, -1, OCI_B_CURSOR);
                        oci_execute($parse_ad);
                        oci_execute($cursor_ad);
                        $i=1;
                        while(oci_fetch($cursor_ad))
                        {
                          echo "<tr>";
                          echo "<td>".$i."</td>";
                          echo "<td>".oci_result($cursor_ad,'PRENUME')." ".oci_result($cursor_ad,'NUME')."</td>";
                          echo "<td>".oci_result($cursor_ad,'NR_COMENZI')."</td>";
                          echo "</tr>";
                          $i=$i+1;
                        }
                        oci_free_statement($cursor_ad);
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--Textarea-->
          <div class="col-md-12">
            <div class="row">
          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <br/>
            <form name="savefile" method="post" action="">
              <div class="container">
              <div class="form-group">
                <label for="textdata">Scrie o notiță rapidă:</label>
                <textarea class="form-control" rows="8" id="comment" name="textdata" id="textdata" value=""></textarea>
              </div>
            </div>
              <input class="btn btn-info" type="submit" name="submitsave" value="Salvează notița într-un fișier">
              <input class="btn btn-success" type="submit" name="submitopen" value="Citiți notița din fișier">
            </form>
          </div>
          <?php
          $fisierul='text_from_textarea';
          if (isset($_POST['submitsave']) || isset($_POST['submitopen'])){

              //salvarea notitei intr-un fisier
              if (isset($_POST['submitsave'])) {
                  $file = fopen($fisierul.".txt","a+");
                  $old="";
                  while(!feof($file)){
                      $old = $old . fgets($file). "\n";
                  }
                  $text = $_POST["textdata"];
                  file_put_contents($fisierul . ".txt", $text);
                  fclose($file);
              }

              //citirea notitei din fisier
              $var_text="";
              if (isset($_POST['submitopen'])) {
                  $fileeee = fopen($fisierul . ".txt", "r");
                  while(!feof($fileeee)){
                      $var_text = $var_text.fgets($fileeee).'<br />';
                  }
                  echo '<div class=\'col-md-12 col-lg-12 col-sm-12 col-xs-12\'><div class=\'well\'>'.$var_text.'</div></div></div></div>';
                  fclose($fileeee);
              }
          }
          ?>
      </div>
    </div>
  </div>
</section>

<?php
//include footer and scripts
include "./templates/footer.php";
?>
