<?php

use yii\db\Migration;

class m161223_072708_add_field_to_shop extends Migration
{
    public function up()
    {
        $this->addColumn('shop', 'province_id', 'INTEGER AFTER `user_id`');
        $this->addColumn('shop', 'city_id', 'INTEGER AFTER `province_id`');
        $this->addColumn('shop', 'district_id', 'INTEGER AFTER `city_id`');
        $this->addColumn('shop', 'tagline', 'VARCHAR(255) AFTER `name`');
        $this->addColumn('shop', 'email', 'VARCHAR(255) AFTER `tagline`');
        $this->addColumn('shop', 'address', 'VARCHAR(255) AFTER `email`');
        $this->addColumn('shop', 'avatar', 'VARCHAR(255) AFTER `address`');
        $this->addColumn('shop', 'banner', 'VARCHAR(255) AFTER `avatar`');
        $this->addColumn('shop', 'startDay', 'VARCHAR(255) AFTER `header`');
        $this->addColumn('shop', 'endDay', 'VARCHAR(255) AFTER `startDay`');
        $this->addColumn('shop', 'startTime', 'TIME AFTER `endDay`');
        $this->addColumn('shop', 'endTime', 'TIME AFTER `startTime`');
    }

    public function down()
    {
        $this->dropColumn('shop', 'endTime');
        $this->dropColumn('shop', 'startTime');
        $this->dropColumn('shop', 'endDay');
        $this->dropColumn('shop', 'startDay');
        $this->dropColumn('shop', 'banner');
        $this->dropColumn('shop', 'avatar');
        $this->dropColumn('shop', 'address');
        $this->dropColumn('shop', 'email');
        $this->dropColumn('shop', 'tagline');
        $this->dropColumn('shop', 'district_id');
        $this->dropColumn('shop', 'city_id');
        $this->dropColumn('shop', 'province_id');
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
