# 项目介绍
## 项目描述简介

类似京东商城的B2C商城 (C2C B2B O2O P2P ERP进销存 CRM客户关系管理)
电商或电商类型的服务在目前来看依旧是非常常用，虽然纯电商的创业已经不太容易，但是各个公司都有变现的需要，所以在自身应用中嵌入电商功能是非常普遍的做法。
为了让大家掌握企业开发特点，以及解决问题的能力，我们开发一个电商项目，项目会涉及非常有代表性的功能。
为了让大家掌握公司协同开发要点，我们使用git管理代码。
在项目中会使用很多前面的知识，比如架构、维护等等。
## 主要功能模块

### 系统包括：

后台：品牌管理、商品分类管理、商品管理、订单管理、系统管理和会员管理六个功能模块。
前台：首页、商品展示、商品购买、订单管理、在线支付等。
## 开发环境和技术

<table border='1'>
<tr>
<td>开发环境</td><td>Window</td>
</tr>
<tr>
<td>开发工具</td><td>Phpstorm+PHP5.6+GIT+Apache</td>
</tr>
<tr>
<td>相关技术</td><td>Yii2.0+CDN+jQuery+sphinx</td>
</tr>
</table>

# 项目人员组成周期成本
## 人员组成

<table>
<tr>
<th>职位</th>
<th>人数</th>
<th>备注</th>
</tr>

<tr>
<td>项目经理和组长</td>
<td>1</td>
<td>一般小公司由项目经理负责管理，中大型公司项目由项目经理或组长负责管理</td>
</tr>

<tr>
<td>开发人员</td>
<td>3</td>
<td></td>
</tr>

<tr>
<td>UI设计人员</td>
<td>0</td>
<td></td>
</tr>

<tr>
<td>前端开发人员</td>
<td>1</td>
<td>专业前端不是必须的，所以前端开发和UI设计人员可以同一个人</td>
</tr>

<tr>
<td>测试人员</td>
<td>1</td>
<td>有些公司并未有专门的测试人员，测试人员可能由开发人员完成测试。
    公司有测试部，测试部负责所有项目的测试。
    项目测试由产品经理进行业务测试。
    项目中如果有测试，一般都具有Bug管理工具。（介绍某一个款，每个公司Bug管理工具不一样）</td>
</tr>
</table>

## 项目周期成本

<table>
<tr>
<th>人数</th>
<th>周期</th>
<th>备注</th>
</tr>

<tr>
<td>1</td>
<td>两周需求及设计</td>
<td>项目经理</td>
</tr>

<tr>
<td>1</td>
<td>两周
    UI设计</td>
<td>UI/UE</td>
</tr>

<tr>
<td>4（1测试  2后端  1前端）</td>
<td>3个月
    第1周需求设计
    9周时间完成编码
    2周时间进行测试和修复</td>
<td>开发人员、测试人员</td>
</tr>
</table>

## 系统功能模块
### 需求
品牌管理：
商品分类管理：
商品管理：
账号管理：
权限管理：
菜单管理：
订单管理：

### 流程
自动登录流程
购物车流程
订单流程
### 设计要点（数据库和页面交互）
系统前后台设计：前台www.yiishop.com 后台admin.yiishop.com 对url地址美化
商品无限级分类设计：
购物车设计

### 要点难点及解决方案
难点在于需要掌握实际工作中，如何分析思考业务功能，如何在已有知识积累的前提下搜索并解决实际问题，抓大放小，融会贯通，尤其要排除畏难情绪。



## 品牌功能模块
### 需求
品牌管理功能涉及品牌的列表展示、品牌添加、修改、删除功能。
品牌需要保存缩略图和简介。
品牌删除使用逻辑删除。

### 逻辑
1、图片上传到七牛云
    1)在composer packagist里下载图片上传组件，在params.php中进行配置
    ```php
    // 图片服务器的域名设置，拼接保存在数据库中的相对地址，可通过web进行展示
        'domain' => '/',
        'webuploader' => [
            // 后端处理图片的地址，value 是相对的地址
            'uploadUrl' => 'brand/upload',
            // 多文件分隔符
            'delimiter' => ',',
            // 基本配置
            'baseConfig' => [
                'defaultImage' => 'http://img1.imgtn.bdimg.com/it/u=2056478505,162569476&fm=26&gp=0.jpg',
                'disableGlobalDnd' => true,
                'accept' => [
                    'title' => 'Images',
                    'extensions' => 'gif,jpg,jpeg,bmp,png',
                    'mimeTypes' => 'image/*',
                ],
                'pick' => [
                    'multiple' => false,
                ],
            ],
        ],
    ```
    
    ```php
      public function actionUpload()
        {
            //var_dump($_FILES['file']['tmp_name']);exit;
    //        配置
            $config = [
                'accessKey'=>'Hy-VyRINX9t6kU2TNURfGP1TYs6Xc0E_eg2lh81F',                      'secretKey'=>'kUU1g3oltnhBSR_knK7sDhrRUyYZWZ9gmP3GPhRd',
                'domain'=>'http://oyvirytup.bkt.clouddn.com/',
                'bucket'=>'yii2shop',
                'area'=>Qiniu::AREA_HUANAN
            ];
    //        实例化对象
            $qiniu = new Qiniu($config);
            $key = time();
    //        调用上传方法
            $qiniu->uploadFile($_FILES['file']['tmp_name'],$key);
            $url = $qiniu->getLink($key);
    
            $info=[
                'code'=>0,
                'url'=>$url,
                'attachment'=>$url,
            ];
            //exit($url);
            exit(json_encode($info));
        }
    ```
### 问题
1、在目录下下载composer插件不能成功
  处理：在外部下好再复制进去
2、上传图片是模型里未进行验证，导致图片上传不到数据库
  处理：在模型里加权限验证

# DAY2 
## 文章功能
### 需求
文章表功能涉及品牌的列表展示、品牌添加、修改、删除功能。
文章分类表功能涉及品牌的列表展示、品牌添加、修改、删除功能。
文章内容表功能涉及品牌的列表展示、品牌添加、修改、删除功能。
文章删除使用逻辑删除。

## 流程
1、通过数据迁移建立三张表
2、显示列表功能
3、处理增删查功能

## 逻辑
1、需要掌握到1对1/1对多关系
   在控制器里得到1对1的数据和1对多的数据，再返回到视图，显示在列表    功能
   ``php
   1对1：
   public function getCategory()
       {
           return $this->hasOne(ArticleCate::className(),   ['id'=>'cate_id']);
       }
   
   1对多：
   public function getArticle()
       {
           return $this->hasMany(Article::className(),['cate_id'=>'id']);
       }
   ``
   
2、需要掌握垂直分表的连表增加和删除以及内容回显功能
   通过在文章控制器的添加和编辑方法里，同时添加两张表的数据和同时获   得到两张张的数据，再返回到视图页面
   ```php
   添加：
    if($article->load($request->post()) && $article->validate()){
               $article->save();
   //            找出文章表对象
               $articleDetail=new ArticleDetail();
               $articleDetail->content=$article->content;
               $articleDetail->article_id=$article->id;
               $articleDetail->save();
   
   编辑：
          $article=Article::findOne($id);
          $article->content=ArticleDetail::findOne(['article_id'=>$id])->content;
   if($article->load($request->post()) && $article->validate()){
               $article->save();
               $articleDetail=new ArticleDetail();
               $articleDetail->content=$article->content;
               $articleDetail->article_id=$article->id;
               $articleDetail->save();
       
   ```
3、软删除
    ```php
    /**
         * 删除文章
         * @param $id
         */
        public function actionDell($id)
        {
            if(Article::updateAll(['status'=>0],['id'=>$id])){
                \Yii::$app->session->setFlash("success", "删除成功");
                return $this->redirect(['article/index']);
            }
        }
        
        
        /**
             * 还原文章
             * @param $id
             * @return \yii\web\Response
             */
            public function actionReduction($id)
            {
                if(Article::updateAll(['status'=>1],['id'=>$id])){
                    \Yii::$app->session->setFlash("success", "还原成功");
                    return $this->redirect(['article/index']);
                }
            }
            
    ```






