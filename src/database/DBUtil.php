<?php
namespace App\database;

use PDO;
use Throwable;

class DBUtil
{
    private const DSN = "sqlite:" . __DIR__ . "/../../sql.db";

    public static function checkDBConnectivity(): bool
    {
        try {
            error_log("Path: " . self::DSN);
            new PDO(
                self::DSN,
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
        error_log("Path: " . self::DSN);

        $hashed_password = hash('sha256', $password);
        $sql = "INSERT INTO users(fullname, username, password) values (?, ?, ?)";
        $pdo = new PDO(
            self::DSN,
            null,
            null,
            options: array(PDO::ATTR_PERSISTENT => true)
        );

        $result = $pdo->prepare($sql)->execute([$fullName, $username, $hashed_password]);
        error_log("Statement: $result");
        return $result;
    }

    public static function verifyUser(string $username, string $password): mixed
    {
        $hashed_password = hash('sha256', $password);
        $sql = "SELECT * FROM users WHERE username=? and password=? LIMIT 1";
        try {
            $pdo = new PDO(self::DSN, null, null, options: array(PDO::ATTR_PERSISTENT => true));
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username, $hashed_password]);
            $result = $stmt->fetch(mode: PDO::FETCH_OBJ);
            return $result;
        } catch (Throwable $th) {
            return false;
        }
    }
}

?>