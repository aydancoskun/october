/**
 * WebSurvey Class For Survey Builder
 * Copyright (c) 2011 Steve Hannah, All rights reserved
 */
//require <xatajax.core.js>
//require <jquery.packed.js>
//require <xataface/IO.js>
//require <jquery.json.js>
//require <jquery-ui.min.js>
//require-css <jquery-ui/jquery-ui.css>
//require-css <websurvey/websurvey.css>
(function(){

	

	var $ = jQuery;
	
	
	// A hack to fix the IE setName bug
	//http://www.matts411.com/post/setting_the_name_attribute_in_ie_dom/
	function setName(el, name){
		el.name = name;
		if ( $.browser.msie && $.browser.version < 8 ){
			el.mergeAttributes(document.createElement("<INPUT name='" + name + "'/>"), false);
		}
	
	}

	var websurvey = XataJax.load('websurvey');
	websurvey.Survey = Survey;
	websurvey.SurveyResponse = SurveyResponse;

	/**
	 * @class
	 * @name Survey
	 * @memberOf websurvey
	 *
	 * @description Encapsulates a web survey.
	 */
	function Survey(/**Object*/ o){
		this.surveyId = null;
		$.extend(this, o);
	
	}
	
	/**
	 * @function
	 * @name newResponse
	 * @memberOf websurvey.WebSurvey#
	 * @description Creates a new Response for the survey based on the HTML DOM
	 * 	element provided.
	 * @param {HTMLElement} el The DOM element that houses the survey fields.
	 * @returns {websurvey.SurveyResponse}
	 */
	function newResponse(/**HTMLElement*/ el){
		var response = new SurveyResponse({
			survey: this,
			el: el
		});
		return response;
	}
	
	
	/**
	 * @description Renders an HTML element as a survey.  This includes merging
	 * question sets and templates into their output form.
	 * @name render
	 * @memberOf websurvey.Survey#
	 * @param {HTMLElement} el The DOM Element that houses the survey.
	 * @returns {void}
	 */
	function render(/**HTMLElement*/ el){
	
	
		$('.question-set', el).each(function(){
		
			var template = $('#'+$(this).attr('template'));
			if ( template.size() == 0 ) throw "Template "+$(this).attr('template')+' could not be found.';
			
			var out = template.clone();
			$(out).removeClass('template');
			
			var questionClone = $('.questions', out).clone();
			$('.questions', out).empty();
			
			var headings = [];
			$('thead tr th', this).each(function(){
				headings.push($(this).text().replace(/^\W+/, '').replace(/\W+$/, ''));
			});
			
			
			$('tbody tr', this).each(function(){
				if ( $(this).attr('template') ){
					var currRowTemplate = $('#'+$(this).attr('template'));
					if ( currRowTemplate.size() == 0 ) throw "Template "+$(this).attr('template')+" could not be found.";
					var row = currRowTemplate.clone();
				} else {
					var row = questionClone.clone();
				}
				
				var questionEl = this;
				
				var colNum = 0;
				var vars = {};
				$('td', this).each(function(){
					vars[headings[colNum]] = $(this).text().replace(/^\W+/, '').replace(/\W+$/, '');
					colNum++;
					
				});
				
				// Now prepare the question
				$('.slot', row).each(function(){
					$(this).text(vars[$(this).attr('name')]);
				});
				
				// Now go through all attributes and see if they contain variables
				$('[name], [value]', row).each(function(){
					var currName = $(this).attr('name');
					if ( currName ){
						currName = currName.replace(/\{\$([^\}]+)\}/, function(match, $1){
							var qattr = vars[$1];
							return qattr;
						
						});
						//$('body').append('['+currName+']');
						$(this).attr('name', currName);
						setName(this, currName);
						//$('body').append($(this).attr('name'));
					}
					
					var currVal = $(this).attr('value');
					if ( currVal ){
						currVal = currVal.replace(/\{\$([^\}]+)\}/, function(match, $1){
							var qattr = vars[$1];
							return qattr;
						
						});
						
						$(this).attr('value', currVal);
					}
				});
				
				
				$('.questions', out).append($(row).children());
				
			});
			
			$(out).insertAfter(this);
			$(this).detach();
			
			
		});
		$('.template', el).detach();
		
		
		// Now do the tabs
		
		var tabs = [];
		var slideNum = 0;
		$('.slide', el).each(function(){
			var h = $('h1,h2,h3,h4,h5,h6', this).first().text();
			if ( h.length > 20 ) h = h.substr(0,20)+'...';
			var slide = {
				label: h
			};
			
			if ( !$(this).attr('id') ){
				$(this).attr('id', 'slide-'+(slideNum++));
			}
			slide.href = $(this).attr('id');
			tabs.push(slide);
		});
		
				
		if ( tabs.length > 0 ){

			var ul = $('<ul>');
			$.each(tabs, function(){
				var a = $('<a>')
					.attr('href', '#'+this.href)
					.text(this.label);
				var li = $('<li>');
				li.append(a);
				ul.append(li);
				
			});
			
			var fslide = $('.slide', el).get(0);
			
			
			var div = $('<div>');
			
			div.insertBefore(fslide);
			div.append(ul);
			div.append($('.slide', el));
			div.tabs();
		}
		
		
	}
	
	
	


	$.extend(Survey.prototype, {
	
		newResponse: newResponse,
		render: render
	});

	/**
	 * @class
	 * @name SurveyResponse
	 * @memberOf websurvey
	 * @param {Object} o
	 * @param {int} o.surveyResponseId The survey response ID (this is used for saving in the db).  If this 
	 *		is omitted, then it will start out as null and will be treated as a *new* response when 
	 *		saved.
	 * @param {websurvey.Survey} survey The survey that houses this response.
	 * 
	 * @description It is best to use the websurvey.Survey#newResponse method to create survey
	 * responses than to create them directly here.
	 */
	function SurveyResponse(/**Object*/o){
		this.surveyResponseId = null;
		this.survey = null;
		$.extend(this, o);
	
	}
	
	$.extend(SurveyResponse.prototype, {
	
		getRecordId: getRecordId,
		parse: parse,
		fill: fill,
		save: save,
		load: SurveyResponse_load,
		validate: validate,
		submit: submit,
		agreeToTerms: agreeToTerms
	});
	
	/**
	 * @function
	 * @name getRecordId
	 * @memberOf websurvey.SurveyResponse#
	 * @description Gets the Xataface Record ID of this survey response.  Returns null if
	 *	no surveyResponseId is currently set.
	 *
	 * @returns {String} The record ID of this survey response.  e.g. survey_responses?survey_response_id=10
	 */
	function getRecordId(){
		if ( this.surveyResponseId ){
			return surveyResponseIdToRecordId(this.surveyResponseId);
		} else {
			return null;
		}
	}
	
	function recordIdToSurveyResponseId(recId){
		var parts = recId.split('=');
		return parts[parts.length-1];
	}
	
	function surveyResponseIdToRecordId(id){
		return 'survey_responses?survey_response_id='+id
	
	}
	
	
	
	/**
	 * @function
	 * @name parse
	 * @memberOf websurvey.SurveyResponse
	 * @description Parses the values out of the HTML form.
	 * @returns {Object} The values stored in the form as a dictionary.  The keys are the field names
	 * while the values are the field values.
	 *
	 * @see websurvey.SurveyResponse#fill For the inverse operation.
	 */
	function parse(){
		var dom = this.el;
		var out = {};
		$('input[name], select[name], textarea[name]', dom).each(function(){
			if ( this.tagName.toLowerCase() == 'input' ){
				if ( $(this).attr('type') == 'checkbox' ){
				
					out[$(this).attr('name')] = $(this).is(':checked') ? $(this).val() : '';
				} else if ( $(this).attr('type') == 'radio' ){
					if ( $(this).is(':checked') ){
						out[$(this).attr('name')] = $(this).val();
					}
				} else {
					out[$(this).attr('name')] = $(this).val();
				}
			} else {
				out[$(this).attr('name')] = $(this).val();
			}
		
		});
		
		return out;
	
	}
	
	/**
	 * @function
	 * @name fill
	 * @memberOf websurvey.SurveyResponse#
	 * @description Fills in the survey with the values provided.
	 * @param {Object} values The values to fill in the survey with. 
	 * @returns {void}
	 */
	function fill(/**Object*/ values){
	
		var dom = this.el;
		
		
		$('input[name], select[name], textarea[name]', dom).each(function(){
		
			if ( this.tagName.toLowerCase() == 'input' ){
				
				if ( ($(this).attr('type') == 'checkbox') || ($(this).attr('type') == 'radio') ){
					//$('body').append("We are trying to fill checkbox "+$(this).attr('name'));
					if ( values[$(this).attr('name')] && (values[$(this).attr('name')] == $(this).val() )){
						//$('body').append("The checkbox "+$(this).attr('name')+" is checked");
						this.checked = true;
						$(this).attr('checked',true);
						$(this).prop('checked', true);
						
					} else {
						this.checked = false;
						$(this).removeAttr('checked');
						$(this).prop('checked', false);
						
					}
					
				} else {
					 $(this).val(values[$(this).attr('name')]);
				}
			} else {
				 $(this).val(values[$(this).attr('name')]);
			}
		
			 
		
		});
		
	}
	
	
	/**
	 * @function
	 * @name SaveCallback
	 * @memberOf websurvey.SurveyResponse
	 * @description Callback function format that can be passed to the websurvey.SurveyResponse#save
	 * method.
	 *
	 * @see <a href="http://xataface.com/dox/core/latest/jsdoc/symbols/xataface.IO.html#.UpdateCallback">xataface.IO.UpdateCallback</a> For details of the callback function.
	 *
	 */
	
	
	/**
	 * @function 
	 * @name save
	 * @memberOf websurvey.SurveyResponse#
	 * @description Saves the current survey response to the database.
	 * @param {websurvey.SurveyResponse.SaveCallback} callback A callback function that is
	 *	executed after the save is complete (succes or fail).
	 */
	function save(callback){
		
		callback = callback || function(){};
		var id = this.getRecordId();
		var self = this;
		var data = this.parse();
		
		
		//data.__proto__ = null;
		var vals = {
			response_data: $.toJSON(data)
		
		};
		if ( id ){
			xataface.IO.update(id, vals, function(res){
				callback.call(self, res);
				
			});
		} else {
			vals.survey_id = this.survey.surveyId;
			xataface.IO.insert('survey_responses', vals, function(res){
				if ( res.code == 200 ){
					self.surveyResponseId = recordIdToSurveyResponseId(res.recordId);
				}
				callback.call(self, res);
				
			});
		}
		
	}
	
	
	/**
	 * @function
	 * @name validate
	 * @memberOf websurvey.SurveyResponse#
	 * @description Validates the input in the survey to make sure that all of the
	 *  data is in place and can be submitted.  This is called just before submitting
	 *	the survey.  It is called by the submit() method so it is unnecessary to call 
	 * this separately on its own prior to calling submit().
	 *
	 * @returns {boolean} True if the survey validates and is OK to submit.
	 */
	function validate(){
		var self = this;
		var requiredFields = {};
		$('.attention', this.el).removeClass('attention');
		$('[required]', this.el).each(function(){
			if ( $(this).attr('name') ) requiredFields[$(this).attr('name')] = 1;
		});
		
		var vals = this.parse();
		var failed = 0;
		$.each(requiredFields, function(k,v){
			if ( !vals[k] ){
				failed = 1;
				$('[name="'+k+'"]', self.el).parent().addClass('attention').focus();
			}
		});
		
		return !failed;
	
	}
	
	
	/**
	 * @function
	 * @name SubmitCallback
	 * @memberOf websurvey.SurveyResponse
	 * @description Function that can be passed to websurvey.SurveyResponse#submit as a 
	 * callback function.
	 *
	 * @param {Object} Response data.  See <a href="http://xataface.com/dox/core/latest/jsdoc/symbols/xataface.IO.html#.InsertCallback">xataface.IO.InsertCallback</a> for details on the parameter structure.
	 */
	
	/**
	 * @function
	 * @name submit
	 * @memberOf websurvey.SurveyResponse#
	 *
	 * @description Submits the survey data and marks it complete.  If validation fails,
	 * then an alert dialog will be displayed indicating the failure and the method
	 * will return false.  If validation succeeds, then this method will return true
	 * but this doesn't necessarily mean the submit succeeded.   The server response
	 * is passed to the callback function so the callback function should determine
	 * the submit status based on the response code.
	 *
	 * @param {websurvey.SurveyResponse.SubmitCallback} callback  The callback function that is called 
	 *	upon completion (either failure or success).
	 *
	 */ 
	function submit(callback){
		if ( !this.validate() ){
		
			alert('Some required fields are empty.  Please fill in all required fields.');
			return false;
		}
		callback = callback || function(){};
		var self = this;
		function doSubmit(res){
			if ( res.code == 200 ){
				xataface.IO.update(self.getRecordId(), {'completed': 1}, function(res){
					if ( res.code == 200 ){
						self.completed = 1;
					}
					callback.call(self, res);
				});
			} else {
				callback.call(self, res);
			}
		}
		
		this.save(doSubmit);
		return true;
	
	
	}
	
	/**
	 * @function
	 * @name AgreeToTermsCallback
	 * @memberOf websurvey.SurveyResponse
	 * @description Callback function format that can be passed to the websurvey.SurveyResponse#agreeToTerms
	 * method to handle the server response.
	 * @param {Object} param See <a href="http://xataface.com/dox/core/latest/jsdoc/symbols/xataface.IO.html#.UpdateCallback">xataface.IO.UpdateCallback</a>
	 * for parameter format.
	 *
	 */
	
	
	/**
	 * @function 
	 * @name agreeToTerms
	 * @memberOf websurvey.SurveyResponse#
	 * @description Records that the user agrees to the terms of this survey.  This will
	 * send an AJAX request to the server to save this status.
	 *
	 * @param {websurvey.SurveyResponse.AgreeToTermsCallback} callback The callback function to call when the server returns 
	 *	its response.
	 * @returns {void}
	 */
	function agreeToTerms(callback){
		callback = callback || function(){};
		var self = this;
		xataface.IO.update(this.getRecordId(), {
			'agreed_to_terms': 1
			}, function(params){
				if ( params.code == 200 ){
					self.agreedToTerms = 1;
					self.requiresAgreement = 1;
				}
				callback.call(self, params);
			}
		);
	
	}
	
	/**
	 * @function
	 * @name LoadCallback
	 * @memberOf websurvey.SurveyResponse
	 * @description Format for callback function that can be passed to websurvey.SurveyResponse#load
	 * to handle when the response has been successfully loaded.
	 *
	 * @param {Object} data The survey data.  Key-value pairs representing the data in the survey.
	 */
	
	
	/**
	 * @function
	 * @name load
	 * @memberOf websurvey.SurveyResponse#
	 * @description Loads the survey response data from the database and fills in
	 * the HTML survey with the data contained in it.  Before this can be called,
	 * the surveyResponseId attribute must be set.
	 *
	 * This will automatically fill the HTML survey with the data.
	 *
	 * @param {websurvey.SurveyResponse.LoadCallback} callback The callback function to
	 *	call once the load is complete.
	 */
	function SurveyResponse_load(callback){
		var self = this;
		callback = callback || function(){};
		var q = {
			'-table': 'survey_responses',
			'survey_response_id': this.surveyResponseId,
			'-action': 'export_json',
			'--fields': 'response_data requires_agreement agreed_to_terms',
			'-mode': 'browse'
		};
		
		$.get(DATAFACE_SITE_HREF, q, function(res){
			if ( res && res.length > 0 ) res = res[0];
			if ( res.response_data ){
				var data = $.evalJSON(res.response_data);
				
				
				self.fill(data);
				
			} else {
				
			}
			self.requiresAgreement = res.requires_agreement;
			self.agreedToTerms = parseInt(res.agreed_to_terms);
			callback.call(self, res.response_data);
			
			
		});
		
	}
	

})();