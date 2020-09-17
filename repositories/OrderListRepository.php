<?php
namespace App\repositories;

use App\entities\OrderList;

class OrderListRepository extends Repository
{
    protected function getTableName()
    {
        return 'order_items';
    }

    protected function getEntityName()
    {
        return OrderList::class;
    }
}