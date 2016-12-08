<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop`.
 */
class m161208_121559_create_shop_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('shop', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'name' => $this->string(255)->unique(),
            'description' => $this->text(),
            'website' => $this->string(255),
            'note' => $this->text(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
        ]);

        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('shop');
    }
}
