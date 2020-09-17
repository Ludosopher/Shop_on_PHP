<?php
namespace App\repositories;

use App\entities\OrderItems;

class OrderItemsRepository extends Repository
{
    protected function getTableName()
    {
        return 'order_items';
    }

    protected function getEntityName()
    {
        return OrderItems::class;
    }
}