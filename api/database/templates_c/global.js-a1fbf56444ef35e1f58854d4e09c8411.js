if ( typeof(window.console)=='undefined' ){window.console = {log: function(str){}};}if ( typeof(window.__xatajax_included__) != 'object' ){window.__xatajax_included__={};};
(function(){
					var headtg = document.getElementsByTagName("head")[0];
					if ( !headtg ) return;
					var linktg = document.createElement("link");
					linktg.type = "text/css";
					linktg.rel = "stylesheet";
					linktg.href="/api/database/index.php?-action=css&--id=find.css-ac6a0245b0577479c82ac9f4f705b396";
					linktg.title="Styles";
					headtg.appendChild(linktg);
				})();
//START xataface/modules/g2/global.js
if ( typeof(window.__xatajax_included__['xataface/modules/g2/global.js']) == 'undefined'){window.__xatajax_included__['xataface/modules/g2/global.js'] = true;
/**
 * Global Javascript Functions included in all pages when the g2 
 * module is enabled.
 *
 * @author Steve Hannah <steve@weblite.ca>
 * Copyright (c) 2011 Web Lite Solutions Corp.
 * All rights reserved.
 */








//START xatajax.actions.js
if ( typeof(window.__xatajax_included__['xatajax.actions.js']) == 'undefined'){window.__xatajax_included__['xatajax.actions.js'] = true;






//START xatajax.form.core.js
if ( typeof(window.__xatajax_included__['xatajax.form.core.js']) == 'undefined'){window.__xatajax_included__['xatajax.form.core.js'] = true;




(function(){
	var $ = jQuery;
	
	/**
	 * @class
	 * @name form
	 * @memberOf XataJax
	 * @description A class with static utility functions for working with forms.
	 */
	XataJax.form = {
		findField: findField,
		createForm: createForm,
		submitForm: submitForm
	
	};
	
	/**
	 * @function
	 * @memberOf XataJax.form
	 * @description
	 * Finds a field by name relative to a starting point.  It will search only within
	 * the startNode's form group (i.e. class xf-form-group).
	 *
	 * <p>This method of finding sibling fields is compatible with the grid widget
	 * so that it will return the sibling widget of the specified name in the same
	 * row as the source widget.  However it will also work when the widgets are
	 * displayed normally.</p>
	 *
	 * <p><b>Note:</b> This is designed to work with fields in the Xataface edit and new
	 * record forms and not just general html forms.  It looks for the <em>data-xf-field-fieldname</em>
	 * HTML attribute to identify the fields by name.  Xataface automatically adds this
	 * attribute to all fields on its forms.</p>
	 *
	 * @param {HTMLElement} startNode The starting point of our search (we search for siblings).
	 * @param {String} fieldName The name of the field we are searching for.
	 *
	 * @return {HTMLElement} The found field or null if it cannot find it.
	 *
	 * @example
	 * //require &lt;xatajax.form.core.js&gt;
	 * var form = XataJax.load('XataJax.form');
	 * var firstNameField = jQuery('#first_name');
	 * var lastNameField = form.findField(firstNameField, 'last_name');
	 * // lastNameField should contain the last name field in the same form
	 * // group as the given first name field.
	 *
	 * 
	 */
	function findField(startNode, fieldName){
		var field = null;
		
		$(startNode).parents('.xf-form-group').each(function(){
			if ( field  ){
				return;
			}
			field = $('[data-xf-field="'+fieldName+'"]', this).get(0);
		});
		
		if ( !field  ){
			var parentGroup = $(startNode).parents('form').get(0);
			field = $('[data-xf-field="'+fieldName+'"]', parentGroup).get(0);
		}
		return field;
	}
	
	
	/**
	 * @function 
	 * @memberOf XataJax.form
	 * @description
	 * Creates a form with the specified parameters.  This can be handy if you 
	 * want to submit a form dynamically and don't want to use AJAX.
	 *
	 * @param {String} method The method.  Either 'get' or 'post'
	 * @param {Object} params The key/value pairs that the form should submit.
	 * @param {String} target The target of the form.
	 * @return {HTMLElement} jQuery object wrapping the form tag.
	 *
	 * @example
	 * XataJax.form.createForm('GET', {
	 *     '-action': 'my_special_action',
	 *     'val1': 'My first value'
	 *     'val2'; 'My second value'
	 *  });
	 */
	function createForm(method, params, target, action){
		if ( typeof(action) == 'undefined' ) action = DATAFACE_SITE_HREF;
		var form = $('<form></form>')
			.attr('action', action)
			.attr('method', method);
		if ( target ) form.attr('target',target);
		
		$.each(params, function(key,value){
			form.append(
				$('<input/>')
					.attr('type', 'hidden')
					.attr('name', key)
					.attr('value', value)
					
			);
		});
		
		return form;
	}
	
	
	/**
	 * @function
	 * @memberOf XataJax.form
	 * @description
	 * Creates and submits a form with the specified parameters.
	 * @param {String} method The method of the form (e.g. get or post)
	 * @param {Object} The key/value pairs to submit with the form.
	 * @param {String} target The target of the form.
	 * @return {void}
	 *
	 * @example
	 * @example
	 * XataJax.form.submitForm('POST', {
	 *     '-action': 'my_special_action',
	 *     'val1': 'My first value'
	 *     'val2'; 'My second value'
	 *  });
	 */
	function submitForm(method, params, target, action){
		var form = createForm(method, params, target, action);
		$('body').append(form);
		form.submit();
	}
	
})();
//END xatajax.form.core.js

}
(function(){
	
	var $ = jQuery;
	
	/**
	 * @class
	 * @name actions
	 * @memberOf XataJax
	 * @description Utility functions for dealing with actions and selected actions.
	 */
	if ( typeof(XataJax.actions) == 'undefined' ){
		XataJax.actions = {};
	}
	
	XataJax.actions.doSelectedAction = doSelectedAction;
	XataJax.actions.handleSelectedAction = handleSelectedAction;
	XataJax.actions.hasRecordSelectors = hasRecordSelectors;
	XataJax.actions.getSelectedIds = getSelectedIds;
	
	/**
	 * @function
	 * @memberOf XataJax.actions
	 * @name ConfirmCallback
	 * @description
	 * A callback function that can be passed to doSelectedAction() to serve as 
	 * a confirmation to the user that they want to proceed with the action.
	 *
	 * @param {Array} recordIds An array of record ids that are to be acted upon.
	 * @returns {Boolean} true if the user confirms that they want to proceed.  False otherwise.
	 */
	
	
	/**
	 * @function
	 * @memberOf XataJax.actions
	 * @description
	 * In a result list with checkboxes to select record ids, this gets an array
	 * of the recordIds of the checked records (or a newline-delimited string).
	 *
	 * <p>This is useful for sending to Xataface actions in the --selected-ids parameter
	 * because the df_get_selected_records() function is set up to read the --selected-ids
	 * parameter and return the corresponding records.</p>
	 *
	 * @param {HTMLElement} container The HTML DOM element that contains the checkboxes.
	 * This may be the result list table or a container thereof.
	 * @param {boolean} asString If false, this will return an array of record ids.  If true,
	 * this will return the ids as a newline-delimited string.
	 * @return {mixed} Either an array of record ids or a newline-delimited string of
	 * record ids depending on the value of the <var>asString</var> parameter.
	 *
	 * @example
	 * var ids = XataJax.actions.getSelectedIds($('#result_list'), true);
	 * $.post(DATAFACE_SITE_HREF, {'-action': 'myaction', '--selected-ids': ids}, function(res){
	 *		alert("we did it");
	 * });
	 */
	function getSelectedIds(/*HTMLElement*/ container, asString){
		if ( typeof(asString) == 'undefined' ) asString = false;
		var ids = [];
		var checkboxes = $('input.rowSelectorCheckbox', container);
		checkboxes.each(function(){
			if ( $(this).is(':checked') && $(this).attr('xf-record-id') ){
				ids.push($(this).attr('xf-record-id'));
			}
		});
		if ( asString ) return ids.join("\n");
		return ids;
	
	}
	
	/**
	 * @function
	 * @memberOf XataJax.actions
	 * @description
	 * Performs an action on the currently selected records in a container.
	 *
	 * <p>Note that the selected IDs will be sent to the action in the --selected-ids
	 * POST parameter.  One record ID per line.  See df_get_selected_records() PHP function to load these records.</p>
	 *
	 * @param {Object} params The POST parameters to send to the action.
	 * @param {HTMLElement} container The container that houses the checkboxes.
	 * @param {XataJax.actions.ConfirmCallback} confirmCallback Optional callback function that can be used to prompt the user to confirm that they would like to proceed.
	 * @param {Function} emptyCallback Callback to be called if there are no records currently selected.
	 * @return {void}
	 *
	 * @example
	 * // This will perform the my_special_action action on all selected records in 
	 * // the result_list section of the page.  It looks through the checkboxes.
	 *
	 * XataJax.actions.doSelectedAction({
	 *     '-action': 'my_special_action'
	 *     },
	 *     jQuery('#result_list'),
	 *     function(ids){
	 *         return confirm('This will perform my special action on '+ids.length+' records.  Are you sure you want to proceed?');
	 *     }
	 * });
	 * 
	 */
	function doSelectedAction(/*Object*/ params, /*HTMLElement*/container, /*XataJax.actions.ConfirmCallback*/confirmCallback, /*Function*/emptyCallback){
		var ids = [];
		var checkboxes = $('input.rowSelectorCheckbox', container);
		checkboxes.each(function(){
			if ( $(this).is(':checked') && $(this).attr('xf-record-id') ){
				ids.push($(this).attr('xf-record-id'));
			}
		});

		if ( ids.length == 0 ){
			if ( typeof(emptyCallback) == 'function' ){
				emptyCallback(params, container);
			} else {
				alert('No records are currently selected.  Please first select the records that you wish to act upon.');
			}
			
			return;
		}
		
		if ( typeof(confirmCallback) == 'function' ){
			if ( !confirmCallback(ids) ){
				return;
			}
		}
		//alert(ids);
		params['--selected-ids'] = ids.join("\n");
		
		XataJax.form.submitForm('post', params);
	
	}
	
	/**
	 * @function
	 * @memberOf XataJax.actions
	 * @description
	 * Checks to see if the given element contains any selector checkboxes for selecting records.
	 *
	 * @param {HTMLElement} container  The html element to check.
	 * @return {boolean} True if it contains at least one selector checkbox.
	 */
	function hasRecordSelectors(/*HTMLElement*/container){
		return ($('input.rowSelectorCheckbox', container).size() > 0);
	}
	
	
	/**
	 * @function
	 * @memberOf XataJax.actions
	 * @description
	 * Handles a selected action that was triggered using a given link.  The link itself
	 * should contain the information about the action to be performed.
	 *
	 * @param {HTMLElement} aTag The html link that was clicked to invoke the action.  The 
	 *   href tag for this link is used as the target action to perform - except the parameters
	 *   are parsed out so that the action will ultimately be submitted via POST.
	 *
	 * @param {String} selector The selector to the container thart contains the checkboxes
	 *   representing the selected records on which to perform this action.
	 */
	function handleSelectedAction(/*HTMLElement*/ aTag, selector){
		var href = $(aTag).attr('href');
		var confirmMsg = $(aTag).attr('data-xf-confirm-message');
		var confirmCallback = null;
		if ( confirmMsg ){
			confirmCallback = function(){
				return confirm(confirmMsg);
			};
		}
		//alert(confirmMsg);
		var params = XataJax.util.getRequestParams(href);

		XataJax.actions.doSelectedAction(params, $(selector), confirmCallback);
		return false;
	
	}
	
})();
//END xatajax.actions.js

}


//START xataface/modules/g2/advanced-find.js
if ( typeof(window.__xatajax_included__['xataface/modules/g2/advanced-find.js']) == 'undefined'){window.__xatajax_included__['xataface/modules/g2/advanced-find.js'] = true;






(function(){
	var $ = jQuery;
	
	$(document).ajaxError(function(e, xhr, settings, exception) {
	   if ( !console ) return;
	   console.log(e);
	   console.log(xhr);
	   console.log(settings);
	   console.log(exception);
	});
	
	
	var g2 = XataJax.load('xataface.modules.g2');
	g2.AdvancedFind = AdvancedFind;
	
	function AdvancedFind(/**Object*/ o){
		this.table = $('meta#xf-meta-tablename').attr('content');
		this.el = $('<div>').addClass('xf-advanced-find').css('display','none').get(0);

		$.extend(this, o);
		this.loaded = false;
		this.loading = false;
		this.installed = false;
		if ( window.location.hash === '#search' ){
			this.show();
		}
	}
	
	$.extend(AdvancedFind.prototype, {
	
		load: load,
		ready: ready,
		show: show,
		hide: hide,
		install: install
	});
	
	
	function load(/**Function*/ callback){
		callback = callback || function(){};
		var self = this;
		$(this.el).load(DATAFACE_SITE_HREF+'?-table='+encodeURIComponent(this.table)+'&-action=g2_advanced_find_form', function(){
			decorateConfigureButton(this);
			var params = XataJax.util.getRequestParams();
			var widgets = [];
			var formEl = this;
			
			$('[name]', this).each(function(){
				if ( params[$(this).attr('name')] ){
					$(this).val(params[$(this).attr('name')]);
				}
				var widget = null;
				
				if ( $(this).attr('data-xf-find-widget-type') ){
					widget = $(this).attr('data-xf-find-widget-type');
				} else if ( $(this).get(0).tagName.toLowerCase() == 'select' ){
					widget = 'select';
				} 
				if ( widget ){
					widgets.push('xataface/findwidgets/'+widget+'.js');
				}
				
			});
			
			
			
			if ( widgets.length > 0 ){
				XataJax.util.loadScript(widgets.join(','), function(){
					self.loaded = true;

					callback.call(self);
					
					$('[name]', formEl).each(function(){
						if ( params[$(this).attr('name')] ){
							$(this).val(params[$(this).attr('name')]);
						}
						var widget = null;
						
						if ( $(this).attr('data-xf-find-widget-type') ){
							widget = $(this).attr('data-xf-find-widget-type');
						} else if ( $(this).get(0).tagName.toLowerCase() == 'select' ){
							widget = 'select';
						} 
						if ( widget ){
							var w = new xataface.findwidgets[widget]();
							w.install(this);
							
						}
						
					});
					
					
					$('button.xf-advanced-find-clear', formEl).click(function(){
						$('input[name],select[name]', formEl).val('');
						return false;
					});
					
					$('button.xf-advanced-find-search', formEl).click(function(){
					    $(this).parents('form').find('[name="-action"]').val('list');
						$(this)
							
							.parents('form').submit();
					});
					
					$(self).trigger('onready');
						
				});
			} else {
				
				self.loaded = true;
				callback.call(self);
				$(self).trigger('onready');
			}
		});
	}
	
	
	function ready(/**Function*/ callback){
		if ( this.loaded ){
			callback.call(this);
		} else {
			$(this).bind('onready', callback);
			if ( !this.loading ){
				this.load();
			}
		}
		
	}
	
	function install(){
		if ( this.installed ) return;
		$(this.el).insertAfter('a.xf-show-advanced-find');
		this.installed = true;
		
	}
	
	function show(){
		//alert('hello');
		
		this.ready(function(){
			window.location.hash='#search';
			//alert('now');
			if ( !this.loaded ) throw "Cannot show advanced find until it is ready.";
			//alert('here');
			if ( !this.installed ) this.install();
			
			$(this.el).parents('form').find('[name="-action"]').val('list');
			//alert('here');
			if ( !$(this.el).is(':visible') ){
				//alert(this.el);
				$(this.el).slideDown(function(){
					// Make sure it is only the width of the window.
					var x = $(this).offset().left;
					//alert(x);
					$(this).width($(window).width()-x-5);
				});
			}
		});
	}
	
	function hide(){
		this.ready(function(){
			window.location.hash = '';
			if ( !this.loaded || !this.installed ) return;
			if ( $(this.el).is(':visible') ){
				$(this.el).slideUp();
			}
		});
	}
	function decorateConfigureButton(el){
	// Decorate the show/hide columns action
		$('li.configure-advanced-find-form-action a', el).click(function(){
			var iframe = $('<iframe>')
				.attr('width', '100%')
				.attr('height', $(window).height() * 0.8)
				
				.on('load', function(){
					var winWidth = $(window).width() * 0.8;
					var width = Math.min(800, winWidth);
					$(this).width(width);
					dialog.dialog("option" , "position", "center");
					
					var showHideController = iframe.contentWindow.xataface.controllers.ShowHideColumnsController;
					showHideController.saveCallbacks.push(function(data){
						data.preventDefault = true;
						dialog.dialog('close');
						window.location.reload(true);
					});
					
				})
				.attr('src', $(this).attr('href')+'&--format=iframe')
				.get(0);
				;
			var dialog = $("<div></div>").append(iframe).appendTo("body").dialog({
				autoOpen: false,
				modal: true,
				resizable: false,
				width: "auto",
				height: "auto",
				close: function () {
					$(iframe).attr("src", "");
				},
				buttons : {
					'Save' : function(){
						$('button.save', iframe.contentWindow.document.body).click();
					}
				},
				create: function(event, ui) {
				   $('body').addClass('stop-scrolling');
				 },
				 beforeClose: function(event, ui) {
				   $('body').removeClass('stop-scrolling');
				 }
			});
			/*jQuery(iframe).dialog({
				autoOpen : true,
				modal : true,
				resizable : false,
				
				width : "auto",
				height: "auto"
			});*/
			dialog.dialog("option", "title", "Show/Hide Columns").dialog("open");
			return false;
		});
	
	}
})();
//END xataface/modules/g2/advanced-find.js

}


//START jquery.floatheader.js
if ( typeof(window.__xatajax_included__['jquery.floatheader.js']) == 'undefined'){window.__xatajax_included__['jquery.floatheader.js'] = true;
/*
	jQuery floating header plugin v1.4.0
	Licenced under the MIT License	
	Copyright (c) 2009, 2010, 2011 
		Erik Bystrom <erik.bystrom@gmail.com>

	Contributors:
		Elias Bergqvist <elias@basilisk.se>
		Diego Arbelaez <diegoarbelaez@gmail.com>
		Glen Gilbert	
		Vasilianskiy Sergey		
		Stephen J. Fuhry
      Jason Axley
*/ 
(function($){
	/**
	 * Clone the table header floating and binds its to the browser scrolling
	 * so that it will be displayed when the original table header is out of sight.
	 *
	 * The plugin defines two function on the table element.
	 * 	fhRecalculate	Recalculates with column widths of the floater.
	 *	fhInit			Recreates the floater from the source table header.
	 *
	 * @param config
	 *		An optional dictionary with configuration for the plugin.
	 *		
	 *		fadeOut		The length of the fade out animation in ms. Default: 200
	 *		fadeIn		The length of the face in animation in ms. Default: 200
	 *		forceClass	Forces the plugin to use the markerClass instead of thead. Default: false
	 *		markerClass The classname to use when marking which table rows that should be floating. Default: floating
	 *		floatClass	The class of the div that contains the floating header. The style should
	 *					contain an appropriate z-index value. Default: 'floatHeader'
	 *		cbFadeOut	A callback that is called when the floating header should be faded out.
	 *					The method is called with the wrapped header as argument.
	 *		cbFadeIn	A callback that is called when the floating header should be faded in.
	 *					The method is called with the wrapped header as argument.
	 *		recalculate	Recalculate the column width on every scroll event
	 *
	 * @version 1.4.0
    * @see http://blog.slackers.se/2009/07/jquery-floating-table-header-plugin.html
	 */
	$.fn.floatHeader = function(config) {
		config = $.extend({
			fadeOut: 200,
			fadeIn: 200,
			forceClass: false,
			markerClass: 'floating',
			floatClass: 'floatHeader',
			recalculate: false,
			IE6Fix_DetectScrollOnBody: true
		}, config);	
		
		return this.each(function () {	
			var self = $(this);
           
         var tableClone = self[0].cloneNode(false);  // only perform a shallow copy
         var table = $(tableClone);
         var cloneId = table.attr("id") + "FloatHeaderClone";
         table.attr("id", cloneId); // change the ID to avoid conflicts
         table.parent().remove();   // remove any existing float box divs for this same grid.  we may be reinitializing and don't want to keep adding these to the DOM

			self.floatBox = $('<div class="'+config.floatClass+'"style="display:none"></div>');
			self.floatBox.append(table);
			
			// Fix for the IE resize handling
			self.IEWindowWidth = document.documentElement.clientWidth;
			self.IEWindowHeight = document.documentElement.clientHeight;
			
         // DO NOT create the floater yet.  
         // Lazy-load and create it only when neccessary to improve page load time

			/*
			 * This is very specific to IE6 only if using position:fixed fixes.
			 * This requires the window overflow to be set to hidden and the
			 * containing 'body' tag to have overflow:auto.
			 */
			if (!$.browser.msie) {
				config.IE6Fix_DetectScrollOnBody = false;
			} else {
				if ($.browser.version > 7) {
					config.IE6Fix_DetectScrollOnBody = false;
				}
			}
			var scrollElement = config.IE6Fix_DetectScrollOnBody ? $('body') : $('div.fixedLeftWrapper').add(window);
			
			// bind to the scroll event
			scrollElement.scroll(function() {		
				if (self.floatBoxVisible) {		
					if (!showHeader(self, self.floatBox)) {
						// kill the floatbox			
						var offset = self.offset();
						self.floatBox.css('position', 'absolute');
						self.floatBox.css('top', offset.top);
						self.floatBox.css('left', offset.left);					
						
						self.floatBoxVisible = false;
						if (config.cbFadeOut) {
							config.cbFadeOut(self.floatBox);
						} else {
							self.floatBox.stop(true, true);
							self.floatBox.fadeOut(config.fadeOut);
						}					
					}
            } else if (showHeader(self, self.floatBox)) {
               // populate the floating header now in case it is needed (lazy load)
               // and only if we haven't yet filled in the header details 
               if (table.children().length === 0) {
                  createFloater(table, self, config);
               }                  
						
					self.floatBoxVisible = true;
					// show the floatbox
					if ($.browser.msie && $.browser.version < 7) {
						// IE6 can't handle fixed positioning; has to use absolute and additional calculation to position correctly
						// strictly speaking, this isn't necessary as it is position:absolute
						self.floatBox.css('position', 'absolute'); 
					} else {
						self.floatBox.css('position', 'fixed');
					}
					
					if (config.cbFadeIn) {
						config.cbFadeIn(self.floatBox);
					} else {
						self.floatBox.stop(true, true);					
						self.floatBox.fadeIn(config.fadeIn);
					}
				}
				
				// if the box is visible update the position
				if (self.floatBoxVisible) {
					// ie6 fix
					if ($.browser.msie && $.browser.version <= 7) {
						self.floatBox.css('top', $(window).scrollTop());
					} else {
						self.floatBox.css('top', 0);
					}
					self.floatBox.css('left', self.offset().left-$(window).scrollLeft());			
					if (config.recalculate) {		
						recalculateColumnWidth(table, self, config);
					}
				}
			});
			
			/*
			 * Unfortunately IE gets rather stroppy with the non-IE version,
			 * constantly resizing, thus cooking your CPU with 100% usage whilest
			 * the browser crashes. So, test for IE and add additional code.
			 */
			if ($.browser.msie && $.browser.version <= 7) {
				$(window).resize(function() {
					// Check if the window size has changed ()
					if ((self.IEWindowWidth != document.documentElement.clientWidth) || (self.IEWindowHeight != document.documentElement.clientHeight)) {
						// Update the client width and height with the Microsoft version.
						self.IEWindowWidth = document.documentElement.clientWidth;
						self.IEWindowHeight = document.documentElement.clientHeight;

                  if (table.children().length > 0) {
                     table.fastempty();
                     createFloater(table, self, config);
                  }
					}
				});
			} else {
				// bind to the resize event
				$(window).resize(function() {
 	            // Only redo the header cells if we have created them already
               if (table.children().length > 0) {
                  table.fastempty();
                  createFloater(table, self, config);
               }
				});
			};			

			// append the floatBox to the dom
        	$(self).after(self.floatBox);			
        	
        	// connect some convenience callbacks
			this.fhRecalculate = function() {
				recalculateColumnWidth(table, self, config);
			};
			
			this.fhInit = function() {
         	// Only redo the header cells if we have created them already
            if (table.children().length > 0) {
                table.fastempty();
                createFloater(table, self, config);
            }	
			};

         /// Creating an alternative to the jquery empty() API that is optimized for cases where you know that there are not any event handlers left on the nodes in the container you are emptying
         /// Otherwise, you could experience memory leaks.  empty() is very slow because it has to visit every DOM element and delete it individually.
         /// This function will clear out all child elements using DOM APIs. Note:  you CANNOT use innerHTML = '' as a general solution because in IE innerHTML is read-only for many, many container nodes.
         $.fn.fastempty = function() {
           if (this[0]) {
              while (this[0].hasChildNodes()) {
                   this[0].removeChild(this[0].lastChild);
               }
           }

           return this;
         };
		});
	};
	
	/**
	 * Copies the template and inserts each element into the target.
	 */
	function createFloater(target, template, config) {
		target.width(template.width());
		
		var items;
		if (!config.forceClass && template.children('thead').length > 0) {
			// set the template to the children of thead
			items = template.children('thead').eq(0).children();
			var thead = jQuery("<thead/>");
			target.append(thead);
			target = thead;
		} else {
			// set the template to the class marking
			items = template.find('.'+config.markerClass);
		}		
		
		// iterate though each row that should be floating
		items.each(function() {
			var row = $(this);
         // avoid deep clone, then removal the nodes you just cloned
         var rowClone = row[0].cloneNode(false); 
         var floatRow = $(rowClone);

			// adjust the column width for each header cell
			row.children().each(function() {
				var cell = $(this);
				var floatCell = cell.clone();
				
				floatCell.width(cell.width());
				floatRow.append(floatCell);
			});

			// append the row to the table
			target.append(floatRow);
		});	
	}
	
	/**
	 * Recalculates the column widths of the floater.
	 */
	function recalculateColumnWidth(target, template, config) {
		target.width(template.width());
		var src;
		var dst;
		if (!config.forceClass && template.children('thead').length > 0) {
			src = template.children('thead').eq(0).children().eq(0);
			dst = target.children('thead').eq(0).children().eq(0);
		} else {
			src = template.find('.'+config.markerClass).eq(0);
			dst = target.children().eq(0);
		}
		
		dst = dst.children().eq(0);
		src.children().each(function(index, element) {
			dst.width($(element).width());			
			dst = dst.next();
		});
	}
	
	/**
	 * Determines if the element is visible
	 */
	function showHeader(element, floater) {
		var elem = $(element);
		var top = $(window).scrollTop();
		var y0 = elem.offset().top;
		
		var height = elem.height()-floater.height();
		var foot = elem.children('tfoot');
		if (foot.length > 0) {
			height -= foot.height();
		}
		
		return y0 <= top && top <= y0 + height;
	}
})(jQuery);
//END jquery.floatheader.js

}
(function(){
	var $ = jQuery;
	var _ = xataface.lang.get;
	
	/**
	 * Help to format the page when it is finished loading.  Attach listeners
	 * etc...
	 */
	$(document).ready(function(){
	
		// START Left column fixes
		/**
		 * We need to hide the left column if there is nothing in it.  Helps for 
		 * page layout.
		 */
		$('#dataface-sections-left-column').each(function(){
			var txt = $(this).text().replace(/^\W+/,'').replace(/\W+$/);
			if ( !txt && $('img', this).length == 0 ) $(this).hide();
		});
		
		$('#left_column').each(function(){
			var txt = $(this).text().replace(/^\W+/,'').replace(/\W+$/);
			if ( !txt && $('img', this).length == 0) $(this).hide();
		});
		
		// END Left column fixes
	
	
	
		// START Prune List Actions
		/**
		 * We need to hide the list actions that aren't relevant.
		 */
		var resultListTable = $('#result_list').get(0);
		
		if ( resultListTable ){
		   $(resultListTable).floatHeader({recalculate:true});
			var rowPermissions = {};
			$('input.rowSelectorCheckbox[data-xf-permissions]', resultListTable).each(function(){
				var perms = $(this).attr('data-xf-permissions').split(',');
				$.each(perms, function(){
					rowPermissions[this] = 1;
				});
			});
			// We need to remove any actions for which there are no rows that can be acted upon
			$('.result-list-actions li.selected-action').each(function(){
				var perm = $(this).children('a').attr('data-xf-permission');
				if ( perm && !rowPermissions[perm]){
					$(this).hide();
				}
				
			});
			
			
		}
			
		// END Prune List Actions


		// START Adjust List cell sizes
		/**
		 * We need to improve the look of the list view so we'll calculate some 
		 * appropriate sizes for the cells.
		 */
		 /*
		$('table.listing td.field-content, table.listing th').each(function(){
			if ( $(this).width() > 200 ){
				//alert($(this).width());
				
				var div = $('<div></div')
					.css({
						'white-space': 'normal',
						'height': '1em',
						'overflow': 'hidden',
						'padding':0,
						'margin':0
					});
				$(div).append($(this).contents());
				$(this).empty();
				$(this).append(div);
				$(this).css({
					'white-space':'normal !important'
				});
				//$(this).css('white-space','normal !important').css('height','1em').css('overflow','hidden');
				
			}
		});
		*/
		$('table.listing > tbody > tr > td span[data-fulltext]').each(function(){
		    var span = this;
		    $(span).addClass('short-text');
		    var moreDiv = null;
		    var td = $(this).parent();
		    while ( $(td).prop('tagName').toLowerCase() != 'td' ){
		        td = $(td).parent();
		    }
		    td = $(td).get(0);
		    $(td).css({
                        //position : 'relative',
                        //display: 'block'
                    });
		    var moreButton = $('<a>')
		        .addClass('listing-show-more-button')
		        .attr('href','#')
		        .html('...')
		        .click(showMore).
		        get(0);
		    var lessButton = $('<a href="#" class="listing-show-less-button">...</a>').click(showLess).get(0);
		    
		    function showMore(){
		        var width = $(td).width();
		        
		        if ( moreDiv == null ){
		            var divContent = null;
		            
		            var parentA = $(span).parent('a');
		            if ( parentA.size() > 0 ){
		                
		                divContent = parentA.clone();
		                $('span', divContent)
		                    .removeClass('short-text')
		                    .removeAttr('data-fulltext')
		                    .text($(span).attr('data-fulltext'));
		            } else {
		                divContent = $(span).clone();
		                divContent.removeClass('short-text').text($(span).attr('data-fulltext'));
		            }
		                
		            var divWidth = width-$(moreButton).width()-10;
		            moreDiv = $('<div style="white-space:normal;"></div>')
		                .css('width', divWidth)
		                .append(divContent)
		                .addClass('full-text')
		                .get(0);
		            $(td).prepend(moreDiv);
		        }
		        $(td).addClass('expanded');
		        
		        
		        return false;
		        
		    }
		    
		    function showLess(){
		        $(td).removeClass('expanded');
		        return false;
		    }
		    $(td).append(moreButton);
		    $(td).append(lessButton);
		});
		$('table.listing td.row-actions-cell').each(function(){
		
			var reqWidth = 0;
			$('.row-actions a', this).each(function(){
				reqWidth += $(this).outerWidth(true);
			});
			
			$(this).width(reqWidth);
			$(this).css({
				padding: 0,
				margin: 0,
				'padding-right': '5px',
				'padding-top': '3px'
			});
			
		});


		// END Adjust List Cell Sizes
		
		
		// START Set Up Drop-Down Actions
		/**
		 * Some of the actions are drop-down menus.  We need to attach the 
		 * appropriate behaviors to them and also show the corrected "selected"
		 * state depending on which action or mode is currently selected.
		 */
		$(".xf-dropdown a.trigger")
			.each(function(){
				var atag = this;
				$(this).parent().find('ul li.selected > a').each(function(){
					$(atag).append(': '+$(this).text());
					$(atag).parent().addClass('selected');
				});
			})
			.append('<span class="arrow"></span>')
			.click(function() { //When trigger is clicked...
			
				var atag = this;
				//Following events are applied to the subnav itself (moving subnav up and down)
				if ( $(this).hasClass('menu-visible') ){
					$(this).removeClass('menu-visible');
					$(this).parent().find(">ul").slideUp('slow'); //When the mouse hovers out of the subnav, move it back up
					$('body').unbind('click.xf-dropdown');
				} else {
					$(this).addClass('menu-visible');
					$(this).parent().find(">ul")
						.each(function(){
							if ( $(atag).hasClass('horizontal-trigger') ){
								//alert($(atag).offset().top);
								var pos = $(atag).position();
								$(this)
									.css('top',0)
									.css('left', 20)
									;
									
								//$(this).offset({top: pos.top-100, left: pos.left+$(atag).outerWidth()});
								
							}
							$(this).css('z-index', 10000);
						
						})
						.slideDown('fast', function(){
							$('body').bind('click.xf-dropdown', function(){
								$(atag).trigger('click');
							});
						
						}).show(); //Drop down the subnav on click
					
				}
				return false;
				
	
			//Following events are applied to the trigger (Hover events for the trigger)
			})
			.hover(function() { 
					$(this).addClass("subhover"); //On hover over, add class "subhover"
				}, 
				function(){	//On Hover Out
					$(this).removeClass("subhover"); //On hover out, remove class "subhover"
				}
			);
		
		
		// END Set up Drop-down Actions
		
		
		// START PRUNE List actions further
		/**
		 * We previously pruned the list actions based on permissions.  Now we're going 
		 * to prunt them if there are no checkboxes. 
		 */
		//check to see if there are any checkboxes available to select
		var hasResultListCheckboxes = XataJax.actions.hasRecordSelectors($('.resultList'));
		var hasRelatedListCheckboxes = XataJax.actions.hasRecordSelectors($('.relatedList'));
		
		
		$('.selected-action a')
			.each(function(){
				if ( !hasResultListCheckboxes ){
					$(this).parent().hide();
				}
			})
			.click(function(){
				XataJax.actions.handleSelectedAction(this, '.resultList');
				return false;
			}
		);
		
		$('.related-selected-action a')
			.each(function(){
				if ( !hasRelatedListCheckboxes ){
					$(this).parent().hide();
				}
			})
			.click(function(){
				XataJax.actions.handleSelectedAction(this, '.relatedList');
				return false;
			}
		);
		
		// END PRUNE List actions further
		
		
		// Handler to set the size of the button bars and stay in correct place
		// when scrolling
		$('.xf-button-bar').each(function(){
			var bar = this;
			var container = $(bar).parent();
			var containerOffset = $(container).offset();
			if ( containerOffset  == null ) containerOffset = {left:0, top:0};
			var parentWidth = $(container).width();
			var rightBound = containerOffset.left+parentWidth;
			var windowWidth = $(window).width();
			var pos = $(this).offset();
			var left = pos.left;
			var screenWidth = $(window).width();
			//alert(screenWidth);
			var outerWidth = $(this).outerWidth();
			var excess = outerWidth+pos.left-screenWidth;
			if ( excess > 0 ){
				var oldWidth = $(this).width();
				$(this).width(oldWidth-excess);
				var newWidth = oldWidth-excess;
			}
			//$(this).outerWidth(screenWidth-pos.left);
			
			$(window).scroll(function(){
			
				var container = $(bar).parent();
				var containerOffset = $(container).offset();
				if ( containerOffset == null ) containerOffset = {left:0, top:0};
				var leftMost = containerOffset.left;
				var rightMost = leftMost + $(container).innerWidth();
				
				var currMarginLeft = $(bar).css('margin-left');
				
				var scrollLeft = $(window).scrollLeft();
				
				
				if ( scrollLeft < left ){
					$(bar).css('margin-left', -30);

					$(bar).width(Math.min(newWidth+scrollLeft, $(container).innerWidth()-10));
				} else if ( scrollLeft < excess + 60 ){
					$(bar).css('margin-left', scrollLeft-left-30);
					
				}
				
			});
			
		});
		
		
		// Make sure the list view menu doesn't show up if there's only 
		// one option in it
		$('.list-view-menu').each(function(){
			var self = this;
			if ( $('.action-sub-menu', this).children().size() < 2 ){
				$(self).hide();
			}
		
		});
		
		
		// If there is only one collapsible sidebar in a form, then we remove it
		$('form h3.Dataface_collapsible_sidebar').each(function(){
			var siblings = $(this).parent().find('>h3.Dataface_collapsible_sidebar:visible');
			if ( siblings.size() <= 1 ) $(this).hide();
		});
		
		
		$('.xf-save-new-related-record a').click(function(){
			$('form input[name="-Save"]').click();
			return false;
		});
		
		$('.xf-save-new-record a').click(function(){
			$('form input[name="--session:save"]').click();
			return false;
		});
		
		
		// START Result Controller
		/**
		 * We are handling the result controller differently in this version.
		 * We provide a popup that allows the user to change the start and limit
		 * fields with a popup dialog.
		 */
		
		$('.result-stats').each(function(){
			if ( $(this).hasClass('details-stats') ) return;
			var resultStats = this;
                        var isRelated = $(resultStats).hasClass('related-result-stats');
			var start = $('span.start', this).text().replace(/^\W+/,'').replace(/\W+$/);
			var end = $('span.end', this).text().replace(/^\W+/,'').replace(/\W+$/);
			var found = $('span.found', this).text().replace(/^\W+/,'').replace(/\W+$/);
			var limit = $('.limit-field input').val();
			
			start = parseInt(start)-1;
			end = parseInt(end);
			found = parseInt(found);
			limit = parseInt(limit);

			$(this).css('cursor', 'pointer');
			
			$(this).click(function(){
				
				var div = $('<div>')
					.addClass('xf-change-limit-dialog')
					;
					
				var label = $('<p>Show <input class="limitter" type="text" value="'+(limit)+'" size="2"/> per page starting at <input type="text" value="'+start+'" class="starter" size="2"/> </p>');
				$('input.limitter', label).change(function(){
				
					var query = XataJax.util.getRequestParams();
                                        var limitParam = '-limit';
                                        if ( isRelated ){
                                            limitParam = '-related:limit';
                                        }
					query[limitParam] = $(this).val();
					window.location.href = XataJax.util.url(query);
				}).css({
					'font-size': '12px'
				});
				$('input.starter', label).change(function(){
				
					var query = XataJax.util.getRequestParams();
                                        var skipParam = '-skip';
                                        if ( isRelated ){
                                            skipParam = '-related:skip';
                                        }
					query[skipParam] = $(this).val();
					window.location.href = XataJax.util.url(query);
				}).css({
					'font-size': '12px'
				});
				
				div.append(label);
				var offset = $(resultStats).offset();
				
				
				
				$('body').append(div);
				
				$(div).css({
					position: 'absolute',
					top: offset.top+$(resultStats).height(),
					left: Math.min(offset.left, $(window).width()-275),
					'background-color': '#bbccff',
					'z-index': 1000,
					'padding': '2px 5px 2px 10px',
					'border-radius': '5px'
				});
				$(div).show();
				$(div).click(function(e){
					e.preventDefault();
					e.stopPropagation();
				});
				
				function onBodyClick(){
					$(div).remove();
					$('body').unbind('click', onBodyClick);
				}
				setTimeout(function(){
					$('body').bind('click', onBodyClick);
				}, 1000);
				
				
			});
			
		});
		
		
		$('.details-stats').each(function(){
			var resultStats = this;
			var cursor = $('span.cursor', this).text();
			var found = $('span.found', this).text();
			cursor = parseInt(cursor);
			found = parseInt(found);
			$(this).click(function(){
				
				var div = $('<div>')
					.addClass('xf-change-limit-dialog')
					;
					
				var label = $('<p>Show <input class="limitter" type="text" value="'+(cursor)+'" size="2"/> of '+found+' </p>');
				$('input.limitter', label).change(function(){
				
					var query = XataJax.util.getRequestParams();
					query['-cursor'] = parseInt($(this).val())-1;
					window.location.href = XataJax.util.url(query);
				}).css({
					'font-size': '12px'
				});
				
				
				div.append(label);
				var offset = $(resultStats).offset();
				
				
				
				$('body').append(div);
				
				$(div).css({
					position: 'absolute !important',
					top: offset.top+$(resultStats).height(),
					left: Math.min(offset.left, $(window).width()-150),
					'background-color': '#bbccff',
					'z-index': 1000,
					'padding': '2px 5px 2px 10px',
					'border-radius': '5px'
				});
				$(div).show();
				$(div).click(function(e){
					e.preventDefault();
					e.stopPropagation();
				});
				
				function onBodyClick(){
					$(div).remove();
					$('body').unbind('click', onBodyClick);
				}
				setTimeout(function(){
					$('body').bind('click', onBodyClick);
				}, 1000);
				
				
			})
			.css('cursor', 'pointer')
			;
			
		
		});
		
		// END Result Controller
		
		// Handle search
		
		(function(){
			var searchField = $('.xf-search-field').parents('form').submit(function(){
				$(this).find(':input[value=""]').attr('disabled', true);
			});
		})();
		
		
		
		// Handle navigation storage.
		(function(){
			if ( typeof(sessionStorage) == 'undefined' ){
				sessionStorage = {};
			}
			
			
			function parseString(str){
				var parts = str.split('&');
				var out = [];
				$.each(parts, function(){
					var kv = this.split('=');
					out[decodeURIComponent(kv[0])] = decodeURIComponent(kv[1]);
				});
				return out;
			}
			
			var currTable = $('meta#xf-meta-tablename').attr('content');
			
			if ( currTable ){
				var currSearch = $('meta#xf-meta-search-query').attr('content');
				var currSearchUrl = window.location.href;
				var searchSelected = false;
				if ( !currSearch ){
					currSearch = sessionStorage['xf-currSearch-'+currTable+'-params'];
					currSearchUrl = sessionStorage['xf-currSearch-'+currTable+'-url'];
					
				} else {
					searchSelected = true;
					sessionStorage['xf-currSearch-'+currTable+'-params'] = currSearch;
					sessionStorage['xf-currSearch-'+currTable+'-url'] = currSearchUrl;
					
				}
				if ( currSearch ){
					var item = $('<li>');
					if ( searchSelected ) item.addClass('selected');
					var a = $('<a>')
						.attr('href', currSearchUrl)
						.attr('title', _('themes.g2.VIEW_SEARCH_RESULTS', 'View Search results'))
						.text(_('themes.g2.SEARCH_RESULTS', 'Search Results'));
					item.append(a);
					
					$('.tableQuicklinks').append(item);
				}
				
				
				
				var currRecord = $('meta#xf-meta-record-title').attr('content');
				var currRecordUrl = window.location.href;
				var recordSelected = false;
				if ( !currRecord ){
					currRecord = sessionStorage['xf-currRecord-'+currTable+'-title'];
					currRecordUrl = sessionStorage['xf-currRecord-'+currTable+'-url'];
					
				} else {
					recordSelected = true;
					sessionStorage['xf-currRecord-'+currTable+'-title'] = currRecord;
					sessionStorage['xf-currRecord-'+currTable+'-url'] = currRecordUrl;
					
				}
				
				
				// Record the parent record when clicking on related links.  This is used
				// by the navigator
				var currRecordId = $('meta#xf-meta-record-id').attr('content');
				if ( currRecordId ){
					(function(){

						$('a.xf-related-record-link[data-xf-related-record-id]').click(function(){
							//alert('here');
							var idKey = 'xf-parent-of-'+$(this).attr('data-xf-related-record-id');
							var idUrl = 'xf-parent-of-url-'+$(this).attr('data-xf-related-record-id');
							var idTitle = 'xf-parent-of-title-'+$(this).attr('data-xf-related-record-id');
							sessionStorage[idKey] = currRecordId;
							sessionStorage[idUrl] = currRecordUrl;
							sessionStorage[idTitle] = currRecord;
							
							return true;
							
						});
					
					})();
					
					
					
					
				}
				
				
				
				
				if ( currRecord ){
					var isChildRecord = false;
					if ( currRecordId ){
						(function(){
						
							var idKey = 'xf-parent-of-'+currRecordId;
							var idUrl = 'xf-parent-of-url-'+currRecordId;
							var idTitle = 'xf-parent-of-title-'+currRecordId;
							//sessionStorage[idKey] = currRecordId;
							//sessionStorage[idUrl] = currRecordUrl;
							//sessionStorage[idTitle] = currRecord;
						
						
							if ( sessionStorage[idUrl] ){
								var item = $('<li>');
								//if ( recordSelected ) item.addClass('selected');
								var a = $('<a>')
									.attr('href', sessionStorage[idUrl])
									.attr('title', sessionStorage[idTitle])
									.text(sessionStorage[idTitle]);
								item.append(a);
								
								$('.tableQuicklinks').append(item);
								isChildRecord = true;
							}
						
						})();
					
					
					}
				
				
					var item = $('<li>');
					if ( recordSelected ) item.addClass('selected');
					var a = $('<a>')
						.attr('href', currRecordUrl)
						.attr('title', currRecord)
						.text(currRecord);
					if ( isChildRecord ){
						$(a).addClass('xf-child-record');
					}
					item.append(a);
					
					$('.tableQuicklinks').append(item);
				}
				
				
				
				var g2 = XataJax.load('xataface.modules.g2');
				var advancedFindForm = new g2.AdvancedFind({});
					
				function handleShowAdvancedFind(){
					advancedFindForm.show();
					//$(this).text('Hide Advanced Search');
					$(this).addClass('expanded').removeClass('collapsed');
					$(this).unbind('click', handleShowAdvancedFind);
					$(this).bind('click', handleHideAdvancedFind);
				};
				
				function handleHideAdvancedFind(){
					advancedFindForm.hide();
					//$(this).text('Advanced Search');
					$(this).addClass('collapsed').removeClass('expanded');
					$(this).unbind('click', handleHideAdvancedFind);
					$(this).bind('click', handleShowAdvancedFind);
				}
				
				$('a.xf-show-advanced-find').bind('click', handleShowAdvancedFind);
				
				
				
				
				
			}
		})();
		
		
		
		
		
	
				
			
			
		
		
		
	});
	
	
	
	
	
	
})();
//END xataface/modules/g2/global.js

}

//START find.js
if ( typeof(window.__xatajax_included__['find.js']) == 'undefined'){window.__xatajax_included__['find.js'] = true;






(function(){

	jQuery(document).ready(function($){
	
	
		var instructions = $('#search-instructions');
		var instructionsLink = $('.search-instructions-link');
		
		instructionsLink.click(function(){
			var div = document.createElement('div');
			$(div)
				.addClass('search-instructions')
				.html(instructions.html())
				.dialog({
					title: 'Search Instructions',
					position: 'right',
					height: $(window).height()*0.9,
					width: $(window).width()*0.4
				
				});
				
			$('.accordion', div).accordion({
				header: 'h6'
				
			});
		});
		/*
		var firstHeading = $('.Dataface_collapsible_sidebar').get(0);
		if ( firstHeading ){
			$(firstHeading).remove();
		}*/
		
		
	});
})();
//END find.js

}
				if ( typeof(XataJax) != "undefined"  ) XataJax.ready();
				