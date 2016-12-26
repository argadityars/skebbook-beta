<?php

use yii\helpers\Html;

$this->title = Yii::$app->name . ' - ' . Html::encode($product->name);
?>

<div class="row">
	<div class="col-md-4">
		<a href="#"><?= Html::img($product->images[0]->getImageUrl(), ['class' => 'img-responsive']) ?></a>
		<div class="row margin-top">
			<?php for ($i=1; $i < count($product->images); $i++): ?>
				<div class="col-md-4">
					<a href="#"><?= Html::img($product->images[$i]->getImageUrl(), ['class' => 'img-responsive']) ?></a>
				</div>
			<?php endfor; ?>
		</div>
	</div>
	<div class="col-md-8">
		<h3 class="no-margin-top"><?= Html::encode($product->name) ?></h3>
		<h4>Rp <?= Yii::$app->formatter->asCurrency(Html::encode($product->price)) ?></h4>
		<table class="table table-clean margin-top">
			<tr>
				<td>Kategori</td>
				<td>: <?= Html::encode($product->category->name) ?></td>
			</tr>
			<tr>
				<td>Kondisi</td>
				<td>: <?= $product->condition == 'Baru' ? "<span class='label label-info'>".Html::encode($product->condition)."<span>" : "<span class='label label-default'>".Html::encode($product->condition)."<span>" ?></td>
			</tr>
			<tr>
				<td>Berat</td>
				<td>: <?= Html::encode($product->weight) ?> Gram</td>
			</tr>
		</table>
		<?php if($product->shop->note != null): ?>
			<h4>Catatan Pedagang</h4>
			<p><?= Html::encode($product->shop->note) ?></p>
		<?php endif; ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">

	<!-- Nav tabs -->
	<ul class="nav nav-tabs margin-top margin-bottom" role="tablist">
		<li role="presentation" class="active"><a href="#deskripsi" aria-controls="deskripsi" role="tab" data-toggle="tab">Deskripsi</a></li>
		<li role="presentation"><a href="#informasi" aria-controls="informasi" role="tab" data-toggle="tab">Informasi Lain</a></li>
		<li role="presentation"><a href="#review" aria-controls="review" role="tab" data-toggle="tab">Review</a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="deskripsi">
			<?= Html::encode($product->description) ?>
		</div>
		<div role="tabpanel" class="tab-pane" id="informasi">
			[Belum di coding]
		</div>
		<div role="tabpanel" class="tab-pane" id="review">
			[Belum di coding]
		</div>
	</div>

	</div>
</div>