<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
    <title>AllGames</title>
</head>

<body>
    <header class="text-gray-400 bg-gray-900 body-font">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a href="index.php" class="flex title-font font-medium items-center text-white mb-4 md:mb-0">
                <img src="assets/images/logo-all-games.svg" width="120" alt="logo allgames">
            </a>
            <nav class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center">
                <a href="index.php" class="mr-5 hover:text-white">Accueil</a>
                <a href="jeux.php" class="mr-5 hover:text-white">Liste des jeux</a>
                <?php if (isLoggedIn()): ?>
                    <a href="ma_liste.php" class="mr-5 hover:text-white">Ma liste</a>
                <?php endif; ?>
            </nav>
            <?php if (isLoggedIn()): ?>
                <a href="logout.php" class="mr-3 inline-flex items-center bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 rounded text-base mt-4 md:mt-0">Déconnexion
                </a>
            <?php else: ?>
                <a href="inscription.php" class="mr-3 inline-flex items-center bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 rounded text-base mt-4 md:mt-0">Inscription
                </a>
                <a href="login.php" class="inline-flex items-center bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 rounded text-base mt-4 md:mt-0">Connexion
                </a>
            <?php endif; ?>

        </div>
    </header>