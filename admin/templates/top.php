<?php
  //facem conexiunea cu baza de date
  include "../database.php";
  //pornim sesiunea
  session_start();
  //daca administratorul nu este logat atunci este directionat spre login
  if (!isset($_SESSION['admin_id'])) {
    header("location:admin_login.php");
  }
 ?>

<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Control Panel</title>

  <!--Favicon-->
  <link rel="shortcut icon" href="../images/logo/favicon.png" />

  <!--Style for page-->
	<link href="../css/style_admin.css" rel="stylesheet">
  <!--Color Style-->
  <link href="../css/color.css" rel="stylesheet">

  <!--Font-uri-->
  <link href="https://fonts.googleapis.com/css?family=Baskervville&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

  <!--Font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Bootstrap -->
  <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">

</head>

<body>
  <div class="all">
    <!--Bara de sus-->
    <div class="info-bar">
      <div class="for-position">
        <!--Link cu logo-ul dashboard-ului-->
        <div class="logo-dashboard">
          <a href="dashboard.php"><img src="../images/logo/logo_main.png" class="logo-dashboard-img"/></a>
        </div>
        <!--Bara de cautare si contul administratorului-->
        <div class="user-bar">
          <form>
            <input type="text" name="search" class="search-bar" placeholder="Search for..">
          </form>

          <!--Responsive-->
          <a href="javascript:void(0);" class="icon-rsp" onclick="myFunction()">
            <i class="fa fa-bars"></i>
          </a>

          <!--Link spre user profile-->
          <div class="user-profile">
            <img src="../images/logo/user_icon_100.png" class="img-user"/>
            <a href="profile.php" class="user-name"><?php echo $_SESSION['admin_name']." ".$_SESSION['admin_prenume']; ?></a>

          </div>
        </div>
      </div>
    </div>
