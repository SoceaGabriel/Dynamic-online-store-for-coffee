<?php

  //includem headerul
  //include "./templates/top.php";

  //pornim sesiunea
  session_start();

  //daca se apasa pe butonul de deconectare
  //if(isset($_POST['deconectare']))
  //{
    //stergem variabilele de sesiune
    unset($_SESSION['user_name']);
    unset($_SESSION['user_prenume']);
    unset($_SESSION['user_id']);

    //distrugem sesiunea
  	session_destroy();

    //redirectionam spre pagina de login
  	header("location:../index.php");
  //}

?>
