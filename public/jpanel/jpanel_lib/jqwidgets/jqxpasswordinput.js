/*
jQWidgets v3.8.0 (2015-Apr)
Copyright (c) 2011-2015 jQWidgets.
License: http://jqwidgets.com/license/
*/

(function(a){a.jqx.jqxWidget("jqxPasswordInput","",{});a.extend(a.jqx._jqxPasswordInput.prototype,{defineInstance:function(){var b={width:null,height:null,disabled:false,rtl:false,placeHolder:null,showStrength:false,showStrengthPosition:"right",maxLength:null,minLength:null,showPasswordIcon:true,strengthTypeRenderer:null,passwordStrength:null,localization:{passwordStrengthString:"Password strength",tooShort:"Too short",weak:"Weak",fair:"Fair",good:"Good",strong:"Strong",showPasswordString:"Show Password"},strengthColors:{tooShort:"rgb(170, 0, 51)",weak:"rgb(170, 0, 51)",fair:"rgb(255, 204, 51)",good:"rgb(45, 152, 243)",strong:"rgb(118, 194, 97)"}};a.extend(true,this,b);return b},createInstance:function(b){this.render()},render:function(){var e=this;var c=a.jqx.browser.browser;var b=a.jqx.browser.version;this._browserCheck=c!="msie"||(b!="7.0"&&b!="8.0");this.widgetID=e.element.id;var f=e.host;var d="Invalid input type. Please set the type attribute of the input element to password.";if(f.attr("type")!="password"){throw d}e._hidden=true;e._setTheme();e._setAttributes();e._showPassword();e._showStrength()},refresh:function(c){var b=this;if(c==true){return}b.removeHandler(b.host,"focus.passwordinput"+b.widgetID);b.removeHandler(b.host,"blur.passwordinput"+b.widgetID);b.removeHandler(b.host,"click.passwordinput"+b.widgetID);b.removeHandler(a(window),"resize.passwordinput"+b.widgetID);b.removeHandler(b.host,"keyup.passwordinput"+b.widgetID);b.removeHandler(b.icon,"mousedown.passwordinput"+b.iconID);b.removeHandler(b.icon,"mouseup.passwordinput"+b.iconID);b.removeHandler(a(document),"mousedown.passwordinput"+b.iconID);b._setAttributes();b._setTheme();b._showPassword();b._showStrength()},val:function(d){var c=this,e=c.element.value,b="placeholder" in c.element;if(a.isEmptyObject(d)&&d!=""){if(!b&&e===c.placeHolder){e=""}return e}else{if(b&&d===e){return}if(!b){if(d===""){if(e!==c.placeHolder){c.element.value=c.placeHolder;c.host.attr("type","text")}return}else{c.host.attr("type","password")}}c.element.value=d;if(c.showStrength===true){c._evaluateStrength()}}},propertyChangedHandler:function(b,c,f,e){var d=this.host;if(c=="disabled"){if(b.disabled==true){b.host.attr("disabled","disabled");b.host.addClass(b.toThemeProperty("jqx-fill-state-disabled"))}else{b.host.removeAttr("disabled");b.host.removeClass(b.toThemeProperty("jqx-fill-state-disabled"))}return}if(c=="placeHolder"){if(this._browserCheck){if("placeholder" in this.element){d.attr("placeholder",this.placeHolder)}else{if(d.val()==""){d.attr("type","text");b.element.value=e}else{if(d.val()==f){b.element.value=e}}}}}else{this.refresh()}},resize:function(c,b){this.width=c;this.height=b;this.host.width(this.width);this.host.height(this.height)},_setAttributes:function(){var b=this;var c=b.host;c.width(b.width);c.height(b.height);if(b.maxLength){c.attr("maxlength",b.maxLength)}if(b.minLength){c.attr("minLength",b.minLength)}if(b.placeHolder&&b._browserCheck){if("placeholder" in b.element){c.attr("placeholder",b.placeHolder)}else{if(c.val()==""){c.attr("type","text");b.element.value=b.placeHolder}}}if(b.disabled==true){c.attr("disabled","disabled");c.addClass(this.toThemeProperty("jqx-fill-state-disabled"))}else{c.removeAttr("disabled");c.removeClass(b.toThemeProperty("jqx-fill-state-disabled"))}b.addHandler(c,"click.passwordinput"+b.widgetID,function(){if(b.showPasswordIcon&&b.icon){b.icon.show();b._positionIcon()}});b.interval=null;b.addHandler(c,"keydown.passwordinput"+b.widgetID,function(){if(b.showPasswordIcon&&b.icon){if(b.interval){clearInterval(b.interval)}var d=0;b.interval=setInterval(function(){if(b.icon[0].style.display!="none"){b._positionIcon();d++;if(d>5){clearInterval(b.interval)}}else{clearInterval(b.interval)}},100)}});b.addHandler(c,"focus.passwordinput"+b.widgetID,function(){b._focused=true;b.host.addClass(b.toThemeProperty("jqx-fill-state-focus"));if(b.placeHolder&&b._browserCheck&&!("placeholder" in b.element)&&c.val()==b.placeHolder){c.val("");if(b._hidden==true){c.attr("type","password")}}if(b.val().length>0){if(b.showStrength==true){var d=c.jqxTooltip("content");if(d){c.jqxTooltip("open")}}}if(b.showPasswordIcon&&b.icon){b.icon.show();b._positionIcon()}});b.addHandler(c,"blur.passwordinput"+b.widgetID,function(){b._focused=false;b.host.removeClass(b.toThemeProperty("jqx-fill-state-focus"));if(b.placeHolder&&b._browserCheck&&!("placeholder" in b.element)&&c.val()==""){b.element.value=b.placeHolder;c.attr("type","text")}if(b.showPasswordIcon==true&&b._browserCheck){if(b.rtl==false){b.host.removeClass(b.toThemeProperty("jqx-passwordinput-password-icon-ltr"))}else{b.host.removeClass(b.toThemeProperty("jqx-passwordinput-password-icon-rtl"))}}if(b.showStrength==true){c.jqxTooltip("close")}if(b.showPasswordIcon&&b.icon){b.icon.hide()}})},destroy:function(){if(this.host.jqxTooltip){this.host.jqxTooltip("destroy")}this.host.remove()},_setTheme:function(){var c=this.host;var b=this;c.addClass(b.toThemeProperty("jqx-widget"));c.addClass(b.toThemeProperty("jqx-widget-content"));c.addClass(b.toThemeProperty("jqx-input"));c.addClass(b.toThemeProperty("jqx-rc-all"));if(b.rtl==true){c.addClass(b.toThemeProperty("jqx-rtl"));c.css("direction","rtl")}else{c.removeClass(b.toThemeProperty("jqx-rtl"));c.css("direction","ltr")}},_showPassword:function(){if(this.showPasswordIcon==true&&this._browserCheck){var f=this;this.iconID=this.widgetID+"-password-icon";a("<span tabindex='-1' hasfocus='false' style='position: absolute; display: none;' id='"+f.iconID+"'></span>").insertAfter(f.host);var e=a("#"+f.iconID);f.icon=e;e.addClass(f.toThemeProperty("jqx-passwordinput-password-icon"));e.attr("title",f.localization.showPasswordString);f._positionIcon();var d=function(){f.host.attr("type","password");f._hidden=true;e.attr("title",f.localization.showPasswordString)};var b=function(){if(f._hidden==false){d()}else{if(f._hidden==true){f.host.attr("type","text");f._hidden=false}}};var c=a.jqx.mobile.isTouchDevice();if(c){f.addHandler(f.icon,"mousedown.passwordinput"+f.iconID,function(g){b();return false})}else{f.addHandler(f.icon,"mousedown.passwordinput"+f.iconID,function(g){b();return false});f.addHandler(f.icon,"mouseup.passwordinput"+f.iconID,function(g){d();return false});f.addHandler(a(document),"mousedown.passwordinput"+f.iconID,function(g){if(f._focused){d()}})}}},_positionIcon:function(){var c=this.host.offset();var b=this.host.outerWidth();var d=this.host.outerHeight();if(this.rtl==true){this.icon.offset({top:parseInt(c.top+d/2-10/2),left:c.left+2})}else{this.icon.offset({top:parseInt(c.top+d/2-10/2),left:c.left+b-18})}},_showStrength:function(){var g=this;if(g.showStrength==true){if(g.host.jqxTooltip!=undefined){var e=g.widgetID+"Strength";var i=e+"Value";var c=e+"Indicator";var f;if(!g.strengthTypeRenderer){f="<div style='width: 220px;' id='"+e+"'><div><span style='font-weight: bold;'>"+g.localization.passwordStrengthString+": </span><span id='"+i+"'></span></div><div id='"+c+"'></div></div>"}else{var d=g.host.val();if(!("placeholder" in g.element)&&g._browserCheck&&d==g.placeHolder){d=""}g._countCharacters();var b=g.localization.tooShort;var h=g.strengthTypeRenderer(d,{letters:g.letters,numbers:g.numbers,specialKeys:g.specials},b);f=h}g.host.jqxTooltip({theme:g.theme,position:g.showStrengthPosition,content:f,trigger:"none",autoHide:false,rtl:g.rtl});if(!g.strengthTypeRenderer){a("#"+i).html(g.localization.tooShort);a("#"+c).addClass("jqx-passwordinput-password-strength-inicator").css("background-color",g.strengthColors.tooShort);if(g.rtl==false){a("#"+c).css("float","left")}else{a("#"+c).css("float","right")}}g._checkStrength()}else{throw new Error("jqxPasswordInput: Missing reference to jqxtooltip.js")}}},_checkStrength:function(){var b=this;b.addHandler(a(window),"resize.passwordinput"+b.widgetID,function(){if(b.icon){b.icon.hide()}});b.addHandler(b.host,"keyup.passwordinput"+b.widgetID,function(){b._evaluateStrength()})},_evaluateStrength:function(){var f=this;var d=f.host.val();var e=d.length;f._countCharacters();if(e>0){if(f.showStrength==true){var i=!f.host.jqxTooltip("opened");if(i){f.host.jqxTooltip("open")}}}var c=f.letters+f.numbers+2*f.specials+f.letters*f.numbers/2+e;var b;if(e<8){b=f.localization.tooShort}else{if(c<20){b=f.localization.weak}else{if(c<30){b=f.localization.fair}else{if(c<40){b=f.localization.good}else{b=f.localization.strong}}}}if(f.strengthTypeRenderer){var h=f.strengthTypeRenderer(d,{letters:f.letters,numbers:f.numbers,specialKeys:f.specials},b);f.host.jqxTooltip({content:h})}else{if(f.passwordStrength){var h=f.passwordStrength(d,{letters:f.letters,numbers:f.numbers,specialKeys:f.specials},b);a.each(f.localization,function(){var j=this;if(h==j){b=h;return false}})}a("#"+f.widgetID+"StrengthValue").html(b);var g=a("#"+f.widgetID+"StrengthIndicator");switch(b){case f.localization.tooShort:g.css({width:"20%","background-color":f.strengthColors.tooShort});break;case f.localization.weak:g.css({width:"40%","background-color":f.strengthColors.weak});break;case f.localization.fair:g.css({width:"60%","background-color":f.strengthColors.fair});break;case f.localization.good:g.css({width:"80%","background-color":f.strengthColors.good});break;case f.localization.strong:g.css({width:"100%","background-color":f.strengthColors.strong});break}}},_countCharacters:function(){var g=this;g.letters=0;g.numbers=0;g.specials=0;var d="<>@!#$%^&*()_+[]{}?:;|'\"\\,./~`-=";var b=g.host.val();var f=b.length;for(var c=0;c<f;c++){var h=b.charAt(c);var e=b.charCodeAt(c);if((e>64&&e<91)||(e>96&&e<123)||(e>127&&e<155)||(e>159&&e<166)){g.letters+=1;continue}if(isNaN(h)==false){g.numbers+=1;continue}if(d.indexOf(h)!=-1){g.specials+=1;continue}}}})})(jqxBaseFramework);