<?php
$css=[
    '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">',
    '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">',
    '<link rel="stylesheet" href="assets/css/style.css">'
];
$javascript=[
    '<script src="assets/js/main.js"></script>',
    '<script src="assets/js/form.js"></script>',
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
                <a href="<?= $this->linkTo('expense_add'); ?>" class="nav_link active"> <i class='bx bx-add-to-queue nav_icon'></i> <span class="nav_name">Ajouter</span> </a> 
                <a href="<?= $this->linkTo('user'); ?>" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Profil</span> </a> 
                <a href="<?= $this->linkTo('help'); ?>" class="nav_link"> <i class='bx bx-help-circle nav_icon'></i> <span class="nav_name">Aide</span> </a> 
            </div>
        </div> 
        <a href="<?= $this->linkTo('logout'); ?>" class="nav_link"> 
            <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Se déconnecter</span> 
        </a>
    </nav>
</div>
<div class="height-100 container">
    <h4>Frais forfait</h4>
    <form id="formAdd" action="index.php?page=expense_add" method="post">
        <div class="row">
            <div class="col-md-3 col-sm-12 mb-3">
                <label for="ffnuite" class="form-label">Frais</label>
                <input name="ffnuite" id="ffnuite" class="form-control" type="text" value="Nuitée" aria-label="Nuitée" required readonly>
            </div>
            <div class="col-md-3 col-sm-12 mb-3">
                <label for="ffnuiteQte" class="form-label">Quantité</label>
                <input name="ffnuiteQte" type="number" class="form-control" id="ffnuiteQte" min="0" required>
            </div>
            <div class="col-md-3 col-sm-12 mb-3">
                <label for="ffnuiteM" class="form-label">Montant</label>
                <div class="input-group">
                    <input name="ffnuiteM" type="number" class="form-control" id="ffnuiteM" min="0" step="0.01" required>
                    <span class="input-group-text">€</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 mb-3">
                <label for="ffnuiteTot" class="form-label">Total</label>
                <div class="input-group">
                    <input name="ffnuiteTot" type="number" value="0" class="form-control" id="ffnuiteTot" aria-label="Total Nuitée" required readonly>
                    <span class="input-group-text">€</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-12 mb-3">
                <label for="ffrepas" class="form-label">Frais</label>
                <input name="ffrepas" id="ffrepas" class="form-control" type="text" value="Repas Midi" aria-label="Repas Midi" required readonly>
            </div>
            <div class="col-md-3 col-sm-12 mb-3">
                <label for="ffrepasQte" class="form-label">Quantité</label>
                <input name="ffrepasQte" type="number" class="form-control" id="ffrepasQte" min="0" required>
            </div>
            <div class="col-md-3 col-sm-12 mb-3">
                <label for="ffrepasM" class="form-label">Montant</label>
                <div class="input-group">
                    <input name="ffrepasM" type="number" class="form-control" id="ffrepasM" min="0" step="0.01" required>
                    <span class="input-group-text">€</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 mb-3">
                <label for="ffrepasTot" class="form-label">Total</label>
                <div class="input-group">
                    <input name="ffrepasTot" type="number" value="0" class="form-control" id="ffrepasTot" aria-label="Total Repas Midi" required readonly>
                    <span class="input-group-text">€</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-12 mb-3">
                <label for="ffkilo" class="form-label">Frais</label>
                <input name="ffkilo" id="ffkilo" class="form-control" type="text" value="Kilométrage" aria-label="Kilométrage" required readonly>
            </div>
            <div class="col-md-3 col-sm-12 mb-3">
                <label for="ffkiloQte" class="form-label">Quantité</label>
                <input name="ffkiloQte" type="number" class="form-control" id="ffkiloQte" min="0" required>
            </div>
            <div class="col-md-3 col-sm-12 mb-3">
                <label for="ffkiloM" class="form-label">Montant</label>
                <div class="input-group">
                    <input name="ffkiloM" type="number" class="form-control" id="ffkiloM" min="0" step="0.01" required>
                    <span class="input-group-text">€</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 mb-3">
                <label for="ffkiloTot" class="form-label">Total</label>
                <div class="input-group">
                    <input name="ffkiloTot" type="number" value="0" class="form-control" id="ffkiloTot" aria-label="Total Kilométrage" required readonly>
                    <span class="input-group-text">€</span>
                </div>
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <h4>Frais hors forfait</h4>
        </div>
        <div id="containerHF">
            <!-- ligne de frais hors forfait -->
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <button type="submit" class="btn btn-primary mb-2">Ajouter fiche de frais</button>
            </div>
            <div class="col-md-6 col-sm-12 flex-right-col">
                <button class="btn btn-primary me-2 mb-2" onclick="addHf()">Ajouter ligne Frais hors Forfait</button>
                <button class="btn btn-danger mb-2" onclick="deleteHf()">Supprimer ligne hors forfait</button>
            </div>
        </div>
    </form>
</div>