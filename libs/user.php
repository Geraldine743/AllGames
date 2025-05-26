<?php

function addUser(PDO $pdo, string $username, string $email, string $password): bool
{
    $query = $pdo->prepare("INSERT INTO `user` (`email`, `password`, `username`) VALUES (:email, :password, :username)");

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query->bindValue(':email', $email);
    $query->bindValue(':username', $username);
    $query->bindValue(':password', $password);

    return $query->execute();
}


function verifyUser(array $user): array
{
    $errors = [];

    if (isset($user["username"])) {
        if ($user["username"] === "") {
            $errors["username"] = "Veuillez saisir un pseudo.";
        }
    } else {
        $errors["username"] = "Il manque le champ pseudo";
    }

    if (isset($user["email"])) {
        if ($user["email"] === "") {
            $errors["email"] = "Veuillez saisir un email.";
        }
    } else {
        $errors["email"] = "Il manque le champ email";
    }

    if (isset($user["password"])) {
        if ($user["password"] === "") {
            $errors["password"] = "Veuillez saisir un mot de passe.";
        }
    } else {
        $errors["password"] = "Il manque le champ mot de passe";
    }

    return $errors;
}
