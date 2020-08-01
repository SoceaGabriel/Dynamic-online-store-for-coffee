<?php
  //includem baza de date
  include "../../database.php";

  //codul pentru bagarea datelor modificate in baza de date
  if(isset($_GET['sbm'])) //daca este trimis formularul
  {
      //extragem valorile din formular
      extract($_GET);

      //apelarea procedurii de insert a unui produs nou
      //dar mai intai verificam daca data nu este mai mare decat data curenta
      $n_d = date('d-M-Y',strtotime($data_ad));
      $query_dta = 'begin PRODUSE_FUNC.VERIFICARE_DATA_ADAUGARE_PROD(:data_a, :resu); end;';
      $parse_dta = oci_parse($c, $query_dta);
      oci_bind_by_name($parse_dta, ":data_a", $n_d);
      oci_bind_by_name($parse_dta, ":resu", $resu);
      oci_execute($parse_dta);

      if($resu == 1)
      {
        $query_insert = 'begin produse_func.insert_produse_all(:num, :tip, :grad, :descr, :pre, :cant, :nr_pad, :nr_caps, :nr_crt, :nr_vnd, :prom, :proc, :data_aaa); end;';
        $parse_insert = oci_parse($c,$query_insert);
        //$res= explode('-', $data_ad);
        //$new_date = $res[0].'/'.$res[1].'/'.$res[2];
        oci_bind_by_name($parse_insert, ":num", $nume_cafea);
        oci_bind_by_name($parse_insert, ":tip", $tip_cafea);
        oci_bind_by_name($parse_insert, ":grad", $grad_prajire);
        oci_bind_by_name($parse_insert, ":descr", $descriere);
        oci_bind_by_name($parse_insert, ":pre", $pret);
        oci_bind_by_name($parse_insert, ":cant", $cantitate);
        oci_bind_by_name($parse_insert, ":nr_pad", $nr_paduri);
        oci_bind_by_name($parse_insert, ":nr_caps", $nr_capsule);
        oci_bind_by_name($parse_insert, ":nr_crt", $nr_buc_crt);
        oci_bind_by_name($parse_insert, ":nr_vnd", $nr_buc_vnd);
        oci_bind_by_name($parse_insert, ":prom", $promotie);
        oci_bind_by_name($parse_insert, ":proc", $procentaj_reducere);
        oci_bind_by_name($parse_insert, ":data_aaa", $n_d);
        oci_execute($parse_insert);

        //aflam codul produsului tocmai inserat
        $query_cod = 'select * from produse where nume_cafea = \''.$nume_cafea.'\'';
        $parse_cod = oci_parse($c,$query_cod);
        oci_execute($parse_cod);
        if(oci_fetch($parse_cod))
        {
          $cod_pr = oci_result($parse_cod, 'COD_PRODUS');
        }

        //inserare numele imaginii/imaginilor in tabela path
        $nr=count($upload);
        for($i=0; $i<$nr; ++$i)
        {
            $query_insert_path = 'begin path_img_func.insert_path_all(:pa, :alt, :title, :cod); end;';
            $parse_insert_path = oci_parse($c,$query_insert_path);
            oci_bind_by_name($parse_insert_path, ":pa", $upload[$i]);
            oci_bind_by_name($parse_insert_path, ":alt", $nume_cafea);
            oci_bind_by_name($parse_insert_path, ":title", $nume_cafea);
            oci_bind_by_name($parse_insert_path, ":cod", $cod_pr);
            oci_execute($parse_insert_path);
        }

        //redirectionare catre pagina de produse
        header('Location: ../products.php');
      }
      else
      {
        echo "Data pe care ați adăugat-o este din viitor si nu ne dorim acest lucru!";
      }
    }
    else
    {
      //daca s-a intampinat vreo eroare
      echo "Nu s-a setat variabila!";
    }

?>
