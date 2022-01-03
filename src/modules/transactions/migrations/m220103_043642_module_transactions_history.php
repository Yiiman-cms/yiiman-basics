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

class m220103_043642_module_transactions_history extends Migration
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
            '{{%module_transactions_history}}',
            [
                'id'              => $this->primaryKey(11),
                'transaction'     => $this->integer(11)->notNull()->comment('تراکنش'),
                'status'          => $this->tinyInteger(1)->notNull()->comment('وضعیت'),
                'created_at'      => $this->datetime()->notNull()->comment('زمان ثبت'),
                'created_by'      => $this->integer(11)->notNull()->comment('ثبت شده توسط'),
                'description'     => $this->string(255)->null()->defaultValue(null)->comment('توضیحات'),
                'language'        => $this->integer(11)->null()->defaultValue(null),
                'language_parent' => $this->integer(11)->null()->defaultValue(null),
            ], $tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%module_transactions_history}}');
    }
}
