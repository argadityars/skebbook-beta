<?php

use yii\db\Migration;

class m161223_055517_add_status_to_product_table extends Migration
{
    public function up()
    {
        $this->addColumn('product', 'status', 'INTEGER AFTER `featured`');
    }

    public function down()
    {
        $this->dropcolumn('product', 'status');
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
