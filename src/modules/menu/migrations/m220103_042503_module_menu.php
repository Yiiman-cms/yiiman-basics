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

class m220103_042503_module_menu extends Migration
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
            '{{%module_menu}}',
            [
                'id'              => $this->primaryKey(11)->comment('Id'),
                'title'           => $this->string(255)->null()->defaultValue(null)->comment('Title'),
                'url'             => $this->string(255)->null()->defaultValue(null)->comment('Url'),
                'location'        => $this->tinyInteger(2)->null()->defaultValue(null)->comment('Location'),
                'icon'            => $this->string(255)->null()->defaultValue(null)->comment('Icon'),
                'image'           => $this->string(255)->null()->defaultValue(null)->comment('Image'),
                'status'          => $this->tinyInteger(1)->null()->defaultValue(null)->comment('Status'),
                'parent_id'       => $this->integer(11)->null()->defaultValue(null)->comment('Parent Menu'),
                'index'           => $this->integer(11)->null()->defaultValue(null)->comment('Index'),
                'type'            => $this->text()->null()->defaultValue(null),
                'related_id'      => $this->integer(11)->null()->defaultValue(null),
                'language'        => $this->integer(11)->null()->defaultValue(null),
                'language_parent' => $this->integer(11)->null()->defaultValue(null),
            ], $tableOptions
        );
        $this->createIndex('parent_id', '{{%module_menu}}', ['parent_id'], false);
        $this->createIndex('language_parent', '{{%module_menu}}', ['language_parent'], false);
        $this->createIndex('language', '{{%module_menu}}', ['language'], false);

    }

    public function safeDown()
    {
        $this->dropIndex('parent_id', '{{%module_menu}}');
        $this->dropIndex('language_parent', '{{%module_menu}}');
        $this->dropIndex('language', '{{%module_menu}}');
        $this->dropTable('{{%module_menu}}');
    }
}
