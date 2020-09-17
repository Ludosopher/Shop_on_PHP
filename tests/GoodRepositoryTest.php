<?php

namespace App\tests;

use App\services\DB;
use PHPUnit\Framework\TestCase;

class GoodRepositoryTest extends TestCase
{
    
    public function testgetOne()
    {
        $id_product = 1;
        $product_name = 'T-shirt';
        $product_price = '400';
        
        $good = Good::class;
        $sql = "SELECT * FROM images WHERE id = :id";
        $params = [':id' => $id_product];
        $config = [
            'driver' => 'mysql',
            'host' => 'localhost',
            'dbname' => 'shop',
            'charset' => 'UTF8',
            'username' => 'root',
            'password' => '',
        ];

        $db = new DB($config);
        $obj = $db->queryObject($sql,$good,$params);
        
        $this->assertEquals($product_name, $obj[3]);
        $this->assertEquals($product_price, $obj[4]);
    }

    public function testgetOneOrder()
    {
        $user_id = 27;
        $order_date = '2020-05-19 12:36:00';
        $entity = Order::class;
        $sql = "SELECT * FROM orders WHERE user_id = :id AND date = :date";
        $params = [
            ':id' => $user_id,
            ':date' => $order_date
            ];
        $config = [
            'driver' => 'mysql',
            'host' => 'localhost',
            'dbname' => 'shop',
            'charset' => 'UTF8',
            'username' => 'root',
            'password' => '',
        ];

        $db = new DB($config);
        $obj = $db->queryObject($sql,$entity,$params);

        $order_status = 'Предварительная обработка';
        $this->assertEquals($order_status, $obj[4]);
    }

    public function testgetOrdersItems()
    {
        $user_id = 27;
        $entity = OrderItems::class;
        $sql = "SELECT images.product_name, images.file_name, order_items.price, order_items.count, order_items.order_id, orders.user_id, orders.date, orders.status 
            FROM order_items 
            INNER JOIN orders ON orders.id = order_items.order_id 
            INNER JOIN images ON images.id = order_items.good_id WHERE user_id = :id";
        $params = [':id' => $user_id];
        $config = [
            'driver' => 'mysql',
            'host' => 'localhost',
            'dbname' => 'shop',
            'charset' => 'UTF8',
            'username' => 'root',
            'password' => '',
        ];

        $db = new DB($config);
        $arr = $db->queryObjects($sql, $entity, $params);

        $product_name = 'T-shirt';
        $price = '400';
        $status = 'Предварительная обработка';

        $this->assertEquals($product_name, $arr[0][0]);
        $this->assertEquals($price, $arr[0][2]);
        $this->assertEquals($status, $arr[0][7]);
    }

    
}