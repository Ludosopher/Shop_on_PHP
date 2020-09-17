<?php

namespace App\controllers;

// use App\entities\Order;
use App\entities\OrderItems;
// use App\repositories\OrderRepository;

class OrderController extends Controller
{
    public function insertAction() // Запись заказа пользователя в таблицы "orders" и "order_items"
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $order = $this->app->order;
            $order->user_id = $_SESSION['user_id'];
            $order->adress = $_POST['adress'];
            $order->date = date('Y-m-d H:i');
            $order->status = 'Предварительная обработка';
            $this->getRepository('Order')->save($order); // Запись нового заказа в таблицу "orders"
            $order_sql = $this->getRepository('Order')->getOneOrder($order->user_id, $order->date); // Получение строки нового заказа из таблицы "orders"
            $orderNumber = $order_sql->id; // Получение id нового заказа
            foreach ($_SESSION['goods'] as $val) {
                $orderItem = new OrderItems();
                $orderItem->order_id = $orderNumber;
                $orderItem->good_id = $val['good']->id;
                $orderItem->count = $val['count'];
                $orderItem->price = $val['good']->price;
                $this->getRepository('OrderItems')->save($orderItem); // Запись заказанных пользователем товаров в таблицу "order_items"
            }
            header('Location: /basket/all');
            return '';
        }

        return $this->render(
            'orderAdd',
            [
                'menu' => $this->getMenu(),
            ]
        );
    }
}