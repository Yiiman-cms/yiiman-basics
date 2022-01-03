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

class m220103_042605_Relations extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_module_notification_users_settings_uid',
            '{{%module_notification_users_settings}}', 'uid',
            '{{%module_user_admin}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_notification_users_settings_uid',
            '{{%module_notification_users_settings}}', 'uid',
            '{{%module_user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_notification_messages_uid',
            '{{%module_notification_messages}}', 'uid',
            '{{%module_user_admin}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_notification_messages_uid',
            '{{%module_notification_messages}}', 'uid',
            '{{%module_user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_notification_messages_created_by',
            '{{%module_notification_messages}}', 'created_by',
            '{{%module_user_admin}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_module_notification_messages_created_by',
            '{{%module_notification_messages}}', 'created_by',
            '{{%module_user}}', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_module_notification_users_settings_uid', '{{%module_notification_users_settings}}');
        $this->dropForeignKey('fk_module_notification_users_settings_uid', '{{%module_notification_users_settings}}');
        $this->dropForeignKey('fk_module_notification_messages_uid', '{{%module_notification_messages}}');
        $this->dropForeignKey('fk_module_notification_messages_uid', '{{%module_notification_messages}}');
        $this->dropForeignKey('fk_module_notification_messages_created_by', '{{%module_notification_messages}}');
        $this->dropForeignKey('fk_module_notification_messages_created_by', '{{%module_notification_messages}}');
    }
}
