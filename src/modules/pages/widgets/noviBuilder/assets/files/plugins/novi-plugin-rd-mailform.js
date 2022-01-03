module.exports=function(e){function t(i){if(n[i])return n[i].exports;var o=n[i]={exports:{},id:i,loaded:!1};return e[i].call(o.exports,o,o.exports,t),o.loaded=!0,o.exports}var n={};return t.m=e,t.c=n,t.p="",t(0)}([function(e,t,n){"use strict";function i(e){return e&&e.__esModule?e:{default:e}}function o(e){var t=p.getDataByKey("novi-plugin-rd-mailform");return e.ui.editor[0].title=t.editor.title,e.ui.editor[0].tooltip=t.editor.tooltip,e.ui.editor[0].header[1]=f.createElement("span",null,t.editor.header),e}var r=n(1),a=i(r),s=n(5),l=i(s),u=n(4),c=i(u),f=novi.react.React,p=novi.language,d={name:"novi-plugin-rd-mailform",title:"Novi RD Mailform",description:"Novi RD Mailform description",version:"1.0.3",dependencies:{novi:"0.8.6"},defaults:{querySelector:".rd-mailform",configLocation:"/noviBuilder/bat/rd-mailform.config.json"},ui:{editor:[a.default],settings:f.createElement(l.default,null)},onLanguageChange:o};novi.plugins.register(d);var m=novi.plugins.settings.get("novi-plugin-rd-mailform");novi.files.getProjectFile({path:m.configLocation}).then(function(e){if(!e||!e.data)return null;c.default.set(e.data)})},function(e,t,n){"use strict";function i(e){return e&&e.__esModule?e:{default:e}}function o(e,t){var n=t[0],i={recipientEmail:n.recipientEmail,useSmtp:n.useSmtp,host:n.host,port:n.port,username:n.username,password:n.password};if(!novi.utils.lodash.isEqual(i,n.initValue)){var o=novi.plugins.settings.get("novi-plugin-rd-mailform");novi.files.saveProjectFile({path:o.configLocation,content:JSON.stringify(i)}).then(function(e){e&&(e.data||e.demoMode)&&c.default.set(i)})}}Object.defineProperty(t,"__esModule",{value:!0});var r=n(2),a=i(r),s=n(3),l=i(s),u=n(4),c=i(u),f=novi.react.React,p=novi.ui.icons,d=novi.language.getDataByKey("novi-plugin-rd-mailform"),m={trigger:f.createElement(a.default,null),tooltip:d.editor.tooltip,header:[p.ICON_MAILFORM,f.createElement("span",null,d.editor.header)],body:[f.createElement(l.default,null)],closeIcon:"submit",onSubmit:o,width:360,height:130,title:d.editor.title};t.default=m},function(e,t){"use strict";function n(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function i(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!=typeof t&&"function"!=typeof t?e:t}function o(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}Object.defineProperty(t,"__esModule",{value:!0});var r=function(){function e(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}return function(t,n,i){return n&&e(t.prototype,n),i&&e(t,i),t}}(),a=novi.ui.icon,s=novi.ui.icons,l=novi.react.React,u=novi.react.Component,c=function(e){function t(){return n(this,t),i(this,(t.__proto__||Object.getPrototypeOf(t)).call(this))}return o(t,e),r(t,[{key:"render",value:function(){return l.createElement(a,null,s.ICON_MAILFORM)}}]),t}(u);t.default=c},function(e,t,n){"use strict";function i(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function o(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!=typeof t&&"function"!=typeof t?e:t}function r(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}Object.defineProperty(t,"__esModule",{value:!0});var a=function(){function e(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}return function(t,n,i){return n&&e(t.prototype,n),i&&e(t,i),t}}(),s=n(4),l=function(e){return e&&e.__esModule?e:{default:e}}(s),u=novi.ui.input,c=novi.ui.switcher,f=novi.react.React,p=novi.react.Component,d=novi.language,m=function(e){function t(e){i(this,t);var n=o(this,(t.__proto__||Object.getPrototypeOf(t)).call(this,e)),r=l.default.get(),a=r.recipientEmail,s=r.useSmtp,u=r.host,c=r.port,f=r.username,p=r.password;return n.state={recipientEmail:a,useSmtp:s,host:u,port:c,username:f,password:p,initValue:r,element:e.element},n.style="\n        .rd-mailform-wrap{\n            padding: 20px 12px 0;\n            display: flex;\n            flex-direction: column;\n            height: calc(100% - 20px);\n            color: #6E778A;\n        }\n        \n        .rd-mailform-switcher{\n            display: flex;\n            flex-direction: row;\n            justify-content: space-between;\n            align-items: center;\n            margin-top: 16px;\n        }\n        \n        .rd-mailform-group{\n            display: flex;\n            flex-direction: row;\n            justify-content: space-between;\n            align-items: center;\n            margin-top: 16px;\n        }\n        \n        .rd-mailfrom-group-item + .rd-mailfrom-group-item{\n            margin-left: 15px;\n        }        \n        ",n._handleSwitcherChange=n._handleSwitcherChange.bind(n),n._renderSmtpSettings=n._renderSmtpSettings.bind(n),n._changeBodyHeight=n._changeBodyHeight.bind(n),n._changeBodyHeight(s),n.messages=d.getDataByKey("novi-plugin-rd-mailform"),n}return r(t,e),a(t,[{key:"render",value:function(){return f.createElement("div",{className:"rd-mailform-wrap"},f.createElement("style",null,this.style),f.createElement("p",{className:"novi-label",style:{marginTop:0}},this.messages.editor.body.emailAddress),f.createElement(u,{onChange:this._handleInputChange.bind(this,"recipientEmail"),value:this.state.recipientEmail}),f.createElement("div",{className:"rd-mailform-switcher"},f.createElement("p",{className:"novi-label",style:{margin:0}},this.messages.editor.body.smtpUse),f.createElement(c,{isActive:this.state.useSmtp,onChange:this._handleSwitcherChange})),this._renderSmtpSettings())}},{key:"_renderSmtpSettings",value:function(){return this.state.useSmtp?f.createElement("div",null,f.createElement("div",{className:"rd-mailform-group"},f.createElement("div",{className:"rd-mailfrom-group-item",style:{width:"60%"}},f.createElement("p",{className:"novi-label",style:{marginTop:0}},this.messages.editor.body.host),f.createElement(u,{disabled:this.state.useSmtp?null:"disabled",onChange:this._handleInputChange.bind(this,"host"),value:this.state.host})),f.createElement("div",{className:"rd-mailfrom-group-item",style:{width:"40%"}},f.createElement("p",{className:"novi-label",style:{marginTop:0}},this.messages.editor.body.port),f.createElement(u,{disabled:this.state.useSmtp?null:"disabled",onChange:this._handleInputChange.bind(this,"port"),value:this.state.port}))),f.createElement("div",{className:"rd-mailform-group"},f.createElement("div",{className:"rd-mailfrom-group-item"},f.createElement("p",{className:"novi-label",style:{marginTop:0}},this.messages.editor.body.userName),f.createElement(u,{disabled:this.state.useSmtp?null:"disabled",onChange:this._handleInputChange.bind(this,"username"),value:this.state.username})),f.createElement("div",{className:"rd-mailfrom-group-item"},f.createElement("p",{className:"novi-label",style:{marginTop:0}},this.messages.editor.body.pass),f.createElement(u,{disabled:this.state.useSmtp?null:"disabled",type:"password",onChange:this._handleInputChange.bind(this,"password"),value:this.state.password})))):null}},{key:"_handleSwitcherChange",value:function(e){this.setState({useSmtp:e}),this._changeBodyHeight(e)}},{key:"_changeBodyHeight",value:function(e){e?novi.editor.setBodyHeight(280):novi.editor.setBodyHeight(130)}},{key:"_handleInputChange",value:function(e,t){var n=t.target.value,i={};i[e]=n,this.setState(i)}}]),t}(p);t.default=m},function(e,t){"use strict";function n(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(t,"__esModule",{value:!0});var i=function(){function e(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}return function(t,n,i){return n&&e(t.prototype,n),i&&e(t,i),t}}(),o=function(){function e(){n(this,e),this.config={}}return i(e,[{key:"set",value:function(e){this.config=e}},{key:"get",value:function(){return this.config}}]),e}(),r=new o;t.default=r},function(e,t,n){"use strict";function i(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function o(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!=typeof t&&"function"!=typeof t?e:t}function r(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}Object.defineProperty(t,"__esModule",{value:!0});var a=function(){function e(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}return function(t,n,i){return n&&e(t.prototype,n),i&&e(t,i),t}}(),s=n(4),l=function(e){return e&&e.__esModule?e:{default:e}}(s),u=novi.react.React,c=novi.react.Component,f=novi.ui.input,p=novi.ui.button,d=novi.language,m=function(e){function t(e){i(this,t);var n=o(this,(t.__proto__||Object.getPrototypeOf(t)).call(this));return n.state={querySelector:e.settings.querySelector,configLocation:e.settings.configLocation},n.initConfigLocation=e.settings.configLocation,n.saveSettings=n.saveSettings.bind(n),n.onInputChange=n.onInputChange.bind(n),n.messages=d.getDataByKey("novi-plugin-rd-mailform"),n}return r(t,e),a(t,[{key:"componentWillReceiveProps",value:function(e){this.setState({querySelector:e.settings.querySelector,configLocation:e.settings.configLocation})}},{key:"render",value:function(){return u.createElement("div",null,u.createElement("span",{style:{letterSpacing:"0,0462em"}},"RD Mailform Plugin"),u.createElement("div",{style:{fontSize:13,color:"#6E778A",marginTop:21}},this.messages.settings.pluginElement),u.createElement(f,{style:{marginTop:10,width:340},value:this.state.querySelector,onChange:this.onInputChange.bind(this,"querySelector")}),u.createElement("div",{style:{fontSize:13,color:"#6E778A",marginTop:21}},this.messages.settings.configPath),u.createElement(f,{style:{marginTop:10,width:340},value:this.state.configLocation,onChange:this.onInputChange.bind(this,"configLocation")}),u.createElement("div",{style:{marginTop:30}},u.createElement(p,{type:"primary",messages:{textContent:this.messages.settings.submitButton},onClick:this.saveSettings})))}},{key:"onInputChange",value:function(e,t){var n=t.target.value,i={};i[e]=n,this.setState(i)}},{key:"saveSettings",value:function(){novi.plugins.settings.update("novi-plugin-rd-mailform",this.state),this.state.configLocation!==this.initConfigLocation&&(this.initConfigLocation=this.state.configLocation,novi.files.getProjectFile({path:this.state.configLocation}).then(function(e){if(!e.data)return null;l.default.set(e.data)}))}}]),t}(c);t.default=m}]);
