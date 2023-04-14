<?php

namespace app\core;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;

    public abstract function attributes(): array;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn ($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES (" . implode(',', $params) . ") ;");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();

        return true;
        // echo '<pre>';
        // var_dump($statement, $params, $attributes);
        // echo '</pre>';
        // exit;
    }

    public function findOne($fields)
    {
        $tableName = static::tableName();
        $attributes = array_keys($fields);
        $logic = implode("AND ", array_map(fn ($attr) => "$attr = :$attr", $attributes));

        $statement = self::prepare("SELECT * FROM $tableName WHERE $logic LIMIT 1");

        foreach ($fields as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public function delete($fields)
    {
        $tableName = static::tableName();
        $attributes = array_keys($fields);
        $logic = implode("AND ", array_map(fn ($attr) => "$attr = :$attr", $attributes));

        $statement = self::prepare("DELETE * FROM $tableName WHERE $logic");

        return $statement->execute();
    }

    public function getAll()
    {
        $tableName = static::tableName();

        $sql = "SELECT * FROM $tableName ;";
        $statement = self::prepare($sql);
        $statement->execute();
        // return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}
