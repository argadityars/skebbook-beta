<?php

use yii\helpers\Html;
$user = Yii::$app->user->identity;
$this->title = Yii::$app->name . ' - ' . Yii::t('user', 'Profile');
?>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-2">
						<?= Html::img($user->profile->getAvatar(), [
		                    'class' => 'img-circle img-responsive',
		                    'alt'   => $user->username,
		                ]) ?>
					</div>
					<div class="col-md-6">
						<h4 class="no-margin-bottom"><?= Html::encode($user->profile->name) ?></h4>
						<small><em>@<?= Html::encode($user->username) ?></em></small>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<h4 class="text-muted"><?= Yii::t('user', 'Profile') ?></h4>

				<table class="table table-hover no-margin-bottom">
					<tr>
						<td class="col-md-3 text-muted"><?= Yii::t('user', 'Name') ?></td>
						<td><?= Html::encode($user->profile->name) ?></td>
					</tr>
					<tr>
						<td class="col-md-3 text-muted"><?= Yii::t('user', 'Sex') ?></td>
						<td><?= Html::encode($user->profile->sex) == 'L' ? 'Laki-Laki' : 'Perempuan' ?></td>
					</tr>
					<tr>
						<td class="col-md-3 text-muted"><?= Yii::t('user', 'Date of Birth') ?></td>
						<td><?= Html::encode(Yii::$app->formatter->asDate($user->profile->getDateOfBirth(), 'php:d F Y')) ?></td>
					</tr>
				</table>
			</div>
			<div class="panel-footer">
				<?= Html::a('Edit', ['settings/profile'], ['class' => 'btn btn-default btn-sm']) ?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<h4 class="text-muted"><?= Yii::t('user', 'Account') ?></h4>

				<table class="table table-hover no-margin-bottom">
					<tr>
						<td class="col-md-3 text-muted"><?= Yii::t('user', 'Email') ?></td>
						<td><?= Html::encode($user->email) ?></td>
					</tr>
					<tr>
						<td class="col-md-3 text-muted"><?= Yii::t('user', 'Username') ?></td>
						<td><?= Html::encode($user->username) ?></td>
					</tr>
				</table>
			</div>
			<div class="panel-footer">
				<?= Html::a('Edit', ['settings/account'], ['class' => 'btn btn-default btn-sm']) ?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<h4 class="text-muted"><?= Yii::t('user', 'Networks') ?></h4>
				<?= $this->render('networks', ['user' => $user]) ?>
			</div>
		</div>
	</div>
</div>