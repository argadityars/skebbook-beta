<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Image;
use app\models\Product;
use app\models\Shop;
use app\models\Subcategory;
use app\models\Tag;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ProductController extends \yii\web\Controller
{
    public function behaviors() 
    { 
        return [ 
            'access' => [ 
                'class' => AccessControl::className(), 
                'only' => ['create', 'update', 'delete'], 
                'rules' => [ 
                    [ 
                        'actions' => ['create', 'update', 'delete'], 
                        'allow' => true, 
                        'roles' => ['@'], 
                    ], 
                ], 
            ], 
        ]; 
    }

    public function actionCreate()
    {
        $this->layout = '2column';
        $product = new Product();
        $tag = new Tag();
        $images = new Image();
        $data = Yii::$app->request->post();
        $key = Yii::$app->getSecurity()->generateRandomString(8);

        if ($product->load($data) && $tag->load($data) && $images->load($data)) {
            $images->productImage = UploadedFile::getInstances($images, 'productImage');
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $product->save();
                $product->link('tags', $tag);
                foreach ($images->productImage as $file) {
                    $image = new Image();
                    $image->name = $key.md5($file->baseName).'.'.$file->extension;
                    $product->link('images', $image);
                }
                if ($images->uploadImages($key)) {
                    $transaction->commit();
                }
            } catch (Exception $e){
                $transaction->rollBack();
                throw $e;
            }
            Yii::$app->session->setFlash('success', "Product created succesfully!");
            $this->redirect('/shop/index');
        } else {
            return $this->render('create', [
                'model' => $product,
                'category' => Category::getOptions(),
                'tags' => $tag,
                'images' => $images,
            ]);
        }
    }

    public function actionView($slug)
    {
        $product = Product::find()->where(['slug' => $slug])->one();

        return $this->render('view', [
            'product' => $product
        ]);
    }

    public function actionUpdate($slug)
    {
        $this->layout = '2column';
        $shop = Shop::find()->where(['user_id' => Yii::$app->user->identity->getId()])->one();
        $product = $this->findModel($slug, $shop->id);
        $category = Category::getOptions();
        $subcategory = $product->subcategory;
        $tags = Tag::find()->where(['product_id' => $product->id])->one();
        $images = $product->images;
        $data = Yii::$app->request->post();

        if ($product->load($data) && $tags->load($data)) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $product->save();
                $tags->save();
                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
            Yii::$app->session->setFlash('success', "Product updated succesfully!");
            $this->redirect('/shop/index');
        } else {
            return $this->render('update', [
                'model' => $product,
                'category' => $category,
                'subcategory' => $subcategory,
                'tags' => $tags,
                'images' => $images,
            ]);
        }
    }

    public function actionDelete($slug)
    {
        $shop = Shop::find()->where(['user_id' => Yii::$app->user->identity->getId()])->one();
        $product = $this->findModel($slug, $shop->id);
        $transaction = Yii::$app->db->beginTransaction();
        
        try {
            $product->status = 0;
            $product->save();
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        Yii::$app->session->setFlash('success', "Product deleted succesfully!");
        $this->redirect('/shop/index');
    }

    protected function findModel($slug, $shop)
    {
        if (($model = Product::find()->where(['slug' => $slug, 'shop_id' => $shop])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSubcat() 
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = \app\models\Subcategory::getOptionsbyCategory($cat_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

}
