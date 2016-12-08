<?php

use yii\db\Migration;

class m161208_134544_add_table_index extends Migration
{
    public function up()
    {
        /**
         * Add index for table shop
         * 
         * create index for column 'user_id'
         * add foreign key for table 'user'
         */
        $this->createIndex(
            'idx-shop-user_id',
            'shop',
            'user_id'
        );

        $this->addForeignKey(
            'fk-shop-user_id',
            'shop',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        /**
         * Add index for table product
         * 
         * create index for column 'shop_id'
         * create index for column 'category_id'
         * create index for column 'subcategory_id'
         * add foreign key for table 'shop'
         * add foreign key for table 'category'
         * add foreign key for table 'subcategory'
         */
        $this->createIndex(
            'idx-product-shop_id',
            'product',
            'shop_id'
        );

        $this->addForeignKey(
            'fk-product-shop_id',
            'product',
            'shop_id',
            'shop',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-product-category_id',
            'product',
            'category_id'
        );

        $this->addForeignKey(
            'fk-product-category_id',
            'product',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-product-subcategory_id',
            'product',
            'subcategory_id'
        );

        $this->addForeignKey(
            'fk-product-subcategory_id',
            'product',
            'subcategory_id',
            'subcategory',
            'id',
            'CASCADE'
        );

        /**
         * Add index for table subcategory
         * create index for column 'category_id'
         * add foreign key for table 'category'
         */
        $this->createIndex(
            'idx-subcategory-category_id',
            'subcategory',
            'category_id'
        );

        $this->addForeignKey(
            'fk-subcategory-category_id',
            'subcategory',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );

        /**
         * Add index for table tag
         * create index for column 'product_id'
         * add foreign key for table 'product'
         */
        $this->createIndex(
            'idx-tag-product_id',
            'tag',
            'product_id'
        );

        $this->addForeignKey(
            'fk-tag-product_id',
            'tag',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        /**
         * Add index for table image
         * create index for column 'product_id'
         * add foreign key for table 'product'
         */
        $this->createIndex(
            'idx-image-product_id',
            'image',
            'product_id'
        );

        $this->addForeignKey(
            'fk-image-product_id',
            'image',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        /**
         * Remove index for table 'image'
         * 
         * Drop foreign key for table 'image'
         * Drop index for column 'product_id'
         */
        $this->dropForeignKey(
            'fk-image-product_id',
            'image'
        );

        $this->dropIndex(
            'idx-image-product_id',
            'image'
        );

        /**
         * Remove index for table 'tag'
         * 
         * Drop foreign key for table 'tag'
         * Drop index for column 'product_id'
         */
        $this->dropForeignKey(
            'fk-tag-product_id',
            'tag'
        );

        $this->dropIndex(
            'idx-tag-product_id',
            'tag'
        );

        /**
         * Remove index for table 'subcategory'
         * 
         * Drop foreign key for table 'subcategory'
         * Drop index for column 'category_id'
         */
        $this->dropForeignKey(
            'fk-subcategory-category_id',
            'subcategory'
        );

        $this->dropIndex(
            'idx-subcategory-category_id',
            'subcategory'
        );

        /**
         * Remove index for table 'product'
         * 
         * Drop foreign key for table 'product'
         * Drop index for column 'subcategory_id'
         * Drop foreign key for table 'product'
         * Drop index for column 'category_id'
         * Drop foreign key for table 'product'
         * Drop index for column 'shop_id'
         */
        $this->dropForeignKey(
            'fk-product-subcategory_id',
            'product'
        );

        $this->dropIndex(
            'idx-product-subcategory_id',
            'product'
        );

        $this->dropForeignKey(
            'fk-product-category_id',
            'product'
        );

        $this->dropIndex(
            'idx-product-category_id',
            'product'
        );

        $this->dropForeignKey(
            'fk-product-shop_id',
            'product'
        );

        $this->dropIndex(
            'idx-product-shop_id',
            'product'
        );

        /**
         * Remove index for table 'shop'
         * 
         * Drop foreign key for table 'shop'
         * Drop index for column 'user_id'
         */
        $this->dropForeignKey(
            'fk-shop-user_id',
            'shop'
        );

        $this->dropIndex(
            'idx-shop-user_id',
            'shop'
        );
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
