<?php

session_start();

if (!isset($_SESSION['role'])) {
    header('Location: ./login-page.php');
}

require_once '../bdd.php';

// récupérer les articles
$request = $database->prepare(
    query: 'SELECT * FROM Article'
);
$request->execute();
$articles = $request->fetchAll(PDO::FETCH_ASSOC);

// récupérer les users
$req = $database->prepare(
    query: 'SELECT * FROM user'
);
$req->execute();
$users = $req->fetchAll(PDO::FETCH_ASSOC);

$roles = ['admin', 'user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen flex flex-col justify-center items-center gap-5 my-10">

    <div class="flex w-1/2 justify-between bg-gray-200 p-5 rounded-full">
        <h1 class="text-2xl">Bonjour <?php echo $_SESSION['name'] ?> !</h1>
        <form action="../logout.php" method="POST" class="flex items-center">
            <button type="submit" class="transition duration-500 ease-in-out hover:text-gray-400">Déconnecter</button>
        </form>
    </div>

    <div class="flex flex-col gap-2 bg-gray-200 w-1/2 p-5 rounded-xl">
        <h2 class="text-2xl">Articles du jour</h2>
        <?php foreach ($articles as $article): ?>
            <div class="p-2 bg-gray-300 rounded-xl">
                <h2 class="text-xl"><?php echo $article['title'] ?></h2>
                <p class="text-base"><?php echo $article['content'] ?></p>
            </div>
            <?php if ($_SESSION['role'] == 'admin'): ?>
                <div class="flex justify-end gap-2">
                    <form action="../delete-article.php" method="POST" class="px-3 py-1 bg-gray-500 transition duration-500 ease-in-out hover:bg-gray-100 rounded-2xl">
                        <input type="hidden" name="del" value="<?php echo $article['id'] ?>">
                        <button type="submit">Supprimer</button>
                    </form>

                    <form action="./update-article-page.php" method="POST" class="px-3 py-1 bg-gray-500 transition duration-500 ease-in-out hover:bg-gray-100 rounded-2xl">
                        <input type="hidden" name="article" value="<?php echo $article['id'] ?>">
                        <button type="submit">Modifier</button>
                    </form>
                </div>
            <?php endif; ?>
        <?php endforeach ?>
    </div>

    <?php if ($_SESSION['role'] == 'admin') : ?>


        <div class="flex flex-col gap-2 bg-gray-200 w-1/2 p-5 rounded-xl">

            <form action="../create-article.php" method="POST" class="flex flex-col">
                <h2 class="text-2xl">Ajouter un article</h2>
                <label for="title" class="text-xl">Titre :</label>
                <input type="text" name="title" id="title" class=" rounded w-full">
                <label for="content" class="text-lg text-start">Contenu :</label>
                <textarea name="content" id="content" rows="10" cols="30" class=" rounded w-full"></textarea>
                <br>
                <input type="submit" name="ajouter" value="Ajouter" class="self-end px-3 py-1 bg-gray-500 transition duration-500 ease-in-out hover:bg-gray-100 rounded-2xl">
            </form>


            <h2 class="text-2xl">Gérer les utilisateurs</h2>
            <?php foreach ($users as $user): ?>
                <div class="flex justify-between items-center">

                    <h2 class="text-xl"><?php echo $user['name'] ?></h2>
                    <p><?php echo $user['role'] ?></p>


                    <form action="../update-role.php" method="POST" class="flex gap-3">

                        <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">

                        <select name="role" id="role">
                            <option value="">--Changer le rôle--</option>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?php echo htmlspecialchars($role); ?>">
                                    <?php echo htmlspecialchars($role); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <input type="submit" name="valider" value="Valider" class="px-3 py-1 bg-gray-500 transition duration-500 ease-in-out hover:bg-gray-100 rounded-2xl">

                    </form>
                </div>
            <?php endforeach ?>
        </div>

    <?php endif; ?>

</body>

</html>