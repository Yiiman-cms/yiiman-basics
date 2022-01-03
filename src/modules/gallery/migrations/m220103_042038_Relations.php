<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_042038_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_module_gallery_medias_category',
            '{{%module_gallery_medias}}','category',
            '{{%module_gallery_categories}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_gallery_medias_language',
            '{{%module_gallery_medias}}','language',
            '{{%module_language}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_gallery_medias_language_parent',
            '{{%module_gallery_medias}}','language_parent',
            '{{%module_gallery_medias}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_gallery_categories_parent',
            '{{%module_gallery_categories}}','parent',
            '{{%module_gallery_categories}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_gallery_categories_language_parent',
            '{{%module_gallery_categories}}','language_parent',
            '{{%module_gallery_categories}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_gallery_categories_language',
            '{{%module_gallery_categories}}','language',
            '{{%module_language}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_gallery_fk_medias_categories_media',
            '{{%module_gallery_fk_medias_categories}}','media',
            '{{%module_gallery_medias}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_module_gallery_fk_medias_categories_category',
            '{{%module_gallery_fk_medias_categories}}','category',
            '{{%module_gallery_categories}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_module_gallery_medias_category', '{{%module_gallery_medias}}');
        $this->dropForeignKey('fk_module_gallery_medias_language', '{{%module_gallery_medias}}');
        $this->dropForeignKey('fk_module_gallery_medias_language_parent', '{{%module_gallery_medias}}');
        $this->dropForeignKey('fk_module_gallery_categories_parent', '{{%module_gallery_categories}}');
        $this->dropForeignKey('fk_module_gallery_categories_language_parent', '{{%module_gallery_categories}}');
        $this->dropForeignKey('fk_module_gallery_categories_language', '{{%module_gallery_categories}}');
        $this->dropForeignKey('fk_module_gallery_fk_medias_categories_media', '{{%module_gallery_fk_medias_categories}}');
        $this->dropForeignKey('fk_module_gallery_fk_medias_categories_category', '{{%module_gallery_fk_medias_categories}}');
    }
}
