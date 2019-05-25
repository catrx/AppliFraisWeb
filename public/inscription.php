<div class="col-md-4">
    <form method="post" action="traitins.php" name="co">

    <h2>Inscription</h2>
    <p class="msg"><?php if(isset( $_SESSION['error'])){

            echo $_SESSION['error'];
            unset($_SESSION['error']);

        }?></p>

<div class="form-group">
    <input class="form-control" type="text" name="surname" id="name" placeholder="Name" />
</div>


<div class="form-group">
    <input class="form-control" type="text" name="name" id="name" placeholder="Prenom" />
</div>


<div class="form-group">
    <input class="form-control" type="text" name="ccode" id="ccode" placeholder="Ccode" />
</div>

<div class="form-group">
    <input class="form-control" type="mail" name="email" id="email" placeholder="Email" />
</div>

<div class="form-group">
    <input class="form-control" type="password" name="password" id="password" placeholder="Password" />
</div>

<div class="form-group">
    <input class="form-control" type="password" name="password1" id="password1" placeholder="Retapez votre mot de passe" />
</div>


<button class="btn btn-warning" role="submit">S'inscrire</button>
</form>

</div>



</div>
</div>
