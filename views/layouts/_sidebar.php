<?php

use yii\helpers\Html;
use yii\widgets\Menu;

$user = Yii::$app->user->identity;
?>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading"><?= Html::encode($user->profile->name) ?></div>

    <!-- List group -->
    <ul class="list-group">
        <?= Html::a('Dashboard', 
            ['/site/index'], 
            ['class' => 'list-group-item']
        ) ?>
        <?= Html::a('Profile', 
            ['/user/settings/profile'], 
            ['class' => 'list-group-item']
        ) ?>
    </ul>
</div>
