<?php
  //includem baza de date
  include "../../database.php";

  //stergerea unui produs
  if (isset($_POST['del'])){
    extract($_POST);
    $query_delete = 'begin produse_func.delete_row_cod_produs(:cod_pr); end;';
    $parse_delete = oci_parse($c,$query_delete);
    $var_aux = $delete_hidden;
    oci_bind_by_name($parse_delete, ":cod_pr", $var_aux);
    oci_execute($parse_delete);
    //redirectionare catre pagina de produse
    header('Location: ../products.php');
  }
?>
