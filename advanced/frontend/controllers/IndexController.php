<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/18 0018
 * Time: 2:01
 */

namespace frontend\controllers;


use yii\web\Controller;

class IndexController extends BaseController
{
    public $layout='index';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionList()
    {
        return $this->render('list');
    }

    public function actionGoods()
    {
        return $this->render('goods');
    }

    public function actionFlow()
    {
        return $this->render('cart');
    }

}