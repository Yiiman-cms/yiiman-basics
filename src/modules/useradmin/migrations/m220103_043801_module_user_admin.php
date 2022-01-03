<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_043801_module_user_admin extends Migration
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
            '{{%module_user_admin}}',
            [
                'id'=> $this->primaryKey(11),
                'auth_key'=> $this->string(32)->null()->defaultValue(null),
                'created_at'=> $this->date()->null()->defaultValue(null),
                'status'=> $this->integer(255)->null()->defaultValue(null),
                'nickName'=> $this->string(255)->null()->defaultValue(null),
                'email'=> $this->string(255)->null()->defaultValue(null),
                'password_hash'=> $this->string(255)->null()->defaultValue(null),
                'password_reset_token'=> $this->string(255)->null()->defaultValue(null),
                'image'=> $this->string(400)->null()->defaultValue(null),
                'updated_at'=> $this->datetime()->null()->defaultValue(null),
                'language'=> $this->integer(11)->null()->defaultValue(null),
                'language_parent'=> $this->integer(11)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('email','{{%module_user_admin}}',['email'],true);
        $this->createIndex('password_reset_token','{{%module_user_admin}}',['password_reset_token'],true);

    }

    public function safeDown()
    {
        $this->dropIndex('email', '{{%module_user_admin}}');
        $this->dropIndex('password_reset_token', '{{%module_user_admin}}');
        $this->dropTable('{{%module_user_admin}}');
    }
}
