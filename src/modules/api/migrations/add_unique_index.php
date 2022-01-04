<?php
/**
 * Copyright (c) 2014-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\Setting\module\models\DynamicModel\migrations;

use yii\db\Exception;
use yii\db\Migration;
use Yii;

class add_unique_index extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        try {

            $this->createTable(
                '{{%settings}}',
                [
                    'id'       => $this->primaryKey(),
                    'type'     => $this->string(255)->notNull(),
                    'section'  => $this->string(255)->notNull(),
                    'key'      => $this->string(255)->notNull(),
                    'value'    => $this->text(),
                    'active'   => $this->boolean(),
                    'created'  => $this->dateTime(),
                    'modified' => $this->dateTime(),
                ],
                $tableOptions
            );

            $this->createIndex('settings_unique_key_section', '{{%settings}}', [
                'section',
                'key'
            ], true);
        } catch (Exception $e) {
        }

    }

    public function safeDown()
    {
        $this->dropIndex('settings_unique_key_section', '{{%settings}}');
        $this->dropTable('{{%settings}}');


    }
}
