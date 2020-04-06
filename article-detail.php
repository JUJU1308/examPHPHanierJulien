<?php
require_once 'pdo_connect.php';
require_once 'functions.php';
?>
<html>
<head>
    <head>
        <?php
        require_once 'stylesheets.php';
        ?>
    </head>
</head>
<body>

    <?php
    include 'nav.php';
    ?>

    <div style="text-align: center">
    <?php
    $res = $pdo->prepare('SELECT * FROM annonce WHERE id = :id');
    $res->execute(['id'=> $_GET['id']]);
    $fetchRes = $res->fetch();
    ?>

        <h1><?php echo($fetchRes['titre']) ?></h1><br>
        <img  src="<?php echo('images/articles/'.$fetchRes['image']); ?>"
              alt="Image de la planète <?php echo($fetchRes['titre']); ?>" > <br>
        <h2><u>Autheur:</u> <?php echo($fetchRes['nom_prenom_utilisateur']) ?></h2>
        <div><u>Contenu:</u> <?php echo($fetchRes['contenu']) ?></div>
        <?php $res->closeCursor(); ?>
    </div>
</body>
</html>