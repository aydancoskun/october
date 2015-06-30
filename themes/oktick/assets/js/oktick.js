function set_str_status_msg(message){
	$("#str_status_msg").html(decodeURIComponent(message)+'&nbsp;');
}

function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function searchSubmit(){
//	$( ".autocomplete-suggestions" ).hide();
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
	if (true) return;
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
        $('[data-toggle="tooltip"]').tooltip();
    });
    $(function () {
        $('[data-toggle="popover"]').popover();
    });
	//$('#autocomplete-ajax').focus();
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
		serviceUrl: 'suggest',
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
			response.suggestions = suggestions;
			return response;
		},
	});
});

//window.setInterval(function(){var r;try{r=window.XMLHttpRequest?new XMLHttpRequest():new ActiveXObject("Microsoft.XMLHTTP")}catch(e){}if(r){r.open("GET","./",true);r.send(null)}},840000);

$(document).on("keypress", "#autocomplete-ajax", function(e) {
	if (e.which == 13) {
//		$( ".autocomplete-suggestions" ).hide();
		searchSubmit();
		return false;
	}
});
$('#submit-button').click(function(event){
    event.preventDefault();
//	$( ".autocomplete-suggestions" ).hide();
	searchSubmit();
	return false;
})
$('#add-ps-button').click(function(event){
    event.preventDefault();
//	$( ".autocomplete-suggestions" ).hide();
	addpsSubmit();
	return false;
})

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
    var expires="";
	if(dev) console.log("Cookie Law Init: createCookie");
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		expires = "; expires="+date.toGMTString();
	}
	document.cookie = "CookieComplianceCookie="+value+expires+"; path=/";
}

function getCookieValue(dev) {
	var nameEQ = "CookieComplianceCookie=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) === 0) {
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
	};

	document.addEventListener('DOMContentLoaded', function() {
		var placeholders = document.querySelectorAll('.defer-image');
		for (var i = 0, len = placeholders.length; i < len; i++) {
			deferImage(placeholders[i]);
		}
	});
})();

function getEstimatedPosition(credits_estimated,type,boundaryValue,estimated_position){
    if(credits_estimated >= parseInt($('#ok_credits').attr('data-value')) && type=="plus"){
        boundaryValue=credits_estimated;
    };
    if(estimated_position=="1" && type=="plus"){
        $( '#estimated-position'+bp_id ).val("1");
        setTimeout(function(){
            $( '#btn-confirm' + bp_id).css( "visibility","visible" );
            reset_attributes(credits_estimated,type,boundaryValue);
        }, 100);
        return;
    } else {
        $.request('onGetEstimatedPosition', {
            data: {
                bp_id: bp_id, 
                credits_estimated: credits_estimated,
            },
            success: function(data) {
                console.log('getEstimatedPosition success '+type+'=' + data.estimatedPosition);
                $( '#estimated-position'+bp_id ).val(data.estimatedPosition);
                $( '#btn-confirm' + bp_id).css( "visibility","visible" );
                reset_attributes(credits_estimated,type,boundaryValue);
            },
            error: function(data) {// Assign handlers immediately after making the request,
                var tmp = data.responseText.split('"');
                var msg = tmp[1];
                alert(msg);
                $( '#estimated-position' + bp_id ).val("--------");
                $( '#btn-confirm' + bp_id).css( "visibility","visible" );
                reset_attributes(credits_estimated,type,boundaryValue);
            }
        });
    }
}
function getOriginalPosition(current_credits,type,boundaryValue,current_position){
    $( '#btn-confirm'+bp_id ).css( "visibility","hidden" );
//    $( '#estimated-position'+bp_id ).val(current_position);
    $( '#estimated-position'+bp_id ).val("--------");
    $( '#btn-confirm' + bp_id).css( "visibility","hidden" );
    reset_attributes(current_credits,type,boundaryValue);
    return;
}
function set_attributes(type,current_credits) {
    $( '#btn-credit-' + type + bp_id ).removeClass('btn-default');
    $( '#btn-credit-' + type + bp_id ).addClass('btn-warning');
    $( '#glyphicon-'  + type + bp_id ).removeClass('glyphicon-'+type);
    $( '#glyphicon-'  + type + bp_id ).addClass('glyphicon-refresh');
    $( '#btn-confirm' + bp_id ).attr('disabled', true);
    $( '#btn-confirm' + bp_id).css( "visibility","visible" );
    $( '#btn-credit-plus' + bp_id).attr('disabled', true);
    $( '#btn-credit-minus' + bp_id).attr('disabled', true);
    $('#credit'+bp_id).val(current_credits);
}
function reset_attributes(current_credits,type,boundaryValue) {
    $( '#btn-credit-' + type + bp_id ).removeClass('btn-warning');
    $( '#btn-credit-' + type + bp_id ).addClass('btn-default');
    $( '#glyphicon-'  + type + bp_id ).removeClass('glyphicon-refresh');
    $( '#glyphicon-'  + type + bp_id ).addClass('glyphicon-'+type);
    $( '#btn-confirm' + bp_id ).removeAttr('disabled');
    $( '#btn-credit-plus' + bp_id).removeAttr('disabled');
    $( '#btn-credit-minus' + bp_id).removeAttr('disabled');
    if( current_credits == boundaryValue ) $( '#btn-credit-' + type + bp_id).attr('disabled', true);
}
$('.btn-credit').click(function(event){
    event.preventDefault();
    bp_id = $(this).attr('data-bp_id');
    type = $(this).attr('data-type'); //plus or minus
    
    // REMOVING OLD BUTTONS IF JUMPED LINE
    if(previous.bp_id != false && previous.bp_id != bp_id){
        console.log("Restore previous buttons");
        var previous_bp_user_credits = $('#bp' + previous.bp_id).attr('data-bp_user_credits');
        $( '#estimated-position'+previous.bp_id ).val("--------");
        $( '#btn-confirm' + previous.bp_id).css( "visibility","hidden" );
        $( '#btn-confirm' + previous.bp_id ).removeAttr('disabled');
        $( '#glyphicon-minus' + previous.bp_id ).removeClass('glyphicon-refresh');
        $( '#glyphicon-minus'  + previous.bp_id ).addClass('glyphicon-minus');
        $( '#glyphicon-plus' + previous.bp_id ).removeClass('glyphicon-refresh');
        $( '#glyphicon-plus'  + previous.bp_id ).addClass('glyphicon-plus');
        $( '#btn-credit-plus' + previous.bp_id).removeClass('btn-warning');
        $( '#btn-credit-minus' + previous.bp_id).removeClass('btn-warning');
        $( '#btn-credit-plus' + previous.bp_id).addClass('btn-default');
        $( '#btn-credit-minus' + previous.bp_id).addClass('btn-default');
        $( '#btn-credit-plus' + previous.bp_id).removeAttr('disabled');
        if( previous_bp_user_credits =="" || previous_bp_user_credits ==0) {
            $('#credit' + previous.bp_id).val( "0" );
            $('#btn-credit-minus' + previous.bp_id).attr('disabled', true);
        } else {
            $('#credit' + previous.bp_id).val( previous_bp_user_credits );
            $( '#btn-credit-minus' + previous.bp_id).removeAttr('disabled');
        }
    }
    previous.bp_id = bp_id;
    
    var credit_field = $('#credit'+bp_id);
    var bp_user_credits = $('#bp'+bp_id).attr('data-bp_user_credits');
    var current_credits = parseInt(credit_field.val());
    var estimated_position = $('#estimated-position'+bp_id).val();
    var current_position = $('#current-position'+bp_id).val();
    
    if (isNaN(current_credits)) {
        credit_field.val(0);
        return;
    }

    var minValue =  credit_field.attr('data-max-minus');
    var maxValue =  credit_field.attr('data-max-plus');
    if(type == 'minus') {
        if(current_credits > minValue) {
            current_credits = current_credits -1;
            set_attributes(type,current_credits)
            if(current_credits == bp_user_credits) {
                getOriginalPosition(current_credits,type,minValue,current_position);
            } else {
                getEstimatedPosition(current_credits,type,minValue,estimated_position);
            }
        }
    } else if(type == 'plus') {
        if(current_credits < maxValue) {
            current_credits = current_credits +1;
            set_attributes(type,current_credits)
            if(current_credits == bp_user_credits) {
                getOriginalPosition(current_credits,type,minValue,current_position);
            } else {
                getEstimatedPosition(current_credits,type,maxValue,estimated_position);
            }
        }
    }
});
$('.btn-confirm').click(function(event){
    event.preventDefault();
    bp_id = $(this).attr('data-bp_id');
    $( '#btn-confirm' + bp_id ).attr('disabled', true);
    $( '#btn-credit-plus'  + bp_id).attr('disabled', true);
    $( '#btn-credit-minus' + bp_id).attr('disabled', true);
    $( '#glyphicon-confirm' + bp_id ).removeClass('glyphicon-ok');
    $( '#glyphicon-confirm' + bp_id ).addClass('glyphicon-refresh');
    
    var credits_confirmed = $('#credit' + bp_id).val();
    if(!credits_confirmed) credits_confirmed="0";
    $.request('onCreditConfirm', {
        data: {
            bp_id: bp_id, 
            credits_confirmed: credits_confirmed,
        }
    })
    .always(function( data, textStatus, errorThrown ) {
            if(data.status=="error"){
                console.log(data.log);
                alert(data.message);
                $( '#btn-confirm' + bp_id ).removeAttr('disabled');
                $( '#btn-credit-plus'  + bp_id).removeAttr('disabled');
                $( '#btn-credit-minus' + bp_id).removeAttr('disabled');
                $( '#glyphicon-confirm' + bp_id ).removeClass('glyphicon-refresh');
                $( '#glyphicon-confirm' + bp_id ).addClass('glyphicon-ok');
                return
            }
        //success: function(data) {
            console.log(textStatus);
            //console.log('Setting $("#ok_credits").text('+data.ok_credits+')');
            var total_credits=data.ok_credits;
            if(total_credits < 0) total_credits = 0;
            $('#ok_credits').text(total_credits.toFixed(2));
            if (data.badge_active == 1){
                $( '#badge_active' ).text(Math.round($("#badge_active").text())+1);
                $( '#row' + bp_id ).addClass('success');
            }
            else if(data.badge_active == -1){
                $('#badge_active').text(Math.round($("#badge_active").text())-1);
                $( '#row' + bp_id ).removeClass('success');
            }
            
            $('#current-position' + bp_id).val($( '#estimated-position'+bp_id ).val());
            $( '#estimated-position' + bp_id ).val("--------");
            $( '#bp' + bp_id).attr('data-bp_user_credits', credits_confirmed);
            $( '#end_stamp' + bp_id ).val(data.end_stamp);

//            var badge_total = Math.round($("#badge_total").text()) + data.badge_total;
//            console.log('Setting $("#badge_total").text('+badge_total+')');
//            $('#badge_total').text(badge_total);
            
            $( '#btn-confirm' + previous.bp_id).css( "visibility","hidden" );
            $( '#btn-confirm' + bp_id ).removeAttr('disabled');
            $( '#glyphicon-confirm' + bp_id ).removeClass('glyphicon-refresh');
            $( '#glyphicon-confirm' + bp_id ).addClass('glyphicon-ok');
            $( '#btn-credit-plus'  + bp_id).removeAttr('disabled');
            if(credits_confirmed > 0) $( '#btn-credit-minus' + bp_id).removeAttr('disabled');
            else $( '#btn-credit-minus' + bp_id).attr('disabled', true);
//        },
/*        error: function(data) {// Assign handlers immediately after making the request,
            console.log('error');
            var tmp = data.responseText.split('"');
            var msg = tmp[1];
            alert(msg);
//            $( '#credit' + bp_id).removeAttr('disabled');
            $( '#btn-confirm' + bp_id ).removeAttr('disabled');
            $( '#btn-credit-plus'  + bp_id).removeAttr('disabled');
            $( '#btn-credit-minus' + bp_id).removeAttr('disabled');
            $( '#glyphicon-confirm' + bp_id ).removeClass('glyphicon-refresh');
            $( '#glyphicon-confirm' + bp_id ).addClass('glyphicon-ok');
        }
*/        
    });
});
$('.btn-delete').click(function(event){
    var types = [BootstrapDialog.TYPE_DEFAULT, 
                     BootstrapDialog.TYPE_INFO, 
                     BootstrapDialog.TYPE_PRIMARY, 
                     BootstrapDialog.TYPE_SUCCESS, 
                     BootstrapDialog.TYPE_WARNING, 
                     BootstrapDialog.TYPE_DANGER];
    event.preventDefault();
    bp_id = $(this).attr('data-bp_id');
    var bp_name = $('#bp'+bp_id).text();
    BootstrapDialog.show({
        title: 'WARNING - Product Deletion!',
        message: 'Are you sure you want to permanently delete "'+bp_name.trim()+'"?',
        type: BootstrapDialog.TYPE_DANGER,
        size: BootstrapDialog.SIZE_SMALL,
        buttons: [{
            label: 'Yes',
            //icon: 'glyphicon glyphicon-remove',
            cssClass: 'btn-danger',
            action: function(dialog) {
                $.request('onProductDelete', {
                    data: {
                        bp_id: bp_id, 
                    }
                })
                .always(function( data, textStatus, errorThrown ) {
                    $('#row'+bp_id).hide();
                    dialog.close();
                });
            }
        }, {
            label: 'No',
            action: function(dialog) {
                dialog.close();
            }
        }]
    });
});
$('.help').click(function(event){
    event.preventDefault();
    var id = $(this).attr('id').replace('_off','').replace('_on','');
    var onoff = $(this).attr('id').replace(id,'');
    if (onoff=="_off"){
        console.log("Help off called");
        console.log("Hidding:'"+id+"'");
        $("#"+id).hide();
        console.log("Showing:'"+id+"_on'");
        $("#"+id+"_on").show();
    }
    if (onoff=="_on"){
        console.log("Help on called");
        console.log("Showing:'"+id+"'");
        $("#"+id).show();
        console.log("Hiding:'"+id+"_on'");
        $("#"+id+"_on").hide();
    }
    $.request('onHelp',{data: {store: id,state: onoff}});
})
$('#btn-add').click(function(event){
    event.preventDefault();
    console.log("adding");
    bp = $('#autocomplete-ajax').val();
    console.log("adding"+bp);
    BootstrapDialog.show({
        title: 'Confirmation',
        message: 'Do you confirm you are a supplier of "'+bp+'" and that it is mentioned on your website?',
        type: BootstrapDialog.TYPE_PRIMARY,
        size: BootstrapDialog.SIZE_SMALL,
        buttons: [{
            label: 'Yes',
            //icon: 'glyphicon glyphicon-remove',
            cssClass: 'btn-primary',
            action: function(dialog) {
                $('#autocomplete-ajax').val('');

//                $.request('onProductDelete', {
//                    data: {
//                        bp_id: bp_id, 
//                    }
//                })
//                .always(function( data, textStatus, errorThrown ) {
//                    $('#row'+bp_id).hide();
                    dialog.close();
//                });
            }

        }, {
            label: 'No',
            action: function(dialog) {
                dialog.close();
            }
        }]
    });
});
