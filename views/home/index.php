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
                <a href="#" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Mes frais</span> </a> 
                <a href="#" class="nav_link"> <i class='bx bx-add-to-queue nav_icon'></i> <span class="nav_name">Ajouter</span> </a> 
                <a href="#" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Profil</span> </a> 
                <a href="#" class="nav_link"> <i class='bx bx-help-circle nav_icon'></i> <span class="nav_name">Aide</span> </a> 
            </div>
        </div> 
        <a href="<?= $this->linkTo('logout'); ?>" class="nav_link"> 
            <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Se déconnecter</span> 
        </a>
    </nav>
</div>
<div class="height-100 ">
    <h4>Mes frais</h4>
</div>