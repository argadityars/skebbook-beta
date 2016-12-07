<?php

use yii\helpers\Html;
use yii\widgets\Menu;

$user = Yii::$app->user->identity;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= Html::img($user->profile->getAvatar(), [
                'class' => 'img-rounded img-responsive block margin-bottom',
                'alt'   => $user->username,
            ]) ?>
            <?= Html::tag('p', Html::encode($user->profile->name), ['class' => 'text-center']) ?>
        </h3>
    </div>
    <div class="panel-body">
        <?= Menu::widget([
            'options' => [
                'class' => 'nav nav-pills nav-stacked',
            ],
            'items' => [
                ['label' => Yii::t('user', 'Dashboard'), 'url' => ['/site/index']],
                ['label' => Yii::t('user', 'Settings'), 'url' => ['/user/settings/profile']],
            ],
        ]) ?>
    </div>
</div>
