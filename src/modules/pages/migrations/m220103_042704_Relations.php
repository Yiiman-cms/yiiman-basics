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

class m220103_042704_Relations extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_module_pages_language_parent',
            '{{%module_pages}}', 'language_parent',
            '{{%module_pages}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_pages_language',
            '{{%module_pages}}', 'language',
            '{{%module_language}}', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_module_pages_language_parent', '{{%module_pages}}');
        $this->dropForeignKey('fk_module_pages_language', '{{%module_pages}}');
    }
}
