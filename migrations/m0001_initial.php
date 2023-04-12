<?php
class m0001_initial
{
    public function up()
    {
        $db = \app\core\Application::$app->db;

        $sql = "CREATE TABLE users(
        id INT AUTO_INCREMENT PRIMARY KEY, 
        email VARCHAR(255) NOT NULL, 
        firstName VARCHAR(255) NOT NULL, 
        lastName VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        status TINYINT NOT NULL DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )ENGINE=INNODB;";

        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;

        $sql = "DROP TABLE users ;";

        $db->pdo->exec($sql);
    }
}
