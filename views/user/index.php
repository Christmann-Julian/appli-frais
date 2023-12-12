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
                <a href="<?= $this->linkTo('expense'); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Consulter</span> </a> 
                <?php if($_SESSION['role'] == "visiteur" ){ ?>
                    <a href="<?= $this->linkTo('expense_add'); ?>" class="nav_link"> <i class='bx bx-add-to-queue nav_icon'></i> <span class="nav_name">Ajouter</span> </a>
                <?php } ?> 
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
    <?php if(isset($_GET['success'])){ ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_GET['success']) ?>
        </div>
    <?php } ?>
    <h4>Profil</h4>
    <form  action="index.php?page=user" method="post">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="lastName" class="form-label">Nom</label>
                <input type="text" class="form-control <?= $valid = isset($errors['lastname']) ? "is-invalid" : "" ?>" name="lastName" id="lastName" value="<?= $user["nom"] ?>" required>
                <?php if(isset($errors['lastname'])){ ?>
                    <div class="invalid-feedback">
                        <?= $errors['lastname'] ?>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="firstName" class="form-label">Prénom</label>
                <input type="text" class="form-control <?= $valid = isset($errors['firstname']) ? "is-invalid" : "" ?>" name="firstName" id="firstName" value="<?= $user["prenom"] ?>" required>
                <?php if(isset($errors['firstname'])){ ?>
                    <div class="invalid-feedback">
                        <?= $errors['firstname'] ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">Ville</label>
            <input type="text" class="form-control <?= $valid = isset($errors['city']) ? "is-invalid" : "" ?>" name="city" id="city" value="<?= $user["ville"] ?>" required>
            <?php if(isset($errors['city'])){ ?>
                <div class="invalid-feedback">
                    <?= $errors['city'] ?>
                </div>
            <?php } ?>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
    <h4 class="mt-3">Informations de connexion</h4>
    <form action="index.php?page=user" method="post">  
        <div class="mb-3">
            <label for="login" class="form-label">Identifiant</label>
            <input type="text" class="form-control <?= $valid = isset($errors['login']) ? "is-invalid" : "" ?>" name="login" id="login"  value="<?= $user["login"] ?>" required>
            <?php if(isset($errors['login'])){ ?>
                <div class="invalid-feedback">
                    <?= $errors['login'] ?>
                </div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Nouveau mot de passe</label>
            <input type="password" class="form-control <?= $valid = isset($errors['password']) ? "is-invalid" : "" ?>" name="password" id="password" aria-describedby="passwordHelp">
            <div id="passwordHelp" class="form-text">Si vous laissez ce champ vide, votre ancien mot de passe sera gardé.</div>
            <?php if(isset($errors['password'])){ ?>
                <div class="invalid-feedback">
                    <?= $errors['password'] ?>
                </div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="confirm-password" class="form-label">Confirmation du mot de passe</label>
            <input type="password" class="form-control <?= $valid = isset($errors['confirm-password']) ? "is-invalid" : "" ?>" name="confirm-password" id="confirm-password">
            <?php if(isset($errors['confirm-password'])){ ?>
                <div class="invalid-feedback">
                    <?= $errors['confirm-password'] ?>
                </div>
            <?php } ?>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>