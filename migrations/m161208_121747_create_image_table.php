<?php

use yii\db\Migration;

/**
 * Handles the creation of table `image`.
 */
class m161208_121747_create_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('image', [
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
        $this->dropTable('image');
    }
}
