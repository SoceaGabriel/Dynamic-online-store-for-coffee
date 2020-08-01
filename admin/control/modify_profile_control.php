<?php

  //includem baza de date
  include "../../database.php";

  //pornim sesiunea
  session_start();

  //codul pentru adaugarea datelor modificate in baza de date
  if(isset($_POST['actualizeaza']))
  {
    //extragem valorile din formular
    $nume = $_POST['nume_ad'];
    $prenume = $_POST['prenume_ad'];
    $email = $_POST['email_ad'];
    $telefon = $_POST['telefon_ad'];
    $localitate = $_POST['localitate_ad'];
    $judet = $_POST['judet_ad'];
    $cod_postal = $_POST['cod_postal_ad'];
    $adresa = $_POST['adresa_ad'];
    $cod_user = $_SESSION['admin_id'];

    //apelam procedura de update
    $query_update_all = 'begin utilizatori_func.update_all_profile(:num, :prenum, :tel, :eml, :local, :jud, :cod_pst, :adr, :id_usr); end;';
    $parse_update_all = oci_parse($c,$query_update_all);
    oci_bind_by_name($parse_update_all, ":num", $nume);
    oci_bind_by_name($parse_update_all, ":prenum", $prenume);
    oci_bind_by_name($parse_update_all, ":tel", $telefon);
    oci_bind_by_name($parse_update_all, ":eml", $email);
    oci_bind_by_name($parse_update_all, ":local", $localitate);
    oci_bind_by_name($parse_update_all, ":jud", $judet);
    oci_bind_by_name($parse_update_all, ":cod_pst", $cod_postal);
    oci_bind_by_name($parse_update_all, ":adr", $adresa);
    oci_bind_by_name($parse_update_all, ":id_usr", $cod_user);
    oci_execute($parse_update_all);
    $committed = oci_commit($c);
    //resetam variabilele de sesiune care retin numele si prenumele modificate ale administratorului
    $_SESSION['admin_name'] = $prenume;
    $_SESSION['admin_prenume'] = $nume;
    //redirectionare catre pagina de produse
    header('Location: ../profile.php');

  }

?>
