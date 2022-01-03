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

class m220103_042036_module_gallery_categories extends Migration
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
            '{{%module_gallery_categories}}',
            [
                'id'              => $this->primaryKey(11),
                'title'           => $this->string(255)->notNull(),
                'description'     => $this->text()->null()->defaultValue(null),
                'image'           => $this->string(255)->notNull(),
                'parent'          => $this->integer(11)->null()->defaultValue(null),
                'language'        => $this->integer(11)->notNull(),
                'language_parent' => $this->integer(11)->null()->defaultValue(null),
            ], $tableOptions
        );
        $this->createIndex('parent', '{{%module_gallery_categories}}', ['parent'], false);
        $this->createIndex('language_parent', '{{%module_gallery_categories}}', ['language_parent'], false);
        $this->createIndex('language', '{{%module_gallery_categories}}', ['language'], false);

    }

    public function safeDown()
    {
        $this->dropIndex('parent', '{{%module_gallery_categories}}');
        $this->dropIndex('language_parent', '{{%module_gallery_categories}}');
        $this->dropIndex('language', '{{%module_gallery_categories}}');
        $this->dropTable('{{%module_gallery_categories}}');
    }
}
