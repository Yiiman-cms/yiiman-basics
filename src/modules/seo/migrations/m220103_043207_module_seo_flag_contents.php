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

class m220103_043207_module_seo_flag_contents extends Migration
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
            '{{%module_seo_flag_contents}}',
            [
                'id'              => $this->primaryKey(11),
                'full_content'    => $this->text()->null()->defaultValue(null),
                'status'          => $this->integer(11)->null()->defaultValue(null),
                'title'           => $this->string(255)->null()->defaultValue(null),
                'slug'            => $this->string(255)->null()->defaultValue(null),
                'short_content'   => $this->string(1000)->null()->defaultValue(null),
                'language'        => $this->integer(11)->notNull(),
                'language_parent' => $this->integer(11)->null()->defaultValue(null),
                'link'            => $this->string(255)->null()->defaultValue(null),
            ], $tableOptions
        );
        $this->createIndex('language_parent', '{{%module_seo_flag_contents}}', ['language_parent'], false);
        $this->createIndex('language', '{{%module_seo_flag_contents}}', ['language'], false);

    }

    public function safeDown()
    {
        $this->dropIndex('language_parent', '{{%module_seo_flag_contents}}');
        $this->dropIndex('language', '{{%module_seo_flag_contents}}');
        $this->dropTable('{{%module_seo_flag_contents}}');
    }
}
