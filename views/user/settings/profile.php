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

/**
 * Date
 */
function getMonthsArray()
{
    for($monthNum = 1; $monthNum <= 12; $monthNum++){
        $months[$monthNum] = date('F', mktime(0, 0, 0, $monthNum, 1));
    }

    return array(0 => 'Pilih Bulan') + $months;
}

function getDaysArray()
{
    for($dayNum = 1; $dayNum <= 31; $dayNum++){
        $days[$dayNum] = $dayNum;
    }

    return array(0 => 'Pilih Hari') + $days;
}

function getYearsArray()
{
    $thisYear = date('Y', time());

    for($yearNum = $thisYear-76; $yearNum <= $thisYear-14; $yearNum++){
        $years[$yearNum] = $yearNum;
    }

    return array(0 => 'Pilih Tahun') + $years;
}
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

                <?= $form->field($model, 'avatarImage')->fileInput(['accept' => 'image/*']) ?>

                <?= $form->field($model, 'name') ?>

                <?= $form->field($model, 'sex')->radioList(['L' => 'Laki-laki', 'P' => 'Perempuan'], ['inline'=>true]) ?>

                <div class="row">
                    <div class="col-md-4"><?= $form->field($model, 'date')->dropdownList(getDaysArray()) ?></div>
                    <div class="col-md-4"><?= $form->field($model, 'month')->dropdownList(getMonthsArray()) ?></div>
                    <div class="col-md-4"><?= $form->field($model, 'year')->dropdownList(getYearsArray()) ?></div>
                </div>

                <?= \yii\helpers\Html::submitButton(
                    Yii::t('user', 'Save'),
                    ['class' => 'btn btn-block btn-success']
                ) ?>
                    
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <?= Html::img($user->profile->getAvatar(), [
            'class' => 'img-circle',
            'alt'   => $user->username,
            'width' => '24px'
        ]) ?>
        <?= $user->username ?>
    </div>
</div>


