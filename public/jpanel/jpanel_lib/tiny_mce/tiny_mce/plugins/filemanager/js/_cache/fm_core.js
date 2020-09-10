/**
 * $Id: domain.js 505 2008-10-23 12:34:12Z spocke $
 *
 * @author Moxiecode
 * @copyright Copyright � 2004-2008, Moxiecode Systems AB, All rights reserved.
 */

(function(){
	try {
		var li = document.location.search.replace(/\?/, '').split('&'), query = {}, i;

		for (i = 0; i < li.length; i++) {
			it = li[i].split('=');
			query[unescape(it[0])] = unescape(it[1]);
		}

		if (query.domain)
			document.domain = query.domain;
	} catch (ex) {
		// Ignore
	}
})();
/*
 * jQuery 1.2.6 - New Wave Javascript
 *
 * Copyright (c) 2008 John Resig (jquery.com)
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 * $Date: 2008-05-24 14:22:17 -0400 (Sat, 24 May 2008) $
 * $Rev: 5685 $
 */
(function(){var _jQuery=window.jQuery,_$=window.$;var jQuery=window.jQuery=window.$=function(selector,context){return new jQuery.fn.init(selector,context);};var quickExpr=/^[^<]*(<(.|\s)+>)[^>]*$|^#(\w+)$/,isSimple=/^.[^:#\[\.]*$/,undefined;jQuery.fn=jQuery.prototype={init:function(selector,context){selector=selector||document;if(selector.nodeType){this[0]=selector;this.length=1;return this;}if(typeof selector=="string"){var match=quickExpr.exec(selector);if(match&&(match[1]||!context)){if(match[1])selector=jQuery.clean([match[1]],context);else{var elem=document.getElementById(match[3]);if(elem){if(elem.id!=match[3])return jQuery().find(selector);return jQuery(elem);}selector=[];}}else
return jQuery(context).find(selector);}else if(jQuery.isFunction(selector))return jQuery(document)[jQuery.fn.ready?"ready":"load"](selector);return this.setArray(jQuery.makeArray(selector));},jquery:"1.2.6",size:function(){return this.length;},length:0,get:function(num){return num==undefined?jQuery.makeArray(this):this[num];},pushStack:function(elems){var ret=jQuery(elems);ret.prevObject=this;return ret;},setArray:function(elems){this.length=0;Array.prototype.push.apply(this,elems);return this;},each:function(callback,args){return jQuery.each(this,callback,args);},index:function(elem){var ret=-1;return jQuery.inArray(elem&&elem.jquery?elem[0]:elem,this);},attr:function(name,value,type){var options=name;if(name.constructor==String)if(value===undefined)return this[0]&&jQuery[type||"attr"](this[0],name);else{options={};options[name]=value;}return this.each(function(i){for(name in options)jQuery.attr(type?this.style:this,name,jQuery.prop(this,options[name],type,i,name));});},css:function(key,value){if((key=='width'||key=='height')&&parseFloat(value)<0)value=undefined;return this.attr(key,value,"curCSS");},text:function(text){if(typeof text!="object"&&text!=null)return this.empty().append((this[0]&&this[0].ownerDocument||document).createTextNode(text));var ret="";jQuery.each(text||this,function(){jQuery.each(this.childNodes,function(){if(this.nodeType!=8)ret+=this.nodeType!=1?this.nodeValue:jQuery.fn.text([this]);});});return ret;},wrapAll:function(html){if(this[0])jQuery(html,this[0].ownerDocument).clone().insertBefore(this[0]).map(function(){var elem=this;while(elem.firstChild)elem=elem.firstChild;return elem;}).append(this);return this;},wrapInner:function(html){return this.each(function(){jQuery(this).contents().wrapAll(html);});},wrap:function(html){return this.each(function(){jQuery(this).wrapAll(html);});},append:function(){return this.domManip(arguments,true,false,function(elem){if(this.nodeType==1)this.appendChild(elem);});},prepend:function(){return this.domManip(arguments,true,true,function(elem){if(this.nodeType==1)this.insertBefore(elem,this.firstChild);});},before:function(){return this.domManip(arguments,false,false,function(elem){this.parentNode.insertBefore(elem,this);});},after:function(){return this.domManip(arguments,false,true,function(elem){this.parentNode.insertBefore(elem,this.nextSibling);});},end:function(){return this.prevObject||jQuery([]);},find:function(selector){var elems=jQuery.map(this,function(elem){return jQuery.find(selector,elem);});return this.pushStack(/[^+>] [^+>]/.test(selector)||selector.indexOf("..")>-1?jQuery.unique(elems):elems);},clone:function(events){var ret=this.map(function(){if(jQuery.browser.msie&&!jQuery.isXMLDoc(this)){var clone=this.cloneNode(true),container=document.createElement("div");container.appendChild(clone);return jQuery.clean([container.innerHTML])[0];}else
return this.cloneNode(true);});var clone=ret.find("*").andSelf().each(function(){if(this[expando]!=undefined)this[expando]=null;});if(events===true)this.find("*").andSelf().each(function(i){if(this.nodeType==3)return;var events=jQuery.data(this,"events");for(var type in events)for(var handler in events[type])jQuery.event.add(clone[i],type,events[type][handler],events[type][handler].data);});return ret;},filter:function(selector){return this.pushStack(jQuery.isFunction(selector)&&jQuery.grep(this,function(elem,i){return selector.call(elem,i);})||jQuery.multiFilter(selector,this));},not:function(selector){if(selector.constructor==String)if(isSimple.test(selector))return this.pushStack(jQuery.multiFilter(selector,this,true));else
selector=jQuery.multiFilter(selector,this);var isArrayLike=selector.length&&selector[selector.length-1]!==undefined&&!selector.nodeType;return this.filter(function(){return isArrayLike?jQuery.inArray(this,selector)<0:this!=selector;});},add:function(selector){return this.pushStack(jQuery.unique(jQuery.merge(this.get(),typeof selector=='string'?jQuery(selector):jQuery.makeArray(selector))));},is:function(selector){return!!selector&&jQuery.multiFilter(selector,this).length>0;},hasClass:function(selector){return this.is("."+selector);},val:function(value){if(value==undefined){if(this.length){var elem=this[0];if(jQuery.nodeName(elem,"select")){var index=elem.selectedIndex,values=[],options=elem.options,one=elem.type=="select-one";if(index<0)return null;for(var i=one?index:0,max=one?index+1:options.length;i<max;i++){var option=options[i];if(option.selected){value=jQuery.browser.msie&&!option.attributes.value.specified?option.text:option.value;if(one)return value;values.push(value);}}return values;}else
return(this[0].value||"").replace(/\r/g,"");}return undefined;}if(value.constructor==Number)value+='';return this.each(function(){if(this.nodeType!=1)return;if(value.constructor==Array&&/radio|checkbox/.test(this.type))this.checked=(jQuery.inArray(this.value,value)>=0||jQuery.inArray(this.name,value)>=0);else if(jQuery.nodeName(this,"select")){var values=jQuery.makeArray(value);jQuery("option",this).each(function(){this.selected=(jQuery.inArray(this.value,values)>=0||jQuery.inArray(this.text,values)>=0);});if(!values.length)this.selectedIndex=-1;}else
this.value=value;});},html:function(value){return value==undefined?(this[0]?this[0].innerHTML:null):this.empty().append(value);},replaceWith:function(value){return this.after(value).remove();},eq:function(i){return this.slice(i,i+1);},slice:function(){return this.pushStack(Array.prototype.slice.apply(this,arguments));},map:function(callback){return this.pushStack(jQuery.map(this,function(elem,i){return callback.call(elem,i,elem);}));},andSelf:function(){return this.add(this.prevObject);},data:function(key,value){var parts=key.split(".");parts[1]=parts[1]?"."+parts[1]:"";if(value===undefined){var data=this.triggerHandler("getData"+parts[1]+"!",[parts[0]]);if(data===undefined&&this.length)data=jQuery.data(this[0],key);return data===undefined&&parts[1]?this.data(parts[0]):data;}else
return this.trigger("setData"+parts[1]+"!",[parts[0],value]).each(function(){jQuery.data(this,key,value);});},removeData:function(key){return this.each(function(){jQuery.removeData(this,key);});},domManip:function(args,table,reverse,callback){var clone=this.length>1,elems;return this.each(function(){if(!elems){elems=jQuery.clean(args,this.ownerDocument);if(reverse)elems.reverse();}var obj=this;if(table&&jQuery.nodeName(this,"table")&&jQuery.nodeName(elems[0],"tr"))obj=this.getElementsByTagName("tbody")[0]||this.appendChild(this.ownerDocument.createElement("tbody"));var scripts=jQuery([]);jQuery.each(elems,function(){var elem=clone?jQuery(this).clone(true)[0]:this;if(jQuery.nodeName(elem,"script"))scripts=scripts.add(elem);else{if(elem.nodeType==1)scripts=scripts.add(jQuery("script",elem).remove());callback.call(obj,elem);}});scripts.each(evalScript);});}};jQuery.fn.init.prototype=jQuery.fn;function evalScript(i,elem){if(elem.src)jQuery.ajax({url:elem.src,async:false,dataType:"script"});else
jQuery.globalEval(elem.text||elem.textContent||elem.innerHTML||"");if(elem.parentNode)elem.parentNode.removeChild(elem);}function now(){return+new Date;}jQuery.extend=jQuery.fn.extend=function(){var target=arguments[0]||{},i=1,length=arguments.length,deep=false,options;if(target.constructor==Boolean){deep=target;target=arguments[1]||{};i=2;}if(typeof target!="object"&&typeof target!="function")target={};if(length==i){target=this;--i;}for(;i<length;i++)if((options=arguments[i])!=null)for(var name in options){var src=target[name],copy=options[name];if(target===copy)continue;if(deep&&copy&&typeof copy=="object"&&!copy.nodeType)target[name]=jQuery.extend(deep,src||(copy.length!=null?[]:{}),copy);else if(copy!==undefined)target[name]=copy;}return target;};var expando="jQuery"+now(),uuid=0,windowData={},exclude=/z-?index|font-?weight|opacity|zoom|line-?height/i,defaultView=document.defaultView||{};jQuery.extend({noConflict:function(deep){window.$=_$;if(deep)window.jQuery=_jQuery;return jQuery;},isFunction:function(fn){return!!fn&&typeof fn!="string"&&!fn.nodeName&&fn.constructor!=Array&&/^[\s[]?function/.test(fn+"");},isXMLDoc:function(elem){return elem.documentElement&&!elem.body||elem.tagName&&elem.ownerDocument&&!elem.ownerDocument.body;},globalEval:function(data){data=jQuery.trim(data);if(data){var head=document.getElementsByTagName("head")[0]||document.documentElement,script=document.createElement("script");script.type="text/javascript";if(jQuery.browser.msie)script.text=data;else
script.appendChild(document.createTextNode(data));head.insertBefore(script,head.firstChild);head.removeChild(script);}},nodeName:function(elem,name){return elem.nodeName&&elem.nodeName.toUpperCase()==name.toUpperCase();},cache:{},data:function(elem,name,data){elem=elem==window?windowData:elem;var id=elem[expando];if(!id)id=elem[expando]=++uuid;if(name&&!jQuery.cache[id])jQuery.cache[id]={};if(data!==undefined)jQuery.cache[id][name]=data;return name?jQuery.cache[id][name]:id;},removeData:function(elem,name){elem=elem==window?windowData:elem;var id=elem[expando];if(name){if(jQuery.cache[id]){delete jQuery.cache[id][name];name="";for(name in jQuery.cache[id])break;if(!name)jQuery.removeData(elem);}}else{try{delete elem[expando];}catch(e){if(elem.removeAttribute)elem.removeAttribute(expando);}delete jQuery.cache[id];}},each:function(object,callback,args){var name,i=0,length=object.length;if(args){if(length==undefined){for(name in object)if(callback.apply(object[name],args)===false)break;}else
for(;i<length;)if(callback.apply(object[i++],args)===false)break;}else{if(length==undefined){for(name in object)if(callback.call(object[name],name,object[name])===false)break;}else
for(var value=object[0];i<length&&callback.call(value,i,value)!==false;value=object[++i]){}}return object;},prop:function(elem,value,type,i,name){if(jQuery.isFunction(value))value=value.call(elem,i);return value&&value.constructor==Number&&type=="curCSS"&&!exclude.test(name)?value+"px":value;},className:{add:function(elem,classNames){jQuery.each((classNames||"").split(/\s+/),function(i,className){if(elem.nodeType==1&&!jQuery.className.has(elem.className,className))elem.className+=(elem.className?" ":"")+className;});},remove:function(elem,classNames){if(elem.nodeType==1)elem.className=classNames!=undefined?jQuery.grep(elem.className.split(/\s+/),function(className){return!jQuery.className.has(classNames,className);}).join(" "):"";},has:function(elem,className){return jQuery.inArray(className,(elem.className||elem).toString().split(/\s+/))>-1;}},swap:function(elem,options,callback){var old={};for(var name in options){old[name]=elem.style[name];elem.style[name]=options[name];}callback.call(elem);for(var name in options)elem.style[name]=old[name];},css:function(elem,name,force){if(name=="width"||name=="height"){var val,props={position:"absolute",visibility:"hidden",display:"block"},which=name=="width"?["Left","Right"]:["Top","Bottom"];function getWH(){val=name=="width"?elem.offsetWidth:elem.offsetHeight;var padding=0,border=0;jQuery.each(which,function(){padding+=parseFloat(jQuery.curCSS(elem,"padding"+this,true))||0;border+=parseFloat(jQuery.curCSS(elem,"border"+this+"Width",true))||0;});val-=Math.round(padding+border);}if(jQuery(elem).is(":visible"))getWH();else
jQuery.swap(elem,props,getWH);return Math.max(0,val);}return jQuery.curCSS(elem,name,force);},curCSS:function(elem,name,force){var ret,style=elem.style;function color(elem){if(!jQuery.browser.safari)return false;var ret=defaultView.getComputedStyle(elem,null);return!ret||ret.getPropertyValue("color")=="";}if(name=="opacity"&&jQuery.browser.msie){ret=jQuery.attr(style,"opacity");return ret==""?"1":ret;}if(jQuery.browser.opera&&name=="display"){var save=style.outline;style.outline="0 solid black";style.outline=save;}if(name.match(/float/i))name=styleFloat;if(!force&&style&&style[name])ret=style[name];else if(defaultView.getComputedStyle){if(name.match(/float/i))name="float";name=name.replace(/([A-Z])/g,"-$1").toLowerCase();var computedStyle=defaultView.getComputedStyle(elem,null);if(computedStyle&&!color(elem))ret=computedStyle.getPropertyValue(name);else{var swap=[],stack=[],a=elem,i=0;for(;a&&color(a);a=a.parentNode)stack.unshift(a);for(;i<stack.length;i++)if(color(stack[i])){swap[i]=stack[i].style.display;stack[i].style.display="block";}ret=name=="display"&&swap[stack.length-1]!=null?"none":(computedStyle&&computedStyle.getPropertyValue(name))||"";for(i=0;i<swap.length;i++)if(swap[i]!=null)stack[i].style.display=swap[i];}if(name=="opacity"&&ret=="")ret="1";}else if(elem.currentStyle){var camelCase=name.replace(/\-(\w)/g,function(all,letter){return letter.toUpperCase();});ret=elem.currentStyle[name]||elem.currentStyle[camelCase];if(!/^\d+(px)?$/i.test(ret)&&/^\d/.test(ret)){var left=style.left,rsLeft=elem.runtimeStyle.left;elem.runtimeStyle.left=elem.currentStyle.left;style.left=ret||0;ret=style.pixelLeft+"px";style.left=left;elem.runtimeStyle.left=rsLeft;}}return ret;},clean:function(elems,context){var ret=[];context=context||document;if(typeof context.createElement=='undefined')context=context.ownerDocument||context[0]&&context[0].ownerDocument||document;jQuery.each(elems,function(i,elem){if(!elem)return;if(elem.constructor==Number)elem+='';if(typeof elem=="string"){elem=elem.replace(/(<(\w+)[^>]*?)\/>/g,function(all,front,tag){return tag.match(/^(abbr|br|col|img|input|link|meta|param|hr|area|embed)$/i)?all:front+"></"+tag+">";});var tags=jQuery.trim(elem).toLowerCase(),div=context.createElement("div");var wrap=!tags.indexOf("<opt")&&[1,"<select multiple='multiple'>","</select>"]||!tags.indexOf("<leg")&&[1,"<fieldset>","</fieldset>"]||tags.match(/^<(thead|tbody|tfoot|colg|cap)/)&&[1,"<table>","</table>"]||!tags.indexOf("<tr")&&[2,"<table><tbody>","</tbody></table>"]||(!tags.indexOf("<td")||!tags.indexOf("<th"))&&[3,"<table><tbody><tr>","</tr></tbody></table>"]||!tags.indexOf("<col")&&[2,"<table><tbody></tbody><colgroup>","</colgroup></table>"]||jQuery.browser.msie&&[1,"div<div>","</div>"]||[0,"",""];div.innerHTML=wrap[1]+elem+wrap[2];while(wrap[0]--)div=div.lastChild;if(jQuery.browser.msie){var tbody=!tags.indexOf("<table")&&tags.indexOf("<tbody")<0?div.firstChild&&div.firstChild.childNodes:wrap[1]=="<table>"&&tags.indexOf("<tbody")<0?div.childNodes:[];for(var j=tbody.length-1;j>=0;--j)if(jQuery.nodeName(tbody[j],"tbody")&&!tbody[j].childNodes.length)tbody[j].parentNode.removeChild(tbody[j]);if(/^\s/.test(elem))div.insertBefore(context.createTextNode(elem.match(/^\s*/)[0]),div.firstChild);}elem=jQuery.makeArray(div.childNodes);}if(elem.length===0&&(!jQuery.nodeName(elem,"form")&&!jQuery.nodeName(elem,"select")))return;if(elem[0]==undefined||jQuery.nodeName(elem,"form")||elem.options)ret.push(elem);else
ret=jQuery.merge(ret,elem);});return ret;},attr:function(elem,name,value){if(!elem||elem.nodeType==3||elem.nodeType==8)return undefined;var notxml=!jQuery.isXMLDoc(elem),set=value!==undefined,msie=jQuery.browser.msie;name=notxml&&jQuery.props[name]||name;if(elem.tagName){var special=/href|src|style/.test(name);if(name=="selected"&&jQuery.browser.safari)elem.parentNode.selectedIndex;if(name in elem&&notxml&&!special){if(set){if(name=="type"&&jQuery.nodeName(elem,"input")&&elem.parentNode)throw"type property can't be changed";elem[name]=value;}if(jQuery.nodeName(elem,"form")&&elem.getAttributeNode(name))return elem.getAttributeNode(name).nodeValue;return elem[name];}if(msie&&notxml&&name=="style")return jQuery.attr(elem.style,"cssText",value);if(set)elem.setAttribute(name,""+value);var attr=msie&&notxml&&special?elem.getAttribute(name,2):elem.getAttribute(name);return attr===null?undefined:attr;}if(msie&&name=="opacity"){if(set){elem.zoom=1;elem.filter=(elem.filter||"").replace(/alpha\([^)]*\)/,"")+(parseInt(value)+''=="NaN"?"":"alpha(opacity="+value*100+")");}return elem.filter&&elem.filter.indexOf("opacity=")>=0?(parseFloat(elem.filter.match(/opacity=([^)]*)/)[1])/100)+'':"";}name=name.replace(/-([a-z])/ig,function(all,letter){return letter.toUpperCase();});if(set)elem[name]=value;return elem[name];},trim:function(text){return(text||"").replace(/^\s+|\s+$/g,"");},makeArray:function(array){var ret=[];if(array!=null){var i=array.length;if(i==null||array.split||array.setInterval||array.call)ret[0]=array;else
while(i)ret[--i]=array[i];}return ret;},inArray:function(elem,array){for(var i=0,length=array.length;i<length;i++)if(array[i]===elem)return i;return-1;},merge:function(first,second){var i=0,elem,pos=first.length;if(jQuery.browser.msie){while(elem=second[i++])if(elem.nodeType!=8)first[pos++]=elem;}else
while(elem=second[i++])first[pos++]=elem;return first;},unique:function(array){var ret=[],done={};try{for(var i=0,length=array.length;i<length;i++){var id=jQuery.data(array[i]);if(!done[id]){done[id]=true;ret.push(array[i]);}}}catch(e){ret=array;}return ret;},grep:function(elems,callback,inv){var ret=[];for(var i=0,length=elems.length;i<length;i++)if(!inv!=!callback(elems[i],i))ret.push(elems[i]);return ret;},map:function(elems,callback){var ret=[];for(var i=0,length=elems.length;i<length;i++){var value=callback(elems[i],i);if(value!=null)ret[ret.length]=value;}return ret.concat.apply([],ret);}});var userAgent=navigator.userAgent.toLowerCase();jQuery.browser={version:(userAgent.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/)||[])[1],safari:/webkit/.test(userAgent),opera:/opera/.test(userAgent),msie:/msie/.test(userAgent)&&!/opera/.test(userAgent),mozilla:/mozilla/.test(userAgent)&&!/(compatible|webkit)/.test(userAgent)};var styleFloat=jQuery.browser.msie?"styleFloat":"cssFloat";jQuery.extend({boxModel:!jQuery.browser.msie||document.compatMode=="CSS1Compat",props:{"for":"htmlFor","class":"className","float":styleFloat,cssFloat:styleFloat,styleFloat:styleFloat,readonly:"readOnly",maxlength:"maxLength",cellspacing:"cellSpacing"}});jQuery.each({parent:function(elem){return elem.parentNode;},parents:function(elem){return jQuery.dir(elem,"parentNode");},next:function(elem){return jQuery.nth(elem,2,"nextSibling");},prev:function(elem){return jQuery.nth(elem,2,"previousSibling");},nextAll:function(elem){return jQuery.dir(elem,"nextSibling");},prevAll:function(elem){return jQuery.dir(elem,"previousSibling");},siblings:function(elem){return jQuery.sibling(elem.parentNode.firstChild,elem);},children:function(elem){return jQuery.sibling(elem.firstChild);},contents:function(elem){return jQuery.nodeName(elem,"iframe")?elem.contentDocument||elem.contentWindow.document:jQuery.makeArray(elem.childNodes);}},function(name,fn){jQuery.fn[name]=function(selector){var ret=jQuery.map(this,fn);if(selector&&typeof selector=="string")ret=jQuery.multiFilter(selector,ret);return this.pushStack(jQuery.unique(ret));};});jQuery.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(name,original){jQuery.fn[name]=function(){var args=arguments;return this.each(function(){for(var i=0,length=args.length;i<length;i++)jQuery(args[i])[original](this);});};});jQuery.each({removeAttr:function(name){jQuery.attr(this,name,"");if(this.nodeType==1)this.removeAttribute(name);},addClass:function(classNames){jQuery.className.add(this,classNames);},removeClass:function(classNames){jQuery.className.remove(this,classNames);},toggleClass:function(classNames){jQuery.className[jQuery.className.has(this,classNames)?"remove":"add"](this,classNames);},remove:function(selector){if(!selector||jQuery.filter(selector,[this]).r.length){jQuery("*",this).add(this).each(function(){jQuery.event.remove(this);jQuery.removeData(this);});if(this.parentNode)this.parentNode.removeChild(this);}},empty:function(){jQuery(">*",this).remove();while(this.firstChild)this.removeChild(this.firstChild);}},function(name,fn){jQuery.fn[name]=function(){return this.each(fn,arguments);};});jQuery.each(["Height","Width"],function(i,name){var type=name.toLowerCase();jQuery.fn[type]=function(size){return this[0]==window?jQuery.browser.opera&&document.body["client"+name]||jQuery.browser.safari&&window["inner"+name]||document.compatMode=="CSS1Compat"&&document.documentElement["client"+name]||document.body["client"+name]:this[0]==document?Math.max(Math.max(document.body["scroll"+name],document.documentElement["scroll"+name]),Math.max(document.body["offset"+name],document.documentElement["offset"+name])):size==undefined?(this.length?jQuery.css(this[0],type):null):this.css(type,size.constructor==String?size:size+"px");};});function num(elem,prop){return elem[0]&&parseInt(jQuery.curCSS(elem[0],prop,true),10)||0;}var chars=jQuery.browser.safari&&parseInt(jQuery.browser.version)<417?"(?:[\\w*_-]|\\\\.)":"(?:[\\w\u0128-\uFFFF*_-]|\\\\.)",quickChild=new RegExp("^>\\s*("+chars+"+)"),quickID=new RegExp("^("+chars+"+)(#)("+chars+"+)"),quickClass=new RegExp("^([#.]?)("+chars+"*)");jQuery.extend({expr:{"":function(a,i,m){return m[2]=="*"||jQuery.nodeName(a,m[2]);},"#":function(a,i,m){return a.getAttribute("id")==m[2];},":":{lt:function(a,i,m){return i<m[3]-0;},gt:function(a,i,m){return i>m[3]-0;},nth:function(a,i,m){return m[3]-0==i;},eq:function(a,i,m){return m[3]-0==i;},first:function(a,i){return i==0;},last:function(a,i,m,r){return i==r.length-1;},even:function(a,i){return i%2==0;},odd:function(a,i){return i%2;},"first-child":function(a){return a.parentNode.getElementsByTagName("*")[0]==a;},"last-child":function(a){return jQuery.nth(a.parentNode.lastChild,1,"previousSibling")==a;},"only-child":function(a){return!jQuery.nth(a.parentNode.lastChild,2,"previousSibling");},parent:function(a){return a.firstChild;},empty:function(a){return!a.firstChild;},contains:function(a,i,m){return(a.textContent||a.innerText||jQuery(a).text()||"").indexOf(m[3])>=0;},visible:function(a){return"hidden"!=a.type&&jQuery.css(a,"display")!="none"&&jQuery.css(a,"visibility")!="hidden";},hidden:function(a){return"hidden"==a.type||jQuery.css(a,"display")=="none"||jQuery.css(a,"visibility")=="hidden";},enabled:function(a){return!a.disabled;},disabled:function(a){return a.disabled;},checked:function(a){return a.checked;},selected:function(a){return a.selected||jQuery.attr(a,"selected");},text:function(a){return"text"==a.type;},radio:function(a){return"radio"==a.type;},checkbox:function(a){return"checkbox"==a.type;},file:function(a){return"file"==a.type;},password:function(a){return"password"==a.type;},submit:function(a){return"submit"==a.type;},image:function(a){return"image"==a.type;},reset:function(a){return"reset"==a.type;},button:function(a){return"button"==a.type||jQuery.nodeName(a,"button");},input:function(a){return/input|select|textarea|button/i.test(a.nodeName);},has:function(a,i,m){return jQuery.find(m[3],a).length;},header:function(a){return/h\d/i.test(a.nodeName);},animated:function(a){return jQuery.grep(jQuery.timers,function(fn){return a==fn.elem;}).length;}}},parse:[/^(\[) *@?([\w-]+) *([!*$^~=]*) *('?"?)(.*?)\4 *\]/,/^(:)([\w-]+)\("?'?(.*?(\(.*?\))?[^(]*?)"?'?\)/,new RegExp("^([:.#]*)("+chars+"+)")],multiFilter:function(expr,elems,not){var old,cur=[];while(expr&&expr!=old){old=expr;var f=jQuery.filter(expr,elems,not);expr=f.t.replace(/^\s*,\s*/,"");cur=not?elems=f.r:jQuery.merge(cur,f.r);}return cur;},find:function(t,context){if(typeof t!="string")return[t];if(context&&context.nodeType!=1&&context.nodeType!=9)return[];context=context||document;var ret=[context],done=[],last,nodeName;while(t&&last!=t){var r=[];last=t;t=jQuery.trim(t);var foundToken=false,re=quickChild,m=re.exec(t);if(m){nodeName=m[1].toUpperCase();for(var i=0;ret[i];i++)for(var c=ret[i].firstChild;c;c=c.nextSibling)if(c.nodeType==1&&(nodeName=="*"||c.nodeName.toUpperCase()==nodeName))r.push(c);ret=r;t=t.replace(re,"");if(t.indexOf(" ")==0)continue;foundToken=true;}else{re=/^([>+~])\s*(\w*)/i;if((m=re.exec(t))!=null){r=[];var merge={};nodeName=m[2].toUpperCase();m=m[1];for(var j=0,rl=ret.length;j<rl;j++){var n=m=="~"||m=="+"?ret[j].nextSibling:ret[j].firstChild;for(;n;n=n.nextSibling)if(n.nodeType==1){var id=jQuery.data(n);if(m=="~"&&merge[id])break;if(!nodeName||n.nodeName.toUpperCase()==nodeName){if(m=="~")merge[id]=true;r.push(n);}if(m=="+")break;}}ret=r;t=jQuery.trim(t.replace(re,""));foundToken=true;}}if(t&&!foundToken){if(!t.indexOf(",")){if(context==ret[0])ret.shift();done=jQuery.merge(done,ret);r=ret=[context];t=" "+t.substr(1,t.length);}else{var re2=quickID;var m=re2.exec(t);if(m){m=[0,m[2],m[3],m[1]];}else{re2=quickClass;m=re2.exec(t);}m[2]=m[2].replace(/\\/g,"");var elem=ret[ret.length-1];if(m[1]=="#"&&elem&&elem.getElementById&&!jQuery.isXMLDoc(elem)){var oid=elem.getElementById(m[2]);if((jQuery.browser.msie||jQuery.browser.opera)&&oid&&typeof oid.id=="string"&&oid.id!=m[2])oid=jQuery('[@id="'+m[2]+'"]',elem)[0];ret=r=oid&&(!m[3]||jQuery.nodeName(oid,m[3]))?[oid]:[];}else{for(var i=0;ret[i];i++){var tag=m[1]=="#"&&m[3]?m[3]:m[1]!=""||m[0]==""?"*":m[2];if(tag=="*"&&ret[i].nodeName.toLowerCase()=="object")tag="param";r=jQuery.merge(r,ret[i].getElementsByTagName(tag));}if(m[1]==".")r=jQuery.classFilter(r,m[2]);if(m[1]=="#"){var tmp=[];for(var i=0;r[i];i++)if(r[i].getAttribute("id")==m[2]){tmp=[r[i]];break;}r=tmp;}ret=r;}t=t.replace(re2,"");}}if(t){var val=jQuery.filter(t,r);ret=r=val.r;t=jQuery.trim(val.t);}}if(t)ret=[];if(ret&&context==ret[0])ret.shift();done=jQuery.merge(done,ret);return done;},classFilter:function(r,m,not){m=" "+m+" ";var tmp=[];for(var i=0;r[i];i++){var pass=(" "+r[i].className+" ").indexOf(m)>=0;if(!not&&pass||not&&!pass)tmp.push(r[i]);}return tmp;},filter:function(t,r,not){var last;while(t&&t!=last){last=t;var p=jQuery.parse,m;for(var i=0;p[i];i++){m=p[i].exec(t);if(m){t=t.substring(m[0].length);m[2]=m[2].replace(/\\/g,"");break;}}if(!m)break;if(m[1]==":"&&m[2]=="not")r=isSimple.test(m[3])?jQuery.filter(m[3],r,true).r:jQuery(r).not(m[3]);else if(m[1]==".")r=jQuery.classFilter(r,m[2],not);else if(m[1]=="["){var tmp=[],type=m[3];for(var i=0,rl=r.length;i<rl;i++){var a=r[i],z=a[jQuery.props[m[2]]||m[2]];if(z==null||/href|src|selected/.test(m[2]))z=jQuery.attr(a,m[2])||'';if((type==""&&!!z||type=="="&&z==m[5]||type=="!="&&z!=m[5]||type=="^="&&z&&!z.indexOf(m[5])||type=="$="&&z.substr(z.length-m[5].length)==m[5]||(type=="*="||type=="~=")&&z.indexOf(m[5])>=0)^not)tmp.push(a);}r=tmp;}else if(m[1]==":"&&m[2]=="nth-child"){var merge={},tmp=[],test=/(-?)(\d*)n((?:\+|-)?\d*)/.exec(m[3]=="even"&&"2n"||m[3]=="odd"&&"2n+1"||!/\D/.test(m[3])&&"0n+"+m[3]||m[3]),first=(test[1]+(test[2]||1))-0,last=test[3]-0;for(var i=0,rl=r.length;i<rl;i++){var node=r[i],parentNode=node.parentNode,id=jQuery.data(parentNode);if(!merge[id]){var c=1;for(var n=parentNode.firstChild;n;n=n.nextSibling)if(n.nodeType==1)n.nodeIndex=c++;merge[id]=true;}var add=false;if(first==0){if(node.nodeIndex==last)add=true;}else if((node.nodeIndex-last)%first==0&&(node.nodeIndex-last)/first>=0)add=true;if(add^not)tmp.push(node);}r=tmp;}else{var fn=jQuery.expr[m[1]];if(typeof fn=="object")fn=fn[m[2]];if(typeof fn=="string")fn=eval("false||function(a,i){return "+fn+";}");r=jQuery.grep(r,function(elem,i){return fn(elem,i,m,r);},not);}}return{r:r,t:t};},dir:function(elem,dir){var matched=[],cur=elem[dir];while(cur&&cur!=document){if(cur.nodeType==1)matched.push(cur);cur=cur[dir];}return matched;},nth:function(cur,result,dir,elem){result=result||1;var num=0;for(;cur;cur=cur[dir])if(cur.nodeType==1&&++num==result)break;return cur;},sibling:function(n,elem){var r=[];for(;n;n=n.nextSibling){if(n.nodeType==1&&n!=elem)r.push(n);}return r;}});jQuery.event={add:function(elem,types,handler,data){if(elem.nodeType==3||elem.nodeType==8)return;if(jQuery.browser.msie&&elem.setInterval)elem=window;if(!handler.guid)handler.guid=this.guid++;if(data!=undefined){var fn=handler;handler=this.proxy(fn,function(){return fn.apply(this,arguments);});handler.data=data;}var events=jQuery.data(elem,"events")||jQuery.data(elem,"events",{}),handle=jQuery.data(elem,"handle")||jQuery.data(elem,"handle",function(){if(typeof jQuery!="undefined"&&!jQuery.event.triggered)return jQuery.event.handle.apply(arguments.callee.elem,arguments);});handle.elem=elem;jQuery.each(types.split(/\s+/),function(index,type){var parts=type.split(".");type=parts[0];handler.type=parts[1];var handlers=events[type];if(!handlers){handlers=events[type]={};if(!jQuery.event.special[type]||jQuery.event.special[type].setup.call(elem)===false){if(elem.addEventListener)elem.addEventListener(type,handle,false);else if(elem.attachEvent)elem.attachEvent("on"+type,handle);}}handlers[handler.guid]=handler;jQuery.event.global[type]=true;});elem=null;},guid:1,global:{},remove:function(elem,types,handler){if(elem.nodeType==3||elem.nodeType==8)return;var events=jQuery.data(elem,"events"),ret,index;if(events){if(types==undefined||(typeof types=="string"&&types.charAt(0)=="."))for(var type in events)this.remove(elem,type+(types||""));else{if(types.type){handler=types.handler;types=types.type;}jQuery.each(types.split(/\s+/),function(index,type){var parts=type.split(".");type=parts[0];if(events[type]){if(handler)delete events[type][handler.guid];else
for(handler in events[type])if(!parts[1]||events[type][handler].type==parts[1])delete events[type][handler];for(ret in events[type])break;if(!ret){if(!jQuery.event.special[type]||jQuery.event.special[type].teardown.call(elem)===false){if(elem.removeEventListener)elem.removeEventListener(type,jQuery.data(elem,"handle"),false);else if(elem.detachEvent)elem.detachEvent("on"+type,jQuery.data(elem,"handle"));}ret=null;delete events[type];}}});}for(ret in events)break;if(!ret){var handle=jQuery.data(elem,"handle");if(handle)handle.elem=null;jQuery.removeData(elem,"events");jQuery.removeData(elem,"handle");}}},trigger:function(type,data,elem,donative,extra){data=jQuery.makeArray(data);if(type.indexOf("!")>=0){type=type.slice(0,-1);var exclusive=true;}if(!elem){if(this.global[type])jQuery("*").add([window,document]).trigger(type,data);}else{if(elem.nodeType==3||elem.nodeType==8)return undefined;var val,ret,fn=jQuery.isFunction(elem[type]||null),event=!data[0]||!data[0].preventDefault;if(event){data.unshift({type:type,target:elem,preventDefault:function(){},stopPropagation:function(){},timeStamp:now()});data[0][expando]=true;}data[0].type=type;if(exclusive)data[0].exclusive=true;var handle=jQuery.data(elem,"handle");if(handle)val=handle.apply(elem,data);if((!fn||(jQuery.nodeName(elem,'a')&&type=="click"))&&elem["on"+type]&&elem["on"+type].apply(elem,data)===false)val=false;if(event)data.shift();if(extra&&jQuery.isFunction(extra)){ret=extra.apply(elem,val==null?data:data.concat(val));if(ret!==undefined)val=ret;}if(fn&&donative!==false&&val!==false&&!(jQuery.nodeName(elem,'a')&&type=="click")){this.triggered=true;try{elem[type]();}catch(e){}}this.triggered=false;}return val;},handle:function(event){var val,ret,namespace,all,handlers;event=arguments[0]=jQuery.event.fix(event||window.event);namespace=event.type.split(".");event.type=namespace[0];namespace=namespace[1];all=!namespace&&!event.exclusive;handlers=(jQuery.data(this,"events")||{})[event.type];for(var j in handlers){var handler=handlers[j];if(all||handler.type==namespace){event.handler=handler;event.data=handler.data;ret=handler.apply(this,arguments);if(val!==false)val=ret;if(ret===false){event.preventDefault();event.stopPropagation();}}}return val;},fix:function(event){if(event[expando]==true)return event;var originalEvent=event;event={originalEvent:originalEvent};var props="altKey attrChange attrName bubbles button cancelable charCode clientX clientY ctrlKey currentTarget data detail eventPhase fromElement handler keyCode metaKey newValue originalTarget pageX pageY prevValue relatedNode relatedTarget screenX screenY shiftKey srcElement target timeStamp toElement type view wheelDelta which".split(" ");for(var i=props.length;i;i--)event[props[i]]=originalEvent[props[i]];event[expando]=true;event.preventDefault=function(){if(originalEvent.preventDefault)originalEvent.preventDefault();originalEvent.returnValue=false;};event.stopPropagation=function(){if(originalEvent.stopPropagation)originalEvent.stopPropagation();originalEvent.cancelBubble=true;};event.timeStamp=event.timeStamp||now();if(!event.target)event.target=event.srcElement||document;if(event.target.nodeType==3)event.target=event.target.parentNode;if(!event.relatedTarget&&event.fromElement)event.relatedTarget=event.fromElement==event.target?event.toElement:event.fromElement;if(event.pageX==null&&event.clientX!=null){var doc=document.documentElement,body=document.body;event.pageX=event.clientX+(doc&&doc.scrollLeft||body&&body.scrollLeft||0)-(doc.clientLeft||0);event.pageY=event.clientY+(doc&&doc.scrollTop||body&&body.scrollTop||0)-(doc.clientTop||0);}if(!event.which&&((event.charCode||event.charCode===0)?event.charCode:event.keyCode))event.which=event.charCode||event.keyCode;if(!event.metaKey&&event.ctrlKey)event.metaKey=event.ctrlKey;if(!event.which&&event.button)event.which=(event.button&1?1:(event.button&2?3:(event.button&4?2:0)));return event;},proxy:function(fn,proxy){proxy.guid=fn.guid=fn.guid||proxy.guid||this.guid++;return proxy;},special:{ready:{setup:function(){bindReady();return;},teardown:function(){return;}},mouseenter:{setup:function(){if(jQuery.browser.msie)return false;jQuery(this).bind("mouseover",jQuery.event.special.mouseenter.handler);return true;},teardown:function(){if(jQuery.browser.msie)return false;jQuery(this).unbind("mouseover",jQuery.event.special.mouseenter.handler);return true;},handler:function(event){if(withinElement(event,this))return true;event.type="mouseenter";return jQuery.event.handle.apply(this,arguments);}},mouseleave:{setup:function(){if(jQuery.browser.msie)return false;jQuery(this).bind("mouseout",jQuery.event.special.mouseleave.handler);return true;},teardown:function(){if(jQuery.browser.msie)return false;jQuery(this).unbind("mouseout",jQuery.event.special.mouseleave.handler);return true;},handler:function(event){if(withinElement(event,this))return true;event.type="mouseleave";return jQuery.event.handle.apply(this,arguments);}}}};jQuery.fn.extend({bind:function(type,data,fn){return type=="unload"?this.one(type,data,fn):this.each(function(){jQuery.event.add(this,type,fn||data,fn&&data);});},one:function(type,data,fn){var one=jQuery.event.proxy(fn||data,function(event){jQuery(this).unbind(event,one);return(fn||data).apply(this,arguments);});return this.each(function(){jQuery.event.add(this,type,one,fn&&data);});},unbind:function(type,fn){return this.each(function(){jQuery.event.remove(this,type,fn);});},trigger:function(type,data,fn){return this.each(function(){jQuery.event.trigger(type,data,this,true,fn);});},triggerHandler:function(type,data,fn){return this[0]&&jQuery.event.trigger(type,data,this[0],false,fn);},toggle:function(fn){var args=arguments,i=1;while(i<args.length)jQuery.event.proxy(fn,args[i++]);return this.click(jQuery.event.proxy(fn,function(event){this.lastToggle=(this.lastToggle||0)%i;event.preventDefault();return args[this.lastToggle++].apply(this,arguments)||false;}));},hover:function(fnOver,fnOut){return this.bind('mouseenter',fnOver).bind('mouseleave',fnOut);},ready:function(fn){bindReady();if(jQuery.isReady)fn.call(document,jQuery);else
jQuery.readyList.push(function(){return fn.call(this,jQuery);});return this;}});jQuery.extend({isReady:false,readyList:[],ready:function(){if(!jQuery.isReady){jQuery.isReady=true;if(jQuery.readyList){jQuery.each(jQuery.readyList,function(){this.call(document);});jQuery.readyList=null;}jQuery(document).triggerHandler("ready");}}});var readyBound=false;function bindReady(){if(readyBound)return;readyBound=true;if(document.addEventListener&&!jQuery.browser.opera)document.addEventListener("DOMContentLoaded",jQuery.ready,false);if(jQuery.browser.msie&&window==top)(function(){if(jQuery.isReady)return;try{document.documentElement.doScroll("left");}catch(error){setTimeout(arguments.callee,0);return;}jQuery.ready();})();if(jQuery.browser.opera)document.addEventListener("DOMContentLoaded",function(){if(jQuery.isReady)return;for(var i=0;i<document.styleSheets.length;i++)if(document.styleSheets[i].disabled){setTimeout(arguments.callee,0);return;}jQuery.ready();},false);if(jQuery.browser.safari){var numStyles;(function(){if(jQuery.isReady)return;if(document.readyState!="loaded"&&document.readyState!="complete"){setTimeout(arguments.callee,0);return;}if(numStyles===undefined)numStyles=jQuery("style, link[rel=stylesheet]").length;if(document.styleSheets.length!=numStyles){setTimeout(arguments.callee,0);return;}jQuery.ready();})();}jQuery.event.add(window,"load",jQuery.ready);}jQuery.each(("blur,focus,load,resize,scroll,unload,click,dblclick,"+"mousedown,mouseup,mousemove,mouseover,mouseout,change,select,"+"submit,keydown,keypress,keyup,error").split(","),function(i,name){jQuery.fn[name]=function(fn){return fn?this.bind(name,fn):this.trigger(name);};});var withinElement=function(event,elem){var parent=event.relatedTarget;while(parent&&parent!=elem)try{parent=parent.parentNode;}catch(error){parent=elem;}return parent==elem;};jQuery(window).bind("unload",function(){jQuery("*").add(document).unbind();});jQuery.fn.extend({_load:jQuery.fn.load,load:function(url,params,callback){if(typeof url!='string')return this._load(url);var off=url.indexOf(" ");if(off>=0){var selector=url.slice(off,url.length);url=url.slice(0,off);}callback=callback||function(){};var type="GET";if(params)if(jQuery.isFunction(params)){callback=params;params=null;}else{params=jQuery.param(params);type="POST";}var self=this;jQuery.ajax({url:url,type:type,dataType:"html",data:params,complete:function(res,status){if(status=="success"||status=="notmodified")self.html(selector?jQuery("<div/>").append(res.responseText.replace(/<script(.|\s)*?\/script>/g,"")).find(selector):res.responseText);self.each(callback,[res.responseText,status,res]);}});return this;},serialize:function(){return jQuery.param(this.serializeArray());},serializeArray:function(){return this.map(function(){return jQuery.nodeName(this,"form")?jQuery.makeArray(this.elements):this;}).filter(function(){return this.name&&!this.disabled&&(this.checked||/select|textarea/i.test(this.nodeName)||/text|hidden|password/i.test(this.type));}).map(function(i,elem){var val=jQuery(this).val();return val==null?null:val.constructor==Array?jQuery.map(val,function(val,i){return{name:elem.name,value:val};}):{name:elem.name,value:val};}).get();}});jQuery.each("ajaxStart,ajaxStop,ajaxComplete,ajaxError,ajaxSuccess,ajaxSend".split(","),function(i,o){jQuery.fn[o]=function(f){return this.bind(o,f);};});var jsc=now();jQuery.extend({get:function(url,data,callback,type){if(jQuery.isFunction(data)){callback=data;data=null;}return jQuery.ajax({type:"GET",url:url,data:data,success:callback,dataType:type});},getScript:function(url,callback){return jQuery.get(url,null,callback,"script");},getJSON:function(url,data,callback){return jQuery.get(url,data,callback,"json");},post:function(url,data,callback,type){if(jQuery.isFunction(data)){callback=data;data={};}return jQuery.ajax({type:"POST",url:url,data:data,success:callback,dataType:type});},ajaxSetup:function(settings){jQuery.extend(jQuery.ajaxSettings,settings);},ajaxSettings:{url:location.href,global:true,type:"GET",timeout:0,contentType:"application/x-www-form-urlencoded",processData:true,async:true,data:null,username:null,password:null,accepts:{xml:"application/xml, text/xml",html:"text/html",script:"text/javascript, application/javascript",json:"application/json, text/javascript",text:"text/plain",_default:"*/*"}},lastModified:{},ajax:function(s){s=jQuery.extend(true,s,jQuery.extend(true,{},jQuery.ajaxSettings,s));var jsonp,jsre=/=\?(&|$)/g,status,data,type=s.type.toUpperCase();if(s.data&&s.processData&&typeof s.data!="string")s.data=jQuery.param(s.data);if(s.dataType=="jsonp"){if(type=="GET"){if(!s.url.match(jsre))s.url+=(s.url.match(/\?/)?"&":"?")+(s.jsonp||"callback")+"=?";}else if(!s.data||!s.data.match(jsre))s.data=(s.data?s.data+"&":"")+(s.jsonp||"callback")+"=?";s.dataType="json";}if(s.dataType=="json"&&(s.data&&s.data.match(jsre)||s.url.match(jsre))){jsonp="jsonp"+jsc++;if(s.data)s.data=(s.data+"").replace(jsre,"="+jsonp+"$1");s.url=s.url.replace(jsre,"="+jsonp+"$1");s.dataType="script";window[jsonp]=function(tmp){data=tmp;success();complete();window[jsonp]=undefined;try{delete window[jsonp];}catch(e){}if(head)head.removeChild(script);};}if(s.dataType=="script"&&s.cache==null)s.cache=false;if(s.cache===false&&type=="GET"){var ts=now();var ret=s.url.replace(/(\?|&)_=.*?(&|$)/,"$1_="+ts+"$2");s.url=ret+((ret==s.url)?(s.url.match(/\?/)?"&":"?")+"_="+ts:"");}if(s.data&&type=="GET"){s.url+=(s.url.match(/\?/)?"&":"?")+s.data;s.data=null;}if(s.global&&!jQuery.active++)jQuery.event.trigger("ajaxStart");var remote=/^(?:\w+:)?\/\/([^\/?#]+)/;if(s.dataType=="script"&&type=="GET"&&remote.test(s.url)&&remote.exec(s.url)[1]!=location.host){var head=document.getElementsByTagName("head")[0];var script=document.createElement("script");script.src=s.url;if(s.scriptCharset)script.charset=s.scriptCharset;if(!jsonp){var done=false;script.onload=script.onreadystatechange=function(){if(!done&&(!this.readyState||this.readyState=="loaded"||this.readyState=="complete")){done=true;success();complete();head.removeChild(script);}};}head.appendChild(script);return undefined;}var requestDone=false;var xhr=window.ActiveXObject?new ActiveXObject("Microsoft.XMLHTTP"):new XMLHttpRequest();if(s.username)xhr.open(type,s.url,s.async,s.username,s.password);else
xhr.open(type,s.url,s.async);try{if(s.data)xhr.setRequestHeader("Content-Type",s.contentType);if(s.ifModified)xhr.setRequestHeader("If-Modified-Since",jQuery.lastModified[s.url]||"Thu, 01 Jan 1970 00:00:00 GMT");xhr.setRequestHeader("X-Requested-With","XMLHttpRequest");xhr.setRequestHeader("Accept",s.dataType&&s.accepts[s.dataType]?s.accepts[s.dataType]+", */*":s.accepts._default);}catch(e){}if(s.beforeSend&&s.beforeSend(xhr,s)===false){s.global&&jQuery.active--;xhr.abort();return false;}if(s.global)jQuery.event.trigger("ajaxSend",[xhr,s]);var onreadystatechange=function(isTimeout){if(!requestDone&&xhr&&(xhr.readyState==4||isTimeout=="timeout")){requestDone=true;if(ival){clearInterval(ival);ival=null;}status=isTimeout=="timeout"&&"timeout"||!jQuery.httpSuccess(xhr)&&"error"||s.ifModified&&jQuery.httpNotModified(xhr,s.url)&&"notmodified"||"success";if(status=="success"){try{data=jQuery.httpData(xhr,s.dataType,s.dataFilter);}catch(e){status="parsererror";}}if(status=="success"){var modRes;try{modRes=xhr.getResponseHeader("Last-Modified");}catch(e){}if(s.ifModified&&modRes)jQuery.lastModified[s.url]=modRes;if(!jsonp)success();}else
jQuery.handleError(s,xhr,status);complete();if(s.async)xhr=null;}};if(s.async){var ival=setInterval(onreadystatechange,13);if(s.timeout>0)setTimeout(function(){if(xhr){xhr.abort();if(!requestDone)onreadystatechange("timeout");}},s.timeout);}try{xhr.send(s.data);}catch(e){jQuery.handleError(s,xhr,null,e);}if(!s.async)onreadystatechange();function success(){if(s.success)s.success(data,status);if(s.global)jQuery.event.trigger("ajaxSuccess",[xhr,s]);}function complete(){if(s.complete)s.complete(xhr,status);if(s.global)jQuery.event.trigger("ajaxComplete",[xhr,s]);if(s.global&&!--jQuery.active)jQuery.event.trigger("ajaxStop");}return xhr;},handleError:function(s,xhr,status,e){if(s.error)s.error(xhr,status,e);if(s.global)jQuery.event.trigger("ajaxError",[xhr,s,e]);},active:0,httpSuccess:function(xhr){try{return!xhr.status&&location.protocol=="file:"||(xhr.status>=200&&xhr.status<300)||xhr.status==304||xhr.status==1223||jQuery.browser.safari&&xhr.status==undefined;}catch(e){}return false;},httpNotModified:function(xhr,url){try{var xhrRes=xhr.getResponseHeader("Last-Modified");return xhr.status==304||xhrRes==jQuery.lastModified[url]||jQuery.browser.safari&&xhr.status==undefined;}catch(e){}return false;},httpData:function(xhr,type,filter){var ct=xhr.getResponseHeader("content-type"),xml=type=="xml"||!type&&ct&&ct.indexOf("xml")>=0,data=xml?xhr.responseXML:xhr.responseText;if(xml&&data.documentElement.tagName=="parsererror")throw"parsererror";if(filter)data=filter(data,type);if(type=="script")jQuery.globalEval(data);if(type=="json")data=eval("("+data+")");return data;},param:function(a){var s=[];if(a.constructor==Array||a.jquery)jQuery.each(a,function(){s.push(encodeURIComponent(this.name)+"="+encodeURIComponent(this.value));});else
for(var j in a)if(a[j]&&a[j].constructor==Array)jQuery.each(a[j],function(){s.push(encodeURIComponent(j)+"="+encodeURIComponent(this));});else
s.push(encodeURIComponent(j)+"="+encodeURIComponent(jQuery.isFunction(a[j])?a[j]():a[j]));return s.join("&").replace(/%20/g,"+");}});jQuery.fn.extend({show:function(speed,callback){return speed?this.animate({height:"show",width:"show",opacity:"show"},speed,callback):this.filter(":hidden").each(function(){this.style.display=this.oldblock||"";if(jQuery.css(this,"display")=="none"){var elem=jQuery("<"+this.tagName+" />").appendTo("body");this.style.display=elem.css("display");if(this.style.display=="none")this.style.display="block";elem.remove();}}).end();},hide:function(speed,callback){return speed?this.animate({height:"hide",width:"hide",opacity:"hide"},speed,callback):this.filter(":visible").each(function(){this.oldblock=this.oldblock||jQuery.css(this,"display");this.style.display="none";}).end();},_toggle:jQuery.fn.toggle,toggle:function(fn,fn2){return jQuery.isFunction(fn)&&jQuery.isFunction(fn2)?this._toggle.apply(this,arguments):fn?this.animate({height:"toggle",width:"toggle",opacity:"toggle"},fn,fn2):this.each(function(){jQuery(this)[jQuery(this).is(":hidden")?"show":"hide"]();});},slideDown:function(speed,callback){return this.animate({height:"show"},speed,callback);},slideUp:function(speed,callback){return this.animate({height:"hide"},speed,callback);},slideToggle:function(speed,callback){return this.animate({height:"toggle"},speed,callback);},fadeIn:function(speed,callback){return this.animate({opacity:"show"},speed,callback);},fadeOut:function(speed,callback){return this.animate({opacity:"hide"},speed,callback);},fadeTo:function(speed,to,callback){return this.animate({opacity:to},speed,callback);},animate:function(prop,speed,easing,callback){var optall=jQuery.speed(speed,easing,callback);return this[optall.queue===false?"each":"queue"](function(){if(this.nodeType!=1)return false;var opt=jQuery.extend({},optall),p,hidden=jQuery(this).is(":hidden"),self=this;for(p in prop){if(prop[p]=="hide"&&hidden||prop[p]=="show"&&!hidden)return opt.complete.call(this);if(p=="height"||p=="width"){opt.display=jQuery.css(this,"display");opt.overflow=this.style.overflow;}}if(opt.overflow!=null)this.style.overflow="hidden";opt.curAnim=jQuery.extend({},prop);jQuery.each(prop,function(name,val){var e=new jQuery.fx(self,opt,name);if(/toggle|show|hide/.test(val))e[val=="toggle"?hidden?"show":"hide":val](prop);else{var parts=val.toString().match(/^([+-]=)?([\d+-.]+)(.*)$/),start=e.cur(true)||0;if(parts){var end=parseFloat(parts[2]),unit=parts[3]||"px";if(unit!="px"){self.style[name]=(end||1)+unit;start=((end||1)/e.cur(true))*start;self.style[name]=start+unit;}if(parts[1])end=((parts[1]=="-="?-1:1)*end)+start;e.custom(start,end,unit);}else
e.custom(start,val,"");}});return true;});},queue:function(type,fn){if(jQuery.isFunction(type)||(type&&type.constructor==Array)){fn=type;type="fx";}if(!type||(typeof type=="string"&&!fn))return queue(this[0],type);return this.each(function(){if(fn.constructor==Array)queue(this,type,fn);else{queue(this,type).push(fn);if(queue(this,type).length==1)fn.call(this);}});},stop:function(clearQueue,gotoEnd){var timers=jQuery.timers;if(clearQueue)this.queue([]);this.each(function(){for(var i=timers.length-1;i>=0;i--)if(timers[i].elem==this){if(gotoEnd)timers[i](true);timers.splice(i,1);}});if(!gotoEnd)this.dequeue();return this;}});var queue=function(elem,type,array){if(elem){type=type||"fx";var q=jQuery.data(elem,type+"queue");if(!q||array)q=jQuery.data(elem,type+"queue",jQuery.makeArray(array));}return q;};jQuery.fn.dequeue=function(type){type=type||"fx";return this.each(function(){var q=queue(this,type);q.shift();if(q.length)q[0].call(this);});};jQuery.extend({speed:function(speed,easing,fn){var opt=speed&&speed.constructor==Object?speed:{complete:fn||!fn&&easing||jQuery.isFunction(speed)&&speed,duration:speed,easing:fn&&easing||easing&&easing.constructor!=Function&&easing};opt.duration=(opt.duration&&opt.duration.constructor==Number?opt.duration:jQuery.fx.speeds[opt.duration])||jQuery.fx.speeds.def;opt.old=opt.complete;opt.complete=function(){if(opt.queue!==false)jQuery(this).dequeue();if(jQuery.isFunction(opt.old))opt.old.call(this);};return opt;},easing:{linear:function(p,n,firstNum,diff){return firstNum+diff*p;},swing:function(p,n,firstNum,diff){return((-Math.cos(p*Math.PI)/2)+0.5)*diff+firstNum;}},timers:[],timerId:null,fx:function(elem,options,prop){this.options=options;this.elem=elem;this.prop=prop;if(!options.orig)options.orig={};}});jQuery.fx.prototype={update:function(){if(this.options.step)this.options.step.call(this.elem,this.now,this);(jQuery.fx.step[this.prop]||jQuery.fx.step._default)(this);if(this.prop=="height"||this.prop=="width")this.elem.style.display="block";},cur:function(force){if(this.elem[this.prop]!=null&&this.elem.style[this.prop]==null)return this.elem[this.prop];var r=parseFloat(jQuery.css(this.elem,this.prop,force));return r&&r>-10000?r:parseFloat(jQuery.curCSS(this.elem,this.prop))||0;},custom:function(from,to,unit){this.startTime=now();this.start=from;this.end=to;this.unit=unit||this.unit||"px";this.now=this.start;this.pos=this.state=0;this.update();var self=this;function t(gotoEnd){return self.step(gotoEnd);}t.elem=this.elem;jQuery.timers.push(t);if(jQuery.timerId==null){jQuery.timerId=setInterval(function(){var timers=jQuery.timers;for(var i=0;i<timers.length;i++)if(!timers[i]())timers.splice(i--,1);if(!timers.length){clearInterval(jQuery.timerId);jQuery.timerId=null;}},13);}},show:function(){this.options.orig[this.prop]=jQuery.attr(this.elem.style,this.prop);this.options.show=true;this.custom(0,this.cur());if(this.prop=="width"||this.prop=="height")this.elem.style[this.prop]="1px";jQuery(this.elem).show();},hide:function(){this.options.orig[this.prop]=jQuery.attr(this.elem.style,this.prop);this.options.hide=true;this.custom(this.cur(),0);},step:function(gotoEnd){var t=now();if(gotoEnd||t>this.options.duration+this.startTime){this.now=this.end;this.pos=this.state=1;this.update();this.options.curAnim[this.prop]=true;var done=true;for(var i in this.options.curAnim)if(this.options.curAnim[i]!==true)done=false;if(done){if(this.options.display!=null){this.elem.style.overflow=this.options.overflow;this.elem.style.display=this.options.display;if(jQuery.css(this.elem,"display")=="none")this.elem.style.display="block";}if(this.options.hide)this.elem.style.display="none";if(this.options.hide||this.options.show)for(var p in this.options.curAnim)jQuery.attr(this.elem.style,p,this.options.orig[p]);}if(done)this.options.complete.call(this.elem);return false;}else{var n=t-this.startTime;this.state=n/this.options.duration;this.pos=jQuery.easing[this.options.easing||(jQuery.easing.swing?"swing":"linear")](this.state,n,0,1,this.options.duration);this.now=this.start+((this.end-this.start)*this.pos);this.update();}return true;}};jQuery.extend(jQuery.fx,{speeds:{slow:600,fast:200,def:400},step:{scrollLeft:function(fx){fx.elem.scrollLeft=fx.now;},scrollTop:function(fx){fx.elem.scrollTop=fx.now;},opacity:function(fx){jQuery.attr(fx.elem.style,"opacity",fx.now);},_default:function(fx){fx.elem.style[fx.prop]=fx.now+fx.unit;}}});jQuery.fn.offset=function(){var left=0,top=0,elem=this[0],results;if(elem)with(jQuery.browser){var parent=elem.parentNode,offsetChild=elem,offsetParent=elem.offsetParent,doc=elem.ownerDocument,safari2=safari&&parseInt(version)<522&&!/adobeair/i.test(userAgent),css=jQuery.curCSS,fixed=css(elem,"position")=="fixed";if(elem.getBoundingClientRect){var box=elem.getBoundingClientRect();add(box.left+Math.max(doc.documentElement.scrollLeft,doc.body.scrollLeft),box.top+Math.max(doc.documentElement.scrollTop,doc.body.scrollTop));add(-doc.documentElement.clientLeft,-doc.documentElement.clientTop);}else{add(elem.offsetLeft,elem.offsetTop);while(offsetParent){add(offsetParent.offsetLeft,offsetParent.offsetTop);if(mozilla&&!/^t(able|d|h)$/i.test(offsetParent.tagName)||safari&&!safari2)border(offsetParent);if(!fixed&&css(offsetParent,"position")=="fixed")fixed=true;offsetChild=/^body$/i.test(offsetParent.tagName)?offsetChild:offsetParent;offsetParent=offsetParent.offsetParent;}while(parent&&parent.tagName&&!/^body|html$/i.test(parent.tagName)){if(!/^inline|table.*$/i.test(css(parent,"display")))add(-parent.scrollLeft,-parent.scrollTop);if(mozilla&&css(parent,"overflow")!="visible")border(parent);parent=parent.parentNode;}if((safari2&&(fixed||css(offsetChild,"position")=="absolute"))||(mozilla&&css(offsetChild,"position")!="absolute"))add(-doc.body.offsetLeft,-doc.body.offsetTop);if(fixed)add(Math.max(doc.documentElement.scrollLeft,doc.body.scrollLeft),Math.max(doc.documentElement.scrollTop,doc.body.scrollTop));}results={top:top,left:left};}function border(elem){add(jQuery.curCSS(elem,"borderLeftWidth",true),jQuery.curCSS(elem,"borderTopWidth",true));}function add(l,t){left+=parseInt(l,10)||0;top+=parseInt(t,10)||0;}return results;};jQuery.fn.extend({position:function(){var left=0,top=0,results;if(this[0]){var offsetParent=this.offsetParent(),offset=this.offset(),parentOffset=/^body|html$/i.test(offsetParent[0].tagName)?{top:0,left:0}:offsetParent.offset();offset.top-=num(this,'marginTop');offset.left-=num(this,'marginLeft');parentOffset.top+=num(offsetParent,'borderTopWidth');parentOffset.left+=num(offsetParent,'borderLeftWidth');results={top:offset.top-parentOffset.top,left:offset.left-parentOffset.left};}return results;},offsetParent:function(){var offsetParent=this[0].offsetParent;while(offsetParent&&(!/^body|html$/i.test(offsetParent.tagName)&&jQuery.css(offsetParent,'position')=='static'))offsetParent=offsetParent.offsetParent;return jQuery(offsetParent);}});jQuery.each(['Left','Top'],function(i,name){var method='scroll'+name;jQuery.fn[method]=function(val){if(!this[0])return;return val!=undefined?this.each(function(){this==window||this==document?window.scrollTo(!i?val:jQuery(window).scrollLeft(),i?val:jQuery(window).scrollTop()):this[method]=val;}):this[0]==window||this[0]==document?self[i?'pageYOffset':'pageXOffset']||jQuery.boxModel&&document.documentElement[method]||document.body[method]:this[0][method];};});jQuery.each(["Height","Width"],function(i,name){var tl=i?"Left":"Top",br=i?"Right":"Bottom";jQuery.fn["inner"+name]=function(){return this[name.toLowerCase()]()+num(this,"padding"+tl)+num(this,"padding"+br);};jQuery.fn["outer"+name]=function(margin){return this["inner"+name]()+num(this,"border"+tl+"Width")+num(this,"border"+br+"Width")+(margin?num(this,"margin"+tl)+num(this,"margin"+br):0);};});})();/**
 * $Id: jquery.i18n.js 481 2008-10-20 15:40:41Z spocke $
 *
 * @author Moxiecode
 * @copyright Copyright � 2004-2008, Moxiecode Systems AB, All rights reserved.
 */

(function($) {
	function xmlEncode(s) {
		return s ? ('' + s).replace(new RegExp('[<>&"\']', 'g'), function (c, b) {
			switch (c) {
				case '&':
					return '&amp;';

				case '"':
					return '&quot;';

				case '\'':
					return '&#39;'; // &apos; is not working in MSIE

				case '<':
					return '&lt;';

				case '>':
					return '&gt;';
			}

			return c;
		}) : s;
	};

	$.translate = function(s, e, va) {
		return s.replace(/\{#([^\}]+)\}/g, function(a, b) {
			var pa = b.split(/\./);

			if (MCManagerI18n[pa[0]])
				a = MCManagerI18n[pa[0]][pa[1]];

			a = a ? a : '{#' + b + '}';

			if (va) {
				a = a.replace(/\{([^\}]+)\}/g, function(a, b) {
					return va[b] || a;
				});
			}

			return e ? xmlEncode(a) : a;
		});
	};

	$.translateElement = function(e) {
		e = e || document.body;
		e.innerHTML = $.translate(e.innerHTML.replace(/=({#[a-z0-9_]+})/gi, '="$1"'), 1);
	};

	document.title = $.translate(document.title.replace(/^(http|https):\/\/[a-z0-9._\-\s]+-/gi, ''));

	$('body > *').each(function(i, v) {
		if (!/(SCRIPT|BR|HR|INPUT|META|IMG|LINK|PARAM|IFRAME)/.test(v.nodeName))
			$.translateElement(v);
	});
})(jQuery);/**
 * $Id: jquery.sortarray.js 453 2008-10-14 12:24:41Z spocke $
 *
 * @author Moxiecode
 * @copyright Copyright � 2004-2008, Moxiecode Systems AB, All rights reserved.
 */

(function($) {
	$.fn.sortArray = function(by, desc) {
		var data = $.makeArray(this);

		function numSort(a, b) {
			a = parseFloat(a[by]);
			b = parseFloat(b[by]);

			a = isNaN(a) ? 0 : a;
			b = isNaN(b) ? 0 : b;

			return desc ? b - a : a - b;
		};

		function strSort(a, b) {
			try {
				a = '' + a[by].toLowerCase();
				b = '' + b[by].toLowerCase();

				if (a == b)
					return 0;

				if (desc ? a > b : a < b)
					return -1;
			} catch (ex) {
				// Ignore
			}

			return 1;
		};

		if (data.length)
			data = data.sort(typeof(data[0][by]) == 'number' ? numSort : strSort);

		return data;
	};

})(jQuery);/**
 * Copyright 2004-2009, Moxiecode Systems AB, All rights reserved.
 */

(function($) {
	$.Window = function(f, a) {
		var t = this;

		t.features = f;
		t.args = a;
		t.isIE6 = /MSIE [56]/.test(navigator.userAgent);

		// Register actions
		t.clickActions = {
			min : t.minimize,
			max : t.maximize,
			med : t.medimize,
			close : t.close
		};

		t.mouseDownActions = {
			move : t.startDrag,
			'resize-n' : t.startDrag,
			'resize-nw' : t.startDrag,
			'resize-w' : t.startDrag,
			'resize-e' : t.startDrag,
			'resize-s' : t.startDrag,
			'resize-sw' : t.startDrag,
			'resize-se' : t.startDrag
		};
	};

	$.extend($.Window.prototype, {
		getArgs : function() {
			return this.args;
		},

		focus : function() {
			var t = this, id = t.id;

			if (!t.focused) {
				if (t.shim)
					t.shim.css('z-index', $.WindowManager.zIndex);

				$('#' + id).css('z-index', t.zIndex = $.WindowManager.zIndex++);
				$('#' + id + '_container').addClass('focus');
				$('#' + id + '_top').addClass('focustop');
				$('#' + id + '_middle').addClass('focusmiddle');
				$('#' + id + '_bottom').addClass('focusbottom');

				$($.WindowManager.windows).each(function() {
					if (this != t)
						this.blur();
				});

				t.focused = 1;
			}

			return this;
		},

		blur : function() {
			var t = this, id = t.id;

			if (t.focused) {
				$('#' + id + '_container').removeClass('focus');
				$('#' + id + '_top').removeClass('focustop');
				$('#' + id + '_middle').removeClass('focusmiddle');
				$('#' + id + '_bottom').removeClass('focusbottom');

				t.focused = 0;
			}

			return t;
		},

		setTitle : function(ti) {
			this.features.title = ti;
			$('#' + this.id + '_title').html(ti);

			return this;
		},

		setStatus : function(st) {
			$('#' + this.id + '_statustext').html(st);

			return this;
		},

		minimize : function() {
			return this;
		},

		medimize : function() {
			var t = this, sp = $.scrollPos(), r;

			if (r = t.lastRect) {
				$('#' + t.id + '_max').removeClass('med').addClass('max');
				t.moveTo(r.x, r.y);
				t.resizeTo(r.w, r.h);
				t.lastRect = 0;
			}

			return t;
		},

		maximize : function() {
			var t = this, sp = $.scrollPos();

			if (!t.lastRect) {
				t.lastRect = {x : t.x, y : t.y, w : t.width, h : t.height};

				$('#' + t.id + '_max').removeClass('max').addClass('med');
				t.moveTo(sp.x, sp.y);
				t.resizeTo($.winWidth(), $.winHeight(), 1);
			}

			return t;
		},

		close : function(ac) {
			var t = this, f;

			if (ac && (f = t.features.onbeforeclose)) {
				if (f.call(t) === false)
					return;
			}

			$('#' + t.id).remove();

			if ($.WindowManager.windows.length == 1)
				$('#windowManEventBlocker').remove();

			$.WindowManager.remove(t);

			if (t.shim) {
				t.shim.remove();
				t.shim = 0;
			}

			if (t.features.onclose)
				t.features.onclose(t);
		},

		moveTo : function(x, y) {
			var t = this, el = $('#' + t.id);

			if (t.x != x) {
				el.css({left : x});
				t.x = x;
			}

			if (t.y != y) {
				el.css({top : y});
				t.y = y;
			}

			if (t.shim)
				t.shim.css({left : x, top : y});

			return t;
		},

		moveBy : function(dx, dy) {
			return this.moveTo(this.x + parseInt(dx), this.y + parseInt(dy));
		},

		resizeTo : function(w, h, nr) {
			var t = this, b = t.borders, el = $('#' + t.id), ifr = $('#' + t.id + '_content, #' + t.id + '_ifr');

			w = parseInt(w);
			h = parseInt(h);

			if (!nr && t.lastRect) {
				$('#' + t.id + '_max').removeClass('med').addClass('max');
				t.lastRect = 0;
			}

			if (t.width != w) {
				ifr.css({width : w - b.w});
				el.css({width : w});
				t.width = w;
			}

			if (t.height != h) {
				ifr.css({height : h - b.h});
				el.css({height : h});
				$('#' + t.id + '_middle').css('height', h - b.h);
				t.height = h;
			}

			if (t.shim)
				t.shim.css({width : w, height : h});

			return t;
		},

		resizeBy : function(dw, dh) {
			return this.resizeTo(this.width + parseInt(dw), this.height + parseInt(dh));
		},

		show : function() {
			var t = this, id = t.id, bw, bh;

			$('#' + id).show();

			// Calculate borders
			bw = $('#' + id + '_middle div.left')[0].clientWidth;
			bw += $('#' + id + '_middle div.right')[0].clientWidth;
			bh = $('#' + id + '_top')[0].clientHeight;
			bh += $('#' + id + '_bottom')[0].clientHeight;

			t.borders = {w : bw, h : bh - 1};

			if (t.shim)
				t.shim.show();

			return t;
		},

		hide : function() {
			var t = this;

			$('#' + t.id).hide();
			
			if (t.shim)
				t.shim.hide();

			return t;
		},

		setContent : function(h) {
			$('#' + this.id + '_content').html(h);

			return this;
		},

		setURL : function(u) {
			var t = this, id = t.id, ifr = $('#' + id + '_ifr'), b = t.borders;

			if (!ifr[0])
				$('#' + id + '_content').html('').append($.createElm('iframe', {id : id + '_ifr', src : u, frameBorder : '0', scrolling : t.features.scrolling}).css({width : t.width - b.w, height : t.height - b.h}));
			else
				ifr.attr('src', u);

			return t;
		},

		startMove : function(a, e) {
			var t = this, bid = t.features.theme + '_move', mb, sx = e.screenX, sy = e.screenY, dx, dy, wx, wy;

			$(document.body).append($.createElm('div', {id : bid, 'class' : t.features.theme + '_event_blocker'}).css('z-index', $.WindowManager.zIndex));
			mb = $('#' + bid).css({width : $.winWidth(), height : $.winHeight(), position : t.isIE6 ? 'absolute' : 'fixed'});
			wx = t.x;
			wy = t.y;

			mb.mousemove(function(e) {
				dx = e.screenX - sx;
				dy = e.screenY - sy;
				t.moveTo(wx + dx, wy + dy);
			});

			mb.mouseup(function(e) {
				mb.remove();
			});
		},

		startDrag : function(a, e) {
			var t = this, bid = t.features.theme + '_move', mb, sx = e.screenX, sy = e.screenY, dx, dy, wx, wy, w, h;

			$(document.body).append($.createElm('div', {id : bid, 'class' : t.features.theme + '_event_blocker'}).css('z-index', $.WindowManager.zIndex));
			mb = $('#' + bid).css({width : $.winWidth(), height : $.winHeight(), position : t.isIE6 ? 'absolute' : 'fixed'});
			wx = t.x;
			wy = t.y;
			w = t.width;
			h = t.height;

			mb.mousemove(function(e) {
				dx = e.screenX - sx;
				dy = e.screenY - sy;
				var x = wx + dx, y = wy + dy;

				switch (a) {
					case 'resize-n':
						t.moveTo(wx, y);
						t.resizeTo(w, h - dy);
					break;

					case 'resize-nw':
						t.moveTo(x, y);
						t.resizeTo(w - dx, h - dy);
					break;

					case 'resize-ne':
						t.moveTo(wx, y);
						t.resizeTo(w + dx, h - dy);
					break;

					case 'resize-w':
						t.moveTo(x, wy);
						t.resizeTo(w - dx, h);
					break;

					case 'resize-e':
						t.resizeTo(w + dx, h);
					break;

					case 'resize-s':
						t.resizeTo(w, h + dy);
					break;

					case 'resize-sw':
						t.moveTo(wx + dx, wy);
						t.resizeTo(w - dx, h + dy);
					break;

					case 'resize-se':
						t.resizeTo(w + dx, h + dy);
					break;

					case 'move':
						t.moveTo(wx + dx, wy + dy);
					break;
				}

				e.preventDefault();
				return false;
			});

			mb.mouseup(function(e) {
				mb.remove();
			});

			e.preventDefault();
			return false;
		},

		render : function() {
			var t = this, id = 'win_' + $.WindowManager.count++, f = t.features, mc = '', bl, v;

			t.features = f = $.extend({
				theme : 'clearlooks2',
				modal : 1,
				type : 'window',
				x : -1,
				y : -1,
				width : 320,
				height : 240,
				title : ' '
			}, f);

			// Center window
			if (f.x == -1)
				f.x = Math.round(($.winWidth() / 2) - (f.width / 2));

			if (f.y == -1)
				f.y = Math.round(($.winHeight() / 2) - (f.height / 2));

			t.id = id;

			if (f.modal) {
				bl = $('#windowManEventBlocker');
				if (!bl[0]) {
					$(document.body).append($.createElm('div', {id : 'windowManEventBlocker', 'class' : f.theme + '_event_blocker'}).addClass(f.theme + '_visible_event_blocker'));
					bl = $('#windowManEventBlocker');
				}

				bl.show().css('z-index', $.WindowManager.zIndex++).css({width : $.winWidth(), height : $.winHeight(), position : t.isIE6 ? 'absolute' : 'fixed'});
			}

			if (t.isIE6 && !t.shim) {
				$(document.body).append('<iframe id="' + id + '_shim" src="javascript:\'\'" frameborder="0" scrolling="no" style="position:absolute;left:0;top:0;filter:Alpha(style=0,opacity=0);"></iframe>');
				t.shim = $('#' + id + '_shim');
			}

			$(document.body).appendAll(
				['div', {id : id, 'class' : f.theme + ' window'},
					['div', {id : id + '_container', 'class' : 'statusbar ' + f.type},
						['div', {id : id + '_top', 'class' : 'windowtop'},
							['div', {'class' : 'left'}],
							['div', {'class' : 'middle'}],
							['div', {'class' : 'right'}],
							['div', {id : id + '_title', 'class' : 'title'}, f.title],

							['a', {id : id + '_min', href : '', 'class' : 'action min'}],
							['a', {id : id + '_max', href : '', 'class' : 'action max'}],
							['a', {id : id + '_close', href : '', 'class' : 'action close'}],
							['a', {id : id + '_move', 'class' : 'action move', tabindex : '-1'}],
							['a', {id : id + '_resize_n', 'class' : 'action resize resize-n', tabindex : '-1'}],
							['a', {id : id + '_resize_nw', 'class' : 'action resize resize-nw', tabindex : '-1'}],
							['a', {id : id + '_resize_ne', 'class' : 'action resize resize-ne', tabindex : '-1'}]
						],

						['div', {id : id + '_middle', 'class' : 'windowmiddle'},
							['div', {'class' : 'left'}],
							['div', {id : id + '_content', 'class' : 'middle'}, ' '],
							['div', {'class' : 'right'}],
							['div', {id : id + '_bigicon', 'class' : 'bigicon'}],

							['a', {id : id + '_resize_w', 'class' : 'action resize resize-w', tabindex : '-1'}],
							['a', {id : id + '_resize_e', 'class' : 'action resize resize-e', tabindex : '-1'}]
						],

						['div', {id : id + '_bottom', 'class' : 'windowbottom' + (f.statusbar ? ' statusbarbottom' : '')},
							['div', {'class' : 'left'}],
							['div', {'class' : 'middle'}],
							['div', {'class' : 'right'}],
							['div', {id : id + '_statustext', 'class' : 'statustext'}, ' '],

							['a', {id : id + '_resize_s', 'class' : 'action resize resize-s', tabindex : '-1'}],
							['a', {id : id + '_resize_sw', 'class' : 'action resize resize-sw', tabindex : '-1'}],
							['a', {id : id + '_resize_se', 'class' : 'action resize resize-se', tabindex : '-1'}]
						]
					]
				]
			);

			if (f.bigicon)
				$('#' + id + '_bigicon').addClass(f.bigicon);

			if (f.chromeless)
				$('#' + id + '_container').addClass('chromeless');

			if (f.resizable)
				$('#' + id + '_container').addClass('resizable');

			if (f.statusbar) {
				$('#' + id + '_container').addClass('statusbar');
				$('#' + id + '_bottom').addClass('statusbarbottom');
			}

			t.show().hide().resizeTo(f.width, f.height).moveTo(f.x, f.y).show();

			if (v = f.title)
				t.setTitle(v);

			if (v = f.content)
				t.setContent(v);

			if (v = f.url)
				t.setURL(v);

			function handleAction(e) {
				var el = $(e.target), action, f;

				t.focus();

				if (el[0].nodeName == 'A' && el.hasClass('action')) {
					action = $.grep(el[0].className.split(/\s+/), function(v) {return !/^action|resize$/.test(v);}).join(' ');

					if (e.type == 'mousedown')
						f = t.mouseDownActions[action];
					else {
						if (t.features.onaction) {
							t.features.onaction.call(t, action);
							return false;
						}

						f = t.clickActions[action];
					}

					if (f) {
						f.call(t, action, e);
						return false;
					}
				}
			};

			$('#' + id).click(handleAction).mousedown(handleAction);

			$($.WindowManager).trigger('WindowManager:open', [t]);

			return t;
		}
	});

	$.WindowManager = {
		zIndex : 100010,
		count : 0,
		windows : [],
		i18n : {
			yes : 'Yes',
			no : 'No',
			ok : 'Ok'
		},

		setup : function() {
			var w = window, lw, nwm, op, b;

			// Find root window manager
			while ((w = w.parent || w.opener) && w != lw) {
				if (w.$ && w.$.WindowManager)
					nwm = w.$.WindowManager;

				lw = w;
			}

			// Found parent window manager use that one and set the title for the dialog
			if (nwm && nwm != this) {
				$.CurrentWindowManager = $.WindowManager;
				b = document.location.pathname.replace(/[^\/]+$/, '');
				op = nwm.open;

				$.WindowManager = $.extend({}, nwm, {
					open : function(f, a) {
						// Is relative URL force it absolute
						if (!/^https?\:|\//.test(f.url))
							f.url = b + f.url;

						return op.call(nwm, f, a);
					}
				});

				nwm.find(window).setTitle(document.title);
			} else {
				$(window).bind('resize', function() {
					$($.WindowManager.windows).each(function(i, w) {
						if (w.lastRect)
							w.resizeTo($.winWidth(), $.winHeight(), 1);
					});
				});
			}

			// Find current window
			$.WindowManager.currentWindow = $.WindowManager.find(window);
		},

		find : function(tw) {
			var i, ifr, w;

			for (i = 0; i < this.windows.length; i++) {
				w = this.windows[i];
				ifr = $('#' + w.id + '_ifr')[0];

				if (ifr && ifr.contentWindow == tw)
					return w;
			}

			return this.defaultWin;
		},

		open : function(f, a) {
			var w = new $.Window(f, a).render();

			this.windows.push(w);

			return w.focus();
		},

		warn : function(msg, cb) {
			return this.modalBox(msg, {
				bigicon : 'warning'
			}, cb);
		},

		error : function(msg, cb) {
			return this.modalBox(msg, {
				bigicon : 'error'
			}, cb);
		},

		info : function(msg, cb) {
			return this.modalBox(msg, {
				bigicon : 'info'
			}, cb);
		},

		confirm : function(msg, cb) {
			return this.modalBox(msg, {
				type : 'confirm',
				bigicon : 'ask',
				onaction : function(a) {
					var t = this;

					if (a == 'ok') {
						t.close();

						if (cb)
							cb.call(t, 1);
					} else if (a == 'cancel' || a == 'close') {
						t.close();

						if (cb)
							cb.call(t, 0);
					}
				}
			}, cb).setContent(
				'<div class="message">' + msg +'</div>' +
				'<a href="" class="action ok">' + this.i18n.yes + '</a>' +
				'<a href="#" class="action cancel">' + this.i18n.no + '</a>'
			);
		},

		modalBox : function(msg, f, cb) {
			f = $.extend({
				type : 'alert',
				bigicon : 'error',
				width : 400,
				height : 130,
				onaction : function(a) {
					if (a == 'ok') {
						this.close();

						if (cb)
							cb.call(this, 1);
					} else if (a == 'close')
						this.close();
				}
			}, f);

			return this.open(f).setContent(
				'<div class="message">' + (msg || '') +'</div>' +
				'<a href="" class="action ok">' + this.i18n.ok + '</a>'
			);
		},

		remove : function(w) {
			var t = this, fr, z = 0, nl = [];

			// Find front most window
			$(t.windows).each(function(i, cw) {
				if (w == cw)
					return;

				if (cw.zIndex > z) {
					z = cw.zIndex;
					fr = cw;
				}

				nl.push(cw);
			});

			t.windows = nl;

			if (fr)
				fr.focus();
		}
	};

	$.WindowManager.setup();
})(jQuery);/**
 * Copyright 2004-2009, Moxiecode Systems AB, All rights reserved.
 */

(function($) {
	$.StatusWindow = function(f, a) {
		var t = this;

		t.isIE6 = /MSIE [56]/.test(navigator.userAgent);

		f = $.extend({
			type : 'status',
			width : 400,
			height : 240,
			onaction : function(a) {
				if (a == 'ok')
					t.close();
			}
		}, f);

		$.Window.call(t, f, a);
	};

	$.extend($.StatusWindow.prototype, $.Window.prototype, {
		setContent : function(co) {
			var v, k, h = '';

			if (typeof(co) != 'string') {
				// Build string
				$(co).each(function(i, v) {
					h += '<div class="statusrow">' +
							'<div class="statuscol1">' + v.title + '</div>' + 
							'<div class="statuscol2">' + v.content + '</div>' +
						'</div>';
				});
			}

			$('#' + this.id + '_statuscont').html(h || co);

			return this;
		},

		render : function() {
			var t = this, f, v;

			$.Window.prototype.render.call(t);
			$.Window.prototype.setContent.call(t,
				'<div id="' + t.id + '_statuscont" class="statustext"></div>' +
				'<a href="#" class="action ok">' + $.WindowManager.i18n.ok + '</a>'
			);

			f = t.features;

			if (v = f.content)
				t.setContent(v);

			return t;
		}
	});

	if (!$.CurrentWindowManager) {
		$.extend($.WindowManager, {
			status : function(f, cb) {
				var t = this, w;

				f = $.extend({
					onaction : function(a) {
						if (a == 'ok') {
							w.close();

							if (cb)
								cb.call(t, 1);
						} else if (a == 'close')
							w.close();
					}
				}, f);

				w = new $.StatusWindow(f).render();

				t.windows.push(w);

				return w.focus();
			},

			showProgress : function(f) {
				var t = this, bl, id = 'progressWindow';

				t.hideProgress();
				t.progress = 1;

				f = $.extend({
					theme : 'clearlooks2',
					x : -1,
					y : -1
				}, f);

				bl = $('#windowManProgressEventBlocker');
				if (!bl[0]) {
					$(document.body).append($.createElm('div', {id : 'windowManProgressEventBlocker', 'class' : f.theme + '_event_blocker'}).addClass(f.theme + '_visible_event_blocker'));
					bl = $('#windowManProgressEventBlocker');
				}

				bl.show().css('z-index', t.zIndex++).css({width : $.winWidth(), height : $.winHeight(), position : t.isIE6 ? 'absolute' : 'fixed'});

				$(document.body).appendAll(
					['div', {id : id, 'class' : f.theme + '_progress'},
						['div', {id : id + '_msg', 'class' : 'message'}]
					]
				);

				$('#' + id + '_msg').html(f.message);
				$('#' + id).css({left : -1000, top : -1000}).show();

				// Center window
				if (f.x == -1)
					f.x = Math.round(($.winWidth() / 2) - ($('#' + id).width() / 2));

				if (f.y == -1)
					f.y = Math.round(($.winHeight() / 2) - ($('#' + id).height() / 2));

				$('#' + id).css({left : f.x, top : f.y});

				$(t).bind('WindowManager:open', function() {t.hideProgress();});
			},

			hideProgress : function() {
				var t = this;

				if (t.progress) {
					$('#progressWindow').remove();
					$('#windowManProgressEventBlocker').hide();
					$(t).unbind('WindowManager:open', t.hideProgress);
					t.progress = 0;
				}
			}
		});
	}
})(jQuery);/**
 * $Id: jquery.domutils.js 460 2008-10-14 16:06:43Z spocke $
 *
 * @author Moxiecode
 * @copyright Copyright � 2004-2008, Moxiecode Systems AB, All rights reserved.
 */

(function($) {
	$.extend({
		createElm : function(n, a, h) {
			n = $(document.createElement(n));

			n.attr(a).html(h);

			return n;
		},

		appendElements : function(te, ne) {
			var i, n;

			if (typeof(ne) == 'string')
				te.appendChild(document.createTextNode(ne));
			else if (ne.length) {
				te = te.appendChild($.createElm(ne[0], ne[1])[0]);

				for (i=2; i<ne.length; i++)
					$.appendElements(te, ne[i]);
			}
		},

		scrollPos : function() {
			var w = window, b = document.body;

			return {
				x : w.pageXOffset || b.scrollLeft,
				y : w.pageYOffset || b.scrollTop
			};
		},

		winWidth : function() {
			return window.innerWidth || $(window).width();
		},

		winHeight : function() {
			return window.innerHeight || $(window).height();
		}
	});

	$.fn.extend({
		appendAll : function(ne) {
			this.each(function(i, v) {
				$.appendElements(v, ne);
			});
		}
	});
})(jQuery);(function ($) {
    var m = {
            '\b': '\\b',
            '\t': '\\t',
            '\n': '\\n',
            '\f': '\\f',
            '\r': '\\r',
            '"' : '\\"',
            '\\': '\\\\'
        },
        s = {
            'array': function (x) {
                var a = ['['], b, f, i, l = x.length, v;
                for (i = 0; i < l; i += 1) {
                    v = x[i];
                    f = s[typeof v];
                    if (f) {
                        v = f(v);
                        if (typeof v == 'string') {
                            if (b) {
                                a[a.length] = ',';
                            }
                            a[a.length] = v;
                            b = true;
                        }
                    }
                }
                a[a.length] = ']';
                return a.join('');
            },
            'boolean': function (x) {
                return String(x);
            },
            'null': function (x) {
                return "null";
            },
            'number': function (x) {
                return isFinite(x) ? String(x) : 'null';
            },
            'object': function (x) {
                if (x) {
                    if (x instanceof Array) {
                        return s.array(x);
                    }
                    var a = ['{'], b, f, i, v;
                    for (i in x) {
                        v = x[i];
                        f = s[typeof v];
                        if (f) {
                            v = f(v);
                            if (typeof v == 'string') {
                                if (b) {
                                    a[a.length] = ',';
                                }
                                a.push(s.string(i), ':', v);
                                b = true;
                            }
                        }
                    }
                    a[a.length] = '}';
                    return a.join('');
                }
                return 'null';
            },
            'string': function (x) {
                if (/["\\\x00-\x1f]/.test(x)) {
                    x = x.replace(/([\x00-\x1f\\"])/g, function(a, b) {
                        var c = m[b];
                        if (c) {
                            return c;
                        }
                        c = b.charCodeAt();
                        return '\\u00' +
                            Math.floor(c / 16).toString(16) +
                            (c % 16).toString(16);
                    });
                }
                return '"' + x + '"';
            }
        };

	$.toJSON = function(v) {
		var f = isNaN(v) ? s[typeof v] : s['number'];
		if (f) return f(v);
	};
	
	$.parseJSON = function(v, safe) {
		if (safe === undefined) safe = $.parseJSON.safe;
		if (safe && !/^("(\\.|[^"\\\n\r])*?"|[,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t])+?$/.test(v))
			return undefined;
		return eval('('+v+')');
	};
	
	$.parseJSON.safe = false;

})(jQuery);/**
 * jQuery Templates
 *
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Written by: Stan Lemon <stanlemon@mac.com>
 *
 * Based off of the Ext.Template library, available at:
 * http://www.extjs.com
 *
 * This library provides basic templating functionality, allowing for macro-based
 * templates within jQuery.
 *
 * Basic Usage:
 *
 * var t = $.template('<div id="foo">Hello ${name}, how are you ${question}?  I am ${me:substr(0,10)}</div>');
 *
 * $(selector).append( t , {
 *     name: 'Stan',
 *     question: 'feeling',
 *     me: 'doing quite well myself, thank you very much!'
 * });
 *
 * Requires: jQuery 1.2+
 *
 *
 * @todo    Add callbacks to the DOM manipulation methods, so that events can be bound
 *          to template nodes after creation.
 */
(function($){
	
	/**
	 * Create a New Template
	 */
	$.template = function(html, options) {
		return new $.template.instance(html, options);
	};

	/**
	 * Template constructor - Creates a new template instance.
	 *
	 * @param 	html 	The string of HTML to be used for the template.
	 * @param 	options An object of configurable options.  Currently
	 * 			you can toggle compile as a boolean value and set a custom
	 *          template regular expression on the property regx by
	 *          specifying the key of the regx to use from the regx object.
	 */
	$.template.instance = function(html, options) {
        // If a custom regular expression has been set, grab it from the regx object
        if ( options && options['regx'] ) options.regx = this.regx[ options.regx ];

		this.options = $.extend({
			compile: 		false,
			regx:           this.regx.standard
		}, options || {});

		this.html = html;

		if (this.options.compile) {
			this.compile();   
		}
		this.isTemplate = true;
	};

	/**
	 * Regular Expression for Finding Variables
	 *
	 * The default pattern looks for variables in JSP style, the form of: ${variable}
	 * There are also regular expressions available for ext-style variables and
	 * jTemplate style variables.
	 *
	 * You can add your own regular expressions for variable ussage by doing.
	 * $.extend({ $.template.re , {
	 *     myvartype: /...../g
	 * }
	 *
	 * Then when creating a template do:
	 * var t = $.template("<div>...</div>", { regx: 'myvartype' });
	 */
	$.template.regx = $.template.instance.prototype.regx = {
	    jsp:        /\$\{([\w-]+)(?:\:([\w\.]*)(?:\((.*?)?\))?)?\}/g,
        ext:        /\{([\w-]+)(?:\:([\w\.]*)(?:\((.*?)?\))?)?\}/g,
        jtemplates: /\{\{([\w-]+)(?:\:([\w\.]*)(?:\((.*?)?\))?)?\}\}/g
	};
	
	/**
	 * Set the standard regular expression to be used.
	 */
	$.template.regx.standard = $.template.regx.jsp;
	
	/**
	 * Variable Helper Methods
	 *
	 * This is a collection of methods which can be used within the variable syntax, ie:
	 * ${variable:substr(0,30)} Which would only print a substring, 30 characters in length
	 * begining at the first character for the variable named "variable".
	 *
	 * A basic substring helper is provided as an example of how you can define helpers.
	 * To add more helpers simply do:
	 * $.extend( $.template.helpers , {
	 *	 sampleHelper: function() { ... }	
	 * });
	 */
	$.template.helpers = $.template.instance.prototype.helpers = {
		substr : function(value, start, length){
			return String(value).substr(start, length);
		}
	};


	/**
	 * Template Instance Methods
	 */
	$.extend( $.template.instance.prototype, {
		
		/**
		 * Apply Values to a Template
		 *
		 * This is the macro-work horse of the library, it receives an object
		 * and the properties of that objects are assigned to the template, where
		 * the variables in the template represent keys within the object itself.
		 *
		 * @param 	values 	An object of properties mapped to template variables
		 */
		apply: function(values) {
			if (this.options.compile) {
				return this.compiled(values);
			} else {
				var tpl = this;
				var fm = this.helpers;

				var fn = function(m, name, format, args) {
					if (format) {
						if (format.substr(0, 5) == "this."){
							return tpl.call(format.substr(5), values[name], values);
						} else {
							if (args) {
								// quoted values are required for strings in compiled templates, 
								// but for non compiled we need to strip them
								// quoted reversed for jsmin
								var re = /^\s*['"](.*)["']\s*$/;
								args = args.split(',');

								for(var i = 0, len = args.length; i < len; i++) {
									args[i] = args[i].replace(re, "$1");
								}
								args = [values[name]].concat(args);
							} else {
								args = [values[name]];
							}

							return fm[format].apply(fm, args);
						}
					} else {
						return values[name] !== undefined ? values[name] : "";
					}
				};

				return this.html.replace(this.options.regx, fn);
			}
		},

		/**
		 * Compile a template for speedier usage
		 */
		compile: function() {
			var sep = $.browser.mozilla ? "+" : ",";
			var fm = this.helpers;

			var fn = function(m, name, format, args){
				if (format) {
					args = args ? ',' + args : "";

					if (format.substr(0, 5) != "this.") {
						format = "fm." + format + '(';
					} else {
						format = 'this.call("'+ format.substr(5) + '", ';
						args = ", values";
					}
				} else {
					args= ''; format = "(values['" + name + "'] == undefined ? '' : ";
				}
				return "'"+ sep + format + "values['" + name + "']" + args + ")"+sep+"'";
			};

			var body;

			if ($.browser.mozilla) {
				body = "this.compiled = function(values){ return '" +
					   this.html.replace(/\\/g, '\\\\').replace(/(\r\n|\n)/g, '\\n').replace(/'/g, "\\'").replace(this.options.regx, fn) +
						"';};";
			} else {
				body = ["this.compiled = function(values){ return ['"];
				body.push(this.html.replace(/\\/g, '\\\\').replace(/(\r\n|\n)/g, '\\n').replace(/'/g, "\\'").replace(this.options.regx, fn));
				body.push("'].join('');};");
				body = body.join('');
			}
			eval(body);
			return this;
		}
	});


	/**
	 * Save a reference in this local scope to the original methods which we're 
	 * going to overload.
	 **/
	var $_old = {
	    domManip: $.fn.domManip,
	    text: $.fn.text,
	    html: $.fn.html
	};

	/**
	 * Overwrite the domManip method so that we can use things like append() by passing a 
	 * template object and macro parameters.
	 */
	$.fn.domManip = function( args, table, reverse, callback ) {
		if (args[0].isTemplate) {
			// Apply the template and it's arguments...
			args[0] = args[0].apply( args[1] );
			// Get rid of the arguements, we don't want to pass them on
			delete args[1];
		}

		// Call the original method
		var r = $_old.domManip.apply(this, arguments);

		return r;
	};

    /**
     * Overwrite the html() method
     */
	$.fn.html = function( value , o ) {
	    if (value && value.isTemplate) var value = value.apply( o );

		var r = $_old.html.apply(this, [value]);

		return r;
	};
	
	/**
	 * Overwrite the text() method
	 */
	$.fn.text = function( value , o ) {
	    if (value && value.isTemplate) var value = value.apply( o );

		var r = $_old.text.apply(this, [value]);

		return r;
	};

})(jQuery);/**
 * $Id: jquery.template.ext.js 453 2008-10-14 12:24:41Z spocke $
 *
 * @author Moxiecode
 * @copyright Copyright � 2004-2008, Moxiecode Systems AB, All rights reserved.
 */

(function($){
	$.template.regx.standard = $.template.regx.ext;

	$.templateFromScript = function(el, opts) {
		return $.template($.trim($.translate($(el).html().replace(/(<!\[CDATA\[|\]\]>)/gi, ''))), opts);
	};

	// Add template helpers
	$.extend($.template.helpers, {
		sizefix : function(v) {
			v = parseInt(v);

			if (isNaN(v) || v == -1)
				return '';

			// MB
			if (v > 1048576)
				return Math.round(v / 1048576, 1) + " MB";

			// KB
			if (v > 1024)
				return Math.round(v / 1024, 1) + " KB";

			return v + " b";
		},

		encodeURIComponent : function(v) {
			return encodeURIComponent(v);
		}
	});
})(jQuery);/**
 * $Id: jquery.uri.js 453 2008-10-14 12:24:41Z spocke $
 *
 * @author Moxiecode
 * @copyright Copyright � 2004-2008, Moxiecode Systems AB, All rights reserved.
 */

(function($) {
	function URI(u, s) {
		var t = this, o, a, b;

		// Default settings
		s = t.settings = s || {};

		// Strange app protocol or local anchor
		if (/^(mailto|news|javascript|about):/i.test(u) || /^\s*#/.test(u)) {
			t.source = u;
			return;
		}

		// Absolute path with no host, fake host and protocol
		if (u.indexOf('/') === 0 && u.indexOf('//') !== 0)
			u = (s.base_uri ? s.base_uri.protocol || 'http' : 'http') + '://mce_host' + u;

		// Relative path
		if (u.indexOf(':/') === -1 && u.indexOf('//') !== 0)
			u = (s.base_uri.protocol || 'http') + '://mce_host' + t.toAbsPath(s.base_uri.path, u);

		// Parse URL (Credits goes to Steave, http://blog.stevenlevithan.com/archives/parseuri)
		u = u.replace(/@@/g, '(mce_at)'); // Zope 3 workaround, they use @@something
		u = /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/.exec(u);
		$(["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"]).each(function(i, v) {
			var s = u[i];

			// Zope 3 workaround, they use @@something
			if (s)
				s = s.replace(/\(mce_at\)/g, '@@');

			t[v] = s;
		});

		if (b = s.base_uri) {
			if (!t.protocol)
				t.protocol = b.protocol;

			if (!t.userInfo)
				t.userInfo = b.userInfo;

			if (!t.port && t.host == 'mce_host')
				t.port = b.port;

			if (!t.host || t.host == 'mce_host')
				t.host = b.host;

			t.source = '';
		}
	};

	$.extend(URI.prototype, {
		/**
		 * Sets the internal path part of the URI.
		 *
		 * @param {string} p Path string to set.
		 */
		setPath : function(p) {
			var t = this;

			p = /^(.*?)\/?(\w+)?$/.exec(p);

			// Update path parts
			t.path = p[0];
			t.directory = p[1];
			t.file = p[2];

			// Rebuild source
			t.source = '';
			t.getURI();
		},

		/**
		 * Converts the specified URI into a relative URI based on the current URI instance location.
		 *
		 * @param {String} u URI to convert into a relative path/URI.
		 * @return {String} Relative URI from the point specified in the current URI instance.
		 */
		toRelative : function(u) {
			var t = this, o;

			if (u === "./")
				return u;

			u = new URI(u, {base_uri : t});

			// Not on same domain/port or protocol
			if ((u.host != 'mce_host' && t.host != u.host && u.host) || t.port != u.port || t.protocol != u.protocol)
				return u.getURI();

			o = t.toRelPath(t.path, u.path);

			// Add query
			if (u.query)
				o += '?' + u.query;

			// Add anchor
			if (u.anchor)
				o += '#' + u.anchor;

			return o;
		},
	
		/**
		 * Converts the specified URI into a absolute URI based on the current URI instance location.
		 *
		 * @param {String} u URI to convert into a relative path/URI.
		 * @param {bool} nh No host and protocol prefix.
		 * @return {String} Absolute URI from the point specified in the current URI instance.
		 */
		toAbsolute : function(u, nh) {
			var u = new URI(u, {base_uri : this});

			return u.getURI(this.host == u.host ? nh : 0);
		},

		/**
		 * Converts a absolute path into a relative path.
		 *
		 * @param {String} base Base point to convert the path from.
		 * @param {String} path Absolute path to convert into a relative path.
		 */
		toRelPath : function(base, path) {
			var items, bp = 0, out = '', i, l;

			// Split the paths
			base = base.substring(0, base.lastIndexOf('/'));
			base = base.split('/');
			items = path.split('/');

			if (base.length >= items.length) {
				for (i = 0, l = base.length; i < l; i++) {
					if (i >= items.length || base[i] != items[i]) {
						bp = i + 1;
						break;
					}
				}
			}

			if (base.length < items.length) {
				for (i = 0, l = items.length; i < l; i++) {
					if (i >= base.length || base[i] != items[i]) {
						bp = i + 1;
						break;
					}
				}
			}

			if (bp == 1)
				return path;

			for (i = 0, l = base.length - (bp - 1); i < l; i++)
				out += "../";

			for (i = bp - 1, l = items.length; i < l; i++) {
				if (i != bp - 1)
					out += "/" + items[i];
				else
					out += items[i];
			}

			return out;
		},

		/**
		 * Converts a relative path into a absolute path.
		 *
		 * @param {String} base Base point to convert the path from.
		 * @param {String} path Relative path to convert into an absolute path.
		 */
		toAbsPath : function(base, path) {
			var i, nb = 0, o = [];

			// Split paths
			base = base.split('/');
			path = path.split('/');

			// Remove empty chunks
			$(base).each(function(i, k) {
				if (k)
					o.push(k);
			});

			base = o;

			// Merge relURLParts chunks
			for (i = path.length - 1, o = []; i >= 0; i--) {
				// Ignore empty or .
				if (path[i].length == 0 || path[i] == ".")
					continue;

				// Is parent
				if (path[i] == '..') {
					nb++;
					continue;
				}

				// Move up
				if (nb > 0) {
					nb--;
					continue;
				}

				o.push(path[i]);
			}

			i = base.length - nb;

			// If /a/b/c or /
			if (i <= 0)
				return '/' + o.reverse().join('/');

			return '/' + base.slice(0, i).join('/') + '/' + o.reverse().join('/');
		},

		/**
		 * Returns the full URI of the internal structure.
		 *
		 * @param {bool} nh Optional no host and protocol part. Defaults to false.
		 */
		getURI : function(nh) {
			var s, t = this;

			// Rebuild source
			if (!t.source || nh) {
				s = '';

				if (!nh) {
					if (t.protocol)
						s += t.protocol + '://';

					if (t.userInfo)
						s += t.userInfo + '@';

					if (t.host)
						s += t.host;

					if (t.port)
						s += ':' + t.port;
				}

				if (t.path)
					s += t.path;

				if (t.query)
					s += '?' + t.query;

				if (t.anchor)
					s += '#' + t.anchor;

				t.source = s;
			}

			return t.source;
		}
	});

	$.parseURI = function(u, s) {
		s = s || {};

		return new URI(u, $.extend({base_uri : new URI(s.base_url || document.location.href)}, s));
	};
})(jQuery);/**
 * Copyright 2004-2009, Moxiecode Systems AB, All rights reserved.
 */

(function($){
	$.cleanName = function(s) {
		var i, lo;

		// Replace diacritics
		lo = [
			/[\300-\306]/g, 'A', /[\340-\346]/g, 'a',
			/\307/g, 'C', /\347/g, 'c',
			/[\310-\313]/g, 'E', /[\350-\353]/g, 'e',
			/[\314-\317]/g, 'I', /[\354-\357]/g, 'i',
			/\321/g, 'N', /\361/g, 'n',
			/[\322-\330]/g, 'O', /[\362-\370]/g, 'o',
			/[\331-\334]/g, 'U', /[\371-\374]/g, 'u'
		];

		for (i = 0; i < lo.length; i += 2)
			s = s.replace(lo[i], lo[i + 1]);

		// Replace whitespace
		s = s.replace(/\s+/g, '_');

		// Remove anything else
		s = s.replace(/[^a-z0-9_\-\.]+/gi, '');

		return s;
	};
})(jQuery);/**
 * $Id: rpc.js 649 2009-01-21 14:56:49Z spocke $
 *
 * @author Moxiecode
 * @copyright Copyright � 2004-2008, Moxiecode Systems AB, All rights reserved.
 */

(function($){
	window.RPC = {
		pageBaseURL : document.location.href.replace(/[^\/]+$/, ''),

		init : function() {
			$().ajaxError(function(e, req, se) {
				if (req.status)
					$.WindowManager.status({title : "The server response wasn't JSON format", content : req.responseText}); 
			});
		},

		toArray : function(res) {
			var fl = [];

			if (res && res.data && res.columns) {
				$(res.data).each(function(i) {
					var o = {index : i};

					$(this).each(function(i, v) {
						o[res.columns[i]] = v;
					});

					fl.push(o);
				});
			}

			return fl;
		},

		exec : function(m, ar, cb) {
			// Make RPC call
			$.post(RPC.pageBaseURL + '../../rpc/index.php', {
				json_data : $.toJSON({
					"method" : m,
					"params" :[ar],
					"id" : "c0"
				})
				}, cb, "json"
			);
		},

		handleError : function(args) {
			var t = this, errors, res = args.response.result, err = args.response.error;

			if (err) {
				if (err.level == 'AUTH') {
					if (res.login_url.indexOf('return_url') != -1)
						document.location = res.login_url;
					else if (res.login_url.indexOf('://') == -1)
						document.location = "../../" + res.login_url + "?return_url=" + escape(document.location);
					else
						document.location = res.login_url + "?return_url=" + escape(document.location);

					return true;
				}

				$.WindowManager.info($.translate(err.errstr));
				return true;
			} else {
				errors = [];

				$(this.toArray(res)).each(function(i, r) {
					var root;

					if (r.status && r.status.toLowerCase() != 'ok') {
						root = args.visual_path || '/';
						root = root.replace(/^\/([^\/]+)\/.*$/, '$1');

						if (r.fromfile != undefined) {
							r.fromfile = r.fromfile.replace(/\{[0-9]+\}/, root);
							r.tofile = r.tofile.replace(/\{[0-9]+\}/, root);
							errors.push({title : r.fromfile + " -> " + r.tofile, content : $.translate(r.message)});
						}

						if (r.file != undefined) {
							r.file = r.file.replace(/\{[0-9]+\}/, root);
							r.file = r.file.replace(/\/+/, '/');
							errors.push({title : r.file, content : $.translate(r.message)});
						}
					}
				});

				if (errors.length) {
					$.WindowManager.status({title : $.translate(args.message), content : errors});
					return true;
				}
			}
		},

		insertFiles : function(s) {
			var t = this, args = {};

			$(s.paths).each(function(i, v) {
				args['path' + i] = v; 
			});

			if (s.progress_message)
				$.WindowManager.showProgress({message : s.progress_message});

			RPC.exec('fm.insertFiles', args, function (data) {
				var o = {files : []};

				$.WindowManager.hideProgress();

				$(RPC.toArray(data.result)).each(function(i, v) {
					var u = v.url;

					if (s.relative_urls)
						u = $.parseURI(s.document_base_url || s.default_base_url).toRelative(u);
					else if (s.document_base_url || s.no_host)
						u = $.parseURI(s.document_base_url).toAbsolute($.parseURI(u).getURI(1), s.no_host);

					v = {
						name : v.name,
						path : v.path,
						url : u,
						size : v.size,
						type : v.type,
						created : v.created,
						modified : v.modified,
						attribs : v.attribs,
						custom : $.extend({}, v.custom)
					};

					o.files.push(v);
				});

				if (s.oninsert) {
					if (s.insert_filter) {
						$(o.files).each(function(i, f) {
							s.insert_filter(f);
						});
					}

					s.oninsert(o);
				}
			});
		},

		insertFile : function(s) {
			var ins = s.oninsert;

			s.paths = [s.path];
			s.oninsert = function(o) {
				o.file = o.files[0];
				ins.call(this, o);
			};

			this.insertFiles(s);
		}
	};

	RPC.init();
})(jQuery);
/**
 * $Id: tinymce.js 643 2009-01-21 13:03:53Z spocke $
 *
 * @author Moxiecode
 * @copyright Copyright � 2004-2008, Moxiecode Systems AB, All rights reserved.
 */

(function($){
	var w, ed, wm, args = {};

	window.focus();

//	try {
		w = opener || parent;

		// Check mcFileManager
		if (w.mcFileManager)
			args = w.mcFileManager.windowArgs;

		// Check TinyMCE
		if (w.tinyMCE && (ed = w.tinyMCE.activeEditor)) {
			if (ed && (wm = ed.windowManager)) {
				if (!args && wm.params)
					args = wm.params;

				if (wm.setTitle)
					wm.setTitle(window, document.title);
			}
		}
/*	} catch (ex) {
	}*/

	if (!$.CurrentWindowManager) {
		// Add default window and add some methods to it
		$.WindowManager.defaultWin = {
			getArgs : function() {
				return args;
			},

			close : function() {
				// Restore selection but only when the window is opened in an iframe
				if (ed && wm.bookmark && top != window)
					ed.selection.moveToBookmark(wm.bookmark);

				if (wm)
					wm.close(window);
				else
					window.close();
			}
		};
	}
})(jQuery);
