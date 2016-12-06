<?php

use yii\db\Migration;
use yii\db\Schema;

class m161201_144656_add_new_field_to_profile extends Migration
{
    public function up()
    {
        $this->addColumn('{{%profile}}', 'sex', Schema::TYPE_STRING . '(255)');
        $this->addColumn('{{%profile}}', 'date', Schema::TYPE_INTEGER);
        $this->addColumn('{{%profile}}', 'month', Schema::TYPE_INTEGER);
        $this->addColumn('{{%profile}}', 'year', Schema::TYPE_INTEGER);
        $this->addColumn('{{%profile}}', 'avatar', Schema::TYPE_STRING . '(255)');
        $this->addColumn('{{%profile}}', 'banner', Schema::TYPE_STRING . '(255)');
    }

    public function down()
    {
        $this->dropColumn('{{%profile}}', 'banner');
        $this->dropColumn('{{%profile}}', 'avatar');
        $this->dropColumn('{{%profile}}', 'year');
        $this->dropColumn('{{%profile}}', 'month');
        $this->dropColumn('{{%profile}}', 'date');
        $this->dropColumn('{{%profile}}', 'sex');
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
