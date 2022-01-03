<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_042035_module_gallery_medias extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%module_gallery_medias}}',
            [
                'id'=> $this->primaryKey(11),
                'type'=> $this->string(20)->notNull(),
                'table'=> $this->string(255)->notNull(),
                'description'=> $this->string(255)->null()->defaultValue(null),
                'table_id'=> $this->integer(11)->notNull(),
                'file_name'=> $this->string(255)->notNull(),
                'file_size'=> $this->double()->notNull(),
                'category'=> $this->integer(11)->null()->defaultValue(null),
                'language'=> $this->integer(11)->notNull(),
                'language_parent'=> $this->integer(11)->null()->defaultValue(null),
                'contentType'=> $this->string(255)->notNull(),
                'path'=> $this->string(255)->null()->defaultValue(null),
                'extension'=> $this->string(10)->notNull(),
                'className'=> $this->string(255)->notNull(),
                'default'=> $this->tinyInteger(1)->null()->defaultValue(null),
                'fieldName'=> $this->string(255)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('category','{{%module_gallery_medias}}',['category'],false);
        $this->createIndex('language','{{%module_gallery_medias}}',['language'],false);
        $this->createIndex('module_gallery_medias_ibfk_3','{{%module_gallery_medias}}',['language_parent'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('category', '{{%module_gallery_medias}}');
        $this->dropIndex('language', '{{%module_gallery_medias}}');
        $this->dropIndex('module_gallery_medias_ibfk_3', '{{%module_gallery_medias}}');
        $this->dropTable('{{%module_gallery_medias}}');
    }
}
