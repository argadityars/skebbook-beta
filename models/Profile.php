<?php 

/**
 * This file is overriding Dektrium's default Profile Model
 */

namespace app\models;

use dektrium\user\models\Profile as BaseProfile;

/**
 * This is overriding the model class for table "profile".
 *
 * @property string $avatar 
 * @property string $banner 
 *
 * @author Argaditya <argadityarss@gmail.com>
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
	 * Returns avatar url or null if avatar not set.
	 * @param string|null $name 
	 */
	public function getAvatar()
	{
		return 'uploads/image/avatar/' . $this->avatar ;
	}

	/**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['sexLength'] = ['sex', 'string', 'max' => 10];
        $rules['sexIn'] = ['sex', 'in', 'range' => ['L', 'P']];
        $rules['dateLength'] = ['date', 'integer', 'min' => 1, 'max' => 31];
        $rules['monthLength'] = ['month', 'string', 'max' => 10];
        $rules['monthIn'] = ['month', 'in', 'range' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']];
        $rules['yearLength'] = ['year', 'integer', 'min' => 4, 'max' => 5];
        $rules['avatarLength'] = ['avatar', 'string', 'max' => 255];
        $rules['bannerLength'] = ['banner', 'string', 'max' => 255];
        $rules['avatarFiles']   = ['avatarImage', 'image', 'extensions' => 'png, jpg, jpeg'];
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
            'date'  => \Yii::t('user', 'Tanggal'),
            'month' => \Yii::t('user', 'Bulan'),
            'year'  => \Yii::t('user', 'Tahun'),
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
            $avatar->saveAs('uploads/image/avatar/' . date('Ydm') . md5($avatar->baseName) . '.' . $avatar->extension);
            return true;
        } else {
            return false;
        }
    }

}