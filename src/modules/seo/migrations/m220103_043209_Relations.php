<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_043209_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_module_seo_flag_contents_language_parent',
            '{{%module_seo_flag_contents}}','language_parent',
            '{{%module_seo_flag_contents}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_seo_flag_contents_language',
            '{{%module_seo_flag_contents}}','language',
            '{{%module_language}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_seo_flags_language',
            '{{%module_seo_flags}}','language',
            '{{%module_language}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_seo_flags_language_parent',
            '{{%module_seo_flags}}','language_parent',
            '{{%module_seo_flags}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_module_seo_flag_contents_language_parent', '{{%module_seo_flag_contents}}');
        $this->dropForeignKey('fk_module_seo_flag_contents_language', '{{%module_seo_flag_contents}}');
        $this->dropForeignKey('fk_module_seo_flags_language', '{{%module_seo_flags}}');
        $this->dropForeignKey('fk_module_seo_flags_language_parent', '{{%module_seo_flags}}');
    }
}
