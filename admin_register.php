<?php
require_once 'functions/user-function.php';
require_once 'pdo_connect.php';

if ( $_SERVER['REQUEST_METHOD'] === 'POST'){

    $errors = validateFormUser();

    if(count($errors) ==  0){
        $errors = addUserBdd($pdo, $errors);
        if(count($errors) == 0){
            header('Location: login.php');
        }
    }

}
?>
<html>
<head>
    <?php
    include 'stylesheets.php';
    ?>
</head>
<body>
<h2>Espace Administrateur : enregistrer un nouvel utilisateur</h2>

<form method="post" action="admin_register.php">
    <input type="text" name="nom" class="form-control" required placeholder="Nom">
    <input type="text" name="prenom" class="form-control" required placeholder="Prenom">
    <input type="text" name="login" class="form-control" required placeholder="login">
    <input type="password" name="password"  class="form-control" placeholder="Mot de passe">
    <input type="submit">
</form>


<ul>
<?php
$errors = validateFormUser();
 if(count($errors)>0){
     echo('<h2>Les erreurs : </h2>');
     foreach ($errors as $error){
         echo('<li>'.$error.'</li>');
     }
 }
?>
</ul>
</body>
</html>
