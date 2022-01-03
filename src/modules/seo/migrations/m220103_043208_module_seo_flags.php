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

class m220103_043208_module_seo_flags extends Migration
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
            '{{%module_seo_flags}}',
            [
                'id'              => $this->primaryKey(11),
                'content'         => $this->integer(11)->null()->defaultValue(null),
                'flag'            => $this->string(500)->null()->defaultValue(null),
                'language'        => $this->integer(11)->notNull(),
                'language_parent' => $this->integer(11)->null()->defaultValue(null),
            ], $tableOptions
        );
        $this->createIndex('flagContent', '{{%module_seo_flags}}', ['content'], false);
        $this->createIndex('language', '{{%module_seo_flags}}', ['language'], false);
        $this->createIndex('language_parent', '{{%module_seo_flags}}', ['language_parent'], false);

    }

    public function safeDown()
    {
        $this->dropIndex('flagContent', '{{%module_seo_flags}}');
        $this->dropIndex('language', '{{%module_seo_flags}}');
        $this->dropIndex('language_parent', '{{%module_seo_flags}}');
        $this->dropTable('{{%module_seo_flags}}');
    }
}
