<?php
namespace App\entities;

class User extends Entity
{
    public $id;
    public $is_admin;
    public $name;
    public $login;
    public $password;
    public $date;
}