<?php
  session_start();
  include "fisiereDeAdaugat/header.php";
  if(isset($_POST["butonul"]))
  {
      $nume = $_POST['f_nume'];
      $prenume = $_POST['f_prenume'];
      $email = $_POST['f_email'];
      $telefon = $_POST['f_telefon'];
      $localitate = $_POST['f_localitate'];
      $judet = $_POST['f_judet'];
      $cod_postal = $_POST['f_codPostal'];
      $adresa = $_POST['f_adresa'];
      $cod_user = $_SESSION['user_id'];

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

      $user_id=$_SESSION['user_id'];
      //inseram comanda
      $query_insert = "begin COM_CRT_FUNC.INSERT_COMANDA('$user_id'); end;";
      $parse_insert = oci_parse($c,$query_insert);
      oci_execute($parse_insert);

  }
?>
  <div style="height:100vh;width:100%;text-align:center;padding:10%;font-size:50px;" >Comanda a fost plasata cu succes!</div>
<?php
  include "fisiereDeAdaugat/footer_min.php";
?>
