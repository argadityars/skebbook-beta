
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = Yii::$app->name . ' - ' . Yii::t('app', 'Shop Settings');
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				
				<div class="row">
					<div class="col-md-7">
						<?= $this->render('_form', [
						    'model' => $model,
						]) ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

