<?php
require_once "libs/session.php";
require_once "libs/pdo.php";
require_once "libs/wishlist.php";
require_once "libs/game.php";
require_once "templates/header.php";

$error404 = false;
$wishlistItem = false;
if (isset($_GET["id"])) {
    $id = (int)$_GET["id"];
    $game = getGame($pdo, $id);
    if (!$game) {
        $error404 = true;
    } else {
        if (isset($_GET["addToWishlist"]) && isLoggedIn()) {
            $user = getConnectedUser();
            addToWishlist($pdo, $id, (int)$user["id"]);
        }
        if (isset($_GET["removeFromWishlist"]) && isLoggedIn()) {
            $user = getConnectedUser();
            removeFromWishlist($pdo, $id, (int)$user["id"]);
        }
        if (isLoggedIn()) {
            $user = getConnectedUser();
            $wishlitItem = getWishlistItemByGameIdAndUserId($pdo, $id, (int)$user["id"]);
        }
    }
} else {
    $error404 = true;
}


?>



<section class="text-gray-400 bg-gray-900 body-font h-svh">
    <?php if ($error404): ?>
        <div class="flex justify-center">
            <div class="text-red-400 text-4xl">
                Jeu introuvable
            </div>
        </div>

    <?php else: ?>

        <div class="container px-5 pt-10 mx-auto flex flex-wrap">
            <h1 class="title-font font-medium text-3xl mb-2 text-white"><?= $game["name"] ?></h1>
        </div>
        <div class="container px-5 py-4 mx-auto flex flex-wrap">
            <div class="lg:w-1/2 sm:w-2/3 w-full overflow-hidden mt-6 mr-6 sm:mt-0">
                <img class="object-cover object-center w-full h-full" src="https://dummyimage.com/600x300" alt="stats">
            </div>
            <div class="flex flex-wrap -mx-4 lg:w-1/2 sm:w-1/3 content-start sm:pr-10">
                <div class="w-full px-4 mb-35">
                    <img class="object-cover object-center w-full h-full mb-5" src="https://dummyimage.com/450x200" alt="stats">
                    <div class="flex flex-wrap">
                        <div class="p-4 sm:w-1/2 lg:w-1/4 w-1/2">
                            <h2 class="title-font font-medium text-sm text-white">Très positives</h2>
                            <p class="leading-relaxed">Evaluations</p>
                        </div>
                        <div class="p-4 sm:w-1/2 lg:w-1/4 w-1/2">
                            <h2 class="title-font font-medium text-sm text-white">1.2k</h2>
                            <p class="leading-relaxed">Favoris</p>
                        </div>
                        <div class="p-4 sm:w-1/2 lg:w-1/4 w-1/2">
                            <h2 class="title-font font-medium text-sm text-white"><?= $game["release_date"] ?></h2>
                            <p class="leading-relaxed">Sortie</p>
                        </div>
                        <div class="p-4 sm:w-1/2 lg:w-1/4 w-1/2">
                            <h2 class="title-font font-medium text-sm text-white"><?= $game["editor_name"] ?></h2>
                            <p class="leading-relaxed">Editeur</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container px-5 pt-10 mx-auto flex flex-wrap">
            <div class="leading-relaxed mb-10"><?= $game["description"] ?></div>
            <?php if (isLoggedIn()): ?>
                <?php if ($wishlitItem): ?>
                    <a href="jeu.php?id=<?= $id ?>&removeFromWishlist" class="inline-flex items-center text-white bg-blue-500 border-0 py-2 px-3 focus:outline-none hover:bg-blue-600 rounded text-lg">
                        <svg class="mr-1.5 -ml-0.5 size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg>
                        Déjà dans votre liste
                    </a>
                <?php else: ?>
                    <a href="jeu.php?id=<?= $id ?>&addToWishlist" class="inline-flex items-center text-white bg-blue-500 border-0 py-2 px-3 focus:outline-none hover:bg-blue-600 rounded text-lg">
                        Ajouter à la liste
                    </a>
                <?php endif; ?>
            <?php else: ?>
                <div class="leading-relaxed mb-10">Veuillez vous <a class="text-white underline" href="login.php">connecter</a> pour ajouter ce jeu à votre liste de souhait</div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>



<?php require_once "templates/footer.php" ?>