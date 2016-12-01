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
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-3">
        
    </div>
    <div class="col-md-9">
        <?= $this->render('_menu') ?>
        <div class="panel panel-default">
            <div class="panel-body">
                
                
                <?php $form = ActiveForm::begin([
                    'id' => 'profile-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                    'validateOnBlur'         => false,
                ]); ?>

                <?= $form->field($model, 'name') ?>

                <?= $form->field($model, 'sex')->radioList(['L' => 'Laki-laki', 'P' => 'Perempuan'], ['inline'=>true]) ?>

                <?php
                    $date = [];
                    for ($i=1; $i < 32; $i++) { 
                         $date[] = [$i => $i];
                    }
                    $month = [
                        'Januari' => 'Januari',
                        'Februari' => 'Februari',
                        'Maret' => 'Maret',
                        'April' => 'April',
                        'Mei' => 'Mei',
                        'Juni' => 'Juni',
                        'Juli' => 'Juli',
                        'Agustus' => 'Agustus',
                        'September' => 'September',
                        'Oktober' => 'Oktober',
                        'November' => 'November',
                        'Desember' => 'Desember'
                    ];
                    $year = [];
                    for ($i=1941; $i < 2003; $i++) { 
                         $year[] = [$i => $i];
                     } 
                ?>
                <div class="row">
                    <div class="col-md-4"><?= $form->field($model, 'date')->dropdownList($date) ?></div>
                    <div class="col-md-4"><?= $form->field($model, 'month')->dropdownList($month) ?></div>
                    <div class="col-md-4"><?= $form->field($model, 'year')->dropdownList($year) ?></div>
                </div>

                <?= \yii\helpers\Html::submitButton(
                    Yii::t('user', 'Save'),
                    ['class' => 'btn btn-block btn-success']
                ) ?>
                    
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <?= Html::img($user->profile->getAvatarUrl(24), [
            'class' => 'img-circle',
            'alt'   => $user->username,
        ]) ?>
        <?= $user->username ?>
    </div>
</div>
