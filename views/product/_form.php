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

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

<fieldset>
    <legend class="text-muted">Informasi Buku</legend>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?php if($model->isNewRecord): ?>
        <?= $form->field($images, 'productImage[]')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*', 'multiple' => true],
                'pluginOptions' => [
                ]
            ])->hint('Only 4 images allowed');   
        ?>
    <?php else: ?>
        <label>Image</label>
        <div class="form-group required form-group-img">
            <?php if(!$images): ?>
                Tidak ada gambar.
            <?php endif; ?>
            <?php foreach ($images as $image): ?>
                <?= Html::img($image->getImageUrl(), ['class' => 'img-rounded img-form', 'width' => '100px']) ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?= $form->field($model, 'price', ['addon' => ['prepend' => ['content' => 'Rp']]])->widget(MaskMoney::classname()); ?>

    <?= $form->field($model, 'weight', ['addon' => ['prepend' => ['content' => 'Gram']]])->textInput(['maxlength' => true]) ?>
</fieldset>

<fieldset>
    <legend class="text-muted">Detail Buku</legend>

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
                    'url'=>Url::to(['/product/subcat']),
                    'initialize' => $model->isNewRecord ? false : true
                ]
            ]); ?>
        </div>
    </div>

    <?= $form->field($tags, 'name')->widget(SelectizeTextInput::className(), [
        'clientOptions' => [
            'create' => true,
            'plugins' => ['remove_button'],
            'maxItems' => 5
        ],
    ])->hint('Pisahkan tag dengan tanda koma (,).'); ?>

    <?= $form->field($model, 'condition')->radioList(['Baru' => 'Baru', 'Bekas' => 'Bekas'], ['inline'=>true]) ?>
</fieldset>

<fieldset>
    <legend class="text-muted">Sinopsis Buku</legend>

    <?= $form->field($model, 'description')->textarea() ?>
</fieldset>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Jual Buku' : 'Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?= Html::a('Batal', ['/shop'], ['class' => 'btn btn-default']) ?>
</div>

<?php ActiveForm::end(); ?>

