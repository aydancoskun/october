//require <jquery.packed.js>
//require <websurvey/websurvey.js>
(function(){
	if ( typeof(console) == 'undefined' ) console = {'log': function(){}};
	if ( typeof(console.log) == 'undefined' ) console.log = function(){};
	
	var $ = jQuery;
	var Survey = XataJax.load('websurvey.Survey');
	var surveyDiv = $('div#websurvey').hide();
	var instructionsDiv = $('div#websurvey-instructions').hide();
	var thankyouDiv = $('div#websurvey-thankyou').hide();
	var agreeCb = null;
	var mouseMoved = false;
	
	
	if ( surveyDiv.size() == 0 ){
		alert('No Survey div found.');
		return;
	}
	
	
	
	
	var survey = new Survey({
		surveyId: surveyDiv.attr('survey-id')
	});
	
	
	var response = survey.newResponse(surveyDiv);
	response.surveyResponseId = $(surveyDiv).attr('survey-response-id');
	
	
	
	
	
	$(document).ready(function(){
	
		survey.render(surveyDiv);
		response.load(function(){
			if ( instructionsDiv.size() > 0 ){
				
				if ( response.requiresAgreement){
					
					agreeCb = $('<input>')
						.attr('type','checkbox')
						;
					var p = $('<p>')
						.css('font-weight', 'bold')
						.css('text-align', 'center')
					;
					
					var p2 = p.clone();
					p.append('I have read and agree to these terms');
					p.append(agreeCb);
					
					var proceedBtn = $('<button>')
						.text('Start Survey Now');
						
					proceedBtn.click(function(){
						if ( !agreeCb.is(':checked') ){
							alert('You must agree to the terms by checking the box above in order to do the survey.');
							return false;
						}
						response.agreeToTerms(function(res){
							if ( res.code == 200 ){
								instructionsDiv.fadeOut(function(){
									surveyDiv.fadeIn();
								});
							} else {
								alert("There was a problem entering the survey.  Please contact the system administrator.");
							}
						
						});
						return false;
					
					});
					
					
					p2.append(proceedBtn);
					instructionsDiv.append(p);
					instructionsDiv.append(p2);
					
					
					
					
				} else {
				
					var p = $('<p>')
						.css({
							'font-weight': 'bold',
							'text-align': 'center'
						});
					var proceedBtn = $('<button>')
						.text('Start Survey Now');
						
					proceedBtn.click(function(){
						instructionsDiv.fadeOut(function(){
							surveyDiv.fadeIn();
						});
					});
					
					p.append(proceedBtn);
					instructionsDiv.append(p);
				}
				
				if ( response.agreedToTerms ){
					surveyDiv.fadeIn();
				} else {
					instructionsDiv.fadeIn();
				}
				
			} else {
			
			
				surveyDiv.fadeIn();
			}
				
				
			// Let's make the next, back, and submit buttons
			var submitBtn = $('<button>')
				.text('Submit');
				
			
			submitBtn.click(function(){
				if ( !confirm('Are you sure you want to submit the survey now?  After submitting it you can no longer make changes to it.') ){
					return false;
				}
				
				response.submit(function(res){
					surveyDiv.fadeOut(function(){
					
						thankyouDiv.fadeIn();
					});
				});
			
			});
			
			var submitp = $('<p>')
				.css('text-align', 'center');
				
			submitp.append(submitBtn);
			surveyDiv.append(submitp);
			
			
			surveyDiv.bind('mousemove', function(){
				mouseMoved = true;
				
			});
			
			setInterval(function(){
				if ( !mouseMoved ) return;
				mouseMoved = false;
				response.save(function(res){
					
				});
			
			}, $.browser.msie ? 60000:15000);
			
				
			
		});
	});
	
	
	
	
})();