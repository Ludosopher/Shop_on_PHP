<?php

namespace App\controllers;


// use App\entities\User;
// use App\entities\Order;
// use App\repositories\UserRepository;

class UserController extends Controller
{
    public function oneAction() // Вывод информации об одном пользователе
    {
        $id = 0;
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
        }

        $user = $this->getRepository('User')->getOne($id);

        return $this->render(
            'userOne',
            [
                'user' => $user,
                'menu' => $this->getMenu(),
                'title' => $user->name,
            ]
        );
    }

    public function allAction() // Вывод информации обо всех пользователях
    {
        $sortby = '';
        if (!empty($_GET['sortby'])) {
            $sortby = (string)$_GET['sortby'];
        }

        $users = $this->getRepository('User')->getAll($sortby);
        return $this->render(
            'userAll',
            [
                'users' => $users,
                'title' => $this->app->getConfig('title'),
                'menu' => $this->getMenu(),
            ]
        );
    }

    public function insertAction() // Добавление нового пользователя в БД
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $this->app->user;
            $user->name = $_POST['name'];
            $user->login = $_POST['login'];
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user->date = $_POST['date'];

            $this->getRepository('User')->save($user);
            header('Location: /user/auth' );
            return '';
        }

        return $this->render(
            'userAdd',
            [
                'menu' => $this->getMenu(),
            ]
        );
    }

    public function authAction() // Аутентификация пользователя
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $this->app->user;
            $user->login = $_POST['login'];
            
            $userDB = $this->getRepository('User')->getSeveral($user);
            
            if (password_verify($_POST['password'], $userDB[0]->password)) {
                $_SESSION['auth'] = true;
                $_SESSION['is_admin'] = $userDB[0]->is_admin;
                $_SESSION['user_id'] = $userDB[0]->id;
                $_SESSION['user_name'] = $userDB[0]->name;
                $user->name = $userDB[0]->name;
            } else {
                return $this->render(
                    'no_password',                                    // Вывод в случае неверного логина и(или) пароля
                    [
                        'menu' => $this->getMenu(),
                    ]
                );
            }
        }
        $user = $this->app->user;
        if (!empty($_SESSION['user_name'])) {$user->name = $_SESSION['user_name'];}
        if (!empty($_SESSION['auth']) && $_SESSION['is_admin'] == 'admin') {
             return $this->render(                                     // Вывод личного кабинета администратора
                'admin',
                [
                    'user' => $user,
                    'title' => $this->app->getConfig('title'),
                    'menu' => $this->getMenu(),
                 ]
            );
        }

        if (!empty($_SESSION['auth']) && $_SESSION['is_admin'] != 'admin') {
              return $this->render(
                   'userOne',                                            // Вывод личного кабинета обычного пользователя
                   [
                     'user' => $user,
                     'title' => $this->app->getConfig('title'),
                     'menu' => $this->getMenu(),
                   ]
            );
        }
            
        return $this->render(
            'userAuth',                                                   // Вывод формы для введения логина и пароля
            [
                'menu' => $this->getMenu(),
            ]
        );
    }

    public function ordersItemsAction() // Вывод списка заказанных определённым пользователем товаров из объединённых таблиц "orders", "images" и "order_items"
    {
        $id = 0;
        if (!empty($_SESSION['user_id'])) {
            $user_id = (int)$_SESSION['user_id'];
        }
        $orders = $this->getRepository('OrderList')->getOrdersItems($user_id); 
        
        return $this->render(
            'userOrdersItems',
            [
                'orders' => $orders,
                'title' => $this->app->getConfig('title'),
                'menu' => $this->getMenu(),
            ]
        );
    }

    public function ordersAction() // Вывод списка заказов из таблицы "orders" для администратора с возможностью изменять статус заказа
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $order = $this->app->order;
            $order->status = $_POST['status'];
            $order->id = $_GET['order_id'];
            $this->getRepository('Order')->save($order);
        }

        $sortby = '';
        if (!empty($_GET['sortby'])) {
            $sortby = (string)$_GET['sortby'];
        }
        
        $orders = $this->getRepository('Order')->getAll($sortby);
        return $this->render(
            'orderAll',
            [
                'orders' => $orders,
                'title' => $this->app->getConfig('title'),
                'menu' => $this->getMenu(),
            ]
        );
    }

    public function exitAction()   // Выход из личного кабинета
    {
        $request = $this->app->request;
        $request->sessionDestroy();

        return $this->mainAction();
    } 
}