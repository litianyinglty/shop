# ��Ŀ����
## ��Ŀ�������

���ƾ����̳ǵ�B2C�̳� (C2C B2B O2O P2P ERP������ CRM�ͻ���ϵ����)
���̻�������͵ķ�����Ŀǰ���������Ƿǳ����ã���Ȼ�����̵Ĵ�ҵ�Ѿ���̫���ף����Ǹ�����˾���б��ֵ���Ҫ������������Ӧ����Ƕ����̹����Ƿǳ��ձ��������
Ϊ���ô��������ҵ�����ص㣬�Լ������������������ǿ���һ��������Ŀ����Ŀ���漰�ǳ��д����ԵĹ��ܡ�
Ϊ���ô�����չ�˾Эͬ����Ҫ�㣬����ʹ��git������롣
����Ŀ�л�ʹ�úܶ�ǰ���֪ʶ������ܹ���ά���ȵȡ�
## ��Ҫ����ģ��

### ϵͳ������

��̨��Ʒ�ƹ�����Ʒ���������Ʒ������������ϵͳ����ͻ�Ա������������ģ�顣
ǰ̨����ҳ����Ʒչʾ����Ʒ���򡢶�����������֧���ȡ�
## ���������ͼ���

<table border='1'>
<tr>
<td>��������</td><td>Window</td>
</tr>
<tr>
<td>��������</td><td>Phpstorm+PHP5.6+GIT+Apache</td>
</tr>
<tr>
<td>��ؼ���</td><td>Yii2.0+CDN+jQuery+sphinx</td>
</tr>
</table>

# ��Ŀ��Ա������ڳɱ�
## ��Ա���

<table>
<tr>
<th>ְλ</th>
<th>����</th>
<th>��ע</th>
</tr>

<tr>
<td>��Ŀ������鳤</td>
<td>1</td>
<td>һ��С��˾����Ŀ����������д��͹�˾��Ŀ����Ŀ������鳤�������</td>
</tr>

<tr>
<td>������Ա</td>
<td>3</td>
<td></td>
</tr>

<tr>
<td>UI�����Ա</td>
<td>0</td>
<td></td>
</tr>

<tr>
<td>ǰ�˿�����Ա</td>
<td>1</td>
<td>רҵǰ�˲��Ǳ���ģ�����ǰ�˿�����UI�����Ա����ͬһ����</td>
</tr>

<tr>
<td>������Ա</td>
<td>1</td>
<td>��Щ��˾��δ��ר�ŵĲ�����Ա��������Ա�����ɿ�����Ա��ɲ��ԡ�
    ��˾�в��Բ������Բ�����������Ŀ�Ĳ��ԡ�
    ��Ŀ�����ɲ�Ʒ�������ҵ����ԡ�
    ��Ŀ������в��ԣ�һ�㶼����Bug�����ߡ�������ĳһ���ÿ����˾Bug�����߲�һ����</td>
</tr>
</table>

## ��Ŀ���ڳɱ�

<table>
<tr>
<th>����</th>
<th>����</th>
<th>��ע</th>
</tr>

<tr>
<td>1</td>
<td>�����������</td>
<td>��Ŀ����</td>
</tr>

<tr>
<td>1</td>
<td>����
    UI���</td>
<td>UI/UE</td>
</tr>

<tr>
<td>4��1����  2���  1ǰ�ˣ�</td>
<td>3����
    ��1���������
    9��ʱ����ɱ���
    2��ʱ����в��Ժ��޸�</td>
<td>������Ա��������Ա</td>
</tr>
</table>

## ϵͳ����ģ��
### ����
Ʒ�ƹ���
��Ʒ�������
��Ʒ����
�˺Ź���
Ȩ�޹���
�˵�����
��������

### ����
�Զ���¼����
���ﳵ����
��������
### ���Ҫ�㣨���ݿ��ҳ�潻����
ϵͳǰ��̨��ƣ�ǰ̨www.yiishop.com ��̨admin.yiishop.com ��url��ַ����
��Ʒ���޼�������ƣ�
���ﳵ���

### Ҫ���ѵ㼰�������
�ѵ�������Ҫ����ʵ�ʹ����У���η���˼��ҵ���ܣ����������֪ʶ���۵�ǰ�������������ʵ�����⣬ץ���С���ڻ��ͨ������Ҫ�ų�η��������



## Ʒ�ƹ���ģ��
### ����
Ʒ�ƹ������漰Ʒ�Ƶ��б�չʾ��Ʒ����ӡ��޸ġ�ɾ�����ܡ�
Ʒ����Ҫ��������ͼ�ͼ�顣
Ʒ��ɾ��ʹ���߼�ɾ����

### �߼�
1��ͼƬ�ϴ�����ţ��
    1)��composer packagist������ͼƬ�ϴ��������params.php�н�������
    ```php
    // ͼƬ���������������ã�ƴ�ӱ��������ݿ��е���Ե�ַ����ͨ��web����չʾ
        'domain' => '/',
        'webuploader' => [
            // ��˴���ͼƬ�ĵ�ַ��value ����Եĵ�ַ
            'uploadUrl' => 'brand/upload',
            // ���ļ��ָ���
            'delimiter' => ',',
            // ��������
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
    //        ����
            $config = [
                'accessKey'=>'Hy-VyRINX9t6kU2TNURfGP1TYs6Xc0E_eg2lh81F',                      'secretKey'=>'kUU1g3oltnhBSR_knK7sDhrRUyYZWZ9gmP3GPhRd',
                'domain'=>'http://oyvirytup.bkt.clouddn.com/',
                'bucket'=>'yii2shop',
                'area'=>Qiniu::AREA_HUANAN
            ];
    //        ʵ��������
            $qiniu = new Qiniu($config);
            $key = time();
    //        �����ϴ�����
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
### ����
1����Ŀ¼������composer������ܳɹ�
  �������ⲿ�º��ٸ��ƽ�ȥ
2���ϴ�ͼƬ��ģ����δ������֤������ͼƬ�ϴ��������ݿ�
  ������ģ�����Ȩ����֤

# DAY2 
## ���¹���
### ����
���±����漰Ʒ�Ƶ��б�չʾ��Ʒ����ӡ��޸ġ�ɾ�����ܡ�
���·�������漰Ʒ�Ƶ��б�չʾ��Ʒ����ӡ��޸ġ�ɾ�����ܡ�
�������ݱ����漰Ʒ�Ƶ��б�չʾ��Ʒ����ӡ��޸ġ�ɾ�����ܡ�
����ɾ��ʹ���߼�ɾ����

## ����
1��ͨ������Ǩ�ƽ������ű�
2����ʾ�б���
3��������ɾ�鹦��

## �߼�
1����Ҫ���յ�1��1/1�Զ��ϵ
   �ڿ�������õ�1��1�����ݺ�1�Զ�����ݣ��ٷ��ص���ͼ����ʾ���б�    ����
   ``php
   1��1��
   public function getCategory()
       {
           return $this->hasOne(ArticleCate::className(),   ['id'=>'cate_id']);
       }
   
   1�Զࣺ
   public function getArticle()
       {
           return $this->hasMany(Article::className(),['cate_id'=>'id']);
       }
   ``
   
2����Ҫ���մ�ֱ�ֱ���������Ӻ�ɾ���Լ����ݻ��Թ���
   ͨ�������¿���������Ӻͱ༭�����ͬʱ������ű�����ݺ�ͬʱ��   �õ������ŵ����ݣ��ٷ��ص���ͼҳ��
   ```php
   ��ӣ�
    if($article->load($request->post()) && $article->validate()){
               $article->save();
   //            �ҳ����±����
               $articleDetail=new ArticleDetail();
               $articleDetail->content=$article->content;
               $articleDetail->article_id=$article->id;
               $articleDetail->save();
   
   �༭��
          $article=Article::findOne($id);
          $article->content=ArticleDetail::findOne(['article_id'=>$id])->content;
   if($article->load($request->post()) && $article->validate()){
               $article->save();
               $articleDetail=new ArticleDetail();
               $articleDetail->content=$article->content;
               $articleDetail->article_id=$article->id;
               $articleDetail->save();
       
   ```
3����ɾ��
    ```php
    /**
         * ɾ������
         * @param $id
         */
        public function actionDell($id)
        {
            if(Article::updateAll(['status'=>0],['id'=>$id])){
                \Yii::$app->session->setFlash("success", "ɾ���ɹ�");
                return $this->redirect(['article/index']);
            }
        }
        
        
        /**
             * ��ԭ����
             * @param $id
             * @return \yii\web\Response
             */
            public function actionReduction($id)
            {
                if(Article::updateAll(['status'=>1],['id'=>$id])){
                    \Yii::$app->session->setFlash("success", "��ԭ�ɹ�");
                    return $this->redirect(['article/index']);
                }
            }
            
    ```






