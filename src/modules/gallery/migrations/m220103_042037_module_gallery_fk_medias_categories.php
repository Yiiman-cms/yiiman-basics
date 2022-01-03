<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use yii\db\Schema;
use yii\db\Migration;

class m220103_042037_module_gallery_fk_medias_categories extends Migration
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
            '{{%module_gallery_fk_medias_categories}}',
            [
                'id'       => $this->primaryKey(11),
                'media'    => $this->integer(11)->notNull(),
                'category' => $this->integer(11)->notNull(),
            ], $tableOptions
        );
        $this->createIndex('media', '{{%module_gallery_fk_medias_categories}}', ['media'], false);
        $this->createIndex('category', '{{%module_gallery_fk_medias_categories}}', ['category'], false);

    }

    public function safeDown()
    {
        $this->dropIndex('media', '{{%module_gallery_fk_medias_categories}}');
        $this->dropIndex('category', '{{%module_gallery_fk_medias_categories}}');
        $this->dropTable('{{%module_gallery_fk_medias_categories}}');
    }
}
