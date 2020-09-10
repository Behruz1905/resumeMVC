/*
jQWidgets v3.8.0 (2015-Apr)
Copyright (c) 2011-2015 jQWidgets.
License: http://jqwidgets.com/license/
*/

(function(a){a.jqx.jqxWidget("jqxFormattedInput","",{});a.extend(a.jqx._jqxFormattedInput.prototype,{defineInstance:function(){var b={width:null,height:null,radix:10,decimalNotation:"default",value:"0",min:"-9223372036854775808",max:"9223372036854775807",upperCase:false,spinButtons:true,spinButtonsStep:1,dropDown:false,dropDownWidth:null,popupZIndex:20000,placeHolder:"",roundedCorners:true,disabled:false,rtl:false,_opened:false,$popup:a("<ul></ul>"),item:'<li><a href="#"></a></li>',events:["open","close","change","radixChange"]};a.extend(true,this,b)},createInstance:function(){var b=this;b._Long();b._regex={2:new RegExp(/([0-1])/),8:new RegExp(/([0-7])/),10:new RegExp(/([0-9\-])/),16:new RegExp(/([0-9]|[a-f])/i)};b.render()},render:function(){var e=this;e._radixNumber=e._getRadix(e.radix);e._number=new e.longObj.math.Long.fromString((e.value).toString(),e._radixNumber);if(e.baseHost){e.host=e.baseHost;e.element=e.host[0]}if(this.element.nodeName.toLowerCase()==="div"){this.baseHost=this.element;var b=this.host.find("input");var d=false;a.each(b,function(){var f=this.type;if(f===null||f==="text"||f==="textarea"){b=a(this);d=true;return false}});if(!d){throw new Error("jqxFormattedInput: Missing Text Input in the Input Group")}if(b.length>0){this.baseHost=a(this.element);this.host=b;this.element=b[0];this.baseHost.addClass(this.toThemeProperty("jqx-widget"));this.baseHost.addClass(this.toThemeProperty("jqx-rc-all"));this.baseHost.addClass(this.toThemeProperty("jqx-input-group"));var c=this.baseHost.children();a.each(c,function(f){a(this).addClass(e.toThemeProperty("jqx-input-group-addon"));a(this).removeClass(e.toThemeProperty("jqx-rc-all"));if(f===0){a(this).addClass(e.toThemeProperty("jqx-rc-l"))}if(f===c.length-1){a(this).addClass(e.toThemeProperty("jqx-rc-r"))}if(this!==e.element){a(this).addClass(e.toThemeProperty("jqx-fill-state-normal"))}if(this.nodeName.toLowerCase()==="div"){e.appendSpinButtons=function(i){e._spinButtonsContainer=a(i);e._spinButtonsContainer.addClass(e.toThemeProperty("jqx-formatted-input-spin-buttons-container"));var h='<div class="'+e.toThemeProperty("jqx-fill-state-normal jqx-formatted-input-spin-button")+'"><div class="'+e.toThemeProperty("jqx-input-icon")+'"></div></div>';e._upbutton=a(h);e._spinButtonsContainer.append(e._upbutton);e._downbutton=a(h);e._spinButtonsContainer.append(e._downbutton);e._upArrow=e._upbutton.find("div");e._upArrow.addClass(e.toThemeProperty("jqx-icon-arrow-up"));e._downArrow=e._downbutton.find("div");e._downArrow.addClass(e.toThemeProperty("jqx-icon-arrow-down"));e._spinButtonsStepLong=new e.longObj.math.Long.fromNumber(e.spinButtonsStep)};var g=function(h){e._addon=a(h);e._addon.addClass(e.toThemeProperty("jqx-formatted-input-addon"));if(!e._arrow){e._arrow=a('<div class="'+e.toThemeProperty("jqx-icon")+" "+e.toThemeProperty("jqx-icon-arrow-down")+'"></div>');e._arrow.appendTo(e._addon)}};if(e.rtl===false){if(!e._spinButtonsContainer&&e.spinButtons===true){e.appendSpinButtons(this)}else{if(!e._addon&&e.dropDown===true&&((f===2)||(f===1&&e.spinButtons===false))){g(this)}}}else{if(!e._addon&&e.dropDown===true){g(this);if(e.spinButtons===true){e._addon.addClass(e.toThemeProperty("jqx-formatted-input-addon-rtl"))}}else{if(!e._spinButtonsContainer&&e.spinButtons===true&&((f===1)||(f===0&&e.dropDown===false))){e.appendSpinButtons(this);e._spinButtonsContainer.addClass(e.toThemeProperty("jqx-formatted-input-spin-buttons-container-rtl"));if(e.dropDown===true){e._addon.addClass(e.toThemeProperty("jqx-formatted-input-addon-rtl"))}}}}}})}}e._inputAndAddon=e.host;if(e.baseHost){if(e._spinButtonsContainer){e._inputAndAddon=e._inputAndAddon.add(e._spinButtonsContainer)}if(e._addon){e._inputAndAddon=e._inputAndAddon.add(e._addon)}}e.removeHandlers();this.addHandlers();if(this.rtl){this.host.addClass(this.toThemeProperty("jqx-rtl"))}this.host.attr("role","textbox");a.jqx.aria(this,"aria-autocomplete","both");a.jqx.aria(this,"aria-disabled",this.disabled);a.jqx.aria(this,"aria-readonly",false);a.jqx.aria(this,"aria-multiline",false);a.jqx.aria(this,"aria-haspopup",true);if(e.value!==""&&e.value!==null){if(e.upperCase===true){e.host.addClass(e.toThemeProperty("jqx-formatted-input-upper-case"))}else{e.host.addClass(e.toThemeProperty("jqx-formatted-input-lower-case"))}if(e._radixNumber===10&&e.decimalNotation==="exponential"){e.element.value=e._getDecimalNotation("exponential")}else{e.element.value=e.value}}else{if(e._spinButtonsContainer){e._spinButtonsContainer.addClass(e.toThemeProperty("jqx-fill-state-disabled"))}if(e._addon){e._addon.addClass(e.toThemeProperty("jqx-fill-state-disabled"))}}if(e._radixNumber!==10&&e.min.toString()==="-9223372036854775808"){e._minLong=new e.longObj.math.Long.fromNumber(e.min)}else{e._setMinMax("min")}if(e._radixNumber!==10&&e.max.toString()==="9223372036854775807"){e._maxLong=new e.longObj.math.Long.fromNumber(e.max)}else{e._setMinMax("max")}},_refreshClasses:function(c){var b=c?"addClass":"removeClass";this.host[b](this.toThemeProperty("jqx-widget-content"));this.host[b](this.toThemeProperty("jqx-input"));this.host[b](this.toThemeProperty("jqx-formatted-input"));this.host[b](this.toThemeProperty("jqx-widget"));this.$popup[b](this.toThemeProperty("jqx-popup"));if(a.jqx.browser.msie){this.$popup[b](this.toThemeProperty("jqx-noshadow"))}this.$popup[b](this.toThemeProperty("jqx-input-popup"));this.$popup[b](this.toThemeProperty("jqx-menu"));this.$popup[b](this.toThemeProperty("jqx-menu-vertical"));this.$popup[b](this.toThemeProperty("jqx-menu-dropdown"));this.$popup[b](this.toThemeProperty("jqx-widget"));this.$popup[b](this.toThemeProperty("jqx-widget-content"));if(this.roundedCorners){this.host[b](this.toThemeProperty("jqx-rc-all"));this.$popup[b](this.toThemeProperty("jqx-rc-all"));if(this.baseHost){this.baseHost[b](this.toThemeProperty("jqx-rc-all"));if(this.rtl===false){this.host[b](this.toThemeProperty("jqx-rc-l"));if(this._addon){this._addon[b](this.toThemeProperty("jqx-rc-r"))}}else{this.host[b](this.toThemeProperty("jqx-rc-r"));if(this._addon){this._addon[b](this.toThemeProperty("jqx-rc-l"))}}}}else{this.host.removeClass(this.toThemeProperty("jqx-rc-all"));this.$popup.removeClass(this.toThemeProperty("jqx-rc-all"));if(this.baseHost){this.baseHost.removeClass(this.toThemeProperty("jqx-rc-all"));if(this.rtl===false){this.host.removeClass(this.toThemeProperty("jqx-rc-l"));if(this._addon){this._addon.removeClass(this.toThemeProperty("jqx-rc-r"))}}else{this.host.removeClass(this.toThemeProperty("jqx-rc-r"));if(this._addon){this._addon.removeClass(this.toThemeProperty("jqx-rc-l"))}}}}if(this.disabled){this.host[b](this.toThemeProperty("jqx-fill-state-disabled"));if(this.baseHost){if(this._spinButtonsContainer){this._spinButtonsContainer[b](this.toThemeProperty("jqx-fill-state-disabled"))}if(this._addon){this._addon[b](this.toThemeProperty("jqx-fill-state-disabled"))}}}else{this.host.removeClass(this.toThemeProperty("jqx-fill-state-disabled"));if(this.baseHost&&this.value!==""&&this.value!==null){if(this._spinButtonsContainer){this._spinButtonsContainer.removeClass(this.toThemeProperty("jqx-fill-state-disabled"))}if(this._addon){this._addon.removeClass(this.toThemeProperty("jqx-fill-state-disabled"))}}}},selectAll:function(){var b=this.host;setTimeout(function(){if("selectionStart" in b[0]){b[0].focus();b[0].setSelectionRange(0,b[0].value.length)}else{var c=b[0].createTextRange();c.collapse(true);c.moveEnd("character",b[0].value.length);c.moveStart("character",0);c.select()}},10)},selectLast:function(){var b=this.host;this.selectStart(b[0].value.length)},selectFirst:function(){this.selectStart(0)},selectStart:function(c){var b=this.host;setTimeout(function(){if("selectionStart" in b[0]){b[0].focus();b[0].setSelectionRange(c,c)}else{var d=b[0].createTextRange();d.collapse(true);d.moveEnd("character",c);d.moveStart("character",c);d.select()}},10)},focus:function(){try{this.host.focus();var c=this;setTimeout(function(){c.host.focus()},25)}catch(b){}},refresh:function(){var f=this;this._refreshClasses(false);this._refreshClasses(true);if(!this.baseHost){if(this.width){this.host.width(this.width)}if(this.height){this.host.height(this.height)}}else{if(this.width){this.baseHost.width(this.width)}if(this.height){this.baseHost.height(this.height);var e=0;var j=this.baseHost.height()-2;if(a.jqx.browser.msie&&a.jqx.browser.version<8){this.baseHost.css("display","inline-block")}a.each(this.baseHost.children(),function(){a(this).css("height","100%");if(a.jqx.browser.msie&&a.jqx.browser.version<8){a(this).css("height",j+"px")}if(this!==f.element){e+=a(this).outerWidth()}});var c=(typeof f.width==="string"&&f.width.charAt(f.width.length-1)==="%")?1:0;this.host.css("width",this.baseHost.width()-e-c+"px");if(a.jqx.browser.msie&&a.jqx.browser.version<9){if(f._spinButtonsContainer){if(f.rtl===false||f.rtl===true&&f._addon){f._spinButtonsContainer.css("border-left-width","0")}}if(f._addon){if(f.rtl===false){f._addon.css("border-left-width","0")}else{if(!f._spinButtonsContainer){f._addon.css("border-right-width","0")}}}var h=0;if(a.jqx.browser.version<8){var g=0;var d=parseInt(f.host.css("border-left-width"),10)+parseInt(f.host.css("border-right-width"),10);var i=parseInt(f.host.css("padding-left"),10)+parseInt(f.host.css("padding-right"),10);if(f._spinButtonsContainer){d+=parseInt(f._spinButtonsContainer.css("border-left-width"),10)+parseInt(f._spinButtonsContainer.css("border-right-width"),10);i+=parseInt(f._spinButtonsContainer.css("padding-left"),10)+parseInt(f._spinButtonsContainer.css("padding-right"),10);if(!f._addon){g=2}}if(f._addon){d+=parseInt(f._addon.css("border-left-width"),10)+parseInt(f._addon.css("border-right-width"),10);i+=parseInt(f._addon.css("padding-left"),10)+parseInt(f._addon.css("padding-right"),10);if(!f._spinButtonsContainer){g=2}}f.host.width(f.host.width()-(i+d)-g);h=6}f.host.height(f.baseHost.height()-(parseInt(f.host.css("border-top-width"),10)+parseInt(f.host.css("border-bottom-width"),10)+parseInt(f.host.css("padding-top"),10)+parseInt(f.host.css("padding-bottom"),10)+h));var b=f.host.height()+"px";f.host.css("min-height",b);f.host.css("line-height",b)}}}this.host.attr("disabled",this.disabled);if(!this.host.attr("placeholder")){this._refreshPlaceHolder()}},_refreshPlaceHolder:function(){if("placeholder" in this.element){this.host.attr("placeHolder",this.placeHolder)}else{var b=this;if(this.element.value===""){this.element.value=this.placeHolder;this.host.focus(function(){if(b.element.value===b.placeHolder){b.element.value=""}});this.host.blur(function(){if(b.element.value===""||b.element.value===b.placeHolder){b.element.value=b.placeHolder}})}}},destroy:function(){this.removeHandlers();if(this.baseHost){a.jqx.utilities.resize(this.baseHost,null,true);this.baseHost.remove()}else{a.jqx.utilities.resize(this.host,null,true);this.host.remove()}if(this.$popup){this.$popup.remove()}},propertyChangedHandler:function(b,d,g,f){if(d==="placeHolder"){b._refreshPlaceHolder();return}if(d==="disabled"){a.jqx.aria(b,"aria-disabled",b.disabled)}if(d==="value"&&g.toString().toUpperCase()!==f.toString().toUpperCase()){b.val(f);return}if(g!==f&&d==="radix"){b._changeRadix(f);return}if(g!==f&&d==="decimalNotation"&&b._radixNumber===10){if(f==="exponential"){b.element.value=b._getDecimalNotation("exponential")}else{b.element.value=b._number.toString(10)}}if(g!==f&&(d==="min"||d==="max")){b._setMinMax(d);b._validateValue(b.value,true);b.value=b.element.value;return}if(g!==f&&(d==="upperCase")&&b.element.value!==""){if(f===true){b.host.removeClass(b.toThemeProperty("jqx-formatted-input-lower-case"));b.host.addClass(b.toThemeProperty("jqx-formatted-input-upper-case"))}else{b.host.removeClass(b.toThemeProperty("jqx-formatted-input-upper-case"));b.host.addClass(b.toThemeProperty("jqx-formatted-input-lower-case"))}return}function c(i,j){var k=b.host.width();var h=i.outerWidth();if(j===false){b.host.width(k+h);i.hide();if(b.rtl===true){if(b.spinButtons===true){b._spinButtonsContainer.addClass(b.toThemeProperty("jqx-formatted-input-spin-buttons-container-rtl-border"))}if(b.dropDown===true){b._addon.removeClass(b.toThemeProperty("jqx-formatted-input-addon-rtl"))}}}else{b.host.width(k-h);i.show();if(b.rtl===true&&b.spinButtons===true&&b.dropDown===true){b._spinButtonsContainer.removeClass(b.toThemeProperty("jqx-formatted-input-spin-buttons-container-rtl-border"));b._addon.addClass(b.toThemeProperty("jqx-formatted-input-addon-rtl"))}}}function e(j,l){if(l===true){var k=a("<div></div>");if(b.baseHost){var h=b.baseHost.children("div");if((b.rtl===false&&j==="spinButtons")||(b.rtl===true&&j==="dropDown")){h.before(k)}else{h.after(k)}b.render();b.host.width(b.host.width()-k.outerWidth())}else{var n=b.element.id;b.host.removeAttr("id");b.host.wrap('<div id="'+n+'" style="display: inline-block;"></div>');var m=a("#"+n);if(b.rtl===false){m.append(k)}else{m.prepend(k)}var i=b.host.data();i.jqxFormattedInput.host=m;i.jqxFormattedInput.element=m[0];b.baseHost=m;b.baseHost.data(i);b.render();b.refresh()}}}if(d==="spinButtons"){if(g!==f){if(b._spinButtonsContainer){c(b._spinButtonsContainer,f)}else{e("spinButtons",f)}return}else{return}}if(g!==f&&d==="spinButtonsStep"){b._spinButtonsStepLong=new b.longObj.math.Long.fromNumber(f)}if(d==="dropDown"){if(g!==f){if(b._addon){c(b._addon,f)}else{e("dropDown",f)}return}else{return}}b.refresh()},select:function(d,e,b){var c=this;if(!b){b=c.$popup.find(".jqx-fill-state-pressed").attr("data-value")}c._changeRadix(parseInt(b,10));c._setMaxLength(true);c.close()},val:function(g){var f=this;if(g&&!(typeof g==="object"&&a.isEmptyObject(g)===true)&&g!=="binary"&&g!=="octal"&&g!=="decimal"&&g!=="exponential"&&g!=="scientific"&&g!=="engineering"&&g!=="hexadecimal"){g=g.toString();if(g.toUpperCase()!==f.element.value.toString().toUpperCase()){var b=f.element.value;if(f.upperCase===true){g=g.toUpperCase()}var e=g.split("");for(var c=0;c<e.length;c++){if(!f._regex[""+f._radixNumber+""].test(e[c])){return}}var h=f._validateValue(g,true);f._raiseEvent("2",{value:h,oldValue:b,radix:f._radixNumber});f.value=h;return h}else{return g}}else{if(g&&!(typeof g==="object"&&a.isEmptyObject(g)===true)){if(g==="exponential"||g==="scientific"||g==="engineering"){return f._getDecimalNotation(g)}else{var d=f._getRadix(g);return f._number.toString(d)}}else{return f.element.value}}},_changeRadix:function(d){var f=this;var e=f._getRadix(d);var g=f._number.toString(e);var b=f.radix;var c=f.value;f.radix=d;f._radixNumber=e;f.element.value=g;f.value=g;this._raiseEvent("3",{radix:d,oldRadix:b,value:g,oldValue:c})},_raiseEvent:function(f,c){if(c===undefined){c={owner:null}}var d=this.events[f];c.owner=this;var e=new a.Event(d);e.owner=this;e.args=c;if(e.preventDefault){e.preventDefault()}var b;if(this.baseHost){b=this.baseHost.trigger(e)}else{b=this.host.trigger(e)}return b},open:function(){var f=this;if(f.value!==""&&f.value!==null){f._setPopupOptions();f._render(f._popupOptions);if(a.jqx.isHidden(this.host)){return}var c;if(f.baseHost){c=a.extend({},f.baseHost.coord(true),{height:f.baseHost[0].offsetHeight})}else{c=a.extend({},f.host.coord(true),{height:f.host[0].offsetHeight})}if(this.$popup.parent().length===0){var e=this.element.id+"_popup";this.$popup[0].id=e;a.jqx.aria(this,"aria-owns",e)}this.$popup.appendTo(a(document.body)).css({position:"absolute",zIndex:this.popupZIndex,top:c.top+c.height,left:c.left}).show();var b=0;var d=this.$popup.children();a.each(d,function(){b+=a(this).outerHeight(true)-1});this.$popup.height(b);this._opened=true;if(f.baseHost){f._addon.addClass(f.toThemeProperty("jqx-fill-state-pressed jqx-combobox-arrow-selected"));f._arrow.addClass(f.toThemeProperty("jqx-icon-arrow-down-selected"))}this._raiseEvent("0",{popup:this.$popup});a.jqx.aria(this,"aria-expanded",true);return this}},close:function(){var b=this;this.$popup.hide();this._opened=false;if(b.baseHost){b._addon.removeClass(b.toThemeProperty("jqx-fill-state-pressed jqx-combobox-arrow-selected"));b._arrow.removeClass(b.toThemeProperty("jqx-icon-arrow-down-selected"))}this._raiseEvent("1",{popup:this.$popup});a.jqx.aria(this,"aria-expanded",false);return this},_render:function(c){var e=this;c=a(c).map(function(h,j){var k=j;var f;switch(h){case 0:f=2;break;case 1:f=8;break;case 2:f=10;break;case 3:f=16;break}h=a(e.item).attr("data-value",f);h.find("a").html(k).attr("data-value",f);var g="";if(e.rtl){g=" "+e.toThemeProperty("jqx-rtl")+" "+e.toThemeProperty("jqx-formatted-input-item-rtl")}h[0].className=e.toThemeProperty("jqx-item")+" "+e.toThemeProperty("jqx-menu-item")+" "+e.toThemeProperty("jqx-formatted-input-item")+" "+e.toThemeProperty("jqx-rc-all")+g;return h[0]});var b;switch(e._radixNumber){case 2:b=0;break;case 8:b=1;break;case 10:b=2;break;case 16:b=3;break}c.eq(b).addClass(this.toThemeProperty("jqx-fill-state-pressed"));this.$popup.html(c);if(!this.dropDownWidth){if(e.baseHost){var d=(typeof e.width==="string"&&e.width.charAt(e.width.length-1)==="%")?1:0;this.$popup.width(this.baseHost.outerWidth()-6-d)}else{this.$popup.width(this.host.outerWidth()-6)}}else{this.$popup.width(this.dropDownWidth)}return this},next:function(){var c=this.$popup.find(".jqx-fill-state-pressed").removeClass(this.toThemeProperty("jqx-fill-state-pressed")),b=c.next();if(!b.length){b=a(this.$popup.find("li")[0])}b.addClass(this.toThemeProperty("jqx-fill-state-pressed"))},prev:function(){var c=this.$popup.find(".jqx-fill-state-pressed").removeClass(this.toThemeProperty("jqx-fill-state-pressed")),b=c.prev();if(!b.length){b=this.$popup.find("li").last()}b.addClass(this.toThemeProperty("jqx-fill-state-pressed"))},addHandlers:function(){var c=this;this.addHandler(this.host,"focus",a.proxy(this.onFocus,this));this.addHandler(this.host,"blur",a.proxy(this.onBlur,this));this.addHandler(this.host,"keypress",a.proxy(this.keypress,this));this.addHandler(this.host,"keyup",a.proxy(this.keyup,this));this.addHandler(this.host,"keydown",a.proxy(this.keydown,this));this.addHandler(this.$popup,"mousedown",a.proxy(this.click,this));if(this.host.on){this.$popup.on("mouseenter","li",a.proxy(this.mouseenter,this))}else{this.$popup.bind("mouseenter","li",a.proxy(this.mouseenter,this))}this.addHandler(this.host,"change",function(f){f.stopPropagation();f.preventDefault()});if(c.baseHost){var d=c.baseHost.attr("id");if(c._spinButtonsContainer){var b=c._upbutton.add(c._downbutton);c.addHandler(c._upbutton,"mousedown.jqxFormattedInputSpinButtonUp"+d,function(){if(!c.disabled&&c.value!==""&&c.value!==null){c._upbutton.addClass(c.toThemeProperty("jqx-fill-state-pressed"));c._incrementOrDecrement("add")}});c.addHandler(c._upbutton,"mouseup.jqxFormattedInputSpinButtonUp"+d,function(){if(!c.disabled&&c.value!==""&&c.value!==null){c._upbutton.removeClass(c.toThemeProperty("jqx-fill-state-pressed"))}});c.addHandler(c._downbutton,"mousedown.jqxFormattedInputSpinButtonDown"+d,function(){if(!c.disabled&&c.value!==""&&c.value!==null){c._downbutton.addClass(c.toThemeProperty("jqx-fill-state-pressed"));c._incrementOrDecrement("subtract")}});c.addHandler(c._downbutton,"mouseup.jqxFormattedInputSpinButtonDown"+d,function(){if(!c.disabled&&c.value!==""&&c.value!==null){c._downbutton.removeClass(c.toThemeProperty("jqx-fill-state-pressed"))}});c.addHandler(b,"mouseenter.jqxFormattedInputSpinButtons"+d,function(g){if(!c.disabled&&c.value!==""&&c.value!==null){var f=a(g.target);if(f.hasClass("jqx-icon-arrow-up")||f.children().hasClass("jqx-icon-arrow-up")){c._upbutton.addClass(c.toThemeProperty("jqx-fill-state-hover"));c._upArrow.addClass(c.toThemeProperty("jqx-icon-arrow-up-hover"))}else{c._downbutton.addClass(c.toThemeProperty("jqx-fill-state-hover"));c._downArrow.addClass(c.toThemeProperty("jqx-icon-arrow-down-hover"))}}});c.addHandler(b,"mouseleave.jqxFormattedInputSpinButtons"+d,function(g){if(!c.disabled&&c.value!==""&&c.value!==null){var f=a(g.target);if(f.hasClass("jqx-icon-arrow-up")||f.children().hasClass("jqx-icon-arrow-up")){c._upbutton.removeClass(c.toThemeProperty("jqx-fill-state-hover"));c._upArrow.removeClass(c.toThemeProperty("jqx-icon-arrow-up-hover"))}else{c._downbutton.removeClass(c.toThemeProperty("jqx-fill-state-hover"));c._downArrow.removeClass(c.toThemeProperty("jqx-icon-arrow-down-hover"))}}});c.addHandler(a("body"),"mouseup.jqxFormattedInputSpinButtons"+d,function(){c._upbutton.add(c._downbutton).removeClass(c.toThemeProperty("jqx-fill-state-pressed"))})}if(c._addon){c.addHandler(c._addon,"click.jqxFormattedInputAddon"+d,function(){if(!c.disabled){if(c._opened){c.close()}else{c.open()}}});c.addHandler(c._addon,"mouseenter.jqxFormattedInputAddon"+d,function(){if(!c.disabled&&c.value!==""&&c.value!==null){c._addon.addClass(c.toThemeProperty("jqx-fill-state-hover jqx-combobox-arrow-hover"));c._arrow.addClass(c.toThemeProperty("jqx-icon-arrow-down-hover"))}});c.addHandler(c._addon,"mouseleave.jqxFormattedInputAddon"+d,function(){if(!c.disabled&&c.value!==""&&c.value!==null){c._addon.removeClass(c.toThemeProperty("jqx-fill-state-hover jqx-combobox-arrow-hover"));c._arrow.removeClass(c.toThemeProperty("jqx-icon-arrow-down-hover"))}});c.addHandler(c._addon.add(c._arrow),"blur.jqxFormattedInputAddon"+d,function(){if(c._opened&&!c.disabled){c.close()}})}a.jqx.utilities.resize(c.baseHost,function(){if(c._opened===true){c.close()}var e=0;if(c._spinButtonsContainer){e+=c._spinButtonsContainer.outerWidth()}if(c._addon){e+=c._addon.outerWidth()}c.host.css("width",c.baseHost.width()-e-1)})}},removeHandlers:function(){var c=this;this.removeHandler(this.host,"focus",a.proxy(this.onFocus,this));this.removeHandler(this.host,"blur",a.proxy(this.onBlur,this));this.removeHandler(this.host,"keypress",a.proxy(this.keypress,this));this.removeHandler(this.host,"keyup",a.proxy(this.keyup,this));this.removeHandler(this.host,"keydown",a.proxy(this.keydown,this));this.removeHandler(this.$popup,"mousedown",a.proxy(this.click,this));if(this.host.off){this.$popup.off("mouseenter","li",a.proxy(this.mouseenter,this))}else{this.$popup.unbind("mouseenter","li",a.proxy(this.mouseenter,this))}if(c.baseHost){var d=c.baseHost.attr("id");if(c._spinButtonsContainer){var b=c._upbutton.add(c._downbutton);c.removeHandler(c._upbutton,"mousedown.jqxFormattedInputSpinButtonUp"+d);c.removeHandler(c._upbutton,"mouseup.jqxFormattedInputSpinButtonUp"+d);c.removeHandler(c._downbutton,"mousedown.jqxFormattedInputSpinButtonDown"+d);c.removeHandler(c._downbutton,"mouseup.jqxFormattedInputSpinButtonDown"+d);c.removeHandler(b,"mouseenter.jqxFormattedInputSpinButtons"+d);c.removeHandler(b,"mouseleave.jqxFormattedInputSpinButtons"+d);c.removeHandler(a("body"),"mouseup.jqxFormattedInputSpinButtons"+d)}if(c._addon){c.removeHandler(c._addon,"click.jqxFormattedInputAddon"+d);c.removeHandler(c._addon,"mouseenter.jqxFormattedInputAddon"+d);c.removeHandler(c._addon,"mouseleave.jqxFormattedInputAddon"+d);c.removeHandler(c._addon.add(c._arrow),"blur.jqxFormattedInputAddon"+d)}}},move:function(b){if(!this._opened){return}switch(b.keyCode){case 9:case 13:case 27:b.preventDefault();break;case 38:b.preventDefault();this.prev();break;case 40:b.preventDefault();this.next();break}b.stopPropagation()},keydown:function(k){var j=this;this.suppressKeyPressRepeat=~a.inArray(k.keyCode,[40,38,9,13,27]);this.move(k);var o=!k.charCode?k.which:k.charCode;var m=String.fromCharCode(o);if(k.altKey===true){if(o===40){if(j._addon){this.open()}return}else{if(o===38){if(j._addon){this.close()}return}}}if(k.ctrlKey===true&&o===67){return}var d=[8,9,13,37,38,39,40,46,88];var i=j._regex[""+j._radixNumber+""];if(d.indexOf(o)===-1&&(!i.test(m)&&!i.test(k.key)&&!i.test(k["char"]))){k.preventDefault();return false}else{var l=j.host[0].selectionStart;var g=j.host[0].selectionEnd-l;var f=this._getCaretPosition(this.host[0]);var b=this.element.value;var c=b.split("");if(o===8){if(g>0){c.splice(l,g)}else{c.splice(f-1,1)}}else{if(o===46){if(g>0){c.splice(l,g)}else{c.splice(f,1)}}else{if(o===88){if(k.ctrlKey===true){if(g>0){c.splice(l,g)}}else{k.preventDefault()}}else{if(o===189){if(c[0]==="-"){c.splice(0,1);j._minus=false}else{c.splice(0,0,"-");j._minus=true}k.preventDefault()}else{var h=d.indexOf(o)===-1?m:"";if(g>0){c.splice(l,g);c.splice(l,0,h)}else{c.splice(f,0,h)}}}}}c=c.join("");if(c!==b){var n=j._validateValue(c,false);if(n===false){j._inputAndAddon.addClass(j.toThemeProperty("jqx-input-invalid"))}else{j._inputAndAddon.removeClass(j.toThemeProperty("jqx-input-invalid"))}}}},keypress:function(c){var b=this;if(b.suppressKeyPressRepeat){return}b.move(c)},keyup:function(c){var b=this;switch(c.keyCode){case 40:case 38:case 16:case 17:case 18:break;case 9:case 13:if(this._opened){this.select(c,this)}else{b._change()}break;case 27:if(!this._opened){return}this.close();break;case 189:if(b._radixNumber===10){if(b._minus===true){b.element.value="-"+b.element.value}else{b.element.value=b.element.value.slice(1)}}break}c.stopPropagation();c.preventDefault();if(b.element.value!==""){if(b.upperCase){b.host.addClass(b.toThemeProperty("jqx-formatted-input-upper-case"))}else{b.host.addClass(b.toThemeProperty("jqx-formatted-input-lower-case"))}if(b._addon){b._addon.removeClass(b.toThemeProperty("jqx-fill-state-disabled"))}}else{b.host.removeClass(b.toThemeProperty("jqx-formatted-input-upper-case jqx-formatted-input-lower-case"));if(b._addon){b._addon.addClass(b.toThemeProperty("jqx-fill-state-disabled"))}}},_getCaretPosition:function(b){var d=0;if(document.selection){b.focus();var c=document.selection.createRange();c.moveStart("character",-b.value.length);d=c.text.length}else{if(b.selectionStart||b.selectionStart==="0"){d=b.selectionStart}}return(d)},onBlur:function(){var b=this;if(b._opened){b.close()}b._setMaxLength();b._inputAndAddon.removeClass(b.toThemeProperty("jqx-fill-state-focus"));b._change();if(b._radixNumber===10&&b.decimalNotation==="exponential"){b.element.value=b._getDecimalNotation("exponential")}b._refreshPlaceHolder()},onFocus:function(){var b=this;b._setMaxLength(true);b._inputAndAddon.addClass(b.toThemeProperty("jqx-fill-state-focus"));if(b._radixNumber===10&&b.decimalNotation==="exponential"){b.element.value=b._number.toString(10)}},click:function(c){c.stopPropagation();c.preventDefault();var b=a(c.target).attr("data-value");this.select(c,this,b)},mouseenter:function(b){this.$popup.find(".jqx-fill-state-pressed").removeClass(this.toThemeProperty("jqx-fill-state-pressed"));a(b.currentTarget).addClass(this.toThemeProperty("jqx-fill-state-pressed"))},_change:function(){var c=this;var b=c.value;var d=c._validateValue(c.element.value,true);c._inputAndAddon.removeClass(c.toThemeProperty("jqx-input-invalid"));if(d.toUpperCase()!==b.toString().toUpperCase()){c._raiseEvent("2",{value:d,oldValue:b,radix:c._radixNumber});c.value=d}},_getRadix:function(b){switch(b){case 10:case"decimal":return 10;case 2:case"binary":return 2;case 8:case"octal":return 8;case 16:case"hexadecimal":return 16}},_setPopupOptions:function(){var b=this;b._popupOptions=new Array();b._popupOptions.push(b._number.toString(2)+" <em>(BIN)</em>");b._popupOptions.push(b._number.toString(8)+" <em>(OCT)</em>");b._popupOptions.push(b._number.toString(10)+" <em>(DEC)</em>");b._popupOptions.push(b._number.toString(16)+" <em>(HEX)</em>")},_validateValue:function(e,g){if(e!==""){var d=this;var f=new d.longObj.math.Long.fromString((e).toString(),d._radixNumber);if(f.lessThan(d._minLong)){if(g){d._number=d._minLong;var c=d._minLong.toString(d._radixNumber);if(d._radixNumber===16&&d.upperCase===true){c=c.toUpperCase()}d.element.value=c;return c}else{return false}}else{if(f.greaterThan(d._maxLong)){if(g){d._number=d._maxLong;var b=d._maxLong.toString(d._radixNumber);if(d._radixNumber===16&&d.upperCase===true){b=b.toUpperCase()}d.element.value=b;return b}else{return false}}else{if(g){d._number=f;d.element.value=e;return e}else{return true}}}}else{if(g){return e}else{return true}}},_getNegativeDecimal:function(l,h){var o=l;if(h===8){var n=new Array();for(var f=0;f<11;f++){var b=parseInt(l.charAt(f),8).toString(2);while(b.length!==3){b="0"+b}n.push(b)}o=n.join("");if(o.charAt(0)==="0"){o=o.slice(1)}}else{if(h===16){var p=new Array();for(var e=0;e<8;e++){var m=parseInt(l.charAt(e),16).toString(2);while(m.length!==4){m="0"+m}p.push(m)}o=p.join("")}}var d="";for(var c=0;c<o.length;c++){var g=o.charAt(c)==="1"?"0":"1";d+=g}d=(parseInt(d,2)+1)*-1;return d},_setMaxLength:function(c){var d=this;var b;if(c===true){switch(d._radixNumber){case 2:b=64;break;case 8:b=22;break;case 10:b=20;break;case 16:b=16;break}}else{b=524288}d.host.attr("maxlength",b)},_setMinMax:function(b){var c=this;c["_"+b+"Long"]=new c.longObj.math.Long.fromString((c[b]).toString(),c._radixNumber)},_getDecimalNotation:function(c){var e=this;var f=e._number.toString(10);function h(j){var i;if(j.charAt(0)==="-"){i="-";j=j.slice(1,j.length)}else{i=""}var k=j.length-1;while(j.charAt(j.length-1)==="0"){j=j.slice(0,j.length-1)}return i+""+j.charAt(0)+"."+j.slice(1,j.length)+"e+"+k}function d(l){var k=l.indexOf("e");var j=l.slice(k+1);var i=l.slice(0,k+1);i=i.replace("e","×10");i+=e._toSuperScript(j);i=i.replace("+","");return i}function b(o){var n=o.indexOf("e");var m=o.slice(n+1);var k=o.slice(0,n);var l=parseInt(m,10)%3;k=k*Math.pow(10,l);var j=o.slice(0,n).length-l-2;if(j>=0){k=k.toFixed(j)}var i=k+"×10"+e._toSuperScript((parseInt(m,10)-l).toString());return i}var g=h(f);if(c==="scientific"){return d(g)}else{if(c==="engineering"){return b(g)}else{return g}}},_toSuperScript:function(h,g){var f="-0123456789";var d="⁻⁰¹²³⁴⁵⁶⁷⁸⁹";var c="";for(var e=0;e<h.length;e++){if(g===true){var b=d.indexOf(h.charAt(e));c+=(b!==-1?f[b]:h[e])}else{var j=f.indexOf(h.charAt(e));c+=(j!==-1?d[j]:h[e])}}return c},_incrementOrDecrement:function(c){var b=this;if(b._number.toString(b._radixNumber)!==b.element.value){b._number=new b.longObj.math.Long.fromString(b.element.value,b._radixNumber)}b._number=b._number[c](b._spinButtonsStepLong);b.element.value=b._number.toString(b._radixNumber);b._change()},_negativeBinary:function(u,r){var s="";u=u.slice(1,u.length);while(u.length<64){u="0"+u}for(var o=0;o<u.length;o++){var t=u.charAt(o)==="1"?"0":"1";s+=t}var d=true;var g="";for(var n=s.length-1;n>=0;n--){var q=s.charAt(n);var b;if(q==="0"){if(d===true){b="1";d=false}else{b="0"}}else{if(d===true){b="0"}else{b="1"}}g=b+""+g}switch(r){case 2:return g;case 8:g="00"+g;var f="";for(var m=22;m>=1;m--){var p=g[m*3-3]+""+g[m*3-2]+""+g[m*3-1];f=parseInt(p,2).toString(8)+""+f}return f;case 16:var e="";for(var h=16;h>=1;h--){var c=g[h*4-4]+""+g[h*4-3]+""+g[h*4-2]+""+g[h*4-1];e=parseInt(c,2).toString(16)+""+e}return e}},_Long:function(){var c=this;c.longObj=new Object();var b=c.longObj;b.math=new Object();b.math.Long=new Object();b.math.Long=function(d,e){this.lowBits=d|0;this.highBits=e|0};b.math.Long.IntCache={};b.math.Long.fromInt=function(d){if(-128<=d&&d<128){var f=b.math.Long.IntCache[d];if(f){return f}}var e=new b.math.Long(d|0,d<0?-1:0);if(-128<=d&&d<128){b.math.Long.IntCache[d]=e}return e};b.math.Long.fromNumber=function(d){if(isNaN(d)||!isFinite(d)){return b.math.Long.ZERO}else{if(d<=-b.math.Long.TWO_PWR_63_DBL_){return b.math.Long.MIN_VALUE}else{if(d+1>=b.math.Long.TWO_PWR_63_DBL_){return b.math.Long.MAX_VALUE}else{if(d<0){return b.math.Long.fromNumber(-d).negate()}else{return new b.math.Long((d%b.math.Long.TWO_PWR_32_DBL_)|0,(d/b.math.Long.TWO_PWR_32_DBL_)|0)}}}}};b.math.Long.fromBits=function(d,e){return new b.math.Long(d,e)};b.math.Long.fromString=function(f,j){if(f.length===0){throw new Error("number format error: empty string")}var g=j||10;if(g<2||36<g){throw new Error("radix out of range: "+g)}if(f.charAt(0)==="-"){return b.math.Long.fromString(f.substring(1),g).negate()}else{if(f.indexOf("-")>=0){throw new Error('number format error: interior "-" character: '+f)}}var k=b.math.Long.fromNumber(Math.pow(g,8));var m=b.math.Long.ZERO;for(var e=0;e<f.length;e+=8){var l=Math.min(8,f.length-e);var h=parseInt(f.substring(e,e+l),g);if(l<8){var d=b.math.Long.fromNumber(Math.pow(g,l));m=m.multiply(d).add(b.math.Long.fromNumber(h))}else{m=m.multiply(k);m=m.add(b.math.Long.fromNumber(h))}}return m};b.math.Long.TWO_PWR_16_DBL_=1<<16;b.math.Long.TWO_PWR_24_DBL_=1<<24;b.math.Long.TWO_PWR_32_DBL_=b.math.Long.TWO_PWR_16_DBL_*b.math.Long.TWO_PWR_16_DBL_;b.math.Long.TWO_PWR_31_DBL_=b.math.Long.TWO_PWR_32_DBL_/2;b.math.Long.TWO_PWR_48_DBL_=b.math.Long.TWO_PWR_32_DBL_*b.math.Long.TWO_PWR_16_DBL_;b.math.Long.TWO_PWR_64_DBL_=b.math.Long.TWO_PWR_32_DBL_*b.math.Long.TWO_PWR_32_DBL_;b.math.Long.TWO_PWR_63_DBL_=b.math.Long.TWO_PWR_64_DBL_/2;b.math.Long.ZERO=b.math.Long.fromInt(0);b.math.Long.ONE=b.math.Long.fromInt(1);b.math.Long.NEG_ONE=b.math.Long.fromInt(-1);b.math.Long.MAX_VALUE=b.math.Long.fromBits(4294967295|0,2147483647|0);b.math.Long.MIN_VALUE=b.math.Long.fromBits(0,2147483648|0);b.math.Long.TWO_PWR_24_=b.math.Long.fromInt(1<<24);b.math.Long.prototype.toInt=function(){return this.lowBits};b.math.Long.prototype.toNumber=function(){return this.highBits*b.math.Long.TWO_PWR_32_DBL_+this.getLowBitsUnsigned()};b.math.Long.prototype.toString=function(j){var h=j||10;if(h<2||36<h){throw new Error("radix out of range: "+h)}if(this.isZero()){return"0"}var k,m;if(this.isNegative()){if(this.equals(b.math.Long.MIN_VALUE)){var f=b.math.Long.fromNumber(h);var d=this.div(f);k=d.multiply(f).subtract(this);return d.toString(h)+k.toInt().toString(h)}else{switch(h){case 2:case 8:case 16:m="-"+this.negate().toString(2);return c._negativeBinary(m,h);default:m="-"+this.negate().toString(h);return m}}}var l=b.math.Long.fromNumber(Math.pow(h,6));k=this;m="";while(true){var i=k.div(l);var g=k.subtract(i.multiply(l)).toInt();var e=g.toString(h);k=i;if(k.isZero()){return e+m}else{while(e.length<6){e="0"+e}m=""+e+m}}};b.math.Long.prototype.getHighBits=function(){return this.highBits};b.math.Long.prototype.getLowBits=function(){return this.lowBits};b.math.Long.prototype.getLowBitsUnsigned=function(){return(this.lowBits>=0)?this.lowBits:b.math.Long.TWO_PWR_32_DBL_+this.lowBits};b.math.Long.prototype.getNumBitsAbs=function(){if(this.isNegative()){if(this.equals(b.math.Long.MIN_VALUE)){return 64}else{return this.negate().getNumBitsAbs()}}else{var e=this.highBits!==0?this.highBits:this.lowBits;for(var d=31;d>0;d--){if((e&(1<<d))!==0){break}}return this.highBits!==0?d+33:d+1}};b.math.Long.prototype.isZero=function(){return this.highBits===0&&this.lowBits===0};b.math.Long.prototype.isNegative=function(){return this.highBits<0};b.math.Long.prototype.isOdd=function(){return(this.lowBits&1)===1};b.math.Long.prototype.equals=function(d){return(this.highBits===d.highBits)&&(this.lowBits===d.lowBits)};b.math.Long.prototype.notEquals=function(d){return(this.highBits!==d.highBits)||(this.lowBits!==d.lowBits)};b.math.Long.prototype.lessThan=function(d){return this.compare(d)<0};b.math.Long.prototype.lessThanOrEqual=function(d){return this.compare(d)<=0};b.math.Long.prototype.greaterThan=function(d){return this.compare(d)>0};b.math.Long.prototype.greaterThanOrEqual=function(d){return this.compare(d)>=0};b.math.Long.prototype.compare=function(e){if(this.equals(e)){return 0}var d=this.isNegative();var f=e.isNegative();if(d&&!f){return -1}if(!d&&f){return 1}if(this.subtract(e).isNegative()){return -1}else{return 1}};b.math.Long.prototype.negate=function(){if(this.equals(b.math.Long.MIN_VALUE)){return b.math.Long.MIN_VALUE}else{return this.not().add(b.math.Long.ONE)}};b.math.Long.prototype.add=function(k){var i=this.highBits>>>16;var e=this.highBits&65535;var l=this.lowBits>>>16;var f=this.lowBits&65535;var n=k.highBits>>>16;var g=k.highBits&65535;var o=k.lowBits>>>16;var h=k.lowBits&65535;var p=0,j=0,d=0,m=0;m+=f+h;d+=m>>>16;m&=65535;d+=l+o;j+=d>>>16;d&=65535;j+=e+g;p+=j>>>16;j&=65535;p+=i+n;p&=65535;return b.math.Long.fromBits((d<<16)|m,(p<<16)|j)};b.math.Long.prototype.subtract=function(d){return this.add(d.negate())};b.math.Long.prototype.multiply=function(k){if(this.isZero()){return b.math.Long.ZERO}else{if(k.isZero()){return b.math.Long.ZERO}}if(this.equals(b.math.Long.MIN_VALUE)){return k.isOdd()?b.math.Long.MIN_VALUE:b.math.Long.ZERO}else{if(k.equals(b.math.Long.MIN_VALUE)){return this.isOdd()?b.math.Long.MIN_VALUE:b.math.Long.ZERO}}if(this.isNegative()){if(k.isNegative()){return this.negate().multiply(k.negate())}else{return this.negate().multiply(k).negate()}}else{if(k.isNegative()){return this.multiply(k.negate()).negate()}}if(this.lessThan(b.math.Long.TWO_PWR_24_)&&k.lessThan(b.math.Long.TWO_PWR_24_)){return b.math.Long.fromNumber(this.toNumber()*k.toNumber())}var i=this.highBits>>>16;var e=this.highBits&65535;var l=this.lowBits>>>16;var f=this.lowBits&65535;var n=k.highBits>>>16;var g=k.highBits&65535;var o=k.lowBits>>>16;var h=k.lowBits&65535;var p=0,j=0,d=0,m=0;m+=f*h;d+=m>>>16;m&=65535;d+=l*h;j+=d>>>16;d&=65535;d+=f*o;j+=d>>>16;d&=65535;j+=e*h;p+=j>>>16;j&=65535;j+=l*o;p+=j>>>16;j&=65535;j+=f*g;p+=j>>>16;j&=65535;p+=i*h+e*o+l*g+f*n;p&=65535;return b.math.Long.fromBits((d<<16)|m,(p<<16)|j)};b.math.Long.prototype.div=function(f){if(f.isZero()){throw new Error("division by zero")}else{if(this.isZero()){return b.math.Long.ZERO}}var i,k;if(this.equals(b.math.Long.MIN_VALUE)){if(f.equals(b.math.Long.ONE)||f.equals(b.math.Long.NEG_ONE)){return b.math.Long.MIN_VALUE}else{if(f.equals(b.math.Long.MIN_VALUE)){return b.math.Long.ONE}else{var d=this.shiftRight(1);i=d.div(f).shiftLeft(1);if(i.equals(b.math.Long.ZERO)){return f.isNegative()?b.math.Long.ONE:b.math.Long.NEG_ONE}else{k=this.subtract(f.multiply(i));var m=i.add(k.div(f));return m}}}}else{if(f.equals(b.math.Long.MIN_VALUE)){return b.math.Long.ZERO}}if(this.isNegative()){if(f.isNegative()){return this.negate().div(f.negate())}else{return this.negate().div(f).negate()}}else{if(f.isNegative()){return this.div(f.negate()).negate()}}var g=b.math.Long.ZERO;k=this;while(k.greaterThanOrEqual(f)){i=Math.max(1,Math.floor(k.toNumber()/f.toNumber()));var l=Math.ceil(Math.log(i)/Math.LN2);var j=(l<=48)?1:Math.pow(2,l-48);var e=b.math.Long.fromNumber(i);var h=e.multiply(f);while(h.isNegative()||h.greaterThan(k)){i-=j;e=b.math.Long.fromNumber(i);h=e.multiply(f)}if(e.isZero()){e=b.math.Long.ONE}g=g.add(e);k=k.subtract(h)}return g};b.math.Long.prototype.modulo=function(d){return this.subtract(this.div(d).multiply(d))};b.math.Long.prototype.not=function(){return b.math.Long.fromBits(~this.lowBits,~this.highBits)};b.math.Long.prototype.and=function(d){return b.math.Long.fromBits(this.lowBits&d.lowBits,this.highBits&d.highBits)};b.math.Long.prototype.or=function(d){return b.math.Long.fromBits(this.lowBits|d.lowBits,this.highBits|d.highBits)};b.math.Long.prototype.xor=function(d){return b.math.Long.fromBits(this.lowBits^d.lowBits,this.highBits^d.highBits)};b.math.Long.prototype.shiftLeft=function(f){f&=63;if(f===0){return this}else{var d=this.lowBits;if(f<32){var e=this.highBits;return b.math.Long.fromBits(d<<f,(e<<f)|(d>>>(32-f)))}else{return b.math.Long.fromBits(0,d<<(f-32))}}};b.math.Long.prototype.shiftRight=function(f){f&=63;if(f===0){return this}else{var e=this.highBits;if(f<32){var d=this.lowBits;return b.math.Long.fromBits((d>>>f)|(e<<(32-f)),e>>f)}else{return b.math.Long.fromBits(e>>(f-32),e>=0?0:-1)}}};b.math.Long.prototype.shiftRightUnsigned=function(f){f&=63;if(f===0){return this}else{var e=this.highBits;if(f<32){var d=this.lowBits;return b.math.Long.fromBits((d>>>f)|(e<<(32-f)),e>>>f)}else{if(f===32){return b.math.Long.fromBits(e,0)}else{return b.math.Long.fromBits(e>>>(f-32),0)}}}}}})})(jqxBaseFramework);