<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = Yii::$app->name . ' - Shop';
?>

<section id="featured-slider"></section>

<section id="energy-content" class="container-fluid">
	<div class="row">
		<div class="col-md-3" id="energy-content-item"><a href="#"></a></div>
		<div class="col-md-3" id="energy-content-item"><a href="#"></a></div>
		<div class="col-md-3" id="energy-content-item"><a href="#"></a></div>
		<div class="col-md-3" id="energy-content-item"><a href="#"></a></div>
	</div>
</section>

<section id="main-content" class="container-fluid">
	<div class="row is-flex">
		<div class="col-md-2" id="sidebar">
			<?= $this->render('_filter', [
				'category' => $category,
			]) ?>
		</div>
		<div class="col-md-9" id="mainbar">
			<?php if(!$model): ?>
				<p class="text-center"><em>Not found</em></p>
			<?php endif; ?>
			<div class="row margin-top">
				<?php foreach($model as $book): ?>
					<div class="col-md-3 margin-bottom">
						<a href="<?= 'product/view/'. $book->slug ?>">
							<?= Html::img($book->images[0]->getImageUrl(), [
								'class' => 'img-responsive'
							]) ?>
						</a>
						<?= Html::a(Html::encode($book->name), ['product/view/'. $book->slug]) ?><br>
						<small><em>by</em> <?= Html::encode($book->author) ?></small><br>
						Rp <?= Yii::$app->formatter->asCurrency(Html::encode($book->price)) ?><br>
					</div>
				<?php endforeach; ?>
			</div>
			<center><?= LinkPager::widget(['pagination' => $pages]); ?></center>
		</div>
	</div>
</section>

