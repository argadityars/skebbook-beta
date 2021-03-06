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
 * @var $this  yii\web\View
 * @var $form  yii\widgets\ActiveForm
 * @var $model dektrium\user\models\SettingsForm
 */

$this->title = Yii::t('user', 'Account settings');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>


<?= $this->render('_menu') ?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <?php $form = ActiveForm::begin([
                    'id'                     => 'account-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                    'validateOnBlur'         => false,
                ]); ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'new_password')->passwordInput() ?>

                <hr />

                <?= $form->field($model, 'current_password')->passwordInput() ?>

                <?= Html::submitButton(Yii::t('user', 'Update Account'), ['class' => 'btn btn-success']) ?>        

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<?php if ($model->module->enableAccountDelete): ?>
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Yii::t('user', 'Delete account') ?></h3>
        </div>
        <div class="panel-body">
            <p>
                <?= Yii::t('user', 'Once you delete your account, there is no going back') ?>.
                <?= Yii::t('user', 'It will be deleted forever') ?>.
                <?= Yii::t('user', 'Please be certain') ?>.
            </p>
            <?= Html::a(Yii::t('user', 'Delete account'), ['delete'], [
                'class'        => 'btn btn-danger',
                'data-method'  => 'post',
                'data-confirm' => Yii::t('user', 'Are you sure? There is no going back'),
            ]) ?>
        </div>
    </div>
<?php endif ?>
