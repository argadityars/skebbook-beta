<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\UploadedFile;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Product $product
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * Add new fields
     * @var files $avatarImage
     * @var files $bannerImage
     */
    public $productImage;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
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
            [['product_id', 'name'], 'required'],
            [['product_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['productImage'], 'image', 'mimeTypes' => 'image/jpeg, image/png, image/gif', 'maxFiles' => 4],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'name' => Yii::t('app', 'Name'),
            'productImage' => Yii::t('app', 'Image'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * fetch stored image file name with complete path 
     * @return string
     */
    public function getImageFile() 
    {
        return isset($this->name) ? Yii::$app->params['uploadPath']['product'] . $this->name : null;
    }

    /**
     * Returns image url.
     * @param string|null $name 
     */
    public function getImageUrl()
    {
        $image = $this->name;
        if ($this->name == null) {
            $image = 'default.png';
        }
        return Yii::$app->params['uploadUrl']['product'] . $image ;
    }

    /**
    * Process upload of image
    *
    * @return mixed the uploaded image instance
    */
    public function uploadImages($key) {
        $path = Yii::$app->params['uploadPath']['product'];

        foreach ($this->productImage as $file) {
            $file->saveAs($path . $key . md5($file->baseName) . '.' . $file->extension);
        }
        return true;
    }

    /**
    * Process deletion of image
    *
    * @return boolean the status of deletion
    */
    public function deleteImage() {
        $file = $this->getImageFile();

        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }

        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        // if deletion successful, reset your file attributes
        $this->avatar = null;
        $this->filename = null;

        return true;
    }

    
}
