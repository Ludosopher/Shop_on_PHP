<?php
namespace App\repositories;

use App\entities\Order;

class OrderRepository extends Repository
{
    protected function getTableName()
    {
        return 'orders';
    }

    protected function getEntityName()
    {
        return Order::class;
    }

    public function getOneOrder($user_id, $order_date) // Получение заказа по имени заказчика и дате.
    {
        $sql = "SELECT * FROM orders WHERE user_id = :id AND date = :date";
        return $this->db->queryObject($sql, $this->getEntityName(), [
            ':id' => $user_id,
            ':date' => $order_date
        ]);
    }
}