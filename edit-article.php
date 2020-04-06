<?php
require_once 'pdo_connect.php';
require_once 'functions.php';
$idArticle = $_GET['id'];
$article = getArticle($pdo, $idArticle);
$errors = [];
$imageUrl = null;
if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
    $returnValidation = validateEditForm();
    $errors = $returnValidation['errors'];
    $imageUrl = $returnValidation['image'];

    if( count($errors) === 0) {
        updateBdd($pdo, $imageUrl, $article['id']);
        header('Location: list-articles.php');
    }
}

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

    <h1>Modifier l'article</h1><br>

    <form method="post" action="edit-article.php?id=<?php echo($article['id']);?>" enctype="multipart/form-data">
        <label>Titre</label>
        <input name="titre" value="<?php echo($article['titre']) ?>" class="form-control" placeholder="Titre">
        <label>Contenu</label>
        <input name="contenu" value="<?php echo($article['contenu']) ?>" class="form-control" placeholder="Contenu" >
        <label>Autheur</label>
        <input name="nom_prenom_utilisateur" value="<?php echo($article['nom_prenom_utilisateur']) ?>" class="form-control" placeholder="Autheur" >
        <label>Image :</label> <br>
        <img src="<?php echo('images/articles/'.$article['image']);?>"><br><br>
        <input type="file" name="image" value="<?php echo($article['image']) ?>"><br><br>

        <input type="submit">
    </form>
        <?php
        if(count($errors) != 0){
            echo(' <h2>Erreurs lors de la dernière soumission du formulaire : </h2>');
            foreach ($errors as $error){
                echo('<div class="error">'.$error.'</div>');
            }
        }
        ?>

</div>
</body>
</html>
