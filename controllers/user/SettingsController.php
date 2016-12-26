<?php 

namespace app\controllers\user;

use Yii;
use app\models\Profile;
use dektrium\user\controllers\SettingsController as BaseSettings;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
* Override BaseSettings
*/
class SettingsController extends BaseSettings
{
	/** @inheritdoc */
    public $defaultAction = 'index';

	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['index', 'profile', 'account', 'networks', 'disconnect', 'delete'],
                        'roles'   => ['@'],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['confirm'],
                        'roles'   => ['?', '@'],
                    ],
                ],
            ],
        ];
    }

	public function actionIndex()
	{
		$this->layout = "@app/views/layouts/2column";

		$model = $this->finder->findProfileById(Yii::$app->user->identity->getId());

		return $this->render('index', [
			'model' => $model,
		]);
	}
	
	public function actionProfile()
	{
		$this->layout = "@app/views/layouts/2column";
		$model = $this->finder->findProfileById(Yii::$app->user->identity->getId());
		$oldAvatar = $model->avatar;
		$this->performAjaxValidation($model);
		$data = Yii::$app->request->post();

		if ($model->load($data)) {
			$model->avatarImage = UploadedFile::getInstance($model, 'avatarImage');

			if ($model->avatarImage) {
				if($oldAvatar) {
                    $model->deleteImage($oldAvatar);
                }
				$model->avatar = date('Ydm') . md5(Yii::$app->user->identity->getId()) . '.' . $model->avatarImage->extension;
				$model->save();
				$model->uploadAvatar();
			} else {
				$model->save();	
			}
			
            Yii::$app->getSession()->setFlash('success', Yii::t('user', 'Profile updated successfully!'));

            return $this->refresh();
        }
		
		return $this->render('profile', [
            'model' => $model
        ]);
	}

	

}