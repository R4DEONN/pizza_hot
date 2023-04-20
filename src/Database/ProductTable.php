<?php
declare(strict_types=1);

namespace App\Database;

use App\Model\Product;
use http\Exception\RuntimeException;

class ProductTable
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return Product[]
     */
    public function list(): array
    {
        $query = <<<SQL
            SELECT
                id, 
                title, 
                subtitle, 
                price, 
                image_url
            FROM 
                product
            ORDER BY id
        SQL;
        $statement = $this->connection->query($query);
        $rows = $statement->fetchAll();

        $products = [];
        foreach ($rows as $row)
        {
            $products[] = $this->createProductFromRow($row);
        }

        return $products;
    }

    /**
     * @param int $productId
     * @return Product
     */
    public function productById(int $productId): Product
    {
        $query = <<<SQL
            SELECT
                id,
                title,
                subtitle,
                price,
                image_url
            FROM
                product
            WHERE id = :id
        SQL;
        $statement = $this->connection->prepare($query);
        $statement->execute([
            ':id' => $productId
        ]);
        $product = $statement->fetch(\PDO::FETCH_ASSOC);
        if (!$product) {
            throw new RuntimeException("Product with
             id $productId could not be found");
        }

        return $this->createProductFromRow($product);
    }

    /**
     * @param array $row
     * @return Product
     */
    private function createProductFromRow(array $row): Product
    {
        return new Product(
            (int)$row['id'],
            $row['title'],
            $row['subtitle'],
            $row['price'],
            $row['image_url']
        );
    }
}