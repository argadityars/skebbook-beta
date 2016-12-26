<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Image;
use app\models\Product;
use app\models\Shop;
use app\models\Subcategory;
use app\models\Tag;
use dektrium\user\models\User;
use yii\base\Controller;
use yii\base\Model; 
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;


class TestController extends Controller
{
    public function actionProduct()
    {
    	$usershop = Shop::find(3)->one();

        return $this->render('product', [
        	'usershop' =>$usershop
        ]);
    }

    public function actionCreate()
    {
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
    		VarDumper::dump($data);
        } else {
            return $this->render('create', [
                'product' => $product,
                'category' => Category::getOptions(),
                'tag' => $tag,
                'images' => $images,
            ]);
        }
    }

    public function actionUpdate()
    {
    	$product = Product::find()->where(['slug' => 'tahilalats-collection-2'])->one();
    	$tag = Tag::find()->where(['product_id' => $product->id])->one();
    	$images = $product->images;
    	$category = Category::getOptions();
    	$subcategory = $product->subcategory;
    	$data = Yii::$app->request->post();

    	if ($product->load($data) && $tag->load($data)) {
    		$transaction = Yii::$app->db->beginTransaction();
    		try {
    			$product->save();
    			$tag->save();
    			$transaction->commit();
    		} catch (Exception $e) {
    			$transaction->rollBack();
    			throw $e;
    		}
            VarDumper::dump($data);
        } else {
	    	return $this->render('update', [
	            'model' => $product,
	            'category' => $category,
	            'subcategory' => $subcategory,
	            'tag' => $tag,
	            'images' => $images,
	        ]);
    	}
    }

    public function actionSubcategory() 
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = Subcategory::getOptionsbyCategory($cat_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

}
