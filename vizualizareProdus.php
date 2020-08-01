<?php
    include "fisiereDeAdaugat/header.php";
?>
 <p><br/></p>
 <p><br/></p>
 <p><br/></p>
 <p><br/></p>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-2" >
           <div >
             <?php
             $idProdus=$_POST["id"];
             $cursor_pa = oci_new_cursor($c);
             $query_pa = 'begin PATH_IMG_FUNC.SELECT_PATH(:id ,:cmp); end;';
             $parse_pa = oci_parse($c,$query_pa);
             oci_bind_by_name($parse_pa, ":cmp", $cursor_pa, -1, OCI_B_CURSOR);
             oci_bind_by_name($parse_pa, ":id", $idProdus);
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
             ?>
                <img style="width:100%;max-width:300px;margin-top:90px;" alt="<?php echo $p_image_alt; ?>" title="<?php echo $p_image_title; ?>" src="imagini/produse/<?php echo $p_imagine;?>" />
            </div>
        </div>
        <div class="col-md-7">
            <div class="row">
                <?php
                    $cursor_cump = oci_new_cursor($c);
                    $query_cump = "begin produse_func.select_produs_cod($idProdus,:cmp); end;";
                    $parse_cump = oci_parse($c,$query_cump);
                    oci_bind_by_name($parse_cump, ":cmp", $cursor_cump, -1, OCI_B_CURSOR);
                    oci_execute($parse_cump);
                    oci_execute($cursor_cump);
                    oci_fetch($cursor_cump);
                    echo "<div style='margin-left:10%;font-size:30px;margin-bottom:30px;'>".oci_result($cursor_cump,'NUME_CAFEA')."</div>";
                ?>
                <div class="col-md-6">
                <?php
                    echo "<div style='font-size:20px;'><b>Tipul de cafea: </b>".oci_result($cursor_cump,'TIP_CAFEA')."<p></p></div>";
                    echo "<div style='font-size:20px;'><b>Gradul de prajire: </b>".oci_result($cursor_cump,'GRAD_DE_PRAJIRE')."<p></p></div>";
                    echo "<div style='font-size:20px;'><b>Cantitate: </b>".oci_result($cursor_cump,'CANTITATE')." g<p></p></div>";
                    $reducere=oci_result($cursor_cump,'PROMOTIE');
                    $a='no';
                    if($reducere===$a)
                    {
                        echo "<div style='font-size:20px;color:red;text-align:center;'>Produsul nu se afla la promotie momentan!</div>";
                        echo "<div style='font-size:40px;color:#b30059;text-align:center;'><b>Pret: </b>".oci_result($cursor_cump,'PRET')." LEI</div>";
                    }
                    else {
                        echo "<div style='font-size:20px;color:green;text-align:center;'>Produsul este la promotie si are o reducere de :".oci_result($cursor_cump,'PROCENTAJ_REDUCERE')."%.</div>";
                        echo "<div style='font-size:40px;color:#b30059;text-align:center;'><b>Pret Redus: </b>".oci_result($cursor_cump,'PRET_PROMOTIE')." LEI</div>";
                    }
                    echo "<div style='margin-top:10px;'><b>Descrierea Produsului: </b>" .oci_result($cursor_cump,'DESCRIERE_PRODUS')."</div>";

                    echo "<div style='margin-top:10px;'><a class='btn btn-info' href='index.php'>Înapoi la produse</a>
                          <form action='control/add_to_cart.php' method='POST' style='display:inline'>
                            <input type='hidden' id='ddd' name='ddd' value='$idProdus'>
                            <button class='btn btn-success' type='submit'><i class='fa fa-shopping-cart'></i> Adaugă în coș</button></div>
                          </form>";

                          /*
                          //adaugare produs in cos
                          if(isset($_SESSION['user_id']) && isset($_POST['ddd']))
                          {
                            //avem un client conectat
                            //inseram produsul in cosul de cumparaturi cu nr de bucati implicit 1

                            extract($_POST);

                            $id_adm = $_SESSION['user_id'];
                            $nr_buc = 1;
                            $query_ad = 'begin COS_FUNC.INSERT_COS_ALL(:nr_buc, :id_adm, :cod_prod); end;';
                            $parse_ad = oci_parse($c,$query_ad);
                            oci_bind_by_name($parse_ad, ":nr_buc", $nr_buc);
                            oci_bind_by_name($parse_ad, ":id_adm", $id_adm);
                            oci_bind_by_name($parse_ad, ":cod_prod", $ddd);
                            oci_execute($parse_ad);
                            echo "MESAJ_1!";
                            //redirectionam spre pagina principala a site-ului
                            //header("location:../index.php");
                          }
                          */
                    oci_free_statement($cursor_cump);
                ?>
                </div>
                <div class="col-md-6">
                    <div style='font-size:20px;color:blue;margin-left:10px;'>Comenzi Telefonice:</div>
                    <div style='font-size:20px;color:red; margin-left:50px; margin-top:10px;'>0744223305</div>
                    <div style='font-size:20px;color:red; margin-left:50px; margin-top:10px;'>0744123405</div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
<?php include('fisiereDeAdaugat/footer_min.php')?>
