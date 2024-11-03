<?php 

session_start();

if(!isset($_POST['title']) || empty($_POST['title'])) {
    echo "<p>Le titre est obligatoire</p>";
}

$title = htmlspecialchars(string: $_POST['title']);

if(!isset($_POST['content']) || empty($_POST['content'])) {
    echo "<p>Le contenu est obligatoire</p>";
}

$content = htmlspecialchars(string: $_POST['content']);

if(!isset($title) || !isset($content)) {
    return;
}

require_once 'bdd.php';

$article = $database->prepare(
    query:'INSERT INTO Article (title, content)
        VALUES (:title, :content)'
);

$article->execute(params: [
    'title' => $title,
    'content' => $content,
]);

if($article->rowCount() > 0) {
    header('Location: pages/article-page.php');
}
else {
    echo "<p>Une erreur est survenue</p>";
}
