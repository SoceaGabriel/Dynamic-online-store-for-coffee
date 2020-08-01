<?php
  //includem baza de date
  include "../database.php";

  //codul pentru bagarea datelor modificate in baza de date
  if(isset($_GET['adut'])) //daca este trimis formularul
  {
      //extragem valorile din formular
      extract($_GET);
      //apelarea procedurii de insert a unui utilizator nou
        $query_insert = 'begin utilizatori_func.insert_utilizatori_all(:prenume,:nume,:parola,\'customer\',:telefon,:email,:loc,:judet,:cod,:adresa); end;';
        $parse_insert = oci_parse($c,$query_insert);

        oci_bind_by_name($parse_insert, ":prenume", $prenume);
        oci_bind_by_name($parse_insert, ":nume", $nume);
        oci_bind_by_name($parse_insert, ":loc", $localitate);
        oci_bind_by_name($parse_insert, ":judet", $judet);
        oci_bind_by_name($parse_insert, ":cod", $codPostal);
        oci_bind_by_name($parse_insert, ":adresa", $adresa);
        oci_bind_by_name($parse_insert, ":telefon", $telefon);
        oci_bind_by_name($parse_insert, ":email", $email);
        oci_bind_by_name($parse_insert, ":parola", $parola);
        oci_execute($parse_insert);

        echo $prenume.'<br/>';
        echo $nume.'<br/>';
        echo $localitate.'<br/>';
        echo $judet.'<br/>';
        echo $codPostal.'<br/>';
        echo $adresa.'<br/>';
        echo $telefon.'<br/>';
        echo $email.'<br/>';
        echo $parola.'<br/>';

        //redirectionare catre pagina de produse
        header('Location: ../login.php');
    }
 else
  {
      //daca s-a intampinat vreo eroare
      echo "Nu s-a reusit inregistrarea!";
    }

?>
