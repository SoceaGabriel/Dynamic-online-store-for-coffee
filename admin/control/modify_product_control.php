<?php
  //includem baza de date
  include "../../database.php";
  //codul pentru bagarea datelor modificate in baza de date
  if(isset($_GET['subm']))
  {
    //extragem valorile din formular
    extract($_GET);

    $query_old_d = 'select DATA_ACTUALIZARE from produse where cod_produs = '.$cod_prod;
    $parse_old_d = oci_parse($c,$query_old_d);
    oci_execute($parse_old_d);
    if(oci_fetch($parse_old_d))
    {
      //se stocheaza codul produsului in variabila php
      $old_d = oci_result($parse_old_d, 'DATA_ACTUALIZARE');
    }

    $n_d = date('d-M-Y',strtotime($data_ad));
    $query_dta_1 = 'begin PRODUSE_FUNC.VERIFICARE_DATA_MOD_PROD(:data_old, :data_new, :resu_1); end;';
    $parse_dta_1 = oci_parse($c, $query_dta_1);
    oci_bind_by_name($parse_dta_1, ":data_old", $old_d);
    oci_bind_by_name($parse_dta_1, ":data_new", $n_d);
    oci_bind_by_name($parse_dta_1, ":resu_1", $resu_1);
    oci_execute($parse_dta_1);

    if($resu_1 == 1)
    {
      //actualizare numele cafelei
      if(isset($nume_cafea))
      {
        $query_num = 'begin produse_func.update_nume_cafea(:num, :codus); end;';
        $parse_num = oci_parse($c,$query_num);
        oci_bind_by_name($parse_num, ":num", $nume_cafea);
        oci_bind_by_name($parse_num, ":codus", $cod_prod);
        oci_execute($parse_num);
      }
      //actualizare pret
      if(isset($pret))
      {
        $query_pret = 'begin produse_func.update_pret(:pre, :codus); end;';
        $parse_pret = oci_parse($c,$query_pret);
        oci_bind_by_name($parse_pret, ":pre", $pret);
        oci_bind_by_name($parse_pret, ":codus", $cod_prod);
        oci_execute($parse_pret);
      }
      //actualizare cantitate
      if(isset($cantitate))
      {
        $query_cant = 'begin produse_func.update_cantitate(:cant, :codus); end;';
        $parse_cant = oci_parse($c,$query_cant);
        oci_bind_by_name($parse_cant, ":cant", $cantitate);
        oci_bind_by_name($parse_cant, ":codus", $cod_prod);
        oci_execute($parse_cant);
      }
      //actualizare nr_paduri
      if(isset($nr_paduri))
      {
        $query_pad = 'begin produse_func.update_nr_paduri(:pad, :codus); end;';
        $parse_pad = oci_parse($c,$query_pad);
        oci_bind_by_name($parse_pad, ":pad", $nr_paduri);
        oci_bind_by_name($parse_pad, ":codus", $cod_prod);
        oci_execute($parse_pad);
      }
      //actualizare nr_capsule
      if(isset($nr_capsule))
      {
        $query_caps = 'begin produse_func.update_nr_capsule(:caps, :codus); end;';
        $parse_caps = oci_parse($c,$query_caps);
        oci_bind_by_name($parse_caps, ":caps", $nr_capsule);
        oci_bind_by_name($parse_caps, ":codus", $cod_prod);
        oci_execute($parse_caps);
      }
      //actualizare nr bucati curente
      if(isset($nr_buc_crt))
      {
        $query_crt = 'begin produse_func.update_nr_buc_curente(:buc_crt, :codus); end;';
        $parse_crt = oci_parse($c,$query_crt);
        oci_bind_by_name($parse_crt, ":buc_crt", $nr_buc_crt);
        oci_bind_by_name($parse_crt, ":codus", $cod_prod);
        oci_execute($parse_crt);
      }
      //actualizare procentaj reducere
      if(isset($procentaj_reducere))
      {
        $query_proc = 'begin produse_func.update_procentaj_reducere(:proc, :codus); end;';
        $parse_proc = oci_parse($c,$query_proc);
        oci_bind_by_name($parse_proc, ":proc", $procentaj_reducere);
        oci_bind_by_name($parse_proc, ":codus", $cod_prod);
        oci_execute($parse_proc);
      }
      //actualizare promotie
      if(isset($promotie))
      {
        $query_prom = 'begin produse_func.update_promotie(:prom, :codus); end;';
        $parse_prom = oci_parse($c,$query_prom);
        oci_bind_by_name($parse_prom, ":prom", $promotie);
        oci_bind_by_name($parse_prom, ":codus", $cod_prod);
        oci_execute($parse_prom);
      }
      //actualizare tip de cafea
      if(isset($tip_cafea))
      {
        $query_tip = 'begin produse_func.update_tip_cafea(:tip, :codus); end;';
        $parse_tip = oci_parse($c,$query_tip);
        oci_bind_by_name($parse_tip, ":tip", $tip_cafea);
        oci_bind_by_name($parse_tip, ":codus", $cod_prod);
        oci_execute($parse_tip);
      }
      //actualizare grad de prajire
      if(isset($grad_prajire))
      {
        $query_grad = 'begin produse_func.update_grad_prajire(:grad, :codus); end;';
        $parse_grad = oci_parse($c,$query_grad);
        oci_bind_by_name($parse_grad, ":grad", $grad_prajire);
        oci_bind_by_name($parse_grad, ":codus", $cod_prod);
        oci_execute($parse_grad);
      }
      //actualizare descriere
      if(isset($descriere))
      {
        $query_desc = 'begin produse_func.update_desc_prod(:desc, :codus); end;';
        $parse_desc = oci_parse($c,$query_desc);
        oci_bind_by_name($parse_desc, ":desc", $descriere);
        oci_bind_by_name($parse_desc, ":codus", $cod_prod);
        oci_execute($parse_desc);
      }

      if(isset($data_ad))
      {
        $query_data = 'begin produse_func.update_data_actualizare(:dat, :codus); end;';
        $parse_data = oci_parse($c,$query_data);
        $n_d = date('d-M-Y',strtotime($data_ad));
        oci_bind_by_name($parse_data, ":dat", $n_d);
        oci_bind_by_name($parse_data, ":codus", $cod_prod);
        oci_execute($parse_data);
      }

      //redirectionare catre pagina de produse
      //echo $n_d."<br/>";
      header('Location: ../products.php');
    }
    else
    {
      echo "Data pe care ați introdus-o ori este mai veche de cât data deja existentă ori este din viitor și nu ne dorim acest lucru!";
    }
  }

?>
