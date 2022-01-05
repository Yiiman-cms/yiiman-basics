/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

(function() {
  var mode = CodeMirror.getMode({indentUnit: 2}, "d");
  function MT(name) { test.mode(name, mode, Array.prototype.slice.call(arguments, 1)); }

  MT("nested_comments",
     "[comment /+]","[comment comment]","[comment +/]","[variable void] [variable main](){}");

})();
