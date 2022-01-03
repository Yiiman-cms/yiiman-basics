<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_043842_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_module_widget_language',
            '{{%module_widget}}','language',
            '{{%module_language}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_widget_language_parent',
            '{{%module_widget}}','language_parent',
            '{{%module_widget}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_module_widget_language', '{{%module_widget}}');
        $this->dropForeignKey('fk_module_widget_language_parent', '{{%module_widget}}');
    }
}
