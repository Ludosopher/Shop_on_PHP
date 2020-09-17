<?php

namespace App\controllers;

// use App\entities\Good;
// use App\repositories\GoodRepository;

class BasketController extends Controller
{
    protected $defaultAction = 'all';
        
    public function addAction()
    {
        $request = $this->app->request;
        /**@var GoodRepository $goodRepository*/
        $goodRepository = $this->getRepository('Good');
        $hasAdd = $this->app->basketServices->add($request, $goodRepository);
        
        //$_POST['no_view'] = true;

        if (!$hasAdd) {
            return $this->render('404');
        }

        $request->redirectApp('Товар добавлен в корзину');
        return '';
    }

    public function allAction()
    {
        return $this->render(
            'basketAll',
            [
                'arr' => $_SESSION,
                'title' => $this->app->getConfig('title'),
                'menu' => $this->getMenu(),
            ]
        );
    }

    public function deleteAction()
    {
        $request = $this->app->request;
        $goodRepository = $this->getRepository('Good');
        $hasAdd = $this->app->basketServices->delete($request, $goodRepository);

        if (!$hasAdd) {
            return $this->render('404');
        }

        $request->redirectApp('');
        return '';
    }

}