<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_043456_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_module_testimotional_language_parent',
            '{{%module_testimotional}}','language_parent',
            '{{%module_testimotional}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_testimotional_language',
            '{{%module_testimotional}}','language',
            '{{%module_language}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_module_testimotional_language_parent', '{{%module_testimotional}}');
        $this->dropForeignKey('fk_module_testimotional_language', '{{%module_testimotional}}');
    }
}
