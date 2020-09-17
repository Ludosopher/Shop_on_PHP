<?php
namespace App\entities;

class OrderList extends Entity
{
    public $product_name;
    public $file_name;
    public $price;
    public $count;
    public $order_id;
    public $user_id;
    public $date;
    public $status;
}
