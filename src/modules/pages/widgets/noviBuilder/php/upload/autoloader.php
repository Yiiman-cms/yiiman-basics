<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace Upload;

/**
 * Autoloader
 * This class provides a default PSR-0 autoloader if not using Composer.
 * @author  Josh Lockhart <info@joshlockhart.com>
 * @since   1.0.0
 * @package Upload
 */
class Autoloader
{
    /**
     * The project's base directory
     * @var string
     */
    static protected $base;

    /**
     * Register autoloader
     */
    static public function register()
    {
        self::$base = dirname(__FILE__).'/../';
        spl_autoload_register([
            new self,
            'autoload'
        ]);
    }

    /**
     * Autoload classname
     * @param  string  $className  The class to load
     */
    static public function autoload($className)
    {
        $className = ltrim($className, '\\');
        $className = strtolower($className);
        $fileName = '';
        $namespace = '';
        if ($lastNsPos = strripos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace).DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className).'.php';

        require self::$base.$fileName;
    }
}
