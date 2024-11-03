<?php 
require_once './bdd.php';


if (!isset($_POST['del'])) {
    header('Location: pages/article-page.php');
}
$deleteArticle = [
    'id' => $_POST['del']
];

$request = $database->prepare('DELETE FROM Article WHERE id = :id');
$request->execute($deleteArticle);

header('Location: pages/article-page.php');

?>
