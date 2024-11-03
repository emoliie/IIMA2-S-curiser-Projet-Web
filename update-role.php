<?php

require_once './bdd.php';

if($_POST['role'] == '') {
    echo '<p>Pas de rôle séléctionné</p>';
    return;
}

$updatedRole = "UPDATE `user` SET `role`= :role WHERE `id` = :id";

$request = $database->prepare($updatedRole);

$request->execute(
    [
        'id' => $_POST['user_id'],
        'role' => $_POST['role']
    ]
);

header('Location: pages/article-page.php');
