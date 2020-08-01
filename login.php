<!DOCTYPE html>
<html lang="en">
<head>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="css/stil1.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
</head>
<body>
  <div class="container">
      <div class="card card-login mx-auto text-center bg-dark">
          <div class="card-header mx-auto bg-dark">
              <span> <img src="imagini/logo_main.png" class="w-75" alt="Logo"> </span><br/>
                          <span class="logo_title mt-5">Pentru a putea accesa magazinul mai intai trebuie sa te conectezi! </span>

          </div>
          <div class="card-body">
              <form action="control/login_control.php" method="POST">
                  <div class="input-group form-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                  </div>

                  <div class="input-group form-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-key"></i></span>
                      </div>
                      <input type="password" name="password" id="parola" class="form-control" placeholder="Password">
                  </div>
                  <div class="form-group" >
                      <a href="registerform.php" class="btn btn-outline-danger float-left login_btn">Creaza-ti cont!</a>
                  </div>

                  <div class="form-group" >
                      <input  type="submit" name="btn" value="Login" class="btn btn-outline-danger float-right login_btn">
                  </div>

              </form>
          </div>
      </div>
    </div>
    <script src="js/javascript.js"></script>
</body>
</html>
