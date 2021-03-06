<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\lib\hquery;

// ------------------------------------------------------------------------

/**
 *  Base class for HTML Elements and Documents.
 *  API Documentation at https://duzun.github.io/hQuery.php
 * @license MIT
 * @internal
 */
abstract class Node implements \Iterator, \Countable
{
    // ------------------------------------------------------------------------
    const VERSION = '2.2.0';
    // ------------------------------------------------------------------------
    public static $last_http_result; // Response details of last request

    // ------------------------------------------------------------------------
    public static $selected_doc = null;

    // ------------------------------------------------------------------------
        static $_ar_ = []; // Properties
        static $_mi_ = PHP_INT_MAX; // Parent doc
        static $_nl_ = null; // contained elements' IDs
        static $_fl_ = false; // excluded elements' IDs
    static $_tr_ = true;
    // ------------------------------------------------------------------------
        protected static $_mb_encodings; // map tag names (eg ['b' => 'strong', 'i' => 'em'])

    // ------------------------------------------------------------------------
    // Memory efficiency tricks ;-)
public $tag_map;
protected $_prop = [];
protected $doc;
protected $ids;
protected $exc;

    // ------------------------------------------------------------------------

    protected function __construct($doc, $ids, $is_ctx = false)
    {
        $this->doc = $doc;
        if (is_int($ids)) {
            $ids = [$ids => $doc->ids[$ids]];
        }
        $this->ids = $is_ctx ? $this->_ctx_ids($ids) : $ids;
        if ($doc === $this) { // documents have no $doc property
            unset($this->doc);
            self::$selected_doc = $this;
        }
    }

    /**
     * Make a context array of ids:
     *     if x in $ids && exists y in $ids such that x in y then del x from $ids
     * @return array ids
     */
    protected function _ctx_ids($ids = null)
    {
        $m = -1;
        $exc = $this->exc;
        if (!isset($ids)) {
            $ids = $this->ids;
        } elseif (is_int($ids)) {
            $ids = isset($this->ids[$ids]) ? [$ids => $this->ids[$ids]] : self::$_fl_;
        } else {
            foreach ($ids as $b => $e) {
                if ($b <= $m || $b + 1 >= $e and empty($exc[$b])) {
                    unset($ids[$b]);
                } else {
                    $m = $e;
                }
            }
        }
        return $ids;
    }

    // ------------------------------------------------------------------------

    /**
     * Parse a selector string into an array structure.
     * tn1#id1 .cl1.cl2:first tn2:5 , tn3.cl3 tn4#id2:eq(-1) > tn5:last-child > tn6:lt(3)
     *  -->
     *   [
     *      [
     *          [{ n: "tn1", i: "id1", c: [],            p: []  }],
     *          [{ n: NULL,  i: NULL,  c: ["cl1","cl2"], p: [0] }],
     *          [{ n: "tn2", i: NULL,  c: [],            p: [5] }]
     *      ]
     *    , [
     *          [{ n: "tn3", i: NULL, c: ["cl3"], p: [] }],
     *          [
     *              { n: "tn4", i: "id2", c: [], p: [-1]   },
     *              { n: "tn5", i: NULL , c: [], p: [-1]   },
     *              { n: "tn6", i: NULL , c: [], p: ["<3"] }
     *          ]
     *      ]
     *   ]
     * @return array
     * @internal
     */
    static function html_selector2struc($sel)
    {
        $sc = '#.:';
        $n = null;
        $a = [];
        $def = [
            'n' => $n,
            'i' => $n,
            'c' => $a,
            'p' => $a
        ];
        $sel = rtrim(trim(preg_replace('/\\s*(>|,)\\s*/', '$1', $sel), " \t\n\r,>"), $sc);
        $sel = explode(',', $sel);
        foreach ($sel as &$a) {
            $a = preg_split('|\\s+|', $a);
            foreach ($a as &$b) {
                $b = explode('>', $b);
                foreach ($b as &$c) {
                    $d = $def;
                    $l = strlen($c);
                    $j = strcspn($c, $sc, 0, $l);
                    if ($j) {
                        $d['n'] = substr($c, 0, $j);
                    }
                    $i = $j;
                    while ($i < $l) {
                        $k = $c[$i++];
                        $j = strcspn($c, $sc, $i, $l);
                        if ($j) {
                            $e = substr($c, $i, $j);
                            switch ($k) {
                                case '.':
                                    $d['c'][] = $e;
                                    break;
                                case '#':
                                    $d['i'] = $e;
                                    break;
                                case ':':
                                    $d['p'][] = self::html_normal_pseudoClass($e);
                                    break;
                            }
                            $i += $j;
                        }
                    }
                    if (empty($d['c'])) {
                        $d['c'] = $n;
                    }
                    if (empty($d['p'])) {
                        $d['p'] = $n;
                    }
                    $c = $d;
                }
            }
        }
        return $sel;
    }
    // ------------------------------------------------------------------------

    // Deprecated

    /**
     * Normalize a CSS selector pseudo-class string.
     * ( int, string or array(name => value) )
     * @return int|array
     * @internal
     */
    static function html_normal_pseudoClass($p)
    {
        if (is_int($p)) {
            return $p;
        }
        $i = (int) $p;
        if ((string) $i === $p) {
            return $i;
        }

        static $map = [
            'lt'       => '<',
            'gt'       => '>',
            'prev'     => '-',
            'next'     => '+',
            'parent'   => '|',
            'children' => '*',
            '*'        => '*'
        ];
        $p = explode('(', $p, 2);
        $p[1] = isset($p[1]) ? trim(rtrim($p[1], ')')) : null;
        switch ($p[0]) {
            case 'first'      :
            case 'first-child':
                return 0;
            case 'last'       :
            case 'last-child' :
                return -1;
            case 'eq'         :
                return (int) $p[1];
            default:
                if (isset($map[$p[0]])) {
                    $p[0] = $map[$p[0]];
                    if (isset($p[1])) {
                        $p[1] = (int) $p[1];
                    }
                } else {
                    // ??? unknown ps
                }
        }
        return [$p[0] => $p[1]];
    }

    static function html_parseAttrStr($str, $case_folding = true, $extended = false)
    {
        static $_attrName_firstLet = null;
        if (!$_attrName_firstLet) {
            $_attrName_firstLet = self::str_range('a-zA-Z_');
        }

        $ret = [];
        for ($i = strspn($str, " \t\n\r"), $len = strlen($str); $i < $len;) {
            $i += strcspn($str, $_attrName_firstLet, $i);
            if ($i >= $len) {
                break;
            }
            $b = $i;
            $i += strcspn($str, " \t\n\r=\"\'", $i);
            $attrName = rtrim(substr($str, $b, $i - $b));
            if ($case_folding) {
                $attrName = strtolower($attrName);
            }
            $i += strspn($str, " \t\n\r", $i);
            $attrValue = null;
            if ($i < $len && $str[$i] == '=') {
                ++$i;
                $i += strspn($str, " \t\n\r", $i);
                if ($i < $len) {
                    $q = substr($str, $i, 1);
                    if ($q == '"' || $q == "'") {
                        $b = ++$i;
                        $e = strpos($str, $q, $i);
                        if ($e !== false) {
                            $attrValue = substr($str, $b, $e - $b);
                            $i = $e + 1;
                        } else {
                            /*??? no closing quote */
                        }
                    } else {
                        $b = $i;
                        $i += strcspn($str, " \t\n\r\"\'", $i);
                        $attrValue = substr($str, $b, $i - $b);
                    }
                }
            }
            if ($extended && $attrValue) switch ($case_folding ? $attrName : strtolower($attrName)) {
                case 'class':
                    $attrValue = preg_split("|\\s+|", trim($attrValue));
                    if (count($attrValue) == 1) {
                        $attrValue = reset($attrValue);
                    } else {
                        sort($attrValue);
                    }
                    break;

                case 'style':
                    $attrValue = self::parseCSStr($attrValue, $case_folding);
                    break;
            }

            $ret[$attrName] = $attrValue;
        }
        return $ret;
    }

    static function str_range($comp, $pos = 0, $len = null)
    {
        $ret = [];
        $b = strlen($comp);
        if (!isset($len) || $len > $b) {
            $len = $b;
        }
        $b = "\x0";
        while ($pos < $len) {
            switch ($c = $comp[$pos++]) {
                case '\\':
                    {
                        $b = substr($comp, $pos, 1);
                        $ret[$b] = $pos++;
                    }
                    break;

                case '-':
                    {
                        $c_ = ord($c = substr($comp, $pos, 1));
                        $b = ord($b);
                        while ($b++ < $c_) {
                            $ret[chr($b)] = $pos;
                        }
                        while ($b-- > $c_) {
                            $ret[chr($b)] = $pos;
                        }
                    }
                    break;

                default:
                {
                    $ret[$b = $c] = $pos;
                }
            }
        }
        return implode('', array_keys($ret));
    }

    static function parseCSStr($str, $case_folding = true)
    {
        $ret = [];
        $a = explode(';', $str); // ??? what if ; in "" ?
        foreach ($a as $v) {
            $v = explode(':', $v, 2);
            $n = trim(reset($v));
            if ($case_folding) {
                $n = strtolower($n);
            }
            $ret[$n] = count($v) == 2 ? trim(end($v)) : null;
        }
        unset($ret['']);
        return $ret;
    }

    static function html_attr2str($attr, $quote = '"')
    {
        $sq = htmlspecialchars($quote);
        if ($sq == $quote) {
            $sq = false;
        }
        ksort($attr);
        if (isset($attr['class']) && is_array($attr['class'])) {
            sort($attr['class']);
            $attr['class'] = implode(' ', $attr['class']);
        }
        if (isset($attr['style']) && is_array($attr['style'])) {
            $attr['style'] = self::CSSArr2Str($attr['style']);
        }
        $ret = [];
        foreach ($attr as $n => $v) {
            $ret[] = $n.'='.$quote.($sq ? str_replace($quote, $sq, $v) : $v).$quote;
        }
        return implode(' ', $ret);
    }

    static function CSSArr2Str($css)
    {
        if (is_array($css)) {
            ksort($css);
            $ret = [];
            foreach ($css as $n => $v) {
                $ret[] = $n.':'.$v;
            }
            return implode(';', $ret);
        }
        return $css;
    }

    static function convert_encoding($a, $to, $from = null, $use_mb = null)
    {
        static $meth = null;
        isset($meth) or $meth = function_exists('mb_convert_encoding');

        if (!isset($use_mb)) {
            $use_mb = $meth && self::is_mb_charset_supported($to) && (!isset($from) || self::is_mb_charset_supported($from));
        } elseif ($use_mb && !$meth) {
            $use_mb = false;
        }
        isset($from) or $from = $use_mb ? mb_internal_encoding() : iconv_get_encoding('internal_encoding');

        if (is_array($a)) {
            $ret = [];
            foreach ($a as $n => $v) {
                $ret[is_string($n) ? self::convert_encoding($n, $to, $from,
                    $use_mb) : $n] = is_string($v) || is_array($v) || $v instanceof stdClass
                    ? self::convert_encoding($v, $to, $from, $use_mb)
                    : $v;
            }
            return $ret;
        } elseif ($a instanceof stdClass) {
            $ret = (object) [];
            foreach ($a as $n => $v) {
                $ret->{is_string($n) ? self::convert_encoding($n, $to, $from,
                    $use_mb) : $n} = is_string($v) || is_array($v) || $v instanceof stdClass
                    ? self::convert_encoding($v, $to, $from, $use_mb)
                    : $v;
            }
            return $ret;
        }
        return is_string($a) ? $use_mb ? mb_convert_encoding($a, $to, $from) : iconv($from, $to, $a) : $a;
    }

    // ------------------------------------------------------------------------

    static function is_mb_charset_supported($charset)
    {
        if (!isset(self::$_mb_encodings)) {
            if (!function_exists('mb_list_encodings')) {
                return false;
            }
            self::$_mb_encodings = array_change_key_case(
                array_flip(mb_list_encodings()),
                CASE_UPPER
            );
        }
        return isset(self::$_mb_encodings[strtoupper($charset)]);
    }

    protected static function html_findTagClose($str, $p)
    {
        $l = strlen($str);
        while ($i = $p < $l ? strpos($str, '>', $p) : $l) {
            $e = $p; // save pos
            $p += strcspn($str, '"\'', $p, $i);

            // If closest quote is after '>', return pos of '>'
            if ($p >= $i) {
                return $i;
            }

            // If there is any quote before '>', make sure '>' is outside an attribute string
            $q = $str[$p]; // " | ' ?
            ++$p; // next char after the quote

            $e += strcspn($str, '=', $e, $p); // is there a '=' before first quote?

            // is this the attr_name (like in "attr_name"="attr_value") ?
            if ($e >= $p) {
                // Attribute name should not have '>'
                $p += strcspn($str, '>'.$q, $p, $l);
                // but if it has '>', it is the tag closing char
                if ($str[$p] == '>') {
                    return $p;
                }
            } // else, its attr_value
            else {
                $p += strcspn($str, $q, $p, $l);
            }

            ++$p; // next char after the quote
        }
        return $i;
    }

    public function __destruct()
    {
        if (self::$selected_doc === $this) {
            self::$selected_doc = self::$_nl_;
        }
        $this->ids = self::$_nl_; // If any reference exists, destroy its contents! P.S. Might be buggy, but hey, I own this property. Sincerly yours, hQuery_Node class.
        unset($this->doc, $this->ids);
    }

    public function is_empty()
    {
        return $this->isEmpty();
    }

    // public function firstChild() {
    // $doc = $this->doc();
    // $q = reset($this->ids);
    // $p = key($this->ids);
    // return new Element($doc, array($p=>$q));
    // }

    // public function lastChild() {
    // $doc = $this->doc();
    // $q = end($this->ids);
    // $p = key($this->ids);
    // return new Element($doc, array($p=>$q));
    // }

    // ------------------------------------------------------------------------

    public function isEmpty()
    {
        return empty($this->ids);
    }
    // ------------------------------------------------------------------------

    public function exclude($sel, $attr = null)
    {
        $e = $this->find($sel, $attr, $this);
        if ($e) {
            if (empty($this->exc)) {
                $this->exc = $e->ids;
            } else {
                // foreach($e->ids as $b => $e) $this->exc[$b] = $e;
                $this->exc = $e->ids + $this->exc;
                ksort($this->exc);
            }
        }
        return $e;
    }

    /**
     *  Finds a collection of nodes inside current document/context (similar to jQuery.fn.find()).
     * @param  string        $sel   - A valid CSS selector (some pseudo-selectors supported).
     * @param  array|string  $attr  - OPTIONAL attributes as string or key-value pairs.
     * @param  hQuery_Node   $ctx   - OPTIONAL the context where to search. If omitted, $this is used.
     * @return hQuery_Element collection of matched elements or NULL
     */
    public function find($sel, $attr = null)
    {
        return $this->doc()->find($sel, $attr, $this);
    }

    /**
     * Get parent doc of this node.
     * @return hQuery
     */
    public function doc()
    {
        return isset($this->doc) ? $this->doc : $this;
    }

    public function __toString()
    {
        // doc
        if ($this->isDoc()) {
            return $this->html;
        }

        $ret = '';
        $doc = $this->doc;
        $ids = $this->ids;
        if (!empty($this->exc)) {
            $ids = array_diff_key($ids, $this->exc);
        }
        foreach ($ids as $p => $q) {
            // if(isset($this->exc, $this->exc[$p])) continue;
            ++$p;
            if ($p < $q) {
                $ret .= substr($doc->html, $p, $q - $p);
            }
        }
        return $ret;
    }

    // ------------------------------------------------------------------------

    public function isDoc()
    {
        return !isset($this->doc) || $this === $this->doc;
    }

    /**
     * @return string .outerHtml
     */
    public function outerHtml($id = null)
    {
        $dm = $this->isDoc() && !isset($id);
        if ($dm) {
            return $this->html;
        } // doc

        $id = $this->_my_ids($id);
        if ($id === false) {
            return self::$_fl_;
        }
        $doc = $this->doc();
        $ret = self::$_nl_;
        $map = isset($this->tag_map) ? $this->tag_map : (isset($doc->tag_map) ? $doc->tag_map : null);
        foreach ($id as $p => $q) {
            $a = $doc->get_attr_byId($p, null, true);
            $n = $doc->tags[$p];
            if ($map && isset($map[$_n = strtolower($n)])) {
                $n = $map[$_n];
            }
            $h = $p++ == $q ? false : ($p < $q ? substr($doc->html, $p, $q - $p) : '');
            $ret .= '<'.$n.($a ? ' '.$a : '').($h === false ? ' />' : '>'.$h.'</'.$n.'>');
        }
        return $ret;
    }

    protected function _my_ids($id = null, $keys = false)
    {
        if (!isset($id)) {
            $id = $this->ids;
        } elseif (is_int($id)) {
            if (!isset($this->ids[$id])) {
                return self::$_fl_;
            }
            if ($keys) {
                return $id;
            }
            $id = [$id => $this->ids[$id]];
        } elseif (!$id) {
            return self::$_fl_;
        } else {
            ksort($id);
        }
        return $keys ? array_keys($id) : $id;
    }

    /**
     * @return string .innerText
     */
    public function text($id = null)
    {
        return html_entity_decode(strip_tags($this->html($id)), ENT_QUOTES);/* ??? */
    }

    /**
     * @return string .innerHTML
     */
    public function html($id = null)
    {
        if ($this->isDoc()) {
            return $this->html;
        } // doc

        $id = $this->_my_ids($id);
        if ($id === false) {
            return self::$_fl_;
        }

        $doc = $this->doc;
        if (!empty($this->exc)) {
            $id = array_diff_key($id, $this->exc);
        }

        $ret = self::$_nl_;
        foreach ($id as $p => $q) {
            // if(isset($this->exc, $this->exc[$p])) continue;
            ++$p;
            if ($p < $q) {
                $ret .= substr($doc->html, $p, $q - $p);
            }
        }
        return $ret;
    }

    /// $el < $this, with $eq == true -> $el <= $this

    /**
     * @return string .nodeName
     */
    public function nodeName($caseFolding = null, $id = null)
    {
        if (!isset($caseFolding)) {
            $caseFolding = hQuery_HTML_Parser::$case_folding;
        }
        $dm = $this->isDoc() && !isset($id);
        if ($dm) {
            $ret = array_unique($this->tags);
        } // doc
        else {
            $id = $this->_my_ids($id, true);
            if ($id === false) {
                return self::$_fl_;
            }
            $ret = self::array_select($this->doc()->tags, $id);
        }
        if ($caseFolding) {
            foreach ($ret as $i => $n) {
                $ret[$i] = strtolower($n);
            }
            if ($dm) {
                $ret = array_unique($ret);
            }
        }
        return count($ret) <= 1 ? reset($ret) : $ret;
    }

    static function array_select($arr, $keys, $force_null = false)
    {
        $ret = [];
        is_array($keys) or is_object($keys) or $keys = [$keys];
        foreach ($keys as $k) {
            if (isset($arr[$k])) {
                $ret[$k] = $arr[$k];
            } elseif ($force_null) {
                $ret[$k] = null;
            }
        }
        return $ret;
    }

// - Magic ------------------------------------------------

    /**
     *  Get string offset of the first/current element
     *  in the source HTML document.
     *   <div class="test"> Contents <span>of</span> #test </div>
     *                    |
     *                    pos()
     * @param  bool  $restore  - if true, restore internal pointer to previous position
     * @return int
     */
    public function pos($restore = true)
    {
        $k = key($this->ids);
        if ($k === null) {
            reset($this->ids);
            $k = key($this->ids);
            if ($k !== null && $restore) {
                end($this->ids);
                next($this->ids);
            }
        }
        return $k;
    }

    function _children($ids = null, $n = null)
    {
        $ret = self::$_ar_;
        $ids = $this->_my_ids($ids);
        if (!$ids) {
            return $ret;
        }

        $dids = &$this->doc()->ids;
        $le = end($ids);
        if (current($dids) === false) {
            $ie = reset($dids);
        }
        $ib = key($dids);
        foreach ($ids as $b => $e) {
            if ($b + 4 >= $e) {
                continue;
            } // empty tag; min 3 chars are required for a tag - eg. <b>

            // child of prev element
            if ($b <= $le) {
                while ($b < $ib) {
                    if ($ie = prev($dids)) {
                        $ib = key($dids);
                    } else {
                        reset($dids);
                        break;
                    }
                }
            } else {
                if ($ie === false && $ib < $b) {
                    break;
                }
            }
            $le = $e;

            while ($ib <= $b) {
                if ($ie = next($dids)) {
                    $ib = key($dids);
                } else {
                    end($dids);
                    break;
                }
            }

            if ($b < $ib) {
                $i = 0;
                while ($ib < $e) {
                    if (!isset($n)) {
                        $ret[$ib] = $ie;
                    } elseif ($n == $i) {
                        $ret[$ib] = $ie;
                        break;
                    } else {
                        ++$i;
                    }
                    $lie = $ie < $e ? $ie : $e;
                    while ($ib <= $lie) {
                        if ($ie = next($dids)) {
                            $ib = key($dids);
                        } else {
                            end($dids);
                            continue 3;
                        }
                    }
                }
            }
        }
        return $ret;
    }

    function _next($ids = null, $n = 0)
    {
        $ret = self::$_ar_;              // array()
        $ids = $this->_my_ids($ids);     // ids to search siblings for
        if (!$ids) {
            return $ret;
        }

        $dids = &$this->doc()->ids;      // all elements in the doc
        $kb = $le = self::$_mi_;         // [$lb=>$le] (last parent) now is 100% parent for any element
        $ke = $lb = -1;                  // last parent
        $ie = reset($ids);               // current child
        $ib = key($ids);
        $e = current($dids);             // traverse starting from current position
        if ($e !== false) {
            do {
                $b = key($dids);
            } while (($ib <= $b || $e < $ib) && ($e = prev($dids)));
        }
        if (empty($e)) {
            $e = reset($dids);
        } // current element

        $pt = $st = $ret;                // stacks: $pt - parents, $st - siblings limits

        while ($e) {
            $b = key($dids);
            /* 4) */
            if ($ib <= $b) { // if current element is past our child, then its siblings context is found
                if ($kb < $ke) {
                    $st[$kb] = $ke;
                }
                $kb = $ie;
                $ke = $le;

                $ib = ($ie = next($ids)) ? key($ids) : self::$_mi_; // $ie < $ib === no more children
                if ($ie < $ib) {
                    break;
                } // no more children, empty siblings context, search done!

                // pop from stack, if not empty
                while ($le < $ib && $pt) { // if past current parent, pop another one from the stack
                    $le = end($pt);
                    unset($pt[$lb = key($pt)]); // there must be something in the stack anyway
                }
            }

            /* 3) */
            if ($b < $ib && $ib < $e) { // push the parents to their stack
                $pt[$lb] = $le;
                $lb = $b;
                $le = $e;
            }

            $e = next($dids);
        } // while

        if ($ke < $kb) {
            return $ret;
        } // no siblings contexts found!
        $st[$kb] = $ke;
        ksort($st);

        foreach ($st as $kb => $ke) {
            if ($e !== false) {
                do {
                    $b = key($dids);
                } while ($kb < $b && ($e = prev($dids)));
            }
            if (empty($e)) {
                $e = reset($dids);
            } // current element
            do {
                $b = key($dids);
                if ($kb < $b) {
                    // iterate next siblings
                    $i = 0;
                    while ($b < $ke) {
                        if ($n == $i) {
                            $ret[$b] = $e;
                            break;
                        } else {
                            ++$i;
                        }
                        $lie = $e < $ke ? $e : $ke;
                        while ($b <= $lie && ($e = next($dids))) {
                            $b = key($dids);
                        }
                        if (!$e) {
                            $e = end($dids);
                            break;
                        }
                    }
                    break;
                }
            } while ($e = next($dids));
        }

        return $ret;
    }

    function _prev($ids = null, $n = 0)
    {
        $ret = self::$_ar_;              // array()
        $ids = $this->_my_ids($ids);     // ids to search siblings for
        if (!$ids) {
            return $ret;
        }

        $dids = &$this->doc()->ids;      // all elements in the doc
        $kb = $le = self::$_mi_;         // [$lb=>$le] (last parent) now is 100% parent for any element
        $ke = $lb = -1;                  // last parent
        $ie = reset($ids);               // current child
        $ib = key($ids);
        $e = current($dids);             // traverse starting from current position
        if ($e !== false) {
            do {
                $b = key($dids);
            } while (($ib <= $b || $e < $ib) && ($e = prev($dids)));
        }
        if (empty($e)) {
            $e = reset($dids);
        } // current element

        $pt = $st = $ret;                // stacks: $pt - parents, $st - siblings limits
        while ($e) {
            $b = key($dids);
            /* 4) */
            if ($ib <= $b) { // if current element is past our child, then its siblings context is found
                if ($kb < $ke) {
                    $st[$kb] = $ke;
                }
                $kb = $lb;
                $ke = $ib;

                $ib = ($ie = next($ids)) ? key($ids) : self::$_mi_; // $ie < $ib === no more children
                if ($ie < $ib) {
                    break;
                } // no more children, empty siblings context, search done!

                // pop from stack, if not empty
                while ($le < $ib && $pt) { // if past current parent, pop another one from the stack
                    $le = end($pt);
                    unset($pt[$lb = key($pt)]); // there must be something in the stack anyway
                }
            }

            /* 3) */
            if ($b < $ib && $ib < $e) { // push the parents to their stack
                $pt[$lb] = $le;
                $lb = $b;
                $le = $e;
            }

            $e = next($dids);
        } // while

        if ($ke < $kb) {
            return $ret;
        } // no siblings contexts found!

        if ($e !== false) {
            do {
                $b = key($dids);
            } while ($kb < $b && ($e = prev($dids)));
        }
        if (empty($e)) {
            $e = reset($dids);
        } // current element

        $st[$kb] = $ke;
        ksort($st);
        $kb = reset($st);
        $ke = key($st);

        do {
            $b = key($dids);

            /* 1) */
            if ($kb < $b) {
                // iterate next siblings
                $pt = self::$_ar_;
                $lie = -1;
                while ($b < $ke) {
                    $pt[$b] = $e;
                    $lie = $e < $ke ? $e : $ke;
                    while ($b <= $lie && ($e = next($dids))) {
                        $b = key($dids);
                    }
                    if (!$e) {
                        $e = end($dids);
                        break;
                    }
                }

                if ($pt) {
                    $c = count($pt);
                    $i = $n < 0 ? 0 : $c;
                    $i -= $n + 1;
                    if (0 <= $i && $i < $c) {
                        $pt = array_slice($pt, $i, 1, true);
                        $ret[key($pt)] = reset($pt);
                    }
                }
                $pt = self::$_nl_;

                if (empty($st)) {
                    break;
                } // stack empty, no more children, search done!

                // pop from stack, if not empty
                if ($kb = reset($st)) {
                    unset($st[$ke = key($st)]);
                } else {
                    $kb = self::$_mi_;
                } // $ke < $kb === context empy

                // rewind back
                while ($kb < $b && ($e = prev($dids))) {
                    $b = key($dids);
                }
                if (!$e) {
                    $e = reset($dids);
                } // only for wrong context! - error
            }
        } while ($e = next($dids));

        return $ret;
    }
    // ------------------------------------------------------------------------
    // Countable:

    function _all($ids = null)
    {
        $ret = self::$_ar_;
        $ids = $this->_my_ids($ids);
        if (!$ids) {
            return $ret;
        }

        return $this->doc()->_find('*', null, null, $ids);
    }
    // ------------------------------------------------------------------------
    // Iterable:

    function _has($el, $eq = false)
    {
        if (is_int($el)) {
            $e = end($this->ids);
            if ($el >= $e) {
                return self::$_fl_;
            }
            foreach ($this->ids as $b => $e) {
                if ($el < $b) {
                    return self::$_fl_;
                }
                if ($el == $b) {
                    return $eq;
                }
                if ($el < $e) {
                    return self::$_tr_;
                }
            }
            return self::$_fl_;
        }
        if ($el instanceof self) {
            if ($el === $this) {
                return self::$_fl_;
            }
            $el = $el->ids;
        } else {
            $el = $this->_ctx_ids($this->_doc_ids($el, true));
        }
        foreach ($el as $b => $e) {
            if (!$this->_has($b)) {
                return self::$_fl_;
            }
        }
        return self::$_tr_;
    }

    /**
     * Get and Normalize ids of $el
     * @return array ids
     */
    protected function _doc_ids($el, $force_array = true)
    {
        if ($el instanceof self) {
            $el = $el->ids;
        }
        if ($force_array) {
            if (is_int($el)) {
                $el = [$el => $this->doc()->ids[$el]];
            }
            if (!is_array($el)) {
                throw new \Exception(__CLASS__.'->'.__FUNCTION__.': not Array!');
            }
        }
        return $el;
    }

    /**
     * Filter all ids of $el that are contained in(side) $this->ids
     * @param  hQuery_Node|array  $el  A node or list of ids
     * @param  boolean            $eq  if false, filter strict contents, otherwise $el might be in $this->ids
     * @return hQuery_Node|array same type as $el
     */
    function _filter_contains($el, $eq = false)
    {
        if ($el instanceof self) {
            $o = $el;
        }
        $el = $this->_doc_ids($el);
        $ret = self::$_ar_;

        $lb = $le = -1;    // last parent
        $ie = reset($el); // current child
        $ib = key($el);
        foreach ($this->ids as $b => $e) {
            // skip up to first $el in $this
            while ($ib < $b || !$eq && $ib == $b) {
                $ie = next($el);
                if ($ie === false) {
                    $ib = -1;
                    break 2;
                }
                $ib = key($el);
            }
            // $b < $ib
            while ($ib < $e) {
                $ret[$ib] = $ie;
                $ie = next($el);
                if ($ie === false) {
                    $ib = -1;
                    break 2;
                }
                $ib = key($el);
            }
        }
        if (!empty($o)) {
            $o = clone $o;
            $o->ids = $ret;
            $ret = $o;
        }
        return $ret;
    }

    public function __get($name)
    {
        if ($this->_prop && array_key_exists($name, $this->_prop)) {
            return $this->_prop[$name];
        }
        return $this->attr($name);
    }

    public function __set($name, $value)
    {
        if (isset($value)) {
            return $this->_prop[$name] = $value;
        }
        $this->__unset($name);
    }

    /**
     * Get and attribute or all attributes of first element in the collection.
     * @param  string   $attr    attribute name, or NULL to get all
     * @param  boolean  $to_str  When $attr is NULL, if true, get the list of attributes as string
     * @return array|string    If no $attr, return a list of attributes, or attribute's value otherwise.
     */
    public function attr($attr = null, $to_str = false)
    {
        $k = key($this->ids);
        if ($k === null) {
            reset($this->ids);
            $k = key($this->ids);
        }
        return isset($k) ? $this->doc()->get_attr_byId($k, $attr, $to_str) : null;
    }

// - Helpers ------------------------------------------------

    public function __unset($name)
    {
        unset($this->_prop[$name]);
    }

    // ------------------------------------------------------------------------

    public function __isset($name)
    {
        return isset($this->_prop[$name]);
    }

    // ------------------------------------------------------------------------

    public function count()
    {
        return isset($this->ids) ? count($this->ids) : 0;
    }

    // ------------------------------------------------------------------------

    /**
     * @return bool
     */
    public function valid()
    {
        return current($this->ids) !== false;
    }

    // ------------------------------------------------------------------------

    /**
     * @return int|mixed|null|string
     */
    public function key()
    {
        return key($this->ids);
    }

    // ------------------------------------------------------------------------

    /**
     * @return array|bool|mixed|void
     */
    public function next()
    {
        return next($this->ids) !== false ? $this->current() : false;
    }

    public function current()
    {
        $k = key($this->ids);
        if ($k === null) {
            return false;
        }
        return [$k => $this->ids[$k]];
    }

    // ------------------------------------------------------------------------

    /**
     * @return array|bool|mixed
     */
    public function prev()
    {
        return prev($this->ids) !== false ? $this->current() : false;
    }

    // ------------------------------------------------------------------------

    /**
     * @return array|bool|mixed|void
     */
    public function rewind()
    {
        reset($this->ids);
        return $this->current();
    }

    // ------------------------------------------------------------------------

    /**
     * Get all ids from inside of this element
     * @return array ids
     */
    protected function _sub_ids($eq = false)
    {
        $ret = [];
        $ce = reset($this->ids);
        $cb = key($this->ids);
        $doc = $this->doc();
        foreach ($doc->ids as $b => $e) {
            if ($b < $cb || !$eq && $b == $cb) {
                continue;
            }
            if ($b < $ce) {
                $ret[$b] = $e;
            } else {
                $ce = next($this->ids);
                if (!$ce) {
                    break;
                } // end of context
                $cb = key($this->ids);
            }
        }
        return $ret;
    }

    // ------------------------------------------------------------------------

    protected function _parent($ids = null, $n = 0)
    {
        $ret = self::$_ar_;
        $ids = $this->_my_ids($ids);
        if (!$ids) {
            return $ret;
        }

        $lb = $le = -1;    // last parent
        $ie = reset($ids); // current child
        $ib = key($ids);
        $dids = &$this->doc()->ids;
        foreach ($dids as $b => $e) { // $b < $ib < $e
            // if current element is past current child and last parent is parent for current child
            if ($ib <= $b) {
                if ($ib < $le && $lb < $ib) {
                    $ret[$lb] = $le;
                }
                // while current element is past current child
                do {
                    $ie = next($ids);
                    if ($ie === false) {
                        $ib = -1;
                        break 2;
                    }
                    $ib = key($ids);
                } while ($ib <= $b);
            }
            // here $b < $ib
            if ($ib < $e) { // [$b=>$e] is a parent of $ib
                $lb = $b;
                $le = $e;
            }
        }
        if ($ib <= $b && $ib < $le && $lb < $ib) { // while current element is past current child and last parent is parent for current child
            $ret[$lb] = $le;
        }
        return $ret;
    }
    // ------------------------------------------------------------------------
}

// ------------------------------------------------------------------------
// PSR-0 alias
class_exists('hQuery_Node', false) or class_alias('YiiMan\YiiBasics\lib\hquery\\Node', 'hQuery_Node', false);
