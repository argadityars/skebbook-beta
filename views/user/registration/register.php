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
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View              $this
 * @var dektrium\user\models\User $user
 * @var dektrium\user\Module      $module
 */

$this->title = Yii::t('user', 'Register - Skebbook');
$this->params['breadcrumbs'][] = 'Register';
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="text-center no-margin-top margin-bottom">Register</h3>
                <?= Html::a('Google', ['/user/security/auth?authclient=google'], ['class' => 'btn btn-danger btn-block']) ?>
                <?= Html::a('Facebook', ['/user/security/auth?authclient=facebook'], ['class' => 'btn btn-primary btn-block margin-btm']) ?>
                <p class="text-center margin-top margin-bottom">or</p>
                <?php $form = ActiveForm::begin([
                    'id'                     => 'registration-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                    'validateOnType'=> true,
                    'validationDelay'=> 100,
                ]); ?>

                <?= $form->field($model, 'name') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'username') ?>

                <?php if ($module->enableGeneratingPassword == false): ?>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                <?php endif ?>

                <?= $form->field($model, 'password_repeat')->passwordInput() ?>

                <?= Html::submitButton(Yii::t('user', 'Register'), ['class' => 'btn btn-primary btn-block']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <p class="text-center">
            <?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
        </p>
    </div>
</div>
