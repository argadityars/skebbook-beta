<?php 

/**
 * This file is overriding Dektrium's default Profile Model
 */

namespace app\models;

use dektrium\user\models\Profile as BaseProfile;
use Yii;

/**
 * This is overriding the model class for table "profile".
 *
 * @property string $avatar 
 * @property string $banner 
 *
 * @author Argaditya <dev.argadityars@gmail.com>
 */

class Profile extends BaseProfile
{
    /**
     * Add new fields
     * @var files $avatarImage
     * @var files $bannerImage
     */
	public $avatarImage;
    public $bannerImage;

	/**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['sexLength'] = ['sex', 'string', 'max' => 10];
        $rules['sexIn'] = ['sex', 'in', 'range' => ['L', 'P']];
        $rules['dateLength'] = ['date', 'integer', 'min' => 1, 'max' => 31];
        $rules['monthLength'] = ['month', 'integer', 'min' => 1, 'max' => 12];
        $rules['yearLength'] = ['year', 'integer', 'min' => 1940];
        $rules['avatarLength'] = ['avatar', 'string', 'max' => 255];
        $rules['bannerLength'] = ['banner', 'string', 'max' => 255];
        $rules['avatarFiles']   = ['avatarImage', 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'];
        $rules['bannerFiles'] = ['bannerImage', 'image', 'extensions' => 'png, jpg, jpeg'];

        return $rules;
    }

	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
    	return [
            'sex'   => \Yii::t('user', 'Jenis Kelamin'),
            'date'  => \Yii::t('user', 'Tanggal Lahir'),
            'month' => \Yii::t('user', 'Bulan Lahir'),
            'year'  => \Yii::t('user', 'Tahun Lahir'),
    		'avatar'=> \Yii::t('user', 'Foto Profil'),
            'banner'     => \Yii::t('user', 'Foto Header'),
    		'avatarImage'=> \Yii::t('user', 'Foto Profil'),
            'bannerImage'=> \Yii::t('user', 'Foto Header'),
    	];
    }

    /**
     * This function is for uploading the image to the app.
     */
    public function uploadAvatar()
    {
    	$avatar = $this->avatarImage;
    	if ($this->validate()) {
            $avatar->saveAs('uploads/image/avatar/' . date('Ydm') . md5(Yii::$app->user->identity->getId()) . '.' . $avatar->extension);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Process deletion of image
     *
     * @return boolean the status of deletion
     */
    public function deleteImage($avatarOld)
    {
        $URL = Yii::getAlias('@webroot'). '/uploads/image/avatar/' . $avatarOld;

        // check if file exists on server
        if (empty($URL) || !file_exists($URL)) {
            return false;
        }

        return unlink($URL);
    }

    /**
     * Returns avatar url or null if avatar not set.
     * @param string|null $name 
     */
    public function getAvatar()
    {
        $avatar = $this->avatar;
        if ($this->avatar == null) {
            $avatar = 'default.png';
        }
        return '/uploads/image/avatar/' . $avatar ;
    }

}