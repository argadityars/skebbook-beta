<?php

use yii\bootstrap\Alert;
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = Yii::$app->name . ' - Shop';
?>

<div class="row">
	<div class="col-md-11">
		
		<?php if(!$model): ?>
			<div class="alert alert-dash margin-top margin-bottom" role="alert">
				<?= Yii::t('app', 'You dont have a shop yet.') ?><br>
				<?= Html::a(Yii::t('app', 'Create Now'), ['shop/create'], ['class' => 'btn btn-info margin-top']) ?>
			</div>
			
		<?php else: ?>
			<div class="shop-detail">
				<div class="shop-header">
					<div class="shop-banner">
						<?php if($model->banner): ?>
							<?= Html::img($model->getBanner(), ['class' => 'img-responsive']) ?>
						<?php endif; ?>
					</div>
					<h4 class="shop-title text-muted"><?= Html::img($model->user->profile->getAvatar(), ['class' => 'img-circle', 'style' => 'width:32px; margin-right: 10px']) ?><?= Html::encode($model->name) ?></h4>
					<h5 class="shop-tagline"></h5>
				</div>
				<div class="shop-menu">
					<?= Html::a('Jual Buku', ['product/create'], ['class' => 'btn btn-menu']) ?>
					<?= Html::a('Pengaturan Toko', ['shop/update'], ['class' => 'btn btn-menu']) ?>
				</div>
			</div>

			<?php if($model->products): ?>
				<?= $this->render('_product', [
			        'products' => $products,
		            'pages' => $pages,
			    ]) ?>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>



