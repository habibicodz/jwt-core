<?php
namespace App\utils;

use PDO;
use Throwable;

class DBUtil
{
    private static $dsn = "sqlite:/home/gemini/Desktop/practice/web/jwt/db/sql.db";

    public static function checkDBConnectivity(): bool
    {
        try {
            new PDO(
                self::$dsn,
                null,
                null,
                options: array(PDO::ATTR_PERSISTENT => true)
            );
            return true;
        } catch (Throwable $th) {
            return false;
        }
    }

    public static function createUser(string $fullName, string $username, string $password): bool
    {
        $sql = "INSERT INTO users(fullname, username, password) values (?, ?, ?)";
        $pdo = new PDO(
            self::$dsn,
            null,
            null,
            options: array(PDO::ATTR_PERSISTENT => true)
        );

        $result = $pdo->prepare($sql)->execute([$fullName, $username, $password]);
        error_log("Statement: $result");
        return $result;
    }
}

?>