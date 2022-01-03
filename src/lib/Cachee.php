<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\lib;


class Cachee
{

    private static $times = [];
    private static $path = '';

    public function addCache($cacheName, $Html, $expireMinutes = 10)
    {
        if (Core::$enabledCache) {

            $this->loadTimes();
            $file = fopen(self::$path.'/'.$cacheName.'.html', 'w+');
            fwrite($file, $Html);
            fclose($file);
            self::$times[$cacheName] = strtotime(date('Y-m-d H:i:s').' + '.$expireMinutes.'minute');
            $this->saveTimes();
            return $Html;
        } else {
            return $Html;
        }
    }

    private function loadTimes()
    {
        if (Core::$enabledCache) {
            if (empty(self::$times)) {
                self::$path = \Yii::getAlias('@runtime').'/tmp/cache';
                if (!realpath(self::$path)) {
                    mkdir(self::$path);
                }
                if (file_exists(self::$path.'/cacheTimes.json')) {
                    self::$times = json_decode(file_get_contents(self::$path.'/cacheTimes.json'), true);
                    if (empty(self::$times)) {
                        self::$times = [];
                    }
                } else {
                    $file = fopen(self::$path.'/cacheTimes.json', 'w+');
                    fwrite($file, '');
                    fclose($file);
                }
            }
        }
    }

    private function saveTimes()
    {
        if (Core::$enabledCache) {

            $file = fopen(self::$path.'/cacheTimes.json', 'w+');
            fwrite($file, json_encode(self::$times));
            fclose($file);
        }
    }

    public function getCache($cacheName)
    {
        if (Core::$enabledCache) {

            if (YII_DEBUG) {
                return false;
            }
            $this->loadTimes();

            if (empty(self::$times[$cacheName])) {
                return false;
            }

            // < check Expire Time >
            {
                if (self::$times[$cacheName] > strtotime(date('Y-m-d H:i:s'))) {
                    if (file_exists(self::$path.'/'.$cacheName.'.html')) {
                        return file_get_contents(self::$path.'/'.$cacheName.'.html');
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
            // </ check Expire Time >
        } else {
            return false;
        }
    }

    public function deleteCache($cacheName)
    {
        if (Core::$enabledCache) {
            if (file_exists(self::$path.'/'.$cacheName)) {
                unlink(self::$path.'/'.$cacheName);
            }
        }
    }
}
