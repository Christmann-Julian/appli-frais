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
                <a href="<?= $this->linkTo('expense'); ?>" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Mes frais</span> </a>
                <?php if($_SESSION['role'] == "visiteur" ){ ?>
                    <a href="<?= $this->linkTo('expense_add'); ?>" class="nav_link"> <i class='bx bx-add-to-queue nav_icon'></i> <span class="nav_name">Ajouter</span> </a>
                <?php } ?> 
                <a href="<?= $this->linkTo('user'); ?>" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Profil</span> </a> 
                <a href="<?= $this->linkTo('help'); ?>" class="nav_link"> <i class='bx bx-help-circle nav_icon'></i> <span class="nav_name">Aide</span> </a> 
            </div>
        </div> 
        <a href="<?= $this->linkTo('logout'); ?>" class="nav_link"> 
            <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Se déconnecter</span> 
        </a>
    </nav>
</div>
<div class="height-100">
    <div class="row pt-2">
        <div class="col-md-6 col-sm-12">
            <h4>Mes frais</h4>
        </div>
        <div class="col-md-6 col-sm-12 flex-right-col">
            <form action="#" method="post">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-3">
                        <input name="search" id="search" class="form-control" type="text" placeholder="Rechercher" required>
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </div>
                </div>   
            </form>
        </div>
    </div>
    <div class="table-responsive-sm">
        <table class="table caption-top table-hover">
            <thead>
                <tr>
                    <th scope="col">Numéro</th>
                    <?php if($_SESSION['role'] == "compta" ){ ?>
                        <th scope="col">Agent</th>
                    <?php } ?>
                    <th scope="col">Etat</th>
                    <th scope="col">Mois</th>
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <?php if($_SESSION['role'] == "compta" ){ ?>
                        <td>Mark</td>
                    <?php } ?>
                    <td><span class="badge bg-primary">En cours</span></td>
                    <td>12/2023</td>
                    <td>127,39 €</td>
                    <td>
                        <a href="#" class="btn btn-primary me-1" role="button"><i class='bx bx-edit'></i></a>
                        <?php if($_SESSION['role'] == "visiteur" ){ ?>
                            <a href="#" class="btn btn-danger" role="button"><i class='bx bx-trash'></i></a>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <?php if($_SESSION['role'] == "compta" ){ ?>
                        <td>Jacob</td>
                    <?php } ?>
                    <td><span class="badge bg-success">Validé</span></td>
                    <td>07/2023</td>
                    <td>89,65€</td>
                    <td>
                        <a href="#" class="btn btn-primary me-1" role="button"><i class='bx bx-edit'></i></a>
                        <?php if($_SESSION['role'] == "visiteur" ){ ?>
                            <a href="#" class="btn btn-danger" role="button"><i class='bx bx-trash'></i></a>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <?php if($_SESSION['role'] == "compta" ){ ?>
                        <td>Larry</td>
                    <?php } ?>
                    <td><span class="badge bg-danger">Refusé</span></td>
                    <td>10/2023</td>
                    <td>15,56€</td>
                    <td>
                        <a href="#" class="btn btn-primary me-1" role="button"><i class='bx bx-edit'></i></a>
                        <?php if($_SESSION['role'] == "visiteur" ){ ?>
                            <a href="#" class="btn btn-danger" role="button"><i class='bx bx-trash'></i></a>
                        <?php } ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>