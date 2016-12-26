<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $profile
 */
$user = Yii::$app->user->identity;
$this->title = Yii::t('user', 'Profile settings');

?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>
<div class="row margin-top">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-body">
        
                <?php $form = ActiveForm::begin([
                    'id' => 'profile-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                    'validateOnBlur'         => false,
                ]); ?>

                <div class="row">
                    <div class="col-md-4">
                        <?= Html::img($user->profile->getAvatar(), [
                            'class' => 'img-rounded img-responsive margin-bottom',
                            'alt'   => $user->username,
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'avatarImage')->fileInput(['accept' => 'image/*']) ?>
                    </div>
                </div>
                
                <?= $form->field($model, 'name') ?>

                <?= $form->field($model, 'sex')->radioList(['L' => 'Laki-laki', 'P' => 'Perempuan'], ['inline'=>true]) ?>

                <div class="row">
                    <div class="col-md-4"><?= $form->field($model, 'date')->dropdownList($model->getDaysArray()) ?></div>
                    <div class="col-md-4"><?= $form->field($model, 'month')->dropdownList($model->getMonthsArray()) ?></div>
                    <div class="col-md-4"><?= $form->field($model, 'year')->dropdownList($model->getYearsArray()) ?></div>
                </div>

                
            </div>
            <div class="panel-footer">
                <?= Html::submitButton(Yii::t('user', 'Update Profile'), ['class' => 'btn btn-success']) ?>
                <?= Html::a(Yii::t('app', 'Cancel'), ['settings/'], ['class' => 'btn btn-default']) ?>
                    
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>

