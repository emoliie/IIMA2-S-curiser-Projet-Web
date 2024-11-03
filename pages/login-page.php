<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once '../bdd.php';

    if ($_POST['name'] != '' && $_POST['password'] != '') {

        $credentials = [
            'name' => $_POST['name']
        ];

        $request = $database->prepare("SELECT * FROM user WHERE name = :name");
        $request->execute($credentials);
        $result = $request->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            echo '<p>Utilisateur non trouvé.</p>';
            return;
        }

        if (!password_verify(password: $_POST['password'], hash: $result["password"])) {
            echo '<p>Mot de passe incorrect.</p>';
            return;
        }

        $_SESSION["id"] = $result["id"];
        $_SESSION["name"] = $result["name"];
        $_SESSION["role"] = $result["role"];

        header('Location: ./article-page.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen flex flex-col justify-center items-center gap-5">
    <form action="./login-page.php" method="POST" class="flex flex-col gap-3 w-1/3 bg-gray-200 p-5 rounded-xl">
    <h1 class="text-2xl">Connexion</h1>
        <label for="name">Pseudo</label>
        <input type="text" name="name" id="name">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id=password>
        <button type="submit" class="px-3 py-1 bg-gray-500 transition duration-500 ease-in-out hover:bg-gray-100 rounded-2xl">Se connecter</button>

    </form>
    <br>
    <a href="./register-page.php" class="transition duration-500 ease-in-out hover:text-gray-400">S'inscrire</a>

</body>

</html>