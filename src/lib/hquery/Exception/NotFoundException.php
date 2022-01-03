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
 * Thrown when a discovery does not find any matches.
 * @final  do NOT extend this class, not final for BC reasons
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
/*final */

class NotFoundException extends \RuntimeException implements Exception
{
}
