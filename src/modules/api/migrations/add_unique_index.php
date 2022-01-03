<?php
/**
 * @link http://phe.me
 * @copyright Copyright (c) 2014 Pheme
 * @license MIT http://opensource.org/licenses/MIT
 */
namespace YiiMan\YiiBasics\modules\setting\migrations;
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
	    try{

		    $this->createTable(
			    '{{%settings}}',
			    [
				    'id' => $this->primaryKey(),
				    'type' => $this->string(255)->notNull(),
				    'section' => $this->string(255)->notNull(),
				    'key' => $this->string(255)->notNull(),
				    'value' => $this->text(),
				    'active' => $this->boolean(),
				    'created' => $this->dateTime(),
				    'modified' => $this->dateTime(),
			    ],
			    $tableOptions
		    );

		    $this->createIndex('settings_unique_key_section', '{{%settings}}', ['section', 'key'], true);
	    }catch (Exception $e){}

    }

    public function safeDown()
    {
        $this->dropIndex('settings_unique_key_section', '{{%settings}}');
	    $this->dropTable('{{%settings}}');


    }
}
