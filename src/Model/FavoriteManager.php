<?php


namespace App\Model;


class FavoriteManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'user_item';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insert(array $favoriteData) : void
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`user_id`, `item_id`) 
        VALUES (:user, :item)");

        $statement->bindValue(':user', $favoriteData['user'], \PDO::PARAM_INT);
        $statement->bindValue(':item', $favoriteData['item'], \PDO::PARAM_INT);

        $statement->execute();
    }
}
