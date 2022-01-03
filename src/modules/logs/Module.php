<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\logs;

/**
 * tour module definition class
 */


use YiiMan\YiiBasics\lib\Application;
use YiiMan\YiiBasics\modules\logs\models\Log;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\web\GroupUrlRule;

class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */

    public $controllerNamespace;
    public $name;
    public $nameSpace;
    public $config = [];
    /**
     * @var array
     */
    public $aliases = [];
    /**
     * @var array
     */
    public $levelClasses = [
        'trace'   => 'label-default',
        'info'    => 'label-info',
        'warning' => 'label-warning',
        'error'   => 'label-danger',
    ];
    /**
     * @var string
     */
    public $defaultLevelClass = 'label-default';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        // < set Class Parameters >
        {
            $this->config = include realpath(__DIR__.'/config.php');
            $this->nameSpace = 'YiiMan\YiiBasics\modules\\'.$this->config['name'];
            $this->controllerNamespace = 'YiiMan\YiiBasics\modules\\'.$this->config['name'].'\controllers';
            $this->name = $this->config['name'];
        }
        // </ set Class Parameters >
    }

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if ($app instanceof Application) {
            $app->getUrlManager()->addRules([
                [
                    'class'  => GroupUrlRule::class,
                    'prefix' => $this->id,
                    'rules'  => [
                        ''                           => 'default/index',
                        '<action:\w+>/<slug:[\w-]+>' => 'default/<action>',
                        '<action:\w+>'               => 'default/<action>',
                    ],
                ]
            ], false);
        } else {
            throw new InvalidConfigException('Can use for web application only.');
        }
    }

    /**
     * @param  string       $slug
     * @param  null|string  $stamp
     * @return null|Log
     */
    public function findLog($slug, $stamp)
    {
        foreach ($this->aliases as $name => $alias) {
            if ($slug === Log::extractSlug($name)) {
                return new Log($name, $alias, $stamp);
            }
        }

        return null;
    }

    /**
     * @param  Log  $log
     * @return Log[]
     */
    public function getHistory(Log $log)
    {
        $logs = [];
        foreach (glob(Log::extractFileName($log->alias, '*')) as $fileName) {
            $logs[] = new Log($log->name, $log->alias, Log::extractFileStamp($log->alias, $fileName));
        }

        return $logs;
    }

    /**
     * @return integer
     */
    public function getTotalCount()
    {
        $total = 0;
        foreach ($this->getLogs() as $log) {
            foreach ($log->getCounts() as $count) {
                $total += $count;
            }
        }

        return $total;
    }

    /**
     * @return Log[]
     */
    public function getLogs()
    {
        $logs = [];
        foreach ($this->aliases as $name => $alias) {
            $logs[] = new Log($name, $alias);
        }

        return $logs;
    }
}
