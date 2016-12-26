<?php
namespace app\components;

use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        // Here you can refer to Application object through $app variable
        $app->params['uploadPath'] = [
        	'avatar' => Yii::getAlias('@webroot') . '/uploads/image/avatar/',
        	'product' => Yii::getAlias('@webroot') . '/uploads/image/product/',
            'shop' => [
                'avatar' => Yii::getAlias('@webroot') . '/uploads/image/shop/avatar/',
                'banner' => Yii::getAlias('@webroot') . '/uploads/image/shop/banner/'
            ]
        ];
        $app->params['uploadUrl'] = [
        	'avatar' => $app->urlManager->baseUrl . '/uploads/image/avatar/',
        	'product' => $app->urlManager->baseUrl . '/uploads/image/product/',
            'shop' => [
                'avatar' => $app->urlManager->baseUrl . '/uploads/image/shop/avatar/',
                'banner' => $app->urlManager->baseUrl . '/uploads/image/shop/banner/'
            ]
        ];
    }     
}