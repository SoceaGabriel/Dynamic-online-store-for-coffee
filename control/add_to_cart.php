<?php
  //includem conexiunea cu baza de date
  include "../database.php";
  session_start();
  //extragem id-ul produsului din formularul trimis
  extract($_POST);

  //adaugare in cos de pe pagina principala
  if(isset($_SESSION['user_id']))
  {
    //avem un client conectat
    //inseram produsul in cosul de cumparaturi cu nr de bucati implicit 1
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
    header("location:../index.php");
  }
  else {
    //nu avem client conectat si adaugam in cos cu adresa ip
    //$ip_address = $_SERVER['REMOTE_USER'];
    //echo $ip_address;
    //$nr_buc = 1;
    //$id_adm = 11032;
    //$query_ad_ip = 'begin COS_FUNC.INSERT_COS_ALL_IP(:nr_buc, :id_adm, :cod_prod, :ipp); end;';
    //$parse_ad_ip = oci_parse($c,$query_ad_ip);
    //oci_bind_by_name($parse_ad_ip, ":nr_buc", $nr_buc);
    //oci_bind_by_name($parse_ad_ip, ":id_adm", $id_adm);
    //oci_bind_by_name($parse_ad_ip, ":cod_prod", $ddd);
    //oci_bind_by_name($parse_ad_ip, ":ipp", $ip_address);
    //oci_execute($parse_ad_ip);

    //redirectionam spre pagina principala a site-ului
    //header("location:../index.php");
  }

?>
