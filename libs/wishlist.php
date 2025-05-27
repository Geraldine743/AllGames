<?php

function addToWishlist(PDO $pdo, int $gameId, int $userId): bool
{
    $sql = "INSERT INTO wishlist (game_id, user_id, created_at)
            VALUE (:gameId, :userId, NOW())";
    $query = $pdo->prepare($sql);
    $query->bindValue(':gameId', $gameId, PDO::PARAM_INT);
    $query->bindValue(':userId', $userId, PDO::PARAM_INT);

    return $query->execute();
}
