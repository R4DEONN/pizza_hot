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

    public function getAllProduct(): array
    {
        $query = <<<SQL
            SELECT title, subtitle, price, image_url
            FROM product
            ORDER BY id
        SQL;
        $statment = $this->connection->query($query);
        $result = $statment->fetchAll();

        return $result; 
    }
}