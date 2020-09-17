<?php
namespace App\entities;

class OrderItems extends Entity
{
    public $id;
    public $order_id;
    public $good_id;
    public $count;
    public $price;

    
}
