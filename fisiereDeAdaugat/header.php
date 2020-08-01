<?php
  //pornim o sesiune
  session_start();

  //pornim conexiunea cu baza de date
  include "database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coffee corner</title>

    <!--Bootstrap-->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <!--Custom style-->
	  <link rel="stylesheet" type="text/css" href="css/style_content.css">
    <!--Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Custom font-->
    <link href="https://fonts.googleapis.com/css?family=Baskervville&display=swap" rel="stylesheet">
    <!--Favicon-->
    <link rel="shortcut icon" href="imagini/favicon.png" />

</head>
<body>
	<div class="user-bar">
		<div class="container-fluid">
			<div class="logo-dashboard">
			<a href="index.php"><img src="imagini/logo_main.png" class="logo-dashboard-img"/></a>
			</div>

			<ul class="user_buttons">

        <!--
        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"></span>Cart<span class="nrProduse">0</span></a>
					<div class="dropdown-menu" style="width:400px;">
						<div class="panel panel-success">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-3">Nr.Produs</div>
									<div class="col-md-3">Imagine produs</div>
									<div class="col-md-3">Nume Produs</div>
									<div class="col-md-3">Preț</div>
								</div>
							</div>
							<div class="panel-body">
								<div id="produse_cos">
								</div>
							</div>
						</div>
					</div>
				</li>
        -->
        <?php
          if(!isset($_SESSION['user_id']))
          {
            echo "<li><a class=\"buton button_albastru_2\" href=\"login.php\"><i class=\"fa fa-sign-in\"></i> Autentificare</a></li>
                  <li><a class=\"buton button_albastru_3\" href=\"registerform.php\"><i class=\"fa fa-vcard-o\"></i> Creare cont</a></li>";
          }
          else {
            echo "<li><a class=\"buton button_albastru_1\" href=\"cos.php\"><i class=\"fa fa-shopping-basket\"></i> Cos cumpărături</a></li>
                  <li><a class=\"buton button_albastru_2\" href=\"my_profile.php\"><i class=\"fa fa-vcard-o\"></i> Contul meu</a></li>
                  <li><a class=\"buton button_albastru_3\" href=\"control/logout_control.php\"><i class=\"fa fa-sign-out\"></i> Deconectare</a></li>";
          }
        ?>

			</ul>
	</div>
</div>
