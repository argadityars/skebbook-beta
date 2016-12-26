<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
?>
<h1>product/index</h1>

<?php if(!$model): ?>
	Jual buku sekarang!
<?php else: ?>
	<?php foreach($model as $product): ?>
		<ul>
			<li><?= Html::a(Html::encode($product->name), ['product/update/'. $product->slug]) ?></li>
		</ul>
	<?php endforeach; ?>
<?php endif; ?>