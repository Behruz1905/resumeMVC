/*
jQWidgets v3.8.0 (2015-Apr)
Copyright (c) 2011-2015 jQWidgets.
License: http://jqwidgets.com/license/
*/

(function(a){a.jqx.jqxWidget("jqxRibbon","",{});a.extend(a.jqx._jqxRibbon.prototype,{defineInstance:function(){var b={width:null,height:"auto",mode:"default",position:"top",selectedIndex:-1,selectionMode:"click",popupCloseMode:"click",animationType:"fade",animationDelay:400,scrollPosition:"both",disabled:false,rtl:false,scrollStep:10,scrollDelay:30,initContent:null,events:["select","unselect","change"]};a.extend(true,this,b)},createInstance:function(){var b=this;b._browser=a.jqx.browser;if(b.mode!="popup"&&b.selectedIndex===-1){b.selectedIndex=0}b._originalHTML=b.host.html();b._render(true)},render:function(){this._render()},refresh:function(b){if(b!==true){this._render()}},destroy:function(){var b=this;b._removeHandlers();b.host.remove()},selectAt:function(b){this._selectAt(b)},clearSelection:function(){this._clearSelection()},disableAt:function(b){var c=this;c._items[b]._disabled=true;a(c._items[b]).addClass(c.toThemeProperty("jqx-fill-state-disabled"));if(b===c.selectedIndex){c._clearSelection()}},enableAt:function(b){var c=this;c._items[b]._disabled=false;a(c._items[b]).removeClass(c.toThemeProperty("jqx-fill-state-disabled"))},hideAt:function(b){var c=this;a(c._items[b]).css("display","none");c._checkScrollButtons();if(b===c.selectedIndex){c._clearSelection()}else{c._updatePositions()}},showAt:function(b){var c=this;if(c._orientation==="horizontal"){a(c._items[b]).css("display","inline-block")}else{a(c._items[b]).css("display","inherit")}c._checkScrollButtons();c._updatePositions()},val:function(b){var c=this;if(b){c._selectAt(b)}else{return c.selectedIndex}},addAt:function(b,e){var c=this;c._removeHandlers();var f=a('<li class="'+c.toThemeProperty("jqx-ribbon-item")+" "+c.toThemeProperty("jqx-ribbon-item-"+c.position)+'">'+e.title+"</li>");var d=a('<div class="'+c.toThemeProperty("jqx-widget-content")+" "+c.toThemeProperty("jqx-ribbon-content-section")+" "+c.toThemeProperty("jqx-ribbon-content-section-"+c.position)+'">'+e.content+"</div>");switch(c.position){case"top":f.addClass(c.toThemeProperty("jqx-rc-t"));d.addClass(c.toThemeProperty("jqx-rc-b"));break;case"bottom":f.addClass(c.toThemeProperty("jqx-rc-b"));d.addClass(c.toThemeProperty("jqx-rc-t"));break;case"left":f.addClass(c.toThemeProperty("jqx-rc-l"));d.addClass(c.toThemeProperty("jqx-rc-r"));break;case"right":f.addClass(c.toThemeProperty("jqx-rc-r"));d.addClass(c.toThemeProperty("jqx-rc-l"));break}if(c.mode==="popup"){d.addClass(c.toThemeProperty("jqx-ribbon-content-section-popup"));if(c._orientation==="horizontal"){d.addClass(c.toThemeProperty("jqx-ribbon-content-section-horizontal-popup"))}else{d.addClass(c.toThemeProperty("jqx-ribbon-content-section-vertical-popup"))}}if(c.rtl===true){f.addClass(c.toThemeProperty("jqx-ribbon-item-rtl"))}if(c._items.length-1>=b){a(c._items[b]).before(f);a(c._contentSections[b]).before(d)}else{c._header.append(f);c._content.append(d)}c._updateItems();c._addHandlers();c._checkScrollButtons();if(b<=c.selectedIndex){c.selectedIndex++}c._updatePositions()},removeAt:function(b){var c=this;if(b===c.selectedIndex){c._clearSelection()}a(c._items[b]).add(c._contentSections[b]).remove();c._updateItems();c._updatePositions()},updateAt:function(b,c){var d=this;a(d._items[b]).html(c.newTitle);a(d._contentSections[b]).html(c.newContent);d._items[b]._isInitialized=false;if(d.initContent&&b===d.selectedIndex){d.initContent(b);d._items[b]._isInitialized=true}d._updatePositions()},setPopupLayout:function(c,f,d,b){var e=this;if(e.mode==="popup"){if(!a(e._contentSections[c]).attr("data-width")){if(a(e._contentSections[c])[0].style.width){a(e._contentSections[c]).attr("data-width",a(e._contentSections[c])[0].style.width)}if(a(e._contentSections[c])[0].style.height){a(e._contentSections[c]).attr("data-height",a(e._contentSections[c])[0].style.height)}}if(d){a(e._contentSections[c]).css("width",d)}if(b){a(e._contentSections[c]).css("height",b)}e._contentSections[c]._layout=f;e._positionContent(c)}},propertyChangedHandler:function(c,d,f,e){if(e!==f){switch(d){case"width":case"height":c._updateSize();break;case"position":c._render();break;case"mode":c._content.width("auto");c._removeHandlers(null,f);c._render();break;case"selectedIndex":c._selectAt(e,f);break;case"selectionMode":c._removeHandlers(f);c._addHandlers();break;case"scrollPosition":c._scrollButtons.removeClass(c.toThemeProperty("jqx-ribbon-scrollbutton-"+f));c._scrollButtons.addClass(c.toThemeProperty("jqx-ribbon-scrollbutton-"+e));var b=a(c._scrollButtons[0]);var g=a(c._scrollButtons[1]);c._scrollButtons.removeClass(c.toThemeProperty("jqx-rc-tr"));c._scrollButtons.removeClass(c.toThemeProperty("jqx-rc-bl"));b.removeClass(c.toThemeProperty("jqx-rc-tl"));g.removeClass(c.toThemeProperty("jqx-rc-br"));c._scrollButtonRc(b,g);c._checkScrollButtons();c._updatePositions();break;case"disabled":if(e===true){c._removeHandlers();c.host.addClass(c.toThemeProperty("jqx-fill-state-disabled"))}else{c.host.removeClass(c.toThemeProperty("jqx-fill-state-disabled"));c._addHandlers()}break;case"theme":a.jqx.utilities.setTheme(f,e,c.host);break;case"rtl":if(e===true){c._header.addClass(c.toThemeProperty("jqx-ribbon-header-rtl"));c._items.addClass(c.toThemeProperty("jqx-ribbon-item-rtl"))}else{c._header.removeClass(c.toThemeProperty("jqx-ribbon-header-rtl"));c._items.removeClass(c.toThemeProperty("jqx-ribbon-item-rtl"))}c._positionSelectionToken(c.selectedIndex);break}}},_raiseEvent:function(g,e){var c=this.events[g];var f=new jQuery.Event(c);f.owner=this;f.args=e;var b;try{b=this.host.trigger(f)}catch(d){}return b},_render:function(c){var d=this;if(c!==true){d._removeHandlers()}d._selectionTokenOffsetY=0;switch(d._browser.browser){case"mozilla":d._browserWidthRtlFlag=0;d._browserScrollRtlFlag=1;d._selectionTokenOffsetX=1;break;case"msie":d._browserWidthRtlFlag=0;d._browserScrollRtlFlag=-1;if(d._browser.version==="8.0"){d._selectionTokenOffsetX=1}else{if(d._browser.version==="7.0"){d._selectionTokenOffsetX=0;if(d.mode==="popup"&&(d.position==="bottom"||d.position==="right")){d._selectionTokenOffsetY=2}}else{d._selectionTokenOffsetX=0}}break;default:d._browserWidthRtlFlag=1;d._browserScrollRtlFlag=1;d._selectionTokenOffsetX=0}if(c==true){var b=d.host.children();d._header=a(b[0]);d._content=a(b[1]);d._checkStructure(b)}d._header.css("float","none");d._content.css("padding","0px");d.host.width(d.width);d.host.height(d.height);if(d.position==="bottom"||d.position==="right"){d._content.after(d._header)}if(d.position==="top"||d.position==="bottom"){d._orientation="horizontal"}else{d._orientation="vertical"}if(d.position==="right"){d._header.css("float","right")}else{if(d.position==="left"){d._header.css("float","left")}}d._items=d._header.children();d._contentSections=d._content.children();a.each(d._contentSections,function(){if(a(this).attr("data-width")!==undefined){a(this).css("width",a(this).attr("data-width"));a(this).css("height",a(this).attr("data-height"));a(this).removeAttr("data-width");a(this).removeAttr("data-height")}});if(c==true){d._selectionToken=a('<div class="'+d.toThemeProperty("jqx-ribbon-selection-token")+" "+d.toThemeProperty("jqx-ribbon-selection-token-"+d.position)+" "+d.toThemeProperty("jqx-widget-content")+'"></div>');d.host.append(d._selectionToken)}d._updateItems();d._addClasses();if(c==true){d._appendScrollButtons();d._checkScrollButtons()}d._allowSelection=true;if(d.selectedIndex!==-1){a(d._items[d.selectedIndex]).addClass(d.toThemeProperty("jqx-widget-content")).addClass(d.toThemeProperty("jqx-ribbon-item-selected"));d._positionSelectionToken(d.selectedIndex);a(d._contentSections[d.selectedIndex]).css("display","block");if(d.initContent){d.initContent(d.selectedIndex);d._items[d.selectedIndex]._isInitialized=true}}if(!d.disabled){d._addHandlers()}else{d.host.addClass(d.toThemeProperty("jqx-fill-state-disabled"))}a.jqx.utilities.resize(d.host,function(){d._updateSize()})},_updateSize:function(){var b=this;if(b._browser.version==="7.0"&&b._browser.browser==="msie"){if(b._orientation==="horizontal"){b._header.css("width",(b.host.width()-parseInt(b._header.css("padding-left"),10)-parseInt(b._header.css("padding-right"),10)-parseInt(b._header.css("border-left-width"),10)-parseInt(b._header.css("border-right-width"),10)));b._contentSections.width(b._content.width()-parseInt(b._contentSections.css("border-left-width"),10)-parseInt(b._contentSections.css("border-right-width"),10)-parseInt(b._contentSections.css("padding-left"),10)-parseInt(b._contentSections.css("padding-right"),10));if(b.mode==="default"&&typeof b.height==="string"&&b.height.indexOf("%")!==-1){b._contentSections.height(b._content.height()-b._header.height()-parseInt(b._contentSections.css("border-bottom-width"),10)-parseInt(b._contentSections.css("border-top-width"),10)-1)}}else{b._header.css("height",(b.host.height()-parseInt(b._header.css("padding-top"),10)-parseInt(b._header.css("padding-bottom"),10)-parseInt(b._header.css("border-top-width"),10)-parseInt(b._header.css("border-bottom-width"),10)));b._contentSections.height(b._content.height()-parseInt(b._contentSections.css("border-top-width"),10)-parseInt(b._contentSections.css("border-bottom-width"),10)-parseInt(b._contentSections.css("padding-top"),10)-parseInt(b._contentSections.css("padding-bottom"),10));if(b.mode==="default"&&typeof b.width==="string"&&b.height.indexOf("%")!==-1){var c=b.position==="left"?parseInt(b._contentSections.css("border-left-width"),10)+parseInt(b._contentSections.css("border-right-width"),10)+1:0;b._contentSections.width(b._content.width()-b._header.width()-c)}}}b._checkScrollButtons(true);b._updatePositions();if(b.mode==="popup"){b._positionPopup()}},_stopAnimation:function(){var b=this;if(!b._allowSelection){b.selectedIndex=b._animatingIndex;a(b._contentSections[b._animatingIndex]).finish();b._clearSelection(true,b._animatingIndex);b._allowSelection=true}},_selectAt:function(b,e){var c=this;if(e===undefined){e=c.selectedIndex}if(b!==e){c._stopAnimation();if(c._allowSelection){c._animatingIndex=b;c._clearSelection(true,e);c._allowSelection=false;c._selecting=b;if(c.selectionMode==="click"){a(c._items[b]).removeClass(c.toThemeProperty("jqx-fill-state-hover"));a(c._items[b]).removeClass(c.toThemeProperty("jqx-ribbon-item-hover"))}if(c.mode=="popup"){c._header.removeClass(c.toThemeProperty("jqx-rc-all"));switch(c.position){case"top":c._header.add(c._items).addClass(c.toThemeProperty("jqx-rc-t"));c._contentSections.addClass(c.toThemeProperty("jqx-rc-b"));break;case"bottom":c._header.add(c._items).addClass(c.toThemeProperty("jqx-rc-b"));c._contentSections.addClass(c.toThemeProperty("jqx-rc-t"));break;case"left":c._header.add(c._items).addClass(c.toThemeProperty("jqx-rc-l"));c._contentSections.addClass(c.toThemeProperty("jqx-rc-r"));break;case"right":c._header.add(c._items).addClass(c.toThemeProperty("jqx-rc-r"));c._contentSections.addClass(c.toThemeProperty("jqx-rc-l"));break}}a(c._items[b]).addClass(c.toThemeProperty("jqx-widget-content")).addClass(c.toThemeProperty("jqx-ribbon-item-selected"));c._selectionToken.css("display","block");c._updatePositions(b);switch(c.animationType){case"fade":a(c._contentSections[b]).fadeToggle(c.animationDelay,function(){c._animationComplete(b,e)});break;case"slide":var d=c.position;if(d==="top"){d="up"}else{if(d==="bottom"){d="down"}}c.slideAnimation=c._slide(a(c._contentSections[b]),{mode:"show",direction:d,duration:c.animationDelay},b,e);break;case"none":a(c._contentSections[b]).css("display","block");c._animationComplete(b,e);break}}else{}}},_clearSelection:function(b,e){var c=this;if(c.mode=="popup"){c._header.addClass(c.toThemeProperty("jqx-rc-all"))}c._selecting=-1;if(e===undefined){e=c.selectedIndex}a(c._items[e]).removeClass(c.toThemeProperty("jqx-widget-content")).removeClass(c.toThemeProperty("jqx-ribbon-item-selected"));c._selectionToken.css("display","none");if(b!==true&&c.animationType!=="none"){if(c.animationType==="fade"){a(c._contentSections[e]).fadeOut(c.animationDelay,function(){c._clearSelectionComplete(e)})}else{if(c.animationType==="slide"){var d=c.position;if(d==="top"){d="up"}else{if(d==="bottom"){d="down"}}c._stopAnimation();e=c.selectedIndex;c.slideAnimation=c._slide(a(c._contentSections[e]),{mode:"hide",direction:d,duration:c.animationDelay},e);c.selectedIndex=-1}}}else{a(c._contentSections[e]).css("display","none");c._clearSelectionComplete(e,b)}},_addHandlers:function(){var c=this;var g=function(i){if(c.popupCloseMode=="click"&&c.mode==="popup"){if(i.target.className.indexOf("jqx-ribbon-content-popup")!=-1){c._clearSelection();return}if(a(i.target).ischildof(c.host)){return}var h=false;a.each(a(i.target).parents(),function(){if(this.className!="undefined"){if(this.className.indexOf){if(this.className.indexOf("jqx-ribbon")!=-1){h=true;return false}if(this.className.indexOf("jqx-ribbon")!=-1){if(self.element.id==this.id){h=true}return false}}}});if(!h){c._clearSelection()}}};if(c.selectionMode==="click"){c.addHandler(c._items,"click.ribbon"+c.element.id,function(i){var h=i.target._index;if(!c._items[h]._disabled){if(h!==c.selectedIndex){c._selectAt(h)}else{if(c.mode==="popup"){if(c.popupCloseMode!="none"){a(i.target).addClass(c.toThemeProperty("jqx-fill-state-hover"));a(i.target).addClass(c.toThemeProperty("jqx-ribbon-item-hover"));c._clearSelection()}}}}});var f=function(h){return((c._selecting!==h&&c._allowSelection===false)||((c._selecting===-1||c.selectedIndex!==h)&&c._allowSelection===true))&&!c._items[h]._disabled};c.addHandler(c._items,"mouseenter.ribbon"+c.element.id,function(h){if(f(h.target._index)){a(h.target).addClass(c.toThemeProperty("jqx-fill-state-hover"));a(h.target).addClass(c.toThemeProperty("jqx-ribbon-item-hover"))}});c.addHandler(c._items,"mouseleave.ribbon"+c.element.id,function(h){if(f(h.target._index)){a(h.target).removeClass(c.toThemeProperty("jqx-fill-state-hover"));a(h.target).removeClass(c.toThemeProperty("jqx-ribbon-item-hover"))}});if(c.mode==="popup"){c.addHandler(c.host,"mouseleave.ribbon"+c.element.id,function(){if(c.popupCloseMode=="mouseLeave"&&c.mode==="popup"){c._clearSelection()}});c.addHandler(c._contentSections,"mouseleave.ribbon"+c.element.id,function(){if(c.popupCloseMode=="mouseLeave"&&c.mode==="popup"){c._clearSelection()}});c.addHandler(a(document),"mousedown.ribbon"+c.element.id,function(h){g(h)})}}else{if(c.selectionMode==="hover"){c.addHandler(c._items,"mouseenter.ribbon"+c.element.id,function(i){var h=i.target._index;if(!c._items[h]._disabled&&h!==c.selectedIndex){c._selectAt(h)}});if(c.mode==="popup"){c.addHandler(c.host,"mouseleave.ribbon"+c.element.id,function(){if(c.popupCloseMode=="mouseLeave"&&c.mode==="popup"){c._clearSelection()}});c.addHandler(c._contentSections,"mouseleave.ribbon"+c.element.id,function(){if(c.popupCloseMode=="mouseLeave"&&c.mode==="popup"){c._clearSelection()}});c.addHandler(a(document),"mousedown.ribbon"+c.element.id,function(h){g(h)});c.addHandler(c._items,"click.ribbon"+c.element.id,function(i){var h=i.target._index;if(!c._items[h]._disabled){if(c.mode==="popup"){if(c.popupCloseMode!="none"){c._clearSelection()}}}})}}}var d=(c.rtl&&c._browser.browser==="msie")?-1:1;var b=a(c._scrollButtons[0]);c.addHandler(b,"mousedown.ribbon"+c.element.id,function(){if(c._orientation==="horizontal"){c._timeoutNear=setInterval(function(){var h=c._header.scrollLeft();c._header.scrollLeft(h-c.scrollStep*d);c._updatePositions()},c.scrollDelay)}else{c._timeoutNear=setInterval(function(){var h=c._header.scrollTop();c._header.scrollTop(h-c.scrollStep);c._updatePositions()},c.scrollDelay)}return false});c.addHandler(b,"mouseup.ribbon"+c.element.id,function(){clearInterval(c._timeoutNear)});var e=a(c._scrollButtons[1]);c.addHandler(e,"mousedown.ribbon"+c.element.id,function(){if(c._orientation==="horizontal"){c._timeoutFar=setInterval(function(){var h=c._header.scrollLeft();c._header.scrollLeft(h+c.scrollStep*d);c._updatePositions()},c.scrollDelay)}else{c._timeoutFar=setInterval(function(){var h=c._header.scrollTop();c._header.scrollTop(h+c.scrollStep);c._updatePositions()},c.scrollDelay)}return false});c.addHandler(e,"mouseup.ribbon"+c.element.id,function(){clearInterval(c._timeoutFar)})},_removeHandlers:function(f,e){var c=this;if(!f){f=c.selectionMode}if(!e){e=c.mode}if(f==="click"){c.removeHandler(c._items,"click.ribbon"+c.element.id);c.removeHandler(c._items,"mouseenter.ribbon"+c.element.id);c.removeHandler(c._items,"mouseleave.ribbon"+c.element.id)}else{if(f==="hover"){c.removeHandler(c._items,"mouseenter.ribbon"+c.element.id);if(e==="popup"){c.removeHandler(c.host,"mouseleave.ribbon"+c.element.id)}}}var b=a(c._scrollButtons[0]);c.removeHandler(b,"mousedown.ribbon"+c.element.id);c.removeHandler(b,"mouseup.ribbon"+c.element.id);var d=a(c._scrollButtons[1]);c.removeHandler(d,"mousedown.ribbon"+c.element.id);c.removeHandler(d,"mouseup.ribbon"+c.element.id)},_checkStructure:function(c){var d=this;var f=c.length;if(f!==2){throw new Error("jqxRibbon: Invalid HTML structure. You need to add a ul and a div to the widget container.")}var b=d._header.children().length;var e=d._content.children().length;if(b!==e){throw new Error("jqxRibbon: Invalid HTML structure. For each list item you must have a corresponding div element.")}},_addClasses:function(){var d=this;d._contentSections.removeClass();d._content.removeClass();d._header.removeClass();d._items.removeClass();d.host.removeClass();d.host.addClass(d.toThemeProperty("jqx-widget")+" "+d.toThemeProperty("jqx-ribbon"));d._header.addClass(d.toThemeProperty("jqx-widget-header")+" "+d.toThemeProperty("jqx-disableselect")+" "+d.toThemeProperty("jqx-ribbon-header")+" "+d.toThemeProperty("jqx-ribbon-header-"+d._orientation));d._items.addClass(d.toThemeProperty("jqx-ribbon-item")+" "+d.toThemeProperty("jqx-ribbon-item-"+d.position));d._content.addClass(d.toThemeProperty("jqx-widget-content")+" "+d.toThemeProperty("jqx-ribbon-content")+" "+d.toThemeProperty("jqx-ribbon-content-"+d._orientation));d._contentSections.addClass(d.toThemeProperty("jqx-widget-content")+" "+d.toThemeProperty("jqx-ribbon-content-section")+" "+d.toThemeProperty("jqx-ribbon-content-section-"+d.position));switch(d.position){case"top":d._header.add(d._items).addClass(d.toThemeProperty("jqx-rc-t"));d._contentSections.addClass(d.toThemeProperty("jqx-rc-b"));break;case"bottom":d._header.add(d._items).addClass(d.toThemeProperty("jqx-rc-b"));d._contentSections.addClass(d.toThemeProperty("jqx-rc-t"));break;case"left":d._header.add(d._items).addClass(d.toThemeProperty("jqx-rc-l"));d._contentSections.addClass(d.toThemeProperty("jqx-rc-r"));break;case"right":d._header.add(d._items).addClass(d.toThemeProperty("jqx-rc-r"));d._contentSections.addClass(d.toThemeProperty("jqx-rc-l"));break}var c,b;if(d.mode==="popup"){if(d.selectedIndex===-1){d.host.addClass(d.toThemeProperty("jqx-rc-all"));d._header.addClass(d.toThemeProperty("jqx-rc-all"))}d.host.addClass(d.toThemeProperty("jqx-ribbon-popup"));d._header.addClass(d.toThemeProperty("jqx-ribbon-header-"+d._orientation+"-popup"));d._content.addClass(d.toThemeProperty("jqx-ribbon-content-popup"));d._contentSections.addClass(d.toThemeProperty("jqx-ribbon-content-section-popup"));d._contentSections.addClass(d.toThemeProperty("jqx-ribbon-content-popup-"+d.position));if(d._orientation==="horizontal"){d._contentSections.addClass(d.toThemeProperty("jqx-ribbon-content-section-horizontal-popup"))}else{d._contentSections.addClass(d.toThemeProperty("jqx-ribbon-content-section-vertical-popup"))}d._positionPopup()}else{if(d._orientation==="horizontal"){if(d.height!=="auto"){b=d._header.outerHeight();if(d.position==="top"){d._content.css("padding-top",b)}else{d._header.addClass(d.toThemeProperty("jqx-ribbon-header-bottom"));d._content.css("padding-bottom",b)}}else{d._header.addClass(d.toThemeProperty("jqx-ribbon-header-auto"))}}else{if(d._orientation==="vertical"){if(d.width!=="auto"){c=d._header.outerWidth();if(d.position==="left"){d._content.css("padding-left",c)}else{d._header.addClass(d.toThemeProperty("jqx-ribbon-header-right"));d._content.css("padding-right",c)}}else{d.host.addClass(d.toThemeProperty("jqx-ribbon-auto"));d._header.addClass(d.toThemeProperty("jqx-ribbon-header-auto"));d._content.addClass(d.toThemeProperty("jqx-ribbon-content-auto-width"))}}}}if(d._browser.version==="7.0"&&d._browser.browser==="msie"){if(d._orientation==="horizontal"){d._header.css("width",(d.host.width()-parseInt(d._header.css("padding-left"),10)-parseInt(d._header.css("padding-right"),10)-parseInt(d._header.css("border-left-width"),10)-parseInt(d._header.css("border-right-width"),10)));d._items.height(d._items.height()-parseInt(d._items.css("padding-top"),10)-parseInt(d._items.css("padding-bottom"),10)-parseInt(d._items.css("border-top-width"),10)-parseInt(d._items.css("border-bottom-width"),10));d._contentSections.width(d._contentSections.width()-parseInt(d._contentSections.css("border-left-width"),10)-parseInt(d._contentSections.css("border-right-width"),10)-parseInt(d._contentSections.css("padding-left"),10)-parseInt(d._contentSections.css("padding-right"),10));if(d.mode==="default"){if(d.height!=="auto"){if(d.position==="top"){d._contentSections.css("padding-top",b)}else{d._contentSections.css("padding-bottom",b)}d._contentSections.height(d._content.height()-d._header.height()-parseInt(d._contentSections.css("border-bottom-width"),10)-parseInt(d._contentSections.css("border-top-width"),10)-1)}}else{}}else{var e;if(d.position==="left"){d._content.addClass(d.toThemeProperty("jqx-ribbon-content-left"));e=parseInt(d._contentSections.css("border-left-width"),10)+parseInt(d._contentSections.css("border-right-width"),10)+1}else{d._content.addClass(d.toThemeProperty("jqx-ribbon-content-right"));e=0}d._header.css("height",(d.host.height()-parseInt(d._header.css("padding-top"),10)-parseInt(d._header.css("padding-bottom"),10)-parseInt(d._header.css("border-top-width"),10)-parseInt(d._header.css("border-bottom-width"),10)));d._items.width(d._items.width()-parseInt(d._items.css("padding-left"),10)-parseInt(d._items.css("padding-right"),10)-parseInt(d._items.css("border-left-width"),10)-parseInt(d._items.css("border-right-width"),10));d._contentSections.height(d._contentSections.height()-parseInt(d._contentSections.css("border-top-width"),10)-parseInt(d._contentSections.css("border-bottom-width"),10)-parseInt(d._contentSections.css("padding-top"),10)-parseInt(d._contentSections.css("padding-bottom"),10));if(d.mode==="default"){if(d.width!=="auto"){if(d.position==="left"){d._contentSections.css("padding-left",c)}else{d._contentSections.css("padding-right",c)}d._contentSections.width(d._content.width()-d._header.width()-e)}}else{}}}if(d.rtl===true){d._header.addClass(d.toThemeProperty("jqx-ribbon-header-rtl"));d._items.addClass(d.toThemeProperty("jqx-ribbon-item-rtl"))}},_positionPopup:function(){var c=this;var b=(c._browser.version==="7.0"&&c._browser.browser==="msie");switch(c.position){case"top":c._content.css("top",c._header.outerHeight());break;case"bottom":if(!b){c._content.css("bottom",c._header.outerHeight())}else{c._content.css("bottom",c._header.height())}break;case"left":c._content.css("left",c._header.outerWidth());break;case"right":c._content.css("right",c._header.outerWidth());break}},_appendScrollButtons:function(){var d=this;var e='<div class="'+d.toThemeProperty("jqx-ribbon-scrollbutton")+" "+d.toThemeProperty("jqx-ribbon-scrollbutton-"+d.position)+" "+d.toThemeProperty("jqx-ribbon-scrollbutton-"+d.scrollPosition)+" "+d.toThemeProperty("jqx-widget-header")+'"><div class="'+d.toThemeProperty("jqx-ribbon-scrollbutton-inner")+'"></div></div>';var b=a(e);var f=a(e);var c=(d._orientation==="horizontal")?["left","right"]:["top","bottom"];b.find(".jqx-ribbon-scrollbutton-inner").addClass(d.toThemeProperty("jqx-icon-arrow-"+c[0]));f.find(".jqx-ribbon-scrollbutton-inner").addClass(d.toThemeProperty("jqx-icon-arrow-"+c[1]));b.addClass(d.toThemeProperty("jqx-ribbon-scrollbutton-lt"));f.addClass(d.toThemeProperty("jqx-ribbon-scrollbutton-rb"));d._scrollButtons=b.add(f);d.host.append(d._scrollButtons);if(d._orientation==="horizontal"){d._scrollButtons.height(d._header.height())}else{d._scrollButtons.width(d._header.width())}d._scrollButtonRc(b,f)},_scrollButtonRc:function(b,d){var c=this;switch(c.position){case"top":if(c.scrollPosition!=="far"){b.addClass(c.toThemeProperty("jqx-rc-tl"))}if(c.scrollPosition!=="near"){d.addClass(c.toThemeProperty("jqx-rc-tr"))}break;case"bottom":if(c.scrollPosition!=="far"){b.addClass(c.toThemeProperty("jqx-rc-bl"))}if(c.scrollPosition!=="near"){d.addClass(c.toThemeProperty("jqx-rc-br"))}break;case"left":if(c.scrollPosition!=="far"){b.addClass(c.toThemeProperty("jqx-rc-tl"))}if(c.scrollPosition!=="near"){d.addClass(c.toThemeProperty("jqx-rc-bl"))}break;case"right":if(c.scrollPosition!=="far"){b.addClass(c.toThemeProperty("jqx-rc-tr"))}if(c.scrollPosition!=="near"){d.addClass(c.toThemeProperty("jqx-rc-br"))}break}},_updateItems:function(){var c=this;c._items=c._header.children();c._contentSections=c._content.children();for(var b=0;b<c._items.length;b++){if(c._items[b]._index===undefined){c._items[b]._disabled=false;c._items[b]._isInitialized=false;c._contentSections[b]._layout="default"}c._items[b]._index=b;c._contentSections[b]._index=b}},_positionContent:function(f){var g=this;var c,k,l,h,b,j;if(g._orientation==="horizontal"){c=g.host.outerWidth();k=g.host.offset().left;l=a(g._items[f]).outerWidth();h=a(g._items[f]).offset().left;b=a(g._contentSections[f]).outerWidth();j="left"}else{c=g.host.outerHeight();k=g.host.offset().top;l=a(g._items[f]).outerHeight();h=a(g._items[f]).offset().top;b=a(g._contentSections[f]).outerHeight();j="top"}var e=a(g._contentSections[f]);var d=function(m){if(m<0){m=0}else{if(m+b>c){m=c-b}}e.css(j,m)};var i;switch(e[0]._layout){case"near":i=h-k;d(i);break;case"far":i=h-k-(b-l);d(i);break;case"center":i=h-k-(b-l)/2;d(i);break;default:e.css(j,"")}},_checkScrollButtons:function(d){var f=this;var g=0;a.each(f._items,function(){var i=a(this);if(i.css("display")!=="none"){g+=(f._orientation==="horizontal")?i.outerWidth(true):i.outerHeight(true)}});var h=f._orientation==="horizontal"?["margin-left","margin-right"]:["margin-top","margin-bottom"];var b=(f._orientation==="horizontal")?f._header.width():f._header.height();if(!f._itemMargins){f._itemMargins=new Array();f._itemMargins.push(a(f._items[0]).css(h[0]));f._itemMargins.push(a(f._items[f._items.length-1]).css(h[1]))}if(g>b){f._scrollButtons.css("display","block");var e=17;var c=17;switch(f.scrollPosition){case"near":c=0;e=34;break;case"far":c=34;e=17;break}a(f._items[0]).css(h[0],e);a(f._items[f._items.length-1]).css(h[1],c)}else{a(f._items[0]).css(h[0],f._itemMargins[0]);a(f._items[f._items.length-1]).css(h[1],f._itemMargins[1]);f._scrollButtons.css("display","none")}if(d===true){if(f._orientation==="horizontal"){f._scrollButtons.height(f._header.height())}else{f._scrollButtons.width(f._header.width())}}},_positionSelectionToken:function(h){var i=this;if(h!==-1){var e=a(i._items[h]);var j,b,d,k,g;if(i._orientation==="horizontal"){var f,m;if(i.rtl===true){if(i._browserWidthRtlFlag===1){f=i._header[0].scrollWidth-i._header[0].clientWidth}else{f=0}m=i._browserScrollRtlFlag}else{f=0;m=1}d=e[0].offsetLeft+f-i._header[0].scrollLeft*m-i._selectionTokenOffsetX+2;g=i._header.outerHeight()-1;var c=e.width()+parseInt(e.css("padding-left"),10)+parseInt(e.css("padding-right"),10);if(i.position==="top"){j=g-i._selectionTokenOffsetY;b=""}else{j="";b=g-i._selectionTokenOffsetY}i._selectionToken.css({top:j,bottom:b,left:d,width:c})}else{j=e[0].offsetTop-i._header[0].scrollTop-i._selectionTokenOffsetX+2;g=i._header.outerWidth()-1;var l=e.height()+parseInt(e.css("padding-top"),10)+parseInt(e.css("padding-bottom"),10);if(i.position==="left"){d=g-i._selectionTokenOffsetY;k=""}else{d="";k=g-i._selectionTokenOffsetY}i._selectionToken.css({top:j,left:d,right:k,height:l})}}},_updatePositions:function(b){var c=this;if(isNaN(b)){b=c.selectedIndex}if(b!==-1){c._positionSelectionToken(b);if(c.mode==="popup"&&c._contentSections[b]._layout!=="default"){c._positionContent(b)}if(c.mode==="popup"&&(c.position==="left"||c.position==="right")){c._content.width("auto");var d=c._contentSections[b].style.width&&c._contentSections[b].style.width.toString().indexOf("%")>=0;if(d){c._content[0].style.width=c._contentSections[b].style.width;c._content.width(a(c._contentSections[b]).width()-c._header.width())}else{c._content.width(a(c._contentSections[b]).width())}}}},_animationComplete:function(c,e){var d=this;d._raiseEvent("0",{selectedIndex:c});var b=e!==-1?e:null;d._raiseEvent("2",{unselectedIndex:b,selectedIndex:c});d.selectedIndex=c;if(d.initContent&&d._items[c]._isInitialized===false){d.initContent(c);d._items[c]._isInitialized=true}d._allowSelection=true;d._selecting=null},_clearSelectionComplete:function(d,b){var c=this;c._selecting=null;if(d===undefined){d=c.selectedIndex}if(d!==-1){c._raiseEvent("1",{unselectedIndex:d})}if(b!==true){c.selectedIndex=-1}},_slide:function(f,e,m,s){var q=this;if(!q.activeAnimations){q.activeAnimations=new Array()}if(q.activeAnimations.length>0){for(var k=0;k<q.activeAnimations.length;k++){q.activeAnimations[k].clearQueue();q.activeAnimations[k].finish()}}else{f.clearQueue();f.finish()}var h="ui-effects-";var d={save:function(u,v){for(var o=0;o<v.length;o++){if(v[o]!==null&&u.length>0){u.data(h+v[o],u[0].style[v[o]])}}},restore:function(u,w){var v,o;for(o=0;o<w.length;o++){if(w[o]!==null){v=u.data(h+w[o]);if(v===undefined){v=""}u.css(w[o],v)}}},createWrapper:function(o){if(o.parent().is(".ui-effects-wrapper")){return o.parent()}var u={width:o.outerWidth(true),height:o.outerHeight(true),"float":o.css("float")},x=a("<div></div>").addClass("ui-effects-wrapper").css({fontSize:"100%",background:"transparent",border:"none",margin:0,padding:0}),i={width:o.width(),height:o.height()},w=document.activeElement;try{w.id}catch(v){w=document.body}o.wrap(x);if(o[0]===w||a.contains(o[0],w)){a(w).focus()}x=o.parent();if(o.css("position")==="static"){x.css({position:"relative"});o.css({position:"relative"})}else{a.extend(u,{position:o.css("position"),zIndex:o.css("z-index")});a.each(["top","left","bottom","right"],function(y,z){u[z]=o.css(z);if(isNaN(parseInt(u[z],10))){u[z]="auto"}});o.css({position:"relative",top:0,left:0,right:"auto",bottom:"auto"})}o.css(i);return x.css(u).show()},removeWrapper:function(i){var o=document.activeElement;if(i.parent().is(".ui-effects-wrapper")){i.parent().replaceWith(i);if(i[0]===o||a.contains(i[0],o)){a(o).focus()}}return i}};var p=["position","top","bottom","left","right","width","height"],l=e.mode,t=l==="show",r=e.direction||"left",g=(r==="up"||r==="down")?"top":"left",c=(r==="up"||r==="left"),b,j={};d.save(f,p);f.show();b=e.distance||f[g==="top"?"outerHeight":"outerWidth"](true);d.createWrapper(f).css({overflow:"hidden"});if(t){f.css(g,c?(isNaN(b)?"-"+b:-b):b)}j[g]=(t?(c?"+=":"-="):(c?"-=":"+="))+b;var n=function(){f.clearQueue();f.stop(true,true)};q.activeAnimations.push(f);f.animate(j,{duration:e.duration,easing:e.easing,complete:function(){q.activeAnimations.pop(f);if(l==="show"){q._animationComplete(m,s)}else{if(l==="hide"){f.hide();q._clearSelectionComplete(m)}}d.restore(f,p);d.removeWrapper(f)}});return n}})})(jqxBaseFramework);