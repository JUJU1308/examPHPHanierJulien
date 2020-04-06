<?php
session_start();

require_once 'functions/user-function.php';
require_once 'pdo_connect.php';

if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
    // je ferais le traitement de mon formulaire d'inscription

    $errors = login($pdo, $_POST['login'], $_POST['password']);

    if(count($errors) == 0){
       header('Location: nav.php');
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
<h1>Login</h1>
    <form method="post">
        <input type="text" name="login" placeholder="login">
        <input type="password" name="password" placeholder="Mot de passe">
        <input type="submit">
    </form>

<?php
if(isset($errors)){
    if(count($errors)>0){
        echo('<h2>Les erreurs : </h2>');
        foreach ($errors as $error){
            echo('<li>'.$error.'</li>');
        }
    }
}

?>
</body>
</html>
