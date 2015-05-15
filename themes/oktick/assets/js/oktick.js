function set_str_status_msg(message){
	$("#str_status_msg").html(decodeURIComponent(message)+'&nbsp;');
}
function searchSubmit(){
	$( "#autocomplete-ajax").css({"background": "url('themes/oktick/assets/img/searchip.gif') no-repeat right center"});
	$( "#str_status_msg" ).html($( "#str_status_msg_searchSubmit" ).html()+'&nbsp;');
	var queryvalue = encodeURIComponent(get_clean_value('autocomplete-ajax'));
	var url = '/submit/' + queryvalue;
	$.get( url, function( data ) {
		$( "#results-container" ).html( data );
		$( "#autocomplete-ajax").css({"background": "url('themes/oktick/assets/img/searchoff.gif') no-repeat right center"});
		reset_search_box_glow();
		$( "#str_status_msg" ).html('&nbsp;');
		dotdotdot_init();
	});

//	$("#search-section").load(url);
	//search_reset();
	//window.location.replace(url);
}
function get_clean_value(id){
	var tmp = document.getElementById(id).value;
	tmp = tmp.replace(/\//g,' ');
	tmp = encodeURIComponent(tmp);
	return tmp;
}
function get_clean_innerHTML(id){
	var tmp = document.getElementById(id).innerHTML;
	tmp = tmp.replace(/\//g,' ');
	tmp = encodeURIComponent(tmp);
	return tmp;
}
function search_reset(){
	$( "#autocomplete-suggestions" ).hide();
	$( "#results-container" ).html("");
	$( "#autocomplete-ajax").css({"background": "url('themes/oktick/assets/img/searchoff.gif') no-repeat right center"});
	reset_search_box_glow();
	$( "#str_status_msg" ).html('&nbsp;');
	$( "#str_status_msg_onSearchStart" ).html('&nbsp;');
	$( "#str_status_msg_onSelect" ).html('&nbsp;');
	$( "#str_status_msg_searchSubmit" ).html('&nbsp;');
	$( "#str_message" ).html( '&nbsp;' );
	$( "#str_message" ).hide();
	$( "#main-tab-title").click();
	$( "#autocomplete-ajax" ).val('');
	$( "#tabbed_content" ).hide();
	$( "#results" ).hide();
	$('#autocomplete-ajax').focus();
}
function reset_search_box_glow(){
	$( "#autocomplete-ajax").removeClass('no-glow');
}
function remove_search_box_glow(){
	$( "#autocomplete-ajax").addClass('no-glow');
}
function convert_links_to_ajax() {
	var menu = "/_";
	var menulength = menu.length;
	$("a, area").click(function() {
		var href = $(this).attr("href");
		if (href == "#") return true;
		var is_menu = strpos(href,menu);
		if(is_menu !== false) return true;
		if (href.indexOf(document.domain) > -1 || href.indexOf(':') === -1) {
			history.pushState({}, '', href);
			$.get(href);
			return false;
		}
	});
}
function readmore_init() {
	return;
//	console.log("readmore_init inits");
	$('.wrapper').each(function() {
		try {
			if($(this).innerHeight() > 0){
//				console.log("readmore_init " + $(this).attr("Class"));
				$(this).readmore({
					moreLink: '<a href="#" class="read-more-link">[+]</a>',
					lessLink: '<a href="#" class="read-less-link">[–]</a>',
					maxHeight: 50,
					speed: 200,
				});
			}
		}
		catch(err) {
//			console.log("readmore_init error:" + err.message);
		}
	});
}
function dotdotdot_init() {
//	console.log("dotdotdot_init inits");
	$('.dot-dot-dot').each(function() {
//		console.log("dotdotdot_init inits");
		$(this).dotdotdot({
			ellipsis	 : '...',
			watch		 : true,
			wrap		 : 'word',
			fallbackToLetter: true,
			height		 : parseInt( $('.dot-dot-dot').css('line-height'), 10) * 1, // this is the number of lines
		});
	});
}
function str_replace(search,replace,subject){
	return subject.split(search).join(replace);
}
function strpos (haystack, needle, offset) {
	var i = (haystack+'').indexOf(needle, (offset || 0));
	return i === -1 ? false : i;
}
$( document ).ready(function() {
    var dev=false;
	if (!window.console) console = {};
	console.log = console.log || function(){};
	console.warn = console.warn || function(){};
	console.error = console.error || function(){};
	console.info = console.info || function(){};
//	$( "#autocomplete-ajax" ).val('Search...');
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
	$('#autocomplete-ajax').focus();
	//																						convert_links_to_ajax();
	//history.pushState(data, event.target.textContent, event.target.href);
	/*
	var stateObj = { foo: "bar" };
	history.pushState(stateObj, "", location.href);
	$( window ).on("popstate", function(e) {
		if (e.originalEvent.state !== null) {
			window.location.href = "http://oktick.com";
			//	  window.location.replace(location.href);
		}
	});
	*/
	//																		$('.hasTooltip').tooltip({"html": true,"container": "body"});
//	https://github.com/devbridge/jQuery-Autocomplete
//	serviceUrl: '/', SEE THE SOURCE OF AUTOCOMPLETE
	if(dev) console.log("autocomplete init");
	$('#autocomplete-ajax').autocomplete({
		paramName: 'suggest',
		preventBadQueries: false,
		tabDisabled: true,
		autoSelectFirst: false,
		deferRequestBy: 800,
		noCache: true,
		triggerSelectOnValidInput: false,
		populateTextField: false,
		onSearchStart: function (query) {
    		if(dev) console.log("autocomplete onSearchStart");
    		if(dev) console.log(query);
    		var len = query.suggest.trimLeft();
    		len = len.length;
    		if(dev) console.log("len="+len);
    		if(len < 2) return false;
			$("#autocomplete-ajax").css({"background": "url('/themes/oktick/assets/img/searchip.gif') no-repeat right center"});
			$( "#str_status_msg" ).html($( "#str_status_msg_onSearchStart" ).html()+'&nbsp;');
//   			query.suggest = encodeURIComponent(query.suggest+"~");
			return;
		},
		onSearchComplete: function (query, suggestions) {
        	if(dev) console.log("autocomplete onSearchComplete");
			remove_search_box_glow();
			$("#autocomplete-ajax").css({"background": "url('themes/oktick/assets/img/searchoff.gif') no-repeat right center"});
			//$( "#str_status_msg" ).html('Put in your Keyword (e.g. Pump or Valve)');
		},
		onSelect: function (suggestion) {
			document.getElementById('autocomplete-ajax').focus();
			$("#autocomplete-ajax").autocomplete().hide();
			$("#autocomplete-ajax").css({"background": "url('themes/oktick/assets/img/searchoff.gif') no-repeat right center"});
			$("#str_status_msg" ).html($( "#str_status_msg_onSelect" ).html()+'&nbsp;');
			$("#autocomplete-suggestions" ).hide();
			$("#autocomplete-ajax").focus();
			return "#!" + suggestion.value;
		},
		transformResult: function(response_raw, originalQuery) {
        	if(dev) console.log("autocomplete transformResult");
			response = typeof response_raw === 'string' ? $.parseJSON(response_raw) : response_raw;
			var suggestions = response.suggestions;
			if ( ! suggestions ) return response;
			if ( ! suggestions.length ) return response;
			response.suggestions.forEach(function(value, index, theArray) {
				theArray[index] = str_replace('"','"',value);
			});
			var message = decodeURIComponent(suggestions.pop());
			message = str_replace(" ","",message);
			//alert(message);
			//if ( message.substring(0,10) != "<messages>" ) return response;
			set_str_status_msg(message);
			if( suggestions.length == 1){
				$('#autocomplete-ajax').autocomplete().hide();
			}
			response["suggestions"] = suggestions;
			return response;
		},
	});
});

//window.setInterval(function(){var r;try{r=window.XMLHttpRequest?new XMLHttpRequest():new ActiveXObject("Microsoft.XMLHTTP")}catch(e){}if(r){r.open("GET","./",true);r.send(null)}},840000);

$(document).on("keypress", "#autocomplete-ajax", function(e) {
	if (e.which == 13) {
		$( ".autocomplete-suggestions" ).hide();
		searchSubmit();
		return false;
	}
});

// COOKIE LAW COMPLIANCE JS ####################################################
// Based on Creare's EU Cookie Law Banner http://www.creare.co.uk
// Created by Rob Kent, Tom Foyster & James Bavington
// Amended and updated by Carlos González
// Addapted for OKticK by leancode

$( document ).ready(function() {
	var cookieDuration = '365';//days before we alert again
	var dev=false;
	if(dev) console.log("Cookie Law Init");

// delete the below out once dev is finished
	if (dev) eraseCookie('CookieComplianceCookie',dev);

	if (getCookieValue(dev) != 'On') {
		$('#cookie-law').show();
        // make visible & create cookie
		createCookie(cookieDuration,dev);
        setTimeout(function() {
        	if(dev) console.log("Cookie Law setTimeout fired");
			$('#cookie-law').fadeOut();
        }, 20000);
    } else {
		$('#cookie-law').hide();

    }
});

function createCookie(days,dev) {
    var value="On";
	if(dev) console.log("Cookie Law Init: createCookie");
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}else {
		var expires = "";
	}
	document.cookie = "CookieComplianceCookie="+value+expires+"; path=/";
}

function getCookieValue(dev) {
	var nameEQ = "CookieComplianceCookie=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) {
        	if(dev) console.log("Cookie Law Init: getCookieValue='"+c.substring(nameEQ.length,c.length)+"'");
		    return c.substring(nameEQ.length,c.length);
		}
	}
	if(dev) console.log("Cookie Law Init: getCookieValue=Cookie does not exist");
	return null;
}

function eraseCookie(name,dev) {
	if(dev) console.log("Cookie Law Init: eraseCookie");
	createCookie(-1,dev);
}

// RESPONSIVE PLACEHOLDER IMAGES JS ############################################

(function() {

	// Only load images if the browser 'cuts the mustard' <http://responsivenews.co.uk/post/18948466399/cutting-the-mustard/>
	if ( ! document.addEventListener || ! document.querySelector) {
		return false;
		//alert("This page is \"cutting the mustard\" and your browser didn't make it.");
	}

	var deferImage = function(element) {
		var i, len, attr;
		var img = new Image();
		var placehold = element.children[0];

		element.className+= ' is-loading';

		img.onload = function() {
			element.className = element.className.replace('is-loading', 'is-loaded');
			element.replaceChild(img, placehold);
		};

		for (i = 0, len = placehold.attributes.length; i < len; i++) {
			attr = placehold.attributes[i];
			if (attr.name.match(/^data-/)) {
				img.setAttribute(attr.name.replace('data-', ''), attr.value);
			}
		}
	}

	document.addEventListener('DOMContentLoaded', function() {
		var placeholders = document.querySelectorAll('.defer-image');
		for (var i = 0, len = placeholders.length; i < len; i++) {
			deferImage(placeholders[i]);
		}
	});

})();

//plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number').click(function(e){
    e.preventDefault();

    fieldName = $(this).attr('data-field');
    console.log(fieldName);
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {

            if(currentVal > input.attr('data-min')) {
                input.val(currentVal - 1).change();
            }
            if(parseInt(input.val()) == input.attr('data-min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('data-max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('data-max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {

    minValue =  parseInt($(this).attr('data-min'));
    maxValue =  parseInt($(this).attr('data-max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        //alert('Sorry, the minimum value was reached');
        $(this).val(minValue);
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        //alert('Sorry, the maximum value was reached');
        $(this).val(maxValue);
    }


});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
