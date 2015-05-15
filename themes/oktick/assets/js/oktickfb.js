function set_str_status_msg(message){
	$("#str_status_msg").html(decodeURIComponent(message)+'&nbsp;');
}
function searchSubmit(){
	$( "#autocomplete-ajax").css({"background": "url('themes/oktick/assets/img/searchip.gif') no-repeat right center"});
	$( "#str_status_msg" ).html($( "#str_status_msg_searchSubmit" ).html()+'&nbsp;');
	var queryvalue = encodeURIComponent(get_clean_value('autocomplete-ajax'));
	var url = '/' + queryvalue;
	search_reset();
	window.location.replace(url);
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
	$( "#autocomplete-ajax").css({"background": "url('themes/oktick/assets/img/searchoff.gif') no-repeat right center"});
	$( "#str_status_msg" ).html('Enter Keyword (e.g. Tools, Boots, etc)');
	$( "#str_status_msg_onSearchStart" ).html('');
	$( "#str_status_msg_onSelect" ).html('');
	$( "#str_status_msg_searchSubmit" ).html('');
	$( "#str_message" ).html( '' );
	$( "#str_message" ).hide();
	$( "#main-tab-title").click();
	$( "#autocomplete-ajax" ).val('');
	$( "#tabbed_content" ).hide();
	$( "#results" ).hide();
	$('#autocomplete-ajax').focus();
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
	console.log("readmore_init inits");
	$('.wrapper').each(function() {
		try {
			if($(this).innerHeight() > 0){
				console.log("readmore_init " + $(this).attr("Class"));
				$(this).readmore({
					moreLink: '<a href="#" class="read-more-link">[+]</a>',
					lessLink: '<a href="#" class="read-less-link">[–]</a>',
					maxHeight: 50,
					speed: 200,
				});
			}
		}
		catch(err) {
			console.log("readmore_init error:" + err.message);
		}
	});
}
function dotdotdot_init() {
    return;
	console.log("dotdotdot_init inits");
	$('.wrapper').each(function() {
		console.log("dotdotdot_init inits");
		$(this).dotdotdot({
			ellipsis	 : '...',
			watch		 : true,
			wrap		 : 'word',
			fallbackToLetter: true,
			height		 : parseInt( $('.wrapper').css('line-height'), 10) * 2, // this is the number of lines
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
function onSearchStart(query) {
	$("#autocomplete-ajax").css({"background": "url('themes/oktick/assets/img/searchip.gif') no-repeat right center"});
	$( "#str_status_msg" ).html($( "#str_status_msg_onSearchStart" ).html()+'&nbsp;');
	//$('#autocomplete-ajax').autocomplete().setOptions({	deferRequestBy: 400 });
}
function onSearchComplete(query, suggestions) {
	$("#autocomplete-ajax").css({"background": "url('themes/oktick/assets/img/searchoff.gif') no-repeat right center"});
	//$( "#str_status_msg" ).html('Put in your Keyword (e.g. Pump or Valve)');
}
function onSelect (suggestion) {
	document.getElementById('autocomplete-ajax').focus();
	$("#autocomplete-ajax").autocomplete().hide();
	$("#autocomplete-ajax").css({"background": "url('themes/oktick/assets/img/searchoff.gif') no-repeat right center"});
	$("#str_status_msg" ).html($( "#str_status_msg_onSelect" ).html()+'&nbsp;');
	$("#autocomplete-suggestions" ).hide();
	$("#autocomplete-ajax").focus();
	return "#!" + suggestion.value;
}
function transformResult(response_raw, originalQuery) {
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
}

$( document ).ready(function() {
	if (!window.console) console = {};
	console.log = console.log || function(){};
	console.warn = console.warn || function(){};
	console.error = console.error || function(){};
	console.info = console.info || function(){};

//	$('#autocomplete-ajax').focus();
    $('#search').flexbox('results.aspx'); // Page that returns proper json

//window.setInterval(function(){var r;try{r=window.XMLHttpRequest?new XMLHttpRequest():new ActiveXObject("Microsoft.XMLHTTP")}catch(e){}if(r){r.open("GET","./",true);r.send(null)}},840000);
});

$(document).on("keypress", "#autocomplete-ajax", function(e) {
	if (e.which == 13) {
		$( ".autocomplete-suggestions" ).hide();
		searchSubmit();
		return false;
	}
});
