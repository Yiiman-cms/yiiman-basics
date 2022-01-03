<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace YiiMan\YiiBasics\modules\systemlog\models;

use Yii;
use yii\base\InvalidConfigException;
use yii\db\Connection;
use yii\db\Exception;
use yii\di\Instance;
use yii\helpers\VarDumper;
use yii\log\LogRuntimeException;
use yii\log\Target;
use yii\web\Request;

/**
 * DbTarget stores log messages in a database table.
 *
 * The database connection is specified by [[db]]. Database schema could be initialized by applying migration:
 *
 * ```
 * yii migrate --migrationPath=@yii/log/migrations/
 * ```
 *
 * If you don't want to use migration and need SQL instead, files for all databases are in migrations directory.
 *
 * You may change the name of the table used to store the data by setting [[logTable]].
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DbTarget extends Target
{
    /**
     * @var Connection|array|string the DB connection object or the application component ID of the DB connection.
     * After the DbTarget object is created, if you want to change this property, you should only assign it
     * with a DB connection object.
     * Starting from version 2.0.2, this can also be a configuration array for creating the object.
     */
    public $db = 'db';
    /**
     * @var string name of the DB table to store cache content. Defaults to "log".
     */
    public $logTable = 'module_systemlog';


    /**
     * Error message level. An error message is one that indicates the abnormal termination of the
     * application and may require developer's handling.
     */
    const LEVEL_ERROR = 0x01;
    /**
     * Warning message level. A warning message is one that indicates some abnormal happens but
     * the application is able to continue to run. Developers should pay attention to this message.
     */
    const LEVEL_WARNING = 0x02;
    /**
     * Informational message level. An informational message is one that includes certain information
     * for developers to review.
     */
    const LEVEL_INFO = 0x04;
    /**
     * Tracing message level. An tracing message is one that reveals the code execution flow.
     */
    const LEVEL_TRACE = 0x08;
    /**
     * Profiling message level. This indicates the message is for profiling purpose.
     */
    const LEVEL_PROFILE = 0x40;
    /**
     * Profiling message level. This indicates the message is for profiling purpose. It marks the
     * beginning of a profiling block.
     */
    const LEVEL_PROFILE_BEGIN = 0x50;
    /**
     * Profiling message level. This indicates the message is for profiling purpose. It marks the
     * end of a profiling block.
     */
    const LEVEL_PROFILE_END = 0x60;

    const LEVEL_LABELS=[
        self::LEVEL_ERROR => 'خطا',
        self::LEVEL_INFO => 'اطلاعات',
        self::LEVEL_PROFILE => 'پروفایل',
        self::LEVEL_PROFILE_BEGIN => 'آغاز پروفایل',
        self::LEVEL_PROFILE_END => 'اتمام پروفایل',
        self::LEVEL_TRACE => 'پیگیری',
        self::LEVEL_WARNING => 'هشدار'
    ];

    public static function getHTMLLevelLabel($level)
    {
        $out=
            [
                self::LEVEL_ERROR => 'خطا',
                self::LEVEL_INFO => 'اطلاعات',
                self::LEVEL_PROFILE => 'پروفایل',
                self::LEVEL_PROFILE_BEGIN => 'آغاز پروفایل',
                self::LEVEL_PROFILE_END => 'اتمام پروفایل',
                self::LEVEL_TRACE => 'پیگیری',
                self::LEVEL_WARNING => 'هشدار'
            ];
        $color=
            [
                self::LEVEL_ERROR => '#ff1744',
                self::LEVEL_INFO => '#00e5ff',
                self::LEVEL_PROFILE => '#6d4c41',
                self::LEVEL_PROFILE_BEGIN => '#6d4c41',
                self::LEVEL_PROFILE_END => '#6d4c41',
                self::LEVEL_TRACE => '#76ff03',
                self::LEVEL_WARNING => '#ff9100'
            ];
        return'<span style="color:'.$color[$level].'">'.$out[$level].'</span>';

    }

    /**
     * Initializes the DbTarget component.
     * This method will initialize the [[db]] property to make sure it refers to a valid DB connection.
     * @throws InvalidConfigException if [[db]] is invalid.
     */
    public function init()
    {
        parent::init();
        $this->db = Instance::ensure($this->db, Connection::className());
    }

    /**
     * Stores log messages to DB.
     * Starting from version 2.0.14, this method throws LogRuntimeException in case the log can not be exported.
     * @throws Exception
     * @throws LogRuntimeException
     */
    public function export()
    {
        if ($this->db->getTransaction()) {
            // create new database connection, if there is an open transaction
            // to ensure insert statement is not affected by a rollback
            $this->db = clone $this->db;
        }

        $tableName = $this->db->quoteTableName($this->logTable);
        $sql = "INSERT INTO $tableName ([[level]], [[category]], [[log_time]], [[prefix]], [[message]],[[ip]],[[uid]],[[session_id]],[[app_name]],[[session_details]],[[last_error]])
                VALUES (:level, :category, :log_time, :prefix, :message,:ip,:uid,:ses,:app,:session_detail,:last_error)";
        $command = $this->db->createCommand($sql);
        foreach ($this->messages as $message) {
            list($text, $level, $category, $timestamp) = $message;
            if (!is_string($text)) {
                // exceptions may not be serializable if in the call stack somewhere is a Closure
                if ($text instanceof \Throwable || $text instanceof \Exception) {
                    $text = (string)$text;
                } else {
                    $text = VarDumper::export($text);
                }
            }

            if ($command->bindValues([
                    ':level' => $level,
                    ':category' => $category,
                    ':log_time' => date('Y-m-d H:i:s', $timestamp),
                    ':prefix' => $this->getMessagePrefix($message),
                    ':message' => $text,
                    ':ip' => $this->getIP(),
                    ':uid' => $this->getUserID(),
                    ':ses' => $this->getSessionID(),
                    ':app' => $this->getApp(),
                    ':session_detail'=>!empty($_SESSION)?json_encode($_SESSION):'{}',
                    ':last_error'=>'',
                ])->execute() > 0) {
                continue;
            }
            throw new LogRuntimeException('Unable to export log through database!');
        }
    }

    public function getMessagePrefix($message)
    {
        if ($this->prefix !== null) {
            return call_user_func($this->prefix, $message);
        }

        if (Yii::$app === null) {
            return '';
        }

        $request = Yii::$app->getRequest();
        $ip = $request instanceof Request ? $request->getUserIP() : '-';

        /* @var $user \yii\web\User */
        $user = Yii::$app->has('user', true) ? Yii::$app->get('user') : null;
        if ($user && ($identity = $user->getIdentity(false))) {
            $userID = $identity->getId();
        } else {
            $userID = '-';
        }

        /* @var $session \yii\web\Session */
        $session = Yii::$app->has('session', true) ? Yii::$app->get('session') : null;
        $sessionID = $session && $session->getIsActive() ? $session->getId() : '-';

        return "[$ip][$userID][$sessionID]";
    }

    private function getIP()
    {
        $request = Yii::$app->getRequest();
        return $request instanceof Request ? $request->getUserIP() : '-';
    }

    private function getUserID()
    {
        /* @var $user \yii\web\User */
        $user = Yii::$app->has('user', true) ? Yii::$app->get('user') : null;
        if ($user && ($identity = $user->getIdentity(false))) {
            $userID = $identity->getId();
        } else {
            $userID = null;
        }
        return $userID;
    }

    private function getSessionID()
    {
        /* @var $session \yii\web\Session */
        $session = Yii::$app->has('session', true) ? Yii::$app->get('session') : null;
        return $session && $session->getIsActive() ? $session->getId() : '-';
    }

    private function getApp()
    {
        return Yii::$app->id;
    }
}
