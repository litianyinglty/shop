<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/10
 * Time: 20:17
 */

namespace backend\models;


use yii\base\Model;

class SearchForm extends Model
{
    public $minPrice;
    public $maxPrice;
    public $keyword;

    public function rules()
    {
        return [
            [['minPrice','maxPrice'],'number'],
            [['keyword'],'safe'],
        ];
    }
}