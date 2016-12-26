<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>

<section id="jumbotron-slider"></section>

<section id="featured-content" class="container">
	<div class="row">
		<div class="col-md-4" id="featured-item-1"><a href="#"></a></div>
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-6" id="featured-item-2"><a href="#"></a></div>
				<div class="col-md-6" id="featured-item-3"><a href="#"></a></div>
			</div>
			<div class="row">
				<div class="col-md-12" id="featured-item-4"><a href="#"></a></div>
			</div>
		</div>
	</div>
</section>

<section id="featured-product" class="container">
	<h3 class="featured-title">Buku Populer</h3>
	<div class="row">
		<?php foreach($model as $product): ?>
			<div class="col-md-3 featured-product-item">
				<a href="<?= '/product/view/' . $product->slug ?>"><?= Html::img($product->images[0]->getImageUrl(), ['class' => 'img-responsive']) ?></a>
				<?= Html::a(Html::encode($product->name), ['/product/view/'.$product->slug]) ?>
				<p class="text-muted"><em><small>by </small></em><?= Html::encode($product->author) ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<section id="featured-content-2"></section>

<section id="promotion" class="container">
	<div class="row">
		<div class="col-md-6 promotion-item"><a href="#"></a></div>
		<div class="col-md-6 promotion-item"><a href="#"></a></div>
	</div>
</section>