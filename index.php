<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang['title'] ?></title>
    <link rel="stylesheet" href="private/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="private/css/-Login-form-Page-BS4-.css">
    <link rel="stylesheet" href="private/css/styles.css">

</head>

<body>
    <div class="container-fluid">
        <div class="row mh-100vh">
            <div class="col-10 col-sm-8 col-md-6 col-lg-6 offset-1 offset-sm-2 offset-md-3 offset-lg-0 align-self-center d-lg-flex align-items-lg-center align-self-lg-stretch bg-white p-5 rounded rounded-lg-0 my-5 my-lg-0" id="login-block">
                <div class="m-auto w-lg-75 w-xl-50">
                    <h2 class="text-info font-weight-light mb-5"><img src="private/img/sato.png" width="80%" class="logo">&nbsp;</h2>





                    <form method="POST" action="./private/php/traitco.php">
                        <div class="form-group"><label class="text-secondary">Login</label><input class="form-control" type="text" required="" name="login" id="email" ></div>
                        <div class="form-group"><label class="text-secondary">Mot de Passe</label><input class="form-control" type="password" required="" name="mdp" id="password"></div>
                        <button class="btn btn-info mt-2" type="submit">Connexion</button>
                    </form>



                    <p class="mt-3 mb-0"></p>
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-end" id="bg-block" style="background-image:url(&quot;private/img/image_sato.png&quot;);background-size:cover;background-position:center center;">
            </div>
          </div>
    </div>
    <script src="private/js/jquery.min.js"></script>
    <script src="private/bootstrap/js/bootstrap.min.js"></script>


</body>
</html>
