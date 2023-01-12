<?php
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
  header('Location: index.php');
}
require('db.php');
if (isset($_REQUEST["submit"])) {

  if (strlen($_REQUEST['passwordLogin']) >= 0) {
    $pwd = $_REQUEST["passwordLogin"];

    $result = array();
    $res = $BD->prepare("SELECT * FROM users WHERE email=?  AND password=?");
    $res->execute(array($_REQUEST["usernameLogin"], $pwd));
    if ($res->rowCount() == 0) {
      $_SESSION["login_error"] = "Mot de passe ou email érroné";
      header('Location: login.php');
    } else {
      $list = $res->fetch();
      $_SESSION["user"] = $list;
      $_SESSION["login_error"] = "";

      header('Location: index.php');
    }
  } else {
    $_SESSION["login_error"] = "Mot de passe trop court";
    header('Location: login.php');
  }
}
?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-1/css/all.min.css' />
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="css/style2.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="sass/style.scss">
  <title>Forms</title>
</head>

<body>

  <header>
    <main class="container flex flex-column items-center justify-center login">
      <form class="flex justify-between login-form" action="login">
        <div class="content flex flex-column justify-center items-center">
          <div class="text flex flex-column justify-center items-center">
            <h1>user login</h1>
            <div class="icon">
              <i class="fab fa-facebook"></i>
              <i class="fab fa-twitter"></i>
              <i class="fab fa-google"></i>
            </div>
            <span>or use social media to signup</span>
          </div>
          <!--div class="form-group">
                        <input type="text" placeholder="enter your username">
                    </div-->
          <div class="form-group">
            <input type="text" placeholder="enter your email" name="usernameLogin">
          </div>
          <div class="form-group">
            <input type="password" placeholder="**************" name="passwordLogin">
          </div>
          <div class="form-group">
            <input type="submit" name="submit" value="login">
          </div>
        </div>
        <aside class="flex flex-column justify-center items-center">
          <h1>welcome, back!</h1>
          <h2>by creating your account your are agree to our privacy and policy.</h2>
          <button type="button" data-toggle="modal" data-target="#register_button_modal">signup</button>
        </aside>
      </form>
    </main>
  </header>
  <div class="container-fluid">
    <div class="modal fade" id="register_button_modal">
      <form class="form-horizontal" method="post">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-dark d-flex justify-content-between">
              <h4 class="modal-title" id="myModalLabel">Register</h4>
              <button type="button" class="close float-left" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body bg-light">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="InputEmail">Email address</label>
                      <input type="email" class="form-control" id="InputEmail" placeholder="Enter email" name="email">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="InputNom">Nom</label>
                      <input type="text" class="form-control" id="InputNom" placeholder="Enter name" name="nom">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="InputNom">Prenom</label>
                      <input type="text" class="form-control" id="Inputprenom" placeholder="Enter the firstname" name="prenom">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="InputUserName">UserName</label>
                      <input type="text" class="form-control" id="InputUserName" placeholder="Enter UserName" name="username">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="InputEmail">Password</label>
                      <input type="password" class="form-control" id="InputPassword" placeholder="Enter password" name="password">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer bg-primary">
              <button type="submit" class="btn btn-danger float-right" data-dismiss="modal">Cancel</button>
              <button type="reset" class="btn btn-info" name="submitRegister">Save changes</button>
              <p class="text-danger"><?= $_SESSION["login_error"] ?></p>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>

</html>