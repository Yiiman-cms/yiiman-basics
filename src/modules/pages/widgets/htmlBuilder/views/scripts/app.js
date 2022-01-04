/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

var htmlFieldClass = class {
    init() {
        this.init_elements();
        this.init_triggers();
        this.start_editor();
    }

    init_triggers() {
        
    }

    init_elements() {
        this.container=$('#htmlContainer');
    }


    start_editor(){

    }
};
var htapp=new htmlFieldClass();
htapp.init();
