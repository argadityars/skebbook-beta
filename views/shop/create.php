<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = Yii::$app->name . ' - ' . Yii::t('app', 'Create Shop');
?>

<h3><?= Yii::t('app', 'Create Shop') ?></h3><hr>

<div class="row">
	<div class="col-md-7">
	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>
</div>
