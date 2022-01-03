<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\lib\hquery\Exception;

use YiiMan\YiiBasics\lib\hquery\Exception;

/**
 * This exception is thrown when we cannot use a discovery strategy. This is *not* thrown when
 * the discovery fails to find a class.
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class StrategyUnavailableException extends \RuntimeException implements Exception
{
}
