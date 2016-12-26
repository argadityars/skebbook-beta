<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\ContactForm;
use app\models\LoginForm;
use app\models\Product;
use yii\data\Pagination;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class BookController extends Controller
{
    /**
     * Displays all product.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'fullpage';
        $query = Product::find();
        $pages = new Pagination(['totalCount' => $query->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
             'model' => $models,
             'category' => Category::getOptions(),
             'pages' => $pages,
        ]);
    }

    public function actionSearch()
    {
        $this->layout = 'fullpage';
        $query = Product::find()
            ->joinWith(['category', 'subcategory', 'tags'])
            ->where([
                'or',
                ['like', 'product.name', Yii::$app->request->get('q')],
                ['like', 'product.author', Yii::$app->request->get('q')],
                ['like', 'category.name', Yii::$app->request->get('q')],
                ['like', 'subcategory.name', Yii::$app->request->get('q')],
                ['like', 'tag.name', Yii::$app->request->get('q')],
            ]);
        $pages = new Pagination(['totalCount' => $query->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
             'model' => $models,
             'category' => Category::getOptions(),
             'pages' => $pages,
        ]);
    }

}
