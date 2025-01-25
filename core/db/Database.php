<?php

namespace app\core\db;

use app\core\Application;

class Database
{
    public \PDO $pdo;
    
    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigration()
    {
        $this->createMigrationTable();
        $appliedMigration = $this->getAppliedMigration();

        $newMigration = [];
        if (!empty($newMigration)) {
            $files = scandir(Application::$ROOT_DIR . '/migration');
            $toAppliedMigration = array_diff($files, $appliedMigration);
            foreach ($toAppliedMigration as $migration) {
                if ($migration === '.' || $migration === '..') {
                    continue;
                }
                require_once Application::$ROOT_DIR . '/migration/'.$migration;
                $className = pathinfo($migration, PATHINFO_FILENAME);
                $instance = new $className();
                $this->log("Applying migration $migration");
                $instance->up();
                $this->log("Applied migration $migration");
            }
            $this->saveMigration($newMigration);
        }else {
            $this->log("All migrations were applied");
        }
    }

    public function createMigrationTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    public function getAppliedMigration()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigration(array $migration)
    {
        $str = implode(", " , array_map(fn($m) => "('$m')", $migration));
        $this->pdo->prepare("INSERT INTO migrations (migration) VALUES
            $str
            ");
    }
    protected function log($message)
    {
        echo '[' . date('Y-m-d H:i:s') . '] - ' . $message . PHP_EOL;
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

}