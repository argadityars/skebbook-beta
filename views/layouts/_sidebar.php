<?php

use yii\helpers\Html;
use yii\widgets\Menu;

$user = Yii::$app->user->identity;
?>

<ul class="sidebar-list">
	<li>
		<?= Html::a('<span class="glyphicon glyphicon-flash" aria-hidden="true"></span> Profile', ['/user/settings'], ['class' => 'link-block active']) ?>
	</li>
	<li>
		<?= Html::a('<span class="glyphicon glyphicon-flash" aria-hidden="true"></span> Dashboard', ['#'], ['class' => 'link-block',]) ?>
	</li>
	<li>
		<?= Html::a('<span class="glyphicon glyphicon-flash" aria-hidden="true"></span> Shop', ['/shop'], ['class' => 'link-block']) ?>
	</li>
</ul>