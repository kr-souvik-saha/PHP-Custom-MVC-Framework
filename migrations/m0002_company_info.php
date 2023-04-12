<?php
class m0002_company_info
{
    public function up()
    {
        $db = \app\core\Application::$app->db;

        $sql = "CREATE TABLE company_info(
            id   INT(12)            AUTO_INCREMENT PRIMARY KEY,
            org_name VARCHAR (120),
            org_gstin  VARCHAR(24),
            prop_name  VARCHAR(120),
            cin_no     VARCHAR(24),
            contact_no     VARCHAR(30),
            alt_contact_no    VARCHAR(30),
            email_id      VARCHAR(120),
            state_is    VARCHAR(120),
            dist_is     VARCHAR(120),
            area_is     VARCHAR(120),
            address_is    TEXT,
            pin_is      INT(7),
            bank_name      VARCHAR(36),
            ac_no    VARCHAR(24),
            branch_name    VARCHAR(24),
            ifsc_is     VARCHAR(12),
            upi_id      VARCHAR(120),
            fb_link     VARCHAR(120),
            twitter_link      VARCHAR(120),
            insta_link     VARCHAR(120),
            linkend_link      VARCHAR(120),
            yt_link     VARCHAR(120),
            brand_name     VARCHAR(120),
            brand_logo     VARCHAR(240),
            brand_desc     LONGTEXT
         )ENGINE=INNODB;";

        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;

        $sql = "DROP TABLE company_info ;";

        $db->pdo->exec($sql);
    }
}
