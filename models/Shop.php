<?php

namespace app\models;

use Yii;
use app\models\Product;
use dektrium\user\models\User;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "shop".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $description
 * @property string $website
 * @property string $note
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Product[] $products
 * @property User $user
 */
class Shop extends ActiveRecord
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
    public static function tableName()
    {
        return 'shop';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'province_id', 'city_id', 'district_id'], 'integer'],
            [['description', 'note'], 'string'],
            [['name', 'description', 'address'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'website', 'tagline', 'address', 'avatar', 'banner'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['website'], 'url'],
            [['name'], 'unique'],
            [['startDay', 'endDay', 'startTime', 'endTime'], 'safe'],
            [['avatarImage', 'bannerImage'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'website' => Yii::t('app', 'Website'),
            'note' => Yii::t('app', 'Note'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->user_id = Yii::$app->user->identity->getId();
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['shop_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Get collection of days
     * @return array 
     */
    public function getDaysArray()
    {
        for($dayNum = 0; $dayNum <= 6; $dayNum++){
            $days[$dayNum] = date('l', mktime(0, 0, 0, 0, $dayNum));
        }

        return $days;
    }

    /**
     * This function is for uploading the image to the app.
     */
    public function uploadBanner()
    {
        $banner = $this->bannerImage;
        if ($this->validate()) {
            $banner->saveAs(Yii::$app->params['uploadPath']['shop']['banner'] . date('Ydm') . md5($this->id) . '.' . $banner->extension);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns avatar url or null if avatar not set.
     * @param string|null $name 
     */
    public function getBanner()
    {
        return Yii::$app->params['uploadUrl']['shop']['banner'] . $this->banner ;
    }

    /**
     * Process deletion of image
     *
     * @return boolean the status of deletion
     */
    public function deleteBanner($bannerOld)
    {
        $URL = Yii::getAlias('@webroot'). '/uploads/image/shop/banner/' . $bannerOld;

        // check if file exists on server
        if (empty($URL) || !file_exists($URL)) {
            return false;
        }

        return unlink($URL);
    }

}
