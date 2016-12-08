<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m161208_121606_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'shop_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'subcategory_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'author' => $this->string(255),
            'price' => $this->money(10, 0),
            'condition' => $this->string(32),
            'weight' => $this->integer(),
            'description' => $this->text(),
            'featured' => $this->integer()->defaultValue(0),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product');
    }
}
