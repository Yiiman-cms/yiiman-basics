<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 * Date: ۰۳/۰۳/۲۰۲۰
 * Time: ۱۱:۲۸ قبل‌ازظهر
 */

namespace YiiMan\YiiBasics\lib;

/**
 * View any string as a hexdump
 * This is most commonly used to view binary data from streams
 * or sockets while debugging, but can be used to view any string
 * with non-viewable characters.
 * @link https://github.com/clue/hexdump
 */
class HexDump
{
    /**
     * @var bool Set to true for uppercase hex
     */
    private $uppercase = false;

    /**
     * View any string as a hexdump, save for inclusion into a HTML webpage
     * @param  string  $data
     * @return string
     * @uses self::dump()
     * @uses htmlentities()
     */
    public function dumpHtml($data)
    {
        if ($data !== '') {
            $data = htmlentities($this->dump($data), ENT_NOQUOTES, 'UTF-8');
        }
        return "<pre>\n".$data."</pre>\n";
    }

    /**
     * View any string as a hexdump.
     * @param  string  $data  The string to be dumped
     * @return string
     */
    public function dump($data)
    {
        // Init
        $hexi = '';
        $ascii = '';
        $dump = '';
        $offset = 0;
        $len = strlen($data);

        // Upper or lower case hexadecimal
        $x = ($this->uppercase === false) ? 'x' : 'X';

        // Iterate string
        for ($i = $j = 0; $i < $len; $i++) {
            // Convert to hexidecimal
            $hexi .= sprintf("%02$x ", ord($data[$i]));

            // Replace non-viewable bytes with '.'
            if (ord($data[$i]) >= 32) {
                $ascii .= $data[$i];
            } else {
                $ascii .= '.';
            }

            // Add extra column spacing
            if ($j === 7 && $i !== $len - 1) {
                $hexi .= ' ';
                $ascii .= ' ';
            }

            // Add row
            if (++$j === 16 || $i === $len - 1) {
                // Join the hexi / ascii output
                $dump .= sprintf("%04$x  %-49s  %s", $offset, $hexi, $ascii);

                // Reset vars
                $hexi = $ascii = '';
                $offset += 16;
                $j = 0;

                // Add newline
                if ($i !== $len - 1) {
                    $dump .= "\n";
                }
            }
        }

        // Finish dump
        $dump .= "\n";

        return $dump;
    }
}
