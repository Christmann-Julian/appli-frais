<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Appli Frais</title>
        <link rel="icon" type="image/png" href="assets/img/logo.png" >
        <?php 
        if(isset($css)){
            foreach ($css as $c) {
                echo($c);
            }
        }  
        ?>
    </head>
    <body id="body-pd">
        <?= $content ?>

        <?php 
        if(isset($javascript)){
            foreach ($javascript as $js) {
                echo($js);
            }
        }  
        ?>
    </body>
</html>