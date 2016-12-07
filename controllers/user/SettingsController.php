<?php 

namespace app\controllers\user;

use Yii;
use app\models\Profile;
use dektrium\user\controllers\SettingsController as BaseSettings;
use yii\web\UploadedFile;

/**
* Override BaseSettings
*/
class SettingsController extends BaseSettings
{
	
	public function actionProfile()
	{
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