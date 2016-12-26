<?php

use dosamigos\selectize\SelectizeTextInput;
use kartik\file\FileInput;
use kartik\money\MaskMoney;
use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">
    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'validateOnBlur' => false,
        'validateOnType' => true,
        'validationDelay'=> 100,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <label>Image</label>
    <div class="form-group required form-group-img">
        <?php if(!$images): ?>
            Tidak ada gambar.
        <?php endif; ?>
        <?php foreach ($images as $image): ?>
            <?= Html::img($image->getImageUrl(), ['class' => 'img-rounded img-form', 'width' => '100px']) ?>
        <?php endforeach; ?>
    </div>

    

    <?= $form->field($model, 'price', ['addon' => ['prepend' => ['content' => 'Rp']]])->widget(MaskMoney::classname()); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'category_id')->dropDownList($category, ['prompt'=>'Select Category']); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'subcategory_id')->widget(DepDrop::classname(), [
                'data' => $model->isNewRecord ? [] : [$subcategory->id => $subcategory->name],
                'pluginOptions'=>[
                    'depends'=>[Html::getInputId($model, 'category_id')],
                    'placeholder'=>'Select...',
                    'url'=>Url::to(['/test/subcategory']),
                    'initialize' => $model->isNewRecord ? false : true
                ]
            ]); ?>
        </div>
    </div>

    <?= $form->field($tag, 'name')->widget(SelectizeTextInput::className(), [
        'clientOptions' => [
            'create' => true,
            'plugins' => ['remove_button'],
            'maxItems' => 5
        ],
    ])->hint('Pisahkan tag dengan tanda koma (,).'); ?>

    <?= $form->field($model, 'condition')->radioList(['Baru' => 'Baru', 'Bekas' => 'Bekas'], ['inline'=>true]) ?>

    <?= $form->field($model, 'description')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>