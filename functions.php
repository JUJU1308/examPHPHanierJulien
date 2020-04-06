<?php
function getArticle($pdo,$id)
{
    $res = $pdo->prepare('SELECT * FROM annonce WHERE id = :id');
    $res->execute(['id'=> $id]);
    return $res->fetch();
}
function addBdd($pdo, $imageUrl){
    $req = $pdo->prepare(
        'INSERT INTO annonce(titre, contenu, nom_prenom_utilisateur, image)
    VALUES(:titre, :contenu, :nom_prenom_utilisateur, :image)');
    $req->execute([
        'titre' => $_POST['titre'],
        'contenu' => $_POST['contenu'],
        'nom_prenom_utilisateur' => $_POST['nom_prenom_utilisateur'],
        'image' => $imageUrl
    ]);
}

function updateBdd($pdo, $imageUrl, $id){
    if(!is_null($imageUrl)){
        $req = $pdo->prepare('UPDATE annonce SET titre = :titre, contenu = :contenu , nom_prenom_utilisateur = :nom_prenom_utilisateur, image = :image WHERE id = :id');
        $req->execute([
            'titre' => $_POST['titre'],
            'contenu' => $_POST['contenu'],
            'nom_prenom_utilisateur' => $_POST['nom_prenom_utilisateur'],
            'image' => $imageUrl,
            'id'=> $id
        ]);
    } else {
        $req = $pdo->prepare('UPDATE annonce SET titre = :titre, contenu = :contenu , nom_prenom_utilisateur = :nom_prenom_utilisateur, image = :image WHERE id = :id');
        $req->execute([
            'titre' => $_POST['titre'],
            'contenu' => $_POST['contenu'],
            'nom_prenom_utilisateur' => $_POST['nom_prenom_utilisateur'],
            'image' => $imageUrl,
            'id'=> $id
        ]);
    }
}
function validateForm() {
    $errors = [];
  if($_FILES['image']['type'] === 'image/png'){
        if($_FILES['image']['size']<8000000){
            $extension = explode('/', $_FILES['image']['type'])[1];
            $imageUrl = uniqid().'.'.$extension;
            move_uploaded_file($_FILES['image']['tmp_name'], 'images/articles/'.$imageUrl);
        } else {
            $errors[] = 'Fichier trop lourd impossible';
        }
    } else {
        $errors[] = 'Impossible : j\'accepte que les PNGS !';
    }
    if (empty($_POST['titre'])) {
        $errors[] = 'Veuillez saisir le titre';
    }
    if ( empty($_POST['nom_prenom_utilisateur'])) {
        $errors[] = 'Veuillez saisir l\'auteur';
    }
    if ( empty($_POST['contenu'])) {
        $errors[] = 'Veuillez saisir le contenu';
    }

    return ['errors'=>$errors, 'image'=>$imageUrl];
}
function deleteArticle($pdo, $id)
{
    $res = $pdo->prepare('DELETE FROM annonce WHERE id = :id');
    $res->execute(['id'=> $id]);
}
function validateEditForm() {
    $errors = [];
    $imageUrl = '';

    if($_FILES['image']['size'] != 0) {

        if ($_FILES['image']['type'] === 'image/png') {
            if ($_FILES['image']['size'] < 80000) {
                $extension = explode('/', $_FILES['image']['type'])[1];
                $imageUrl = uniqid() . '.' . $extension;
                move_uploaded_file($_FILES['image']['tmp_name'], 'images/articles/' . $imageUrl);
            } else {
                $errors[] = 'Fichier trop lourd impossible';
            }
        } else {
            $errors[] = 'Impossible : j\'accepte que les PNGS !';
        }
    }
    if (empty($_POST['titre'])) {
        $errors[] = 'Veuillez saisir le titre';
    }
    if ( empty($_POST['contenu'])) {
        $errors[] = 'Veuillez saisir le contenu';
    }
    if ( empty($_POST['nom_prenom_utilisateur'])) {
        $errors[] = 'Veuillez saisir l\'autheur';
    }

    return ['errors'=>$errors, 'image'=>$imageUrl];
}

?>