<?php


namespace App\Model;

class UserManager extends AbstractManager
{
    const TABLE = 'user';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $item
     * @return int
     */
    public function insert(array $userData): int
    {
        $statement = $this->pdo->prepare("
            INSERT INTO " . self::TABLE . " (`name`, `password`) 
            VALUES (:name, :password)");
        $statement->bindValue(':name', $userData['username'], \PDO::PARAM_STR);
        $statement->bindValue(':password', $userData['password'], \PDO::PARAM_STR);
        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

    public function selectOneByName(string $username)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE name=:username");
        $statement->bindValue(':username', $username, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }
}
