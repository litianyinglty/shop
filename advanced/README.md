Lty324820!
# 项目介绍
## 项目描述简介

类似京东商城的B2C商城 (C2C B2B O2O P2P ERP进销存 CRM客户关系管理) 电商或电商类型的服务在目前来看依旧是非常常用，虽然纯电商的创业已经不太容易，但是各个公司都有变现的需要，所以在自身应用中嵌入电商功能是非常普遍的做法。 为了让大家掌握企业开发特点，以及解决问题的能力，我们开发一个电商项目，项目会涉及非常有代表性的功能。 为了让大家掌握公司协同开发要点，我们使用git管理代码。 在项目中会使用很多前面的知识，比如架构、维护等等。

## 主要功能模块
   
## 系统包括：

 后台：品牌管理、商品分类管理、商品管理、订单管理、系统管理和会员管理六个功能模块。 前台：首页、商品展示、商品购买、订单管理、在线支付等。

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
<td>本次项目由项目组长负责管理</td>
</tr>

<tr>
<td>开发人员</td>
<td>3</td>
<td>1人负责：品牌管理、商品分类管理、商品管理、订单管理、
    1人负责：系统管理和会员管理六个功能模块，首页、
    1人负责：商品展示、商品购买、订单管理、在线支付等。
</td>
</tr>

<tr>
<td>UI设计人员</td>
<td>0</td>
<td></td>
</tr>

<tr>
<td>前端开发人员</td>
<td>1</td>
<td>前端开发和UI设计由一人负责</td>
</tr>

<tr>
<td>测试人员</td>
<td>1</td>
<td>测试人员可由开发人员完成测试。公司有测试部，测试部负责所有项目的测试。 项目测试由产品经理进行业务测试。项目中如果有测试，一般都具有Bug管理工具。（介绍某一个款，每个公司Bug管理工具不一样）</td>
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
<td>两周UI设计</td>
<td>UI/UE</td>
</tr>

<tr>
<td>4（1测试 2后端 1前端）</td>
<td>3个月 第1周需求设计 9周时间完成编码 2周时间进行测试和修复</td>
<td>开发人员、测试人员</td>
</tr>
</table>

## 系统功能模块
### 需求
 <input type="checkbox">品牌管理：
 
 <input type="checkbox">文章管理：
 
 <input type="checkbox">商品分类管理：
 
 <input type="checkbox">商品管理：
 
 <input type="checkbox">账号管理：
 
 <input type="checkbox">权限管理：
 
 <input type="checkbox">菜单管理：
 
 <input type="checkbox">订单管理：

### 流程
1、自动登录流程

2、购物车流程

3、订单流程

### 设计要点（数据库和页面交互）
1、系统前后台设计：前台www.yiishop.com 后台admin.yiishop.com 对url地址美化

2、商品无限级分类设计：

3、购物车设计

### 要点难点及解决方案
难点在于需要掌握实际工作中，如何分析思考业务功能，如何在已有知识积累的前提下搜索并解决实际问题，抓大放小，融会贯通，尤其要排除畏难情绪

# 项目总体
## 品牌功能模块
### 需求
1、品牌管理功能涉及品牌的列表展示、品牌添加、修改、删除功能。

2、品牌需要保存缩略图和简介。

3、品牌删除使用逻辑删除。

### 流程
### 设计要点（数据库和页面交互）
1、图片上传到七牛云 1)在composer packagist里下载图片上传组件，在params.php中进行配置 php // 图片服务器的域名设置，拼接保存在数据库中的相对地址
    
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
    
### 要点难点及解决方案
1、删除使用逻辑删除,只改变status属性,不删除记录

2、使用uploadify插件,提升用户体验

3、使用composer下载和安装uploadify

4、composer安装插件报错,解决办法: composer global require "fxp/composer-asset-plugin:^1.2.0"

5、注册七牛云账号 安装yii2 七牛云插件

6、将品牌logo上传到七牛云


## 文章管理模块
### 需求
1、文章的增删改查

2、文章分类的增删改查

### 流程
1、通过数据迁移建立三张表 

2、显示列表功能 

3、处理增删查功能

### 设计要点
文章模型和文章详情模型建立1对1关系

### 要点难点及解决方案
1、文章分类不能重复,通过添加验证规则unique解决

2、文章垂直分表,创建表单使用文章模型和文章详情模型

### 逻辑
1、需要掌握到1对1/1对多关系 在控制器里得到1对1的数据和1对多的数据，再返回到视图，显示在列表 功能 ``php 1对1： 

   ``php
   public function getCategory()
       {
           return $this->hasOne(ArticleCate::className(),   ['id'=>'cate_id']);
       }
   

   public function getArticle()
       {
           return $this->hasMany(Article::className(),['cate_id'=>'id']);
       }
   ``
   
2、需要掌握垂直分表的连表增加和删除以及内容回显功能 通过在文章控制器的添加和编辑方法里，同时添加两张表的数据和同时获 得到两张张的数据，再返回到视图页面
   ```php
   
    if($article->load($request->post()) && $article->validate()){
               $article->save();
               $articleDetail=new ArticleDetail();
               $articleDetail->content=$article->content;
               $articleDetail->article_id=$article->id;
               $articleDetail->save();
   
          $article=Article::findOne($id);
          $article->content=ArticleDetail::findOne(['article_id'=>$id])->content;
   if($article->load($request->post()) && $article->validate()){
               $article->save();
               $articleDetail=new ArticleDetail();
               $articleDetail->content=$article->content;
               $articleDetail->article_id=$article->id;
               $articleDetail->save();
       
   ```
## 商品分类管理模块
### 需求
1、商品的增删改查

2、商品分类的增删改查

### 流程
1、通过数据迁移建立五张表 

2、商品和商品分类及商品详情在一个模型中同时进行操作 

3、处理增删查功能

### 设计要点
1、商品分类实现无限极分类，分类列表显示展开

2、商品的1对1关系以及1对多关系

3、单图上传和多图上传七牛云

4、同时添加和删除多张表信息

5、商品自动生成sn

### 要点难点及解决方案
1、商品分类需要使用zTree插件、并且使用treegrid显示列表功能，基于 Nestedset 的无级限分类和 CTreeView

2、商品详情使用ueditor富文本编辑器，并且上传图片

3、使用插件webuploader上传图片

### 逻辑
1、首先要掌握多张表的联系关系

2、如何建立无限极分类

3、上传单张和多张图片到七牛云以及数据库

4、逻辑删除——软删除

5、通过商品最低价、最高价、关键字搜索功能

6、新增商品自动生成sn,规则为年月日+今天的第几个商品,比如2016053000001


## 管理员模块
### 需求
1、创建管理员

2、管理员登录

3、管理员注销

4、管理员自动登录

### 流程
1、通过数据迁移建立1张表 

2、创建管理员、实现管理员登录、自动登录、注销

3、处理增删查功能

### 设计要点
1、管理员密码加盐加密

2、管理员登陆后需要保存最后登录时间和最后登陆ip(如何获取ip对应的数字,自行搜

### 要点难点及解决方案
1、自动登录调用Yii内置接口实现

2、处理密码加盐加密

3、创建生成登录令牌

4、登录获取最后登录时间、最后登录Ip

5、adminlte设计页面插件


## RBAC功能模块
### 需求
1、创建权限

2、创建角色

3、给角色添加权限

4、给用户添加角色

5、实现用户的访问权限

6、赋予权限的菜单栏自动显示

### 流程
1、通过数据迁移建立四张表 

2、创建权限、创建角色、给角色添加权限、给用户添加对应角色

3、权限表理增删查功能

4、角色表增删改查功能

### 设计要点
1、为不同的用户添加不同的权限

2、赋予权限的菜单栏自动显示

### 要点难点及解决方案
1、访问权限没有实现，通过composer下载mdmsoft/yii2-admin插件，配置组件，实现访问权限管理，访问目录在菜单栏自动显示

2、给予权限的用户，访问目录在菜单栏自动显示









