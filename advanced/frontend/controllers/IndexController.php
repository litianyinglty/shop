<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/18 0018
 * Time: 2:01
 */

namespace frontend\controllers;


use yii\web\Controller;

class IndexController extends Controller
{
    public $layout='public';

    public function actionIndex()
    {
        return $this->render('index');
    }

}