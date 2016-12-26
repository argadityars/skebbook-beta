<?php

use kartik\widgets\TimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

<fieldset>
	<legend class="text-muted">Informasi Toko</legend>
	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'tagline')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
</fieldset>

<fieldset>
	<legend class="text-muted">Lokasi Toko</legend>
	<?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'province_id')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'city_id')->textInput(['maxlength' => true]) ?>
</fieldset>

<fieldset>
	<legend class="text-muted">Logo dan Header</legend>
	
	<?= $form->field($model, 'avatar')->textInput() ?>

	<?= $form->field($model, 'bannerImage')->fileInput() ?>
</fieldset>

<fieldset>
	<legend class="text-muted">Jam Kerja</legend>
	<div class="row">
		<div class="col-md-6">
			<?= $form->field($model, 'startDay')->dropdownList($model->getDaysArray(), ['prompt'=>'Pilih Hari']) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'endDay')->dropdownList($model->getDaysArray(), ['prompt'=>'Pilih Hari']) ?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6">
			<?= $form->field($model, 'startTime')->widget(TimePicker::classname(), [
				'pluginOptions' => [
			        'showMeridian' => false,
			        'minuteStep' => 1,
			        'secondStep' => 5,
			    ]
			]) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'endTime')->widget(TimePicker::classname(), [
				'pluginOptions' => [
			        'showMeridian' => false,
			        'minuteStep' => 5,
			    ]
			]) ?>
		</div>
	</div>
</fieldset>

<?php if(!$model->isNewRecord): ?>
    <fieldset>
    	<legend class="text-muted">Catatan untuk Pembeli</legend>
    	<?= $form->field($model, 'note')->textarea() ?>
    </fieldset>
<?php endif; ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Buat Toko' : 'Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?= Html::a('Batal', ['index'], ['class' => 'btn btn-default']) ?>
</div>

<?php ActiveForm::end(); ?>
