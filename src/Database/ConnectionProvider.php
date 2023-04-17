<?php
declare(strict_types=1);

namespace App\Database;

class ConnectionProvider
{
    public static function connectDatabase(): \PDO
    {
        $connectionParams = self::getConnectionParams();
        $dsn = $connectionParams['dsn'];
        $user = $connectionParams['user'];
        $password = $connectionParams['password'];
        return new \PDO($dsn, $user, $password);
    }

    /**
    * @return array{dsn:string,username:string,password:string}
    */
    private static function getConnectionParams(): array
    {
        $stringParams = file_get_contents(__DIR__ . "/configuration.json");
        $arrayParams = json_decode($stringParams, true);
        return $arrayParams;
    }
}