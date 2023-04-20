<?php
declare(strict_types=1);

namespace App\Database;

use App\Model\Product;

class ProductTable
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function list(): array
    {
        $query = <<<SQL
            SELECT title, subtitle, price, image_url
            FROM product
            ORDER BY id
        SQL;
        $statement = $this->connection->query($query);
        $result = $statement->fetchAll();

        return $result; 
    }
}