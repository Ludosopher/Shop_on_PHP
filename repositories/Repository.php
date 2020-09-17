<?php

namespace App\repositories;

use App\core\Container;
use App\entities\Entity;
use App\entities\OrderList;
use App\services\DB;

abstract class Repository
{
    /**
     * @var DB
     */
    protected $db;

    /**
     * @var Container
     */
    protected $container;

    abstract protected function getTableName();
    abstract protected function getEntityName();

    public function setContainer(Container $container)
    {
        $this->container = $container;
        $this->setDB();
    }

    private function setDB() 
    {
        $this->db = $this->container->db;
    }

    public function getOne($id) // Получение одной строки из БД по "id"
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        $params = [':id' => $id];
        return $this->db->queryObject($sql, $this->getEntityName(), $params);
    }

    public function getSeveral($entity) // Получение нескольких строк из БД по одному или нескольким условиям
    {
        $placeholders = [];
        $params = [];
        foreach ($entity as $fieldName => $value) {
            if (!empty($value)) {
                $params[':' . $fieldName] = $value;
                $placeholders[] = " $fieldName = :$fieldName";
            }
            if ($fieldName == 'id') {
                continue;
            }
        }
        $tableName = $this->getTableName();
        $conditions = implode(' AND ', $placeholders);
        $sql = "SELECT * FROM {$tableName} WHERE {$conditions} ORDER BY date DESC";
        
        return $this->db->queryObjects($sql, $this->getEntityName(), $params);
    }

    public function getAll($sortby) // Получение всех строк таблицы БД
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} ORDER BY {$sortby} DESC";
        return $this->db->queryObjects($sql, $this->getEntityName());
    }

    public function getOrdersItems($user_id) // Получение одной строки из объединённой таблицы ("orders"+"images"+"order_items") по "id" пользователя
    {
        $tableName = $this->getTableName();
        $sql = "SELECT images.product_name, images.file_name, order_items.price, order_items.count, order_items.order_id, orders.user_id, orders.date, orders.status 
                FROM {$tableName} 
                    INNER JOIN orders ON orders.id = order_items.order_id 
                    INNER JOIN images ON images.id = order_items.good_id WHERE user_id = :id";
        $params = [':id' => $user_id];
        return $this->db->queryObjects($sql, $this->getEntityName(), $params);
    }

    protected function insert(Entity $entity) // Запись в БД новой строки
    {
        $columns = [];
        $params = [];
        foreach ($entity as $fieldName => $value) {
            if ($fieldName == 'id') {
                continue;
            }
            $columns[] = $fieldName;
            $params[':' . $fieldName] = $value;
        }

        $tableName = $this->getTableName();
        $sql = "INSERT INTO {$tableName} 
                    (" . implode(', ', $columns) . ")
                VALUES 
                (" . implode(', ', array_keys($params)) . ")
                ";
        $this->db->exec($sql, $params);
        $entity->id =$this->db->lastInsertId();
    }

    protected function update(Entity $entity) // Обновление содержимого одной или нескольких ячеек в строке БД
    {
        $placeholders = [];
        $params = [];
        foreach ($entity as $fieldName => $value) {
            if (!empty($value)) {
                $params[':' . $fieldName] = $value;
                $placeholders[] = " $fieldName = :$fieldName";
            }
            if ($fieldName == 'id') {
                continue;
            }
        }

        $tableName = $this->getTableName();
        $sql = "
            UPDATE {$tableName} SET " . implode(', ', $placeholders) ." WHERE id = :id
        ";

        $this->db->exec($sql, $params);
    }

    public function delete(Entity $entity) // Удаление стороки в БД
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        $this->db->exec($sql, [':id' => $entity->id]);
    }

    public function save(Entity $entity) // Выбор между вводом новой строки или обновлением существующей
    {
        if (empty($entity->id)) {
            $this->insert($entity);
        }
        $this->update($entity);
    }
  
}