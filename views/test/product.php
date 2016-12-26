<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
?>
<h1>test/product</h1>

<hr>
Shop Name: <?= Html::encode($usershop->name) ?> <br>
Shop Owner: <?= Html::encode($usershop->user->username) ?> <br>
Shop Products :
	<?php foreach($usershop->products as $product): ?>
		<ul>
			<li><?= Html::encode($product->name) ?></li>
		</ul> 
	<?php endforeach; ?>
<hr>

