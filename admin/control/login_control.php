<?php
//date pentru conexiune
$username = "magazin_cafea"; //username-ul de conectare la baza de date
$password = "cafea";         // parola de conectare la baza de date
$database = "localhost/XE";  // connect string-ul pentru a ne conecta la baza de date

//efectuam conexiunea
$c = oci_connect($username, $password, $database);
if (!$c) {
    $m = oci_error();
    trigger_error('Could not connect to database: '. $m['message'], E_USER_ERROR);
}

//pornim o sesiune
session_start();

//pasii de autentificare
  if(isset($_POST['login-btn']))
  {
    //extragem valorile din formular
    extract($_POST);
    if (!empty($email) && !empty($password))
    {
      //daca nu s-au trimis formulare valori nule
      //se iau datele de autentificare din baza de date specifice
      $curs = oci_new_cursor($c);
      $query = 'begin utilizatori_func.select_admin_proc(:v_email, :v_password, :cur); end;';
      $parse = oci_parse($c,$query);
      oci_bind_by_name($parse,":v_email", $email);
      oci_bind_by_name($parse,":v_password", $password);
      oci_bind_by_name($parse, ":cur", $curs, -1, OCI_B_CURSOR);
      oci_execute($parse);
      oci_execute($curs);
      if(oci_fetch($curs)){
          //se verifica daca cel care a introdus datele este administrator
          if(oci_result($curs,'RANG_USER')=='admin')
          {
            //daca da, logarea se realizeaza cu succes
            //se seteaza variabile de sesiune
            $_SESSION['admin_name'] = oci_result($curs,'PRENUME');
            $_SESSION['admin_prenume'] = oci_result($curs,'NUME');
            $_SESSION['admin_id'] = oci_result($curs,'ID_USER');
            //se inchide cursorul
            oci_free_statement($curs);
            //se redirectioneaza catre dashboard
            header('Location: ../dashboard.php');
          }
          else {
            //daca nu este admin
            echo "Nu aveti cont de utilizator!";
          }
      }else{
        //daca numele sau parola sau ambele sunt gresite
        echo "Nume sau parola incorecte!";
      }
    }
    else
    {
      //daca nu s-au introdus numeel sau parola
      echo "Nu s-au introdus numele sau/și parola !";
    }
  }
?>
