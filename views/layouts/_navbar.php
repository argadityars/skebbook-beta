<?php 

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
?>

<?php
NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-default navbar-fixed-top navbar-skeb',
    ],
]);
$navItems=[
    ['label' => 'Home', 'url' => ['/site/index']],
    ['label' => 'Book', 'url' => ['/book']],
  ];
  if (Yii::$app->user->isGuest) {
    array_push($navItems,
        ['label' => 'Login', 'url' => ['/user/login']],
        ['label' => 'Register', 'url' => ['/user/register']]);
  } else {
    array_push($navItems,[
        'label' => Yii::$app->user->identity->username,
            'items' => [
                ['label' => 'My Shop', 'url' => ['/shop']],
                ['label' => 'Setting', 'url' => ['/user/settings']],
                '<li class="divider"></li>',
                ['label' => 'Logout', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']]
            ]
    ]);
  }
echo "<form class='navbar-form navbar-left' role='search' action='/book/search' method='get' autocomplete='off'>
   <div class='form-group'>
        <input id='search' type='text' name='q' placeholder='Search' class='form-control navbar-search'>
    </div>
</form>";
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $navItems,
]);

NavBar::end();
?>