<?php

namespace App\controllers;


//use App\entities\Good;
//use App\entities\Feedback;
//use App\repositories\GoodRepository;

class GoodController extends Controller
{
    public function oneAction() // Вывод информации об одном товаре на отдельную страницу вместе с отзывами о нём и формой для записи нового отзыва; запись нового отзыва в БД; подсчёт числа просмотров данного товара
    {
        $no_basket = true;
        $no_commet = true;

        $id = 0;
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
        }
        
        $no_commet = $this->addCommet($id); // Запись отзыва пользователя в БД и фиксация этого факта для исключения увеличения числа просмотров в этом случае

        $good = $this->getRepository('Good')->getOne($id); // Получение данных об одном товаре из БД в виде объекта
        
        $this->views($good, $no_commet, $no_basket); // Подсчёт количества просмотров товара

        $this->app->feedback->id_product = $id;

        $feedback = $this->getRepository('Feedback')->getSeveral($this->app->feedback); // Получение данных об отзывах на текущий товар из БД в виде мсссива объектов                                                   
        return $this->render(
            'goodOne',
            [
                'good' => $good,
                'feedback' => $feedback,
                'menu' => $this->getMenu(),
                'title' => $good->name,
            ]
        );
    }

    public function allAction() // Вывод всех товаров из БД на страницу каталога товаров
    {
        $sortby = '';
        if (!empty($_GET['sortby'])) {
            $sortby = (string)$_GET['sortby'];
        }
        
        $goods = $this->getRepository('Good')->getAll($sortby);
                
        return $this->render(
            'goodAll',
            [
                'goods' => $goods,
                'title' => $this->app->getConfig('title'),
                'menu' => $this->getMenu(),
            ]
        );
    }

    public function insertAction() // Добавление нового товара в БД
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //$good = new Good();
            $good = $this->app->good;
            $good->file_name = $_POST['file_name'];
            $good->width = 252;
            $good->product_name = $_POST['product_name'];
            $good->price = $_POST['price'];

            $this->getRepository('Good')->save($good);
            header('Location: /good/all?sortby=views' );
            return '';
        }

        return $this->render(
            'goodAdd',
            [
                'menu' => $this->getMenu(),
            ]
        );
    }

    protected function addCommet($id) // Добавление отзыва в БД
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $commet = $this->app->feedback;
            $commet->author = $_POST['author'];
            $commet->id_product = $id;
            $commet->date = date('Y-m-d H:i');
            $commet->text = $_POST['text'];
            
            $this->getRepository('Feedback')->save($commet);
            return false;
        }
        return true;
    }
    
    protected function views($good, $no_commet, $no_basket) // Подсчёт количества просмотров товара таким образом, чтобы не учитывалась перезагрузка страницы товара (и не добавлялись просмотры) при добавлении отзыва или добавлении товара в корзину
    {
        $sum = 0;
        $arr = $_SESSION['goods'];
        if (!empty($arr)) {
            foreach ($arr as $value) {
                $sum += $value['count'];
            }
        }

        if (!empty($_SESSION['count_sum']) && $sum !== $_SESSION['count_sum']) {
            $no_basket = false;
        }
        $_SESSION['count_sum'] = $sum;

        if ($no_commet && $no_basket) {
            $new_views = $good->views + 1;
            $new_good = $this->app->good;
            $new_good->id = $good->id;
            $new_good->views = $new_views;
            $this->getRepository('Good')->save($new_good);
        }
    }
}