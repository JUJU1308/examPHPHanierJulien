<?php
require_once 'pdo_connect.php';
require_once 'functions.php';
$id = $_GET['id'];
deleteArticle($pdo, $id);
header('Location: list-articles.php');
?>