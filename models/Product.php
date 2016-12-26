<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $shop_id
 * @property integer $category_id
 * @property integer $subcategory_id
 * @property string $name
 * @property string $slug 
 * @property string $author
 * @property string $price
 * @property string $condition
 * @property integer $weight
 * @property string $description
 * @property integer $featured
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Image[] $images
 * @property Category $category
 * @property Shop $shop
 * @property Subcategory $subcategory
 * @property Tag[] $tags
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
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
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'immutable' => true,
                'ensureUnique'=>true,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // Required field
            [['name', 'author', 'condition', 'category_id', 'subcategory_id'], 'required'],
            [['weight', 'featured'], 'integer'],
            [['price'], 'number', 'min' => 1000],
            [['description'], 'string'],
            [['name', 'author'], 'string', 'max' => 255],
            [['name'], 'match', 'pattern' => '/^[\w\-().,?\s]+$/'],
            [['author'], 'match', 'pattern' => '/^[\w\.\s]+$/'],
            [['condition'], 'in', 'range' => ['Baru', 'Bekas']],

            // Relational field
            [['shop_id', 'category_id', 'subcategory_id', 'created_at', 'updated_at'], 'safe'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shop::className(), 'targetAttribute' => ['shop_id' => 'id']],
            [['subcategory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategory::className(), 'targetAttribute' => ['subcategory_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'shop_id' => Yii::t('app', 'Shop'),
            'category_id' => Yii::t('app', 'Category'),
            'subcategory_id' => Yii::t('app', 'Subcategory'),
            'name' => Yii::t('app', 'Name'),
            'author' => Yii::t('app', 'Author'),
            'price' => Yii::t('app', 'Price'),
            'condition' => Yii::t('app', 'Condition'),
            'weight' => Yii::t('app', 'Weight'),
            'description' => Yii::t('app', 'Description'),
            'featured' => Yii::t('app', 'Featured'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $shop = Shop::find()->where(['user_id' => Yii::$app->user->identity->getId()])->one();
            $this->shop_id = $shop->id;
            $this->name = ucwords($this->name);
            $this->author = ucwords($this->author);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shop::className(), ['id' => 'shop_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategory()
    {
        return $this->hasOne(Subcategory::className(), ['id' => 'subcategory_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['product_id' => 'id']);
    }
}
