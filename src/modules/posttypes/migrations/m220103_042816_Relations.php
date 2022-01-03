<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_042816_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_module_posttypes_fields_posttype',
            '{{%module_posttypes_fields}}','posttype',
            '{{%module_posttypes}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_posttypes_fk_posttype_from',
            '{{%module_posttypes_fk}}','posttype_from',
            '{{%module_posttypes}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_posttypes_fk_posttype_to',
            '{{%module_posttypes_fk}}','posttype_to',
            '{{%module_posttypes}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_posttypes_multiples_posttype_id',
            '{{%module_posttypes_multiples}}','posttype_id',
            '{{%module_posttypes}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_posttypes_multiples_fields_multiple_field_id',
            '{{%module_posttypes_multiples_fields}}','multiple_field_id',
            '{{%module_posttypes_multiples}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_module_posttypes_fields_posttype', '{{%module_posttypes_fields}}');
        $this->dropForeignKey('fk_module_posttypes_fk_posttype_from', '{{%module_posttypes_fk}}');
        $this->dropForeignKey('fk_module_posttypes_fk_posttype_to', '{{%module_posttypes_fk}}');
        $this->dropForeignKey('fk_module_posttypes_multiples_posttype_id', '{{%module_posttypes_multiples}}');
        $this->dropForeignKey('fk_module_posttypes_multiples_fields_multiple_field_id', '{{%module_posttypes_multiples_fields}}');
    }
}
