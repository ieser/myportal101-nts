<?php
namespace Core\Base;

class Database {
    private static $connections = []; // Array per gestire più connessioni
    private static $defaultAlias = "main"; // Alias di default
    private $connection; // Connessione PDO per l'istanza corrente

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public static function sql($alias = null) {
        $alias = $alias ?: self::$defaultAlias;
        $configFilePath = APP_PATH . '/Config/databases.php';

        if (!file_exists($configFilePath)) {
            throw new \Exception('Database config file not found.');
        }

        $config = include($configFilePath);

        if (!isset($config[$alias])) {
            throw new \Exception("Database alias '{$alias}' not found in config.");
        }

        $pdo = self::connect($alias, $config[$alias]);
        return new self($pdo); // Restituisce un'istanza di Database
    }

    private static function connect($alias, $config) {
        if (!isset(self::$connections[$alias])) {
            try {
                if ($config["dbtype"] === "mysql") {
                    $dsn = "mysql:host={$config['dbhost']};dbname={$config['dbname']};port={$config['dbport']}";
                    $pdo = new \PDO($dsn, $config['dbusr'], $config['dbpwd']);
                } elseif ($config["dbtype"] === "sqlsrv") {
                    $dsn = "sqlsrv:server={$config['dbhost']};Database={$config['dbname']}";
                    $pdo = new \PDO($dsn, $config['dbusr'], $config['dbpwd']);
                } else {
                    throw new \Exception("Unsupported database type '{$config['dbtype']}' for alias '{$alias}'.");
                }

                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$connections[$alias] = $pdo;
            } catch (\PDOException $e) {
                throw new \Exception("Connection failed for alias '{$alias}': " . $e->getMessage());
            }
        }

        return self::$connections[$alias];
    }

    public function insert($statement, $parameters = []) {
        try {
            $stmt = $this->execute($statement, $parameters);
            return $this->connection->lastInsertId();
        } catch (\Exception $e) {
            throw new \Exception("Insert failed: " . $e->getMessage());
        }
    }

    public function select($statement, $parameters = []) {
        try {
            $stmt = $this->execute($statement, $parameters);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception("Select failed: " . $e->getMessage());
        }
    }

    public function update($statement, $parameters = []) {
        try {
            $this->execute($statement, $parameters);
        } catch (\Exception $e) {
            throw new \Exception("Update failed: " . $e->getMessage());
        }
    }

    public function delete($statement, $parameters = []) {
        try {
            $this->execute($statement, $parameters);
        } catch (\Exception $e) {
            throw new \Exception("Delete failed: " . $e->getMessage());
        }
    }

    public function create($statement, $parameters = []) {
        try {
            $this->execute($statement, $parameters);
        } catch (\Exception $e) {
            throw new \Exception("Create failed: " . $e->getMessage());
        }
    }
    private function execute($statement, $parameters = []) {
        try {
            $stmt = $this->connection->prepare($statement);
            $stmt->execute($parameters);
            return $stmt;
        } catch (\PDOException $e) {
            throw new \Exception("Execution failed: " . $e->getMessage());
        }
    }
}
