<?php
session_start();
//$ip_add=getenv("REMOTE_ADDR");
include("database.php");

//Afisez produsele pe pagina principala
if(isset($_POST["getProduct"]))
{
    $cursor_cump = oci_new_cursor($c);
    $query_cump = 'begin produse_func.select_produse(:cmp); end;';
    $parse_cump = oci_parse($c,$query_cump);
    oci_bind_by_name($parse_cump, ":cmp", $cursor_cump, -1, OCI_B_CURSOR);
    oci_execute($parse_cump);
    oci_execute($cursor_cump);
     while(oci_fetch($cursor_cump)){
            $p_id = oci_result($cursor_cump,'COD_PRODUS');
            $p_cat = oci_result($cursor_cump,'TIP_CAFEA');
            $p_title = oci_result($cursor_cump,'NUME_CAFEA');
            $p_pret = oci_result($cursor_cump,'PRET');
            $p_promotie = oci_result($cursor_cump,'PROMOTIE');
            $p_pret_prom = oci_result($cursor_cump,'PRET_PROMOTIE');

            //cautam imaginea corespunzatoare produsului respectiv
            $cursor_path = oci_new_cursor($c);
            $query_path = 'begin PATH_IMG_FUNC.SELECT_PATH(:id ,:cmp); end;';
            $parse_path = oci_parse($c,$query_path);
            oci_bind_by_name($parse_path, ":cmp", $cursor_path, -1, OCI_B_CURSOR);
            oci_bind_by_name($parse_path, ":id", $p_id);
            oci_execute($parse_path);
            oci_execute($cursor_path);
             if(oci_fetch($cursor_path))
             {
               $p_imagine = oci_result($cursor_path,'PATH');
               $p_image_alt = oci_result($cursor_path,'ALT');
               $p_image_title = oci_result($cursor_path,'TITLE');
             }
             else {
               $p_imagine = "lavazza-super-crea.jpg";
               $p_image_alt= "";
               $p_image_title = "";
             }
             oci_free_statement($cursor_path);

            echo "<div class='col-md-4'>
                    <div class='panel panel-info'>
                        <div class='panel-heading' style='height:50px; font-family: Baskervville; font-weight:bold;text-align:center;'>$p_title</div>
                        <div class='panel-body'>
                            <img alt='$p_image_alt' title='$p_image_title' src='imagini/produse/$p_imagine' style='width:auto; height:250px;'/>
                        </div>
                        <div class='panel-heading'>Categorie: ".$p_cat." <br/>";
                        if($p_promotie == "yes")
                        {
                          echo "<strike>".$p_pret."</strike> ".$p_pret_prom." lei";
                        }
                        else {
                          echo $p_pret_prom." lei";
                        }

                        echo "<form action='control/add_to_cart.php' method='POST' style='display:inline;'>
                              <input type='hidden' id='ddd' name='ddd' value='$p_id'>
                              <button pid='$p_id' style='float:right; margin-left:10px;'
                              type='submit' id='product_cos' class='btn btn-success btn-xs'>Adauga in cos</button></form>
                              <form action='vizualizareProdus.php' method='POST' style='display:inline'>
                                <input type='hidden' name='id' value='$p_id'>
                                <button pid='$p_id' style='float:right;' id='detalii' class='btn btn-info btn-xs'>Vezi detalii</button>
                              </form>
                            </div>
                          </div>
                        </div>";
    }
}
//afisez cafaua in functie de pret
if(isset($_POST["selecteazaCafeauaDupaPret"]))
{
    $sel=$_POST["modalitateOrdonare"];//aici am gradul de prajire
    $cursor_cump = oci_new_cursor($c);
    if($sel=='pret_cresc')
    {
        $query_cump = "begin produse_func.SELECT_crescator(:cmp); end;";
    }
    if($sel=='pret_desc')
    {
        $query_cump = "begin produse_func.SELECT_descrescator(:cmp); end;";
    }
    if($sel=='pret_redus')
    {
        $query_cump = "begin produse_func.SELECT_Promotie(:cmp); end;";
    }

    $parse_cump = oci_parse($c,$query_cump);
    oci_bind_by_name($parse_cump, ':cmp', $cursor_cump, -1, OCI_B_CURSOR);
    oci_execute($parse_cump);
    oci_execute($cursor_cump);
    while(oci_fetch($cursor_cump)){
            $p_id = oci_result($cursor_cump,'COD_PRODUS');
            $p_cat = oci_result($cursor_cump,'TIP_CAFEA');
            $p_title = oci_result($cursor_cump,'NUME_CAFEA');
            $p_pret = oci_result($cursor_cump,'PRET');
            $p_promotie = oci_result($cursor_cump,'PROMOTIE');
            $p_pret_prom = oci_result($cursor_cump,'PRET_PROMOTIE');

            //cautam imaginea corespunzatoare produsului respectiv
            $cursor_pa = oci_new_cursor($c);
            $query_pa = 'begin PATH_IMG_FUNC.SELECT_PATH(:id ,:cmp); end;';
            $parse_pa = oci_parse($c,$query_pa);
            oci_bind_by_name($parse_pa, ":cmp", $cursor_pa, -1, OCI_B_CURSOR);
            oci_bind_by_name($parse_pa, ":id", $p_id);
            oci_execute($parse_pa);
            oci_execute($cursor_pa);
             if(oci_fetch($cursor_pa))
             {
               $p_imagine = oci_result($cursor_pa,'PATH');
               $p_image_alt = oci_result($cursor_pa,'ALT');
               $p_image_title = oci_result($cursor_pa,'TITLE');
             }
             else {
               $p_imagine = "lavazza-super-crema.jpg";
               $p_image_alt= "";
               $p_image_title = "";
             }
             oci_free_statement($cursor_pa);

             echo"   <form action='vizualizareProdus.php' method='POST'>
             <div class='col-md-4'>
             <div class='panel panel-info'>
                 <div class='panel-heading' style='height:50px; font-family: Baskervville; font-weight:bold;text-align:center;'>$p_title</div>
                 <div class='panel-body'>
                     <img src='imagini/produse/$p_imagine' style='width:auto; height:250px;'/>
                 </div>
                 <div class='panel-heading'>Categorie:".$p_cat."<br/>";
                 if($p_promotie == "yes")
                 {
                   echo "<strike>".$p_pret."</strike> ".$p_pret_prom." lei";
                 }
                 else {
                   echo $p_pret_prom." lei";
                 }

                 echo" <input type='hidden' name='id' value='$p_id'>
                     <button pid='$p_id' style='float:right; margin-left:10px;' id='product' class='btn btn-success btn-xs'>Adauga in cos</button>
                     <button style='float:right;' class='btn btn-info btn-xs' type='submit'>Vezi detalii</button>

                 </div>
             </div>
         </div>
         </form>";
    }
}
if(isset($_POST["selecteazaCafeauaDupaTip"]))
{
    $sel=$_POST["selecteazaTip"];//aici am gradul de prajire
    $cursor_cump = oci_new_cursor($c);
    $query_cump = "begin produse_func.SELECT_TIP_DE_CAFEA('$sel',:cmp); end;";
    $parse_cump = oci_parse($c,$query_cump);
    oci_bind_by_name($parse_cump, ':cmp', $cursor_cump, -1, OCI_B_CURSOR);
    oci_execute($parse_cump);
    oci_execute($cursor_cump);
    while(oci_fetch($cursor_cump)){
            $p_id = oci_result($cursor_cump,'COD_PRODUS');
            $p_cat = oci_result($cursor_cump,'TIP_CAFEA');
            $p_title = oci_result($cursor_cump,'NUME_CAFEA');
            $p_pret = oci_result($cursor_cump,'PRET');
            $p_promotie = oci_result($cursor_cump,'PROMOTIE');
            $p_pret_prom = oci_result($cursor_cump,'PRET_PROMOTIE');

            //cautam imaginea corespunzatoare produsului respectiv
            $cursor_pa = oci_new_cursor($c);
            $query_pa = 'begin PATH_IMG_FUNC.SELECT_PATH(:id ,:cmp); end;';
            $parse_pa = oci_parse($c,$query_pa);
            oci_bind_by_name($parse_pa, ":cmp", $cursor_pa, -1, OCI_B_CURSOR);
            oci_bind_by_name($parse_pa, ":id", $p_id);
            oci_execute($parse_pa);
            oci_execute($cursor_pa);
             if(oci_fetch($cursor_pa))
             {
               $p_imagine = oci_result($cursor_pa,'PATH');
               $p_image_alt = oci_result($cursor_pa,'ALT');
               $p_image_title = oci_result($cursor_pa,'TITLE');
             }
             else {
               $p_imagine = "lavazza-super-crema.jpg";
               $p_image_alt= "";
               $p_image_title = "";
             }
             oci_free_statement($cursor_pa);

            echo"   <form action='vizualizareProdus.php' method='POST'>
                    <div class='col-md-4'>
                    <div class='panel panel-info'>
                        <div class='panel-heading' style='height:50px; font-family: Baskervville; font-weight:bold;text-align:center;'>$p_title</div>
                        <div class='panel-body'>
                            <img src='imagini/produse/$p_imagine' style='width:auto; height:250px;'/>
                        </div>
                        <div class='panel-heading'>Categorie:".$p_cat."<br/>";
                        if($p_promotie == "yes")
                        {
                          echo "<strike>".$p_pret."</strike> ".$p_pret_prom." lei";
                        }
                        else {
                          echo $p_pret_prom." lei";
                        }

                        echo" <input type='hidden' name='id' value='$p_id'>
                            <button pid='$p_id' style='float:right; margin-left:10px;' id='product' class='btn btn-success btn-xs'>Adauga in cos</button>
                            <button style='float:right;' class='btn btn-info btn-xs' type='submit'>Vezi detalii</button>

                        </div>
                    </div>
                </div>
                </form>";
    }
}

//afisam produsele pe baza de selectie ----dupa gradul de prajire

if(isset($_POST["selecteazaCafeaua"]))
{
    $sel=$_POST["selecteaza"];//aici am gradul de prajire
    $cursor_cump = oci_new_cursor($c);
    $query_cump = "begin produse_func.SELECT_PE_GRAD_DE_PRAJIRE('$sel',:cmp); end;";
    $parse_cump = oci_parse($c,$query_cump);
    oci_bind_by_name($parse_cump, ':cmp', $cursor_cump, -1, OCI_B_CURSOR);
    oci_execute($parse_cump);
    oci_execute($cursor_cump);
    while(oci_fetch($cursor_cump)){
            $p_id = oci_result($cursor_cump,'COD_PRODUS');
            $p_cat = oci_result($cursor_cump,'TIP_CAFEA');
            $p_title = oci_result($cursor_cump,'NUME_CAFEA');
            $p_pret = oci_result($cursor_cump,'PRET');
            $p_promotie = oci_result($cursor_cump,'PROMOTIE');
            $p_pret_prom = oci_result($cursor_cump,'PRET_PROMOTIE');

            //cautam imaginea corespunzatoare produsului respectiv
            $cursor_patt = oci_new_cursor($c);
            $query_patt = 'begin PATH_IMG_FUNC.SELECT_PATH(:id ,:cmp); end;';
            $parse_patt = oci_parse($c,$query_patt);
            oci_bind_by_name($parse_patt, ":cmp", $cursor_patt, -1, OCI_B_CURSOR);
            oci_bind_by_name($parse_patt, ":id", $p_id);
            oci_execute($parse_patt);
            oci_execute($cursor_patt);
             if(oci_fetch($cursor_patt))
             {
               $p_imagine = oci_result($cursor_patt,'PATH');
               $p_image_alt = oci_result($cursor_patt,'ALT');
               $p_image_title = oci_result($cursor_patt,'TITLE');
             }
             else {
               $p_imagine = "lavazza-super-crema.jpg";
               $p_image_alt= "";
               $p_image_title = "";
             }
             oci_free_statement($cursor_patt);

            echo"   <form action='vizualizareProdus.php' method='POST'>
                    <div class='col-md-4'>
                    <div class='panel panel-info'>
                        <div class='panel-heading' style='height:50px; font-family: Baskervville; font-weight:bold;text-align:center;'>$p_title</div>
                        <div class='panel-body'>
                            <img src='imagini/produse/$p_imagine' style='width:auto; height:250px;'/>
                        </div>
                        <div class='panel-heading'>Categorie:".$p_cat."<br/>";
                        if($p_promotie == "yes")
                        {
                          echo "<strike>".$p_pret."</strike> ".$p_pret_prom." lei";
                        }
                        else {
                          echo $p_pret_prom." lei";
                        }

                        echo" <input type='hidden' name='id' value='$p_id'>
                            <button pid='$p_id' style='float:right; margin-left:10px;' id='product' class='btn btn-success btn-xs'>Adauga in cos</button>
                            <button style='float:right;' class='btn btn-info btn-xs' type='submit'>Vezi detalii</button>

                        </div>
                    </div>
                </div>
                </form>";
    }
}

//afisez produsele in cosul de cumparaturi
if(isset($_POST["checkOutDetalils"]))
{
    $cursor_cump = oci_new_cursor($c);
    $user_id=$_SESSION['user_id'];
    $query_cump = "begin cos_func.select_produs_cos($user_id,:cmp); end;";
    $parse_cump = oci_parse($c,$query_cump);
    oci_bind_by_name($parse_cump, ":cmp", $cursor_cump, -1, OCI_B_CURSOR);
    oci_execute($parse_cump);
    oci_execute($cursor_cump);
    while(oci_fetch($cursor_cump)){
        $cantitate = oci_result($cursor_cump,'NR_BUC');
        $p_id=oci_result($cursor_cump,'NR_CURENT');
        $id_Produs = oci_result($cursor_cump,'PRODUSE_COD_PRODUS');

            $cur = oci_new_cursor($c);
            $query_cum = "begin produse_func.select_produs_cod($id_Produs,:cmp); end;";
            $parse_cum = oci_parse($c,$query_cum);
            oci_bind_by_name($parse_cum, ":cmp", $cur, -1, OCI_B_CURSOR);
            oci_execute($parse_cum);
            oci_execute($cur);
            oci_fetch($cur);
            $promotie=oci_result($cur,'PROMOTIE');
            if($promotie=='yes')
            {
                $p_pret=oci_result($cur,'PRET_PROMOTIE');
            }
            else{
                $p_pret=oci_result($cur,'PRET');
            }
            $p_nume=oci_result($cur,'NUME_CAFEA');
            $pret_total=$p_pret * $cantitate;

            //cautam imaginea corespunzatoare produsului respectiv
            $cursor_pat = oci_new_cursor($c);
            $query_pat = 'begin PATH_IMG_FUNC.SELECT_PATH(:id ,:cmp); end;';
            $parse_pat = oci_parse($c,$query_pat);
            oci_bind_by_name($parse_pat, ":cmp", $cursor_pat, -1, OCI_B_CURSOR);
            oci_bind_by_name($parse_pat, ":id", $id_Produs);
            oci_execute($parse_pat);
            oci_execute($cursor_pat);
             if(oci_fetch($cursor_pat))
             {
               $p_imagine = oci_result($cursor_pat,'PATH');
               $p_image_alt = oci_result($cursor_pat,'ALT');
               $p_image_title = oci_result($cursor_pat,'TITLE');
             }
             else {
               $p_imagine = "lavazza-super-crema.jpg";
               $p_image_alt= "";
               $p_image_title = "";
             }
             oci_free_statement($cursor_pat);

        echo'
            <div class="row">
                <div class="col-md-2">
                    <div class="btn-group">
                        <a href="#" remove_id="'.$id_Produs.'" class="btn btn-danger remove"><span class="fa fa-trash-o"></span></a>
                        <a href="#" update_id="'.$p_id.'" class="btn btn-primary update"><span class="fa fa-check"></span></a>
                    </div>
                </div>

                <div class="col-md-2"><img class="img-responsive" style="max-height:100px;" src="imagini/produse/'.$p_imagine.'"></div>
                <div class="col-md-2">'.$p_nume.'</div>
                <div class="col-md-2"><input type="text" class="form-control cantitate" value="'.$cantitate.'" ></div>
                <div class="col-md-2"><input type="text" class="form-control pret" value="'.$p_pret.'" readonly="readonly"></div>
                <div class="col-md-2"><input type="text" class="form-control total" value="'.$pret_total.'" readonly="readonly"></div>
            </div>';
        oci_free_statement($cur);
    }
        echo "<div style='text-align:right'><a href='plaseazaComanda.php' class='btn btn-success' style='margin-right:20px;margin-bottom:20px;'>Plaseaza o comanda!</a><div>";


}
//afisez produsele in cosul de cumparaturi plasare comanda
if(isset($_POST["verificaPlasareComanda"]))
{
    $cursor_cump = oci_new_cursor($c);
    $user_id=$_SESSION['user_id'];
    $query_cump = "begin cos_func.select_produs_cos($user_id,:cmp); end;";
    $parse_cump = oci_parse($c,$query_cump);
    oci_bind_by_name($parse_cump, ":cmp", $cursor_cump, -1, OCI_B_CURSOR);
    oci_execute($parse_cump);
    oci_execute($cursor_cump);
    $suma_totala_de_plata=0;
    while(oci_fetch($cursor_cump)){
        $cantitate = oci_result($cursor_cump,'NR_BUC');
        $p_id=oci_result($cursor_cump,'NR_CURENT');
        $id_Produs = oci_result($cursor_cump,'PRODUSE_COD_PRODUS');

            $cur = oci_new_cursor($c);
            $query_cum = "begin produse_func.select_produs_cod($id_Produs,:cmp); end;";
            $parse_cum = oci_parse($c,$query_cum);
            oci_bind_by_name($parse_cum, ":cmp", $cur, -1, OCI_B_CURSOR);
            oci_execute($parse_cum);
            oci_execute($cur);
            oci_fetch($cur);
            $promotie=oci_result($cur,'PROMOTIE');
            if($promotie=='yes')
            {
                $p_pret=oci_result($cur,'PRET_PROMOTIE');
            }
            else{
                $p_pret=oci_result($cur,'PRET');
            }
            $p_nume=oci_result($cur,'NUME_CAFEA');
            $pret_total=$p_pret * $cantitate;

            $suma_totala_de_plata+=$pret_total;
            //cautam imaginea corespunzatoare produsului respectiv
            $cursor_pat = oci_new_cursor($c);
            $query_pat = 'begin PATH_IMG_FUNC.SELECT_PATH(:id ,:cmp); end;';
            $parse_pat = oci_parse($c,$query_pat);
            oci_bind_by_name($parse_pat, ":cmp", $cursor_pat, -1, OCI_B_CURSOR);
            oci_bind_by_name($parse_pat, ":id", $id_Produs);
            oci_execute($parse_pat);
            oci_execute($cursor_pat);
             if(oci_fetch($cursor_pat))
             {
               $p_imagine = oci_result($cursor_pat,'PATH');
               $p_image_alt = oci_result($cursor_pat,'ALT');
               $p_image_title = oci_result($cursor_pat,'TITLE');
             }
             else {
               $p_imagine = "lavazza-super-crema.jpg";
               $p_image_alt= "";
               $p_image_title = "";
             }
             oci_free_statement($cursor_pat);
        echo'
            <div class="row">
                <div class="col-md-3"><img class="img-responsive" style="max-height:100px;" src="imagini/produse/'.$p_imagine.'"></div>
                <div class="col-md-3">'.$p_nume.'</div>

                <div class="col-md-2"><input type="text" class="form-control cantitate" value="'.$cantitate.'" ></div>
                <div class="col-md-2"><input type="text" class="form-control pret" value="'.$p_pret.' lei" readonly="readonly"></div>
                <div class="col-md-2"><input type="text" class="form-control prte-total" value="'.$pret_total.' lei" readonly="readonly"></div>
            </div>';
        oci_free_statement($cur);
    }
    echo"
        <div style='width:100%;border-top:2px solid;'></div>
        ";

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
    echo '
    <form action="plaseazaComanda_control.php" method="POST">
        <div style="width:100%;padding-top:10px;">
            <!--nume-->
            <div class="profile_item">
                <div class="profile_header">Nume </div>
                <input type="text" name="f_nume" class="form-control cantitate" style="width:300px;margin-left:42px;margin-top:4px;" value="'.$var1.'"></div>
            </div>
            <hr class="hr_profile"/>
            <!--prenume-->
            <div class="profile_item">
                <div class="profile_header">Prenume</div>
                <input type="text" name="f_prenume" class="form-control cantitate" style="width:300px;margin-left:42px;margin-top:4px;" value="'.$var2.'"></div>
            </div>
            <hr class="hr_profile"/>

            <!--Email-->
            <div class="profile_item">
                <div class="profile_header">Email</div>
                <input type="text" name="f_email" id="f_email" class="form-control cantitate" style="width:300px;margin-left:42px;margin-top:4px;" value="'.$var4.'"></div>
            </div>
            <hr class="hr_profile"/>

            <!--Telefon-->
            <div class="profile_item">
                <div class="profile_header">Telefon</div>
                <input type="text" name="f_telefon" class="form-control cantitate" style="width:300px;margin-left:42px;margin-top:4px;" value="'.$var3.'"></div>
            </div>
            <hr class="hr_profile"/>

            <!--Localitate-->
            <div class="profile_item">
                <div class="profile_header">Localitate</div>
                <input type="text" name="f_localitate" class="form-control cantitate" style="width:300px;margin-left:42px;margin-top:4px;" value="'.$var5.'"></div>
            </div>
            <hr class="hr_profile"/>

            <!--Judet-->
            <div class="profile_item">
                <div class="profile_header">Județ</div>
                <input type="text" name="f_judet" class="form-control cantitate" style="width:300px;margin-left:42px;margin-top:4px;" value="'.$var6.'"></div>
            </div>
            <hr class="hr_profile"/>

            <!--Cod postal-->
            <div class="profile_item">
                <div class="profile_header">Cod poștal</div>
                <input type="text" name="f_codPostal" class="form-control cantitate" style="width:300px;margin-left:42px;margin-top:4px;" value="'.$var7.'"></div>
            </div>
            <hr class="hr_profile"/>

            <!--Adresa-->
            <div class="profile_item">
                <div class="profile_header">Adresa</div>
                <input type="text" name="f_adresa" class="form-control cantitate" style="width:300px;margin-left:42px;margin-top:4px;" value="'.$var8.'"></div>
            </div>
        </div>';
    echo"  <div class='row'>
            <div class='col-md-7'></div>
            <div class='col-md-2' >Suma totala de plata:<input type='text' style='lenght:100px;' class='form-control pret_total' value='".$suma_totala_de_plata." lei' readonly='readonly'></div>
            <div class='col-md-2' style='margin-top:38px;' ><button class='btn btn-success' method='submit' name='butonul' >Plaseaza o comanda!</button></div>
            <div class='col-md-1'></div>
        </div>
    </form>";

}
//adaugam produse in cos in momentul in care apasam butonul de "aduga produs"
if(isset($_POST["addtoCart"])){
    $p_id=$_POST["proId"];
    if(isset($_SESSION['user_id'])){
        $user_id=$_SESSION['user_id'];
    }
    else{
        $user_id=0;
    }
    $n_d = date('d-M-Y');
    $ip_add = getenv("REMOTE_ADDR");

    $query_insert = "begin COS_FUNC.INSERT_COS_ALL(1,'$user_id','$p_id','$n_d','$ip_add');  end;";
    $parse_insert = oci_parse($c,$query_insert);
    oci_execute($parse_insert);
    if($parse_insert){
    echo"
        <div class='alert alert-success'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <b>Produsul a fost adaugat in cos!</b>
            </div>";
    }

}


//stergem un produs din cos
if(isset($_POST["removeItemFromCart"])){
    $remove_id=$_POST["rid"];
    $id_user=$_SESSION['user_id'];
    $query_delete = "begin COS_FUNC.DELETE_ROW('$remove_id','$id_user'); end;";
    $parse_delete = oci_parse($c,$query_delete);
    if(oci_execute($parse_delete)){
        echo "<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <b>Produsul cu id: ".$remove_id." a fost sters din cosul de cumaraturi!</b>
            </div>
        ";
        exit();
    }
}
//uploadam produse din cos
if(isset($_POST["updateCartItem"])){
    $mes = "ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss";
    $update_id=$_POST["update_id"];
    $can=$_POST["cantitate"];
    $query_update = "begin COS_FUNC.UPDATE_NR_BUC('$can', '$update_id', :mesaj); end;";
    $parse_update = oci_parse($c,$query_update);

    //oci_bind_by_name($parse_update, ":can", $can);
    //oci_bind_by_name($parse_update, ":upd", $update_id);
    oci_bind_by_name($parse_update, ":mesaj", $mes);

    if(oci_execute($parse_update)){
        echo "<div class='alert alert-info'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close' aria-hidden='true'>&times;</a>
                <b>".$mes."</b>
            </div>
        ";
        exit();
    }
}
