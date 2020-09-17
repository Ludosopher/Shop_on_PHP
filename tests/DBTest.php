<?php

namespace App\tests;

use App\services\DB;
use PHPUnit\Framework\TestCase;

class DBTest extends TestCase
{
    
    public function testqueryObject()
    {
        $table_name = 'images';
        $id = 1;
        $property_1 = 'T-shirt';
        $property_2 = '400';
                
        $entity = Good::class;
        $sql = "SELECT * FROM {$table_name} WHERE id = :id";
        $params = [':id' => $id];
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

        $this->assertEquals($property_1, $obj[3]);
        $this->assertEquals($property_2, $obj[4]);
    }

    public function testqueryObjects()
    {
        $table_name = 'images';
        $property_1 = 'T-shirt';
        $property_2 = '400';
                
        $entity = Good::class;
        $sql = "SELECT * FROM {$table_name}";
        $config = [
            'driver' => 'mysql',
            'host' => 'localhost',
            'dbname' => 'shop',
            'charset' => 'UTF8',
            'username' => 'root',
            'password' => '',
        ];

        $db = new DB($config);
        $arr = $db->queryObjects($sql,$entity);

        $this->assertEquals($property_1, $arr[0][3]);
        $this->assertEquals($property_2, $arr[0][4]);
    }

    public function testfind()
    {
        $table_name = 'images';
        $id = 1;
        $property_1 = 'T-shirt';
        $property_2 = '400';
        
        $sql = "SELECT * FROM {$table_name} WHERE id = :id";
        $params = [':id' => $id];
        $config = [
            'driver' => 'mysql',
            'host' => 'localhost',
            'dbname' => 'shop',
            'charset' => 'UTF8',
            'username' => 'root',
            'password' => '',
        ];

        $db = new DB($config);
        $arr = $db->find($sql,$params);

        $this->assertEquals($property_1, $arr['product_name']);
        $this->assertEquals($property_2, $arr['price']);
    }
}