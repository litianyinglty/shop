<?php
/**
 * Created by PhpStorm.
 * Email: wenmang2015@qq.com
 * Date: 2017/11/11
 * Time: 16:39
 * Company: 源码时代重庆校区
 */
namespace backend\components;
use yii\base\Component;
class RbacMenu extends Component
{
    public static function Menu(){
        $auth=\Yii::$app->authManager;
        $permissions=$auth->getPermissions();
        //装菜单数组
        $menuArr=[];
        foreach ($permissions as $name=>$permission){
            if ($permission->description===null){
                //结束本次循环
                continue;
            }
            if (strpos($name,"/")===false  ){
                $menuArr[$name]=[
                    'label' => $permission->description,
                    'icon' => 'fighter-jet',
                    'url' => "#",
                    'visible'=>\Yii::$app->user->can($name)
                ];
            }else{
                //$name  brand/add
                $menuArr[explode("/",$name)[0]]['items'][]= [
                    'label' => $permission->description,
                    'icon' => 'file-code-o',
                    'url' => [$name],
                    'visible'=>\Yii::$app->user->can($name)
                ];
            }
        }
        return $menuArr;
    }

    public static function menu1(){
        $auth=\Yii::$app->authManager;
        $arr=[];
        $pers=$auth->getPermissions();
        foreach ($pers as $k=>$per){
            if ($per->description===null){
                continue;
            }
            if (strpos($k,'/')===false){
                $arr[$k]=[
                    'label' => $per->description,
                    'icon' => 'file-code-o',
                    'url' => "#",
                    'visible' =>  \Yii::$app->user->identity->username==="admin"?true:\Yii::$app->user->can($per->name),
                ];
            }else {
                $arr[explode('/',$k)[0]]['items'][]=[
                    'label' => $per->description,
                    'icon' => 'file-code-o',
                    'url' => [$per->name],
                    'visible' =>  \Yii::$app->user->identity->username==="admin"?true:\Yii::$app->user->can($per->name),
                ];
            }
        }
        return $arr;
    }
}