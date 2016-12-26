<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = Yii::$app->name . ' - Jual Buku';
?>
<div class="product-update">

    <h1>Ubah Buku</h1>

    <?= $this->render('_form', [
        'model' => $model,
        'category' => $category,
        'subcategory' => $subcategory,
        'tag' => $tag,
        'images' => $images,
    ]) ?>

</div>