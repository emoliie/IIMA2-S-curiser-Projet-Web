<?php

session_start();

require_once "../bdd.php";

if (!isset($_POST['article'])) {
    header('Location:article-page.php');
}

if (!$_SESSION['role']) {
    header('Location:article-page.php');
}

if ($_SESSION['role'] != 'admin') {
    header('Location:article-page.php');
}

$request = $database->prepare(
    query: 'SELECT * FROM Article WHERE id = :id'
);

$request->execute(
    ['id' => $_POST['article']],
);

$result = $request->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen flex flex-col justify-center items-center gap-5">
    <form action="../update-article.php" method="POST" class="flex flex-col gap-3 w-1/3 bg-gray-200 p-5 rounded-xl">
        <input type="hidden" name="article" value="<?php echo $result['id'] ?>">
        <label for="title">Titre :</label>
        <input type="text" name="title" id="title" placeholder="<?php echo $result['title'] ?>">
        <label for="content">Contenu :</label>
        <textarea name="content" id="content" rows="10" cols="30" placeholder="<?php echo $result['content'] ?>"></textarea>
        <input type="submit" name="modifier" value="Modifier" class="px-3 py-1 bg-gray-500 transition duration-500 ease-in-out hover:bg-gray-100 rounded-2xl">
    </form>
</body>

</html>