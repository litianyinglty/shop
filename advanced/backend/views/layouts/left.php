<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php Yii::getAlias('@web')?>/images/20160103014047_QyTkE (1).jpeg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p style="color: green;font-size: 20px;text-align: center"><?=Yii::$app->user->identity->username;?></p>
                <p style="color: purple;font-size: 20px">欢迎进入后台管理</p>
<!--                <a href="#"><i class="fa fa-circle text-success"></i> </a>-->
            </div>
        </div>

        <!-- search form -->
<!--        <form action="#" method="get" class="sidebar-form">-->
<!--            <div class="input-group">-->
<!--                <input type="text" name="q" class="form-control" placeholder="Search..."/>-->
<!--              <span class="input-group-btn">-->
<!--                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>-->
<!--                </button>-->
<!--              </span>-->
<!--            </div>-->
<!--        </form>-->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                // 'items' =>  \backend\components\RbacMenu::Menu1(),
                'items' => mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id,null, function($menu){
                    $data = json_decode($menu['data'], true);
                    $items = $menu['children'];
                    $return = [
                        'label' => $menu['name'],
                        'url' => [$menu['route']],
                    ];
                    //处理我们的配置
                    if ($data) {
                        //visible
                        isset($data['visible']) && $return['visible'] = $data['visible'];
                        //icon
                        isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon'];
                        //other attribute e.g. class...
                        $return['options'] = $data;
                    }
                    //没配置图标的显示默认图标，默认图标大家可以自己随便修改
                    (!isset($return['icon']) || !$return['icon']) && $return['icon'] = 'circle-o';
                    $items && $return['items'] = $items;
                    return $return;
                }),
            ]
        ) ?>
    </section>

</aside>
