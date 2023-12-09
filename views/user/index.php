<?php
$css=[
    '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">',
    '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">',
    '<link rel="stylesheet" href="assets/css/style.css">'
];
$javascript=[
    '<script src="assets/js/main.js"></script>',
    '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>'
];
?>

<header class="header" id="header">
    <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    <div class="header_user"> <span><?= $_SESSION['prenom'].' '.$_SESSION['nom'] ?></span><div class="header_img"> <img src="assets/img/user.jpg" alt=""> </div></div> 
</header>
<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div> <a href="#" class="nav_logo"> 
            <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Appli frais</span> </a>
            <div class="nav_list"> 
                <a href="<?= $this->linkTo('expense'); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Mes frais</span> </a> 
                <a href="<?= $this->linkTo('expense_add'); ?>" class="nav_link"> <i class='bx bx-add-to-queue nav_icon'></i> <span class="nav_name">Ajouter</span> </a> 
                <a href="<?= $this->linkTo('user'); ?>" class="nav_link  active"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Profil</span> </a> 
                <a href="<?= $this->linkTo('help'); ?>" class="nav_link"> <i class='bx bx-help-circle nav_icon'></i> <span class="nav_name">Aide</span> </a> 
            </div>
        </div> 
        <a href="<?= $this->linkTo('logout'); ?>" class="nav_link"> 
            <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Se déconnecter</span> 
        </a>
    </nav>
</div>
<div class="height-100">
    <h4>Profil</h4>
    <form>
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="lastName" class="form-label">Nom</label>
                <input type="text" class="form-control" name="lastName" id="lastName" value="Doe" required>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="firstName" class="form-label">Prénom</label>
                <input type="text" class="form-control" name="firstName" id="firstName" value="John" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">Ville</label>
            <input type="text" class="form-control" name="city" id="city" value="Paris" required>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
    <h4 class="mt-3">Informations de connexion</h4>
    <form>  
        <div class="mb-3">
            <label for="login" class="form-label">Identifiant</label>
            <input type="text" class="form-control" name="login" id="login"  value="jDoe" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Nouveau mot de passe</label>
            <input type="password" class="form-control" id="password" aria-describedby="passwordHelp">
            <div id="passwordHelp" class="form-text">Si vous laissez ce champ vide, votre ancien mot de passe sera gardé.</div>
        </div>
        <div class="mb-3">
            <label for="confirm-password" class="form-label">Confirmation du mot de passe</label>
            <input type="password" class="form-control" id="confirm-password">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>