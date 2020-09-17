<?php

namespace App\controllers;

use App\core\App;
use App\services\renderers\IRenderer;
use App\services\renderers\TmplRenderer;

abstract class Controller
{
    protected $defaultAction = 'main';

    /**
     * @var TmplRenderer
     */
    protected $renderer;

    /**
     * @var App
     */
    protected $app;

    public function __construct(IRenderer $renderer, App $app)
    {
        session_start();
        $this->renderer = $renderer;
        $this->app = $app;
    }

    public function run($actionName)
    {
        $action = $this->defaultAction;
        if (!empty($actionName)) {
            $action = $actionName;
            if (!method_exists($this, $action . 'Action')) {
                return $this->render('404');
            }
        }
        $action .= 'Action';
        return $this->$action();
    }

    protected function render($template, $params = [])
    {
        return $this->renderer->render($template, $params);
    }

    protected function getMenu()
    {
        return [
            [
                'name' => 'Регистрация',
                'href' => '/user/insert',
            ],
            [
                'name' => 'Личный кабинет',
                'href' => '/user/auth',
            ],
            [
                'name' => 'Товары',
                'href' => '/good/all?sortby=views',
            ],
            [
                'name' => 'Корзина',
                'href' => '/basket/all',
            ],

        ];
    }

    /**
     * @param $repositoryName
     * @return \App\repositories\Repository|null
     */
    public function getRepository($repositoryName)
    {
        return $this->app->db->getRepository($repositoryName);
    }

    public function mainAction() 
    {
        return $this->render(
            'main',
            [
                'menu' => $this->getMenu(),
            ]
        );
    } 
}