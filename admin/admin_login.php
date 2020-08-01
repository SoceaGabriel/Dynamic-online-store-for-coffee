<!DOCTYPE html>
<html lang="ro">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Pagina de login pentru administrator">
	<meta name="author" content="Socea Gabriel">
	<meta name="keyword" content="Dashboard, Admin, Template, Theme, Bootstrap, Responsive">

	<title>Admin login</title>

	<!--Bootstrap-->
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../bootstrap/css/bootstrap-theme.css" rel="stylesheet" >

	<!--Fonts & Icons-->
	<link href="../css/elegant-icons-style.css" rel="stylesheet" />
	<link href="../css/font-awesome.css" rel="stylesheet" />

	<!--Style for page-->
	<link href="../css/style_admin.css" rel="stylesheet">
</head>

<body class="login-img3-body">
	<!--Formularul de login-->
	<div class="container">
    <form class="login-form" id="admin-login-form" method="POST" action="control/login_control.php">
		<p class="message"></p>
		<div class="login-wrap">
			<p class="login-img"><i class="icon_lock_alt"></i></p>

			<!--Email-->
			<div class="input-group form-group">
				<span class="input-group-addon"><i class="icon_profile"></i></span>
				<input type="email" class="form-control" name="email" id="email" placeholder="Email Address" autofocus>
			</div>

			<!--Parola-->
			<div class="input-group form-group">
				<span class="input-group-addon"><i class="icon_key_alt"></i></span>
				<input type="password" name="password" id="password" class="form-control" placeholder="Password">
			</div>
			<p class="admin_login"></p>
			<button class="login-btn btn btn-primary btn-lg btn-block" name="login-btn" type="submit">Login</button>
			<a class="btn btn-info btn-lg btn-block" href="../../index.php">Inapoi la site</a>
		</div>
    </form>
    <div class="text-right">
    </div>
  </div>

</body>
</html>
