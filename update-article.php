<?php

require_once './bdd.php';

$updatedArticle = "UPDATE `Article` SET `title` = :title,`content` = :content WHERE `id` = :id";

$request = $database->prepare($updatedArticle);

$request->execute(
    [
        'id' => $_POST['article'],
        'title' => $_POST['title'],
        'content' => $_POST['content']
    ]
);

header('Location: pages/article-page.php');

?>
