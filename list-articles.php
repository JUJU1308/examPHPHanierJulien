<?php
require_once 'pdo_connect.php';
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
<h2>
    <h1>Les articles disponibles dans notre base de donnée :</h1>

    <table class="table">
        <thead>
        <tr>

            <th scope="col">Titre</th>
            <th scope="col">Auteur</th>
            <th scope="col">Contenu</th>
            <th scope="col">Image</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $reponse = $pdo->query('SELECT * FROM annonce');
        while ($data = $reponse->fetch())
        {
            ?>
            <tr>
                <td><?php echo($data['titre']); ?></td>
                <td><?php echo($data['nom_prenom_utilisateur']); ?></td>
                <td><?php echo($data['contenu']); ?></td>
                <td><?php echo($data['image']); ?></td>
                <td>
                    <img  style="max-width: 100px;"src="<?php echo('images/articles/'.$data['image']); ?>"
                         alt="Image de l'article "<?php echo($data['image']); ?>/>
                </td>
                <td>
                    <a title="Voir le détail" href="article-detail.php?id=<?php echo($data['id']); ?>">
                        <i class="fa fa-eye"></i>
                    </a>

                    <a title="Editer" href="edit-article.php?id=<?php echo($data['id']); ?>">
                        <i class="fa fa-edit"></i>
                    </a>

                    <a title="Supprimer" href="delete-article.php?id=<?php echo($data['id']);?>">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>


            </tr>
            <?php
        }
        $reponse->closeCursor();
        ?>

        </tbody>
    </table>
</h2>
</body>
</html>