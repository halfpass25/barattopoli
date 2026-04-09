<?php

class Database
{
    private static ?Database $instance = null;
    private PDO $pdo;

    // Costruttore privato
    private function __construct(array $config)
    {
        $this->pdo = new PDO(
            $config['dsn'],
            $config['username'],
            $config['password'],
            $config['options'] ?? []
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    // Singleton: ora $config è opzionale
    public static function getInstance(array $config = []): Database
    {
        if (self::$instance === null) {

            // Se non è passato nessun config, usiamo valori di default presi da config.php
            if (empty($config)) {
                $config = [
                    'dsn'      => DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME,
                    'username' => DB_USER,
                    'password' => DB_PASS,
                    'options'  => []
                ];
            }

            self::$instance = new self($config);
        }

        return self::$instance;
    }

    // Query statiche
    public function execute(string $sql): PDOStatement
    {
        return $this->pdo->query($sql);
    }

    // Prepared statement con parametri
    public function prepareAndExecute(string $sql, array $params): PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    // Metodi di fetch
    public function fetchOne(string $sql, array $params = []): array|false
    {
        if (empty($params)) {
            return $this->execute($sql)->fetch();
        }
        return $this->prepareAndExecute($sql, $params)->fetch();
    }

    public function fetchAll(string $sql, array $params = []): array
    {
        if (empty($params)) {
            return $this->execute($sql)->fetchAll();
        }
        return $this->prepareAndExecute($sql, $params)->fetchAll();
    }

    public function write(string $sql, array $params = []): bool
    {
        if (empty($params)) {
            return (bool) $this->execute($sql);
        }
        return $this->prepareAndExecute($sql, $params) ? true : false;
    }
}
