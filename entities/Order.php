<?php
namespace App\entities;

class Order extends Entity
{
    public $id;
    public $user_id;
    public $adress;
    public $date;
    public $status;
}
