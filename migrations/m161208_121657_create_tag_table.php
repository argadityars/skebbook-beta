<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tag`.
 */
class m161208_121657_create_tag_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tag', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
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
        $this->dropTable('tag');
    }
}
