<?php

use kartik\widgets\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?= Html::beginForm('search', 'get', ['class' => 'form-vertical sidebar-form']); ?>
	<div class="form-group">
		<label class="control-label" for="category">Category</label>
		<?= Html::dropDownList('category', null, $category, ['prompt'=>'Select Category', 'class' => 'form-control', 'id' => 'category']) ?>
	</div>
	<div class="form-group">
		<label class="control-label" for="subcategory">Subcategory</label>
		<?= DepDrop::widget([
			'name' => 'subcategory',
			'data' => [],
			'pluginOptions'=>[
                'depends' => ['category'],
                'placeholder' => 'Select...',
                'url' => Url::to(['/product/subcat']),
            ]
		]) ?>
	</div>
	<div class="form-group">
		<label class="control-label" for="condition">Kondisi
		<div class="checkbox">
			<label>
			<?= Html::checkbox('baru', false) ?> Baru
			</label>
		</div>
		<div class="checkbox">
			<label>
			<?= Html::checkbox('bekas', false) ?> Bekas
			</label>
		</div>
	</div>
	<div class="form-group">
	    <?= Html::submitButton('Filter', ['class' => 'btn btn-primary btn-block']) ?>
	</div>
<?= Html::endForm() ?>		