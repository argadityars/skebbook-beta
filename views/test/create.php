<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = Yii::$app->name . ' - Jual Buku';
?>
<div class="product-create">

    <h1>Jual Buku</h1>

    <?= $this->render('_form', [
        'model' => $product,
        'category' => $category,
        'tag' => $tag,
        'images' => $images,
    ]) ?>

</div>