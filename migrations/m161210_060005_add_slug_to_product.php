<?php

use yii\db\Migration;

class m161210_060005_add_slug_to_product extends Migration
{
    public function up()
    {
        $this->addColumn('product', 'slug', 'VARCHAR(150) AFTER `name` NOT NULL');
    }

    public function down()
    {
        $this->dropcolumn('product', 'slug');
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
