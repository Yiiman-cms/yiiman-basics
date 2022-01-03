<?php
/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

	/**
	 * Created by YiiMan TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:+989353466620 | +17272282283
	 *
	 * Site:https://yiiman.ir
	 * Date: ۰۴/۱۰/۲۰۱۹
	 * Time: ۱۰:۲۴ قبل‌ازظهر
	 */
	
	namespace YiiMan\YiiBasics\lib;
	
	
	use mysqli;
	use Yii;
	
	
	class DB extends Object1 {
		/**
		 * @param $query
		 *
		 * @return array
		 */
		public function queryAll($query){
			$mysqli = new mysqli($this->getDsnAttribute( 'host'), Yii::$app->db->username, Yii::$app->db->password,$this->getDsnAttribute(
				'dbname'));
			$mysqli->set_charset("utf8");
			if ($mysqli->connect_errno) {
				echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			
			
			if (!$mysqli->multi_query($query)) {
				echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
			}
			$result=[];
			do {
				if ($res = $mysqli->store_result()) {
					$result[]=$res->fetch_all(MYSQLI_ASSOC);
					
					$res->free();
				}
			} while ($mysqli->more_results() && $mysqli->next_result());
			return $result;
		}
		
		/**
		 * @param $name
		 *
		 * @return mixed|null
		 */
		private function getDsnAttribute($name)
		{
			if (preg_match('/' . $name . '=([^;]*)/', Yii::$app->db->dsn, $match)) {
				return $match[1];
			} else {
				return null;
			}
		}
	}
