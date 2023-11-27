<?php
$css=[
    '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">',
    '<link rel="stylesheet" href="assets/css/login.css">'
];
$javascript=[
    '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>'
];
?>
<div class="loginBox"> <img class="user" src="assets/img/logo.png" height="100px" width="100px">
        <h3>Appli frais</h3>
        <?php if($loginError != null) { ?>
            <div class="alert alert-danger" style="text-align: center;" role="alert"><?php echo($loginError); ?></div>
        <?php } ?>
        <form action="index.php?page=login" method="post">
            <div class="inputBox"> 
                <input id="uname" type="text" name="Login" placeholder="Identifiant"> 
                <input id="pass" type="password" name="Password" placeholder="Mot de passe"> 
            </div> 
            <input type="submit" value="Se connecter">
        </form> 
        <a href="#">Mot de passe oublié<br> </a>
</div>