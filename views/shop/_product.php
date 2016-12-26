<?php 

use yii2mod\alert\Alert;
use yii\helpers\Html;
use yii\widgets\LinkPager;

?>
<div class="panel panel-default no-margin-bottom">
	<table class="table table-responsive table-hover">
		<?php foreach($products as $product): ?>
			<tr>
			    <td class="col-md-1" >
			    	<?= Html::img($product->images[0]->getImageUrl(), [
						'class' => 'img-responsive',
					]) ?>
			    </td>
			    <td style="vertical-align: middle;">
			    	<?= Html::a(Html::encode($product->name), ['product/view/'. $product->slug]) ?>
			    	<?= $product->condition == 'Baru' ? "<small><span class='label label-info'>Baru</span></small>" : "" ?>
			    	<div class="row">
			    		<div class="col-md-5"><small class="text-muted"><?= Yii::t('app', 'Category')?>: <?= $product->category->name ?></small></div>
			    		<div class="col-md-5"><small class="text-muted"><?= Yii::t('app', 'Sub-Category')?>: <?= $product->subcategory->name ?></small></div>
			    	</div>
			    </td>
			    <td style="vertical-align: middle;" class="text-right">
			    	<?= Html::a('Edit Buku', ['product/update/'. $product->slug], ['class' => 'btn btn-info btn-sm']) ?>
			    	<?= Html::a('<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>', ['product/delete/'. $product->slug], ['class' => 'btn', 'onclick' => "return confirm('Are you sure you want to delete this?');"]) ?>
			    </td>
		  	</tr>
		<?php endforeach; ?>
	</table>

</div>
<center><?= LinkPager::widget(['pagination' => $pages]); ?></center>
