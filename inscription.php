<?php
require_once "templates/header.php";
require_once "libs/pdo.php";
require_once "libs/user.php";

if (isLoggedIn()) {
    header("Location:index.php");
}

$errors = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $errors = verifyUser($_POST);

    if (count($errors) === 0) {
        $res = addUser($pdo, $_POST["username"], $_POST["email"], $_POST["password"]);
        if ($res) {
            header("Location:login.php");
        } else {
            $errors["form"] = "Une erreur est survenue pendant l'inscription.";
        }
    }
}

?>

<section class="text-gray-400 bg-gray-900 body-font">
    <form action="" method="post" class="container px-5 py-24 mx-auto flex flex-wrap items-center">
        <div class="lg:w-2/6 md:w-1/2 bg-gray-800 bg-opacity-50 rounded-lg p-8 flex flex-col md:m-auto w-full mt-10 md:mt-0">
            <?php if (isset($errors["form"])): ?>
                <div class="text-red-400">
                    <?= $errors["form"] ?>
                </div>
            <?php endif; ?>
            <h2 class="text-white text-lg font-medium title-font mb-5">Inscription</h2>
            <div class="relative mb-4">
                <label for="username" class="leading-7 text-sm text-gray-400">Pseudo</label>
                <input type="text" id="username" name="username" class="w-full bg-gray-600 bg-opacity-20 focus:bg-transparent focus:ring-2 focus:ring-blue-900 rounded border border-gray-600 focus:border-blue-500 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                <?php if (isset($errors["username"])): ?>
                    <div class="text-red-400">
                        <?= $errors["username"] ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="relative mb-4">
                <label for="email" class="leading-7 text-sm text-gray-400">Email</label>
                <input type="email" id="email" name="email" class="w-full bg-gray-600 bg-opacity-20 focus:bg-transparent focus:ring-2 focus:ring-blue-900 rounded border border-gray-600 focus:border-blue-500 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                <?php if (isset($errors["email"])): ?>
                    <div class="text-red-400">
                        <?= $errors["email"] ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="relative mb-4">
                <label for="password" class="leading-7 text-sm text-gray-400">Mot de passe</label>
                <input type="password" id="password" name="password" class="w-full bg-gray-600 bg-opacity-20 focus:bg-transparent focus:ring-2 focus:ring-blue-900 rounded border border-gray-600 focus:border-blue-500 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                <?php if (isset($errors["password"])): ?>
                    <div class="text-red-400">
                        <?= $errors["password"] ?>
                    </div>
                <?php endif; ?>
            </div>
            <button class="text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">S'inscrire</button>
        </div>
    </form>
</section>

<?php require_once "templates/footer.php" ?>