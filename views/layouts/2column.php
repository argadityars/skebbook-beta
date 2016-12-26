<?php

use kartik\widgets\Alert;

?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>
	<?php if (Yii::$app->session->hasFlash('success')): ?>
		<?= Alert::widget([
		   'options' => ['class' => 'alert-success alert-no-margin'],
		   'body' => Yii::$app->session->getFlash('success'),
		]); ?>
	<?php endif; ?>
	<section id="main-content" class="container-fluid">
		<div class="row is-flex">
			<div class="col-md-2" id="sidebar">
				<?= $this->render('_sidebar') ?>
			</div>
			<div class="col-md-10" id="mainbar">
				<?= $content; ?>
		</div>
	</section>
<?php $this->endContent(); ?>