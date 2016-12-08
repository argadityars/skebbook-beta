<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sub_category`.
 */
class m161208_121636_create_subcategory_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('subcategory', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'name' => $this->string(255),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('subcategory');
    }
}
