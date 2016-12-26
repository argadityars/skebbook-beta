<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\Shop;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ShopController extends Controller
{
    public function behaviors() 
    { 
        return [ 
            'access' => [ 
                'class' => AccessControl::className(), 
                'only' => ['index', 'create', 'update'], 
                'rules' => [ 
                    [ 
                        'actions' => ['index', 'create', 'update'], 
                        'allow' => true, 
                        'roles' => ['@'], 
                    ], 
                ], 
            ], 
        ]; 
    }  

    public function actionIndex()
    {
        $this->layout = '2column';

    	$shop = Shop::find()->where(['user_id' => Yii::$app->user->identity->getId()])->one();
        if ($shop) {
            $product = Product::find()->where(['shop_id' => $shop->id, 'status' => 1]);
            $pages = new Pagination(['totalCount' => $product->count()]);
            $products = $product->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            return $this->render('index', [
                'model' => $shop,
                'products' => $products,
                'pages' => $pages,
            ]);
        }
        
        return $this->render('index', [
            'model' => $shop
        ]);
    }

    public function actionCreate()
    {
        $this->layout = '2column';

        if (Shop::find()->where(['user_id' => Yii::$app->user->identity->getId()])->one()) {
            throw new ForbiddenHttpException(Yii::t('app', 'You already have a shop.'));
        }

    	$model = new Shop();

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()) {
                Yii::$app->session->setFlash('success', "Shop created succesfully!");
                return $this->redirect(['index']);
            } else {
                throw new ServerErrorHttpException('Failed to process your request.');
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate()
    {
        $this->layout = '2column';
        $model = $this->findModel();
        $oldBanner = $model->banner;

        if ($model->load(Yii::$app->request->post())) {
            $model->bannerImage = UploadedFile::getInstance($model, 'bannerImage');

            if ($model->bannerImage) {
                if ($oldBanner) {
                    $model->deleteBanner($oldBanner);
                }
                $model->banner = date('Ydm') . md5($model->id) . '.' . $model->bannerImage->extension;
                $model->save();
                $model->uploadBanner();
            } else {
                $model->save();
            }
            
            Yii::$app->session->setFlash('success', "Shop updated succesfully!");
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    protected function findModel()
    {
        if (($model = Shop::find()->where(['user_id' => Yii::$app->user->identity->getId()])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
