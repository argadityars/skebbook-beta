<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\Pjax;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= $this->render('_navbar') ?>

<?= $content ?>

<footer id="footer" class="footer">
    <section id="contact"></section>
    <section id="footer-content"></section>
    <section id="footer-copyright"><center>&copy; Skebbook <?= date('Y') ?></center></section>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
