<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_042351_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_module_location_neighbourhood_city',
            '{{%module_location_neighbourhood}}','city',
            '{{%module_location_city}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_module_location_neighbourhood_city', '{{%module_location_neighbourhood}}');
    }
}
