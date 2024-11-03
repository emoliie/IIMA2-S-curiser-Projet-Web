<?php
session_start();

$roles = ['admin', 'user'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once '../bdd.php';

    if ($_POST['name'] != '' && $_POST['password'] != '' && $_POST['role'] != '') {
        // On vérifie si un utilisateur existe deja

        $checkUserStmt = $database->prepare("SELECT * FROM user WHERE name = :name");
        $checkUserStmt->execute(['name' => $_POST['name']]);
        $existingUser = $checkUserStmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            echo "Le nom d'utilisateur est déjà pris. Veuillez en choisir un autre.";
            return;
        }

        $newUser = [
            //gauche : noms dans la base de donnée, droite : noms dans le form
            'name' => $_POST['name'],
            'password' => password_hash(
                password: $_POST['password'],
                algo: PASSWORD_BCRYPT,
                options: []
            ),
            'role' => $_POST['role']
        ];

        $request = $database->prepare("INSERT INTO user(name, password,role) VALUES (:name, :password, :role)"); // on ajoute dans la base de donnée
        
        if ($request->execute($newUser)) {
            echo 'Inscription réussie';
            header('Location: login-page.php');
        } else {
            echo 'Inscription échouée';
        }
    } else {
        echo "Formulaire incomplet";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen flex flex-col justify-center items-center gap-5">

    <form action="register-page.php" method="POST" id="create-user-form" class="flex flex-col gap-3 w-1/3 bg-gray-200 p-5 rounded-xl">
        <h1 class="text-2xl">Inscription</h1>
        <label for="name">Pseudo</label>
        <input type="text" name="name" id="name">

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id=password>

        <select name="role" id="role">
            <option value="">--Séléctionner un rôle</option>
            <?php foreach ($roles as $role): ?>
                <option value="<?php echo htmlspecialchars($role); ?>">
                    <?php echo htmlspecialchars($role); ?>
                </option>
            <?php endforeach; ?>

        </select>

        <button type="submit" class="px-3 py-1 bg-gray-500 transition duration-500 ease-in-out hover:bg-gray-100 rounded-2xl">S'inscrire</button>

    </form>

    <br>
    <a href="./login-page.php" class="transition duration-500 ease-in-out hover:text-gray-400">Se connecter</a>
</body>

</html>