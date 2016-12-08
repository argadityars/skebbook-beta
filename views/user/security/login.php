<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\widgets\Connect;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View                   $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module           $module
 */

$this->title = Yii::t('user', 'Login - Skebbook');
$this->params['breadcrumbs'][] = 'Login';
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="text-center no-margin-top margin-bottom">Login</h3>
                <?= Html::a('Google', ['/user/security/auth?authclient=google'], ['class' => 'btn btn-danger btn-block']) ?>
                <?= Html::a('Facebook', ['/user/security/auth?authclient=facebook'], ['class' => 'btn btn-primary btn-block margin-btm']) ?>
                <p class="text-center margin-top margin-bottom">or</p>
                <?php $form = ActiveForm::begin([
                    'id'                     => 'login-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                    'validateOnBlur'         => false,
                    'validateOnType'         => false,
                    'validateOnChange'       => false,
                ]) ?>

                <?= $form->field(
                    $model,
                    'login',
                    ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]
                ) ?>

                <?= $form
                    ->field(
                        $model,
                        'password',
                        ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']]
                    )
                    ->passwordInput()
                ?>

                <?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '4']) ?>

                <?= Html::submitButton(
                    Yii::t('user', 'Sign in'),
                    ['class' => 'btn btn-primary btn-block', 'tabindex' => '3']
                ) ?>

                <?php ActiveForm::end(); ?>
                <?php if ($module->enablePasswordRecovery): ?>
                    <p class="text-center margin-top">Lupa password?
                        <?= Html::a(Yii::t('user', 'klik disini'), ['/user/recovery/request'], ['tabindex' => '5']) ?>
                    </p> 
                <?php endif ?>
            </div>
        </div>
        
        <?php if ($module->enableConfirmation): ?>
            <p class="text-center">
                <?= Html::a(Yii::t('user', 'Didn\'t receive confirmation message?'), ['/user/registration/resend']) ?>
            </p>
        <?php endif ?>
        <?php if ($module->enableRegistration): ?>
            <p class="text-center">
                <?= Html::a(Yii::t('user', 'Don\'t have an account? Sign up!'), ['/user/registration/register']) ?>
            </p>
        <?php endif ?>
    </div>
</div>
