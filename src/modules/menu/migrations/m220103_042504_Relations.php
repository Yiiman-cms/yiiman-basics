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

class m220103_042504_Relations extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_module_menu_parent_id',
            '{{%module_menu}}', 'parent_id',
            '{{%module_menu}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_menu_language_parent',
            '{{%module_menu}}', 'language_parent',
            '{{%module_menu}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_menu_language',
            '{{%module_menu}}', 'language',
            '{{%module_language}}', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_module_menu_parent_id', '{{%module_menu}}');
        $this->dropForeignKey('fk_module_menu_language_parent', '{{%module_menu}}');
        $this->dropForeignKey('fk_module_menu_language', '{{%module_menu}}');
    }
}
