<?php

class m0001_initial {
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE users (
                id int AUTO_INCREMENT PRIMARY KEY,
                email varchar(255) NOT NULL,
                name varchar(255) NOT NULL,
                password varchar(255) NOT NULL,
                created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP                
                ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE users;";
        $db->pdo->exec($SQL);
    }
}
