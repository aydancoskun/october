	<div class="row">&nbsp;</div>
	<div class="row">&nbsp;</div>
	<div class="row copyrightbox">
		<div class="centered twelve columns text-center footer">
 			<h6>Copyright &copy; 2002 - <?php echo $str_current_year; ?> Clive H. Whittaker. All Rights Reserved.</h6>
		</div>
	</div>
	<div id ="str_debug_msg" style="font-size: 0.7em;display: block; margin: 0px 0;line-height:12px;content: ' ';"></div>
	<div id="str_return_type" style="display:none;"></div>
	<div id="str_status_msg_default" style="display:none;"><?php echo $str_status_msg_default; ?></div>
	<div id="str_status_msg_select_keyword" style="display:none;"><?php echo $str_status_msg_select_keyword; ?></div>
	<div id="str_status_msg_select_item" style="display:none;"><?php echo $str_status_msg_select_item; ?></div>
	<div id="str_status_msg_expand" style="display:none;"><?php echo $str_status_msg_expand; ?></div>
	<div id="str_page_type" style="display:none;"><?php echo $str_page_type; ?></div>
	<div id="str_page_type_search" style="display:none;"><?php echo $str_page_type_search; ?></div>
	<div id="str_page_type_suggest" style="display:none;"><?php echo $str_page_type_suggest; ?></div>
	<div id="str_status_msg_onSearchStart" style="display:none;"><?php echo $str_status_msg_onSearchStart; ?></div>
	<div id="str_status_msg_onSearchComplete" style="display:none;"><?php echo $str_status_msg_onSearchComplete; ?></div>
	<div id="str_status_msg_onSelect" style="display:none;"><?php echo $str_status_msg_onSelect; ?></div>
	<div id="str_status_msg_searchSubmit" style="display:none;"><?php echo $str_status_msg_searchSubmit; ?></div>
	<div id="str_status_msg_onSearchStart_R" style="display:none;"></div>
	<div id="str_status_msg_onSearchComplete_R" style="display:none;"></div>
	<div id="str_status_msg_onSelect_R" style="display:none;"></div>
	<div id="str_status_msg_searchSubmit_R" style="display:none;"></div>
	<div id="searchvalue" style="display:none;"><?php echo $searchvalue; ?></div>

	<!--script>
	$('#go_submit').click(function() {
		$('#target').submit();
	});
	</script-->

	<!-- Grab Google CDN's jQuery, fall back to local if offline -->
	<!-- 2.0 for modern browsers, 1.10 for .oldie -->
	<script>
	var oldieCheck = Boolean(document.getElementsByTagName('html')[0].className.match(/\soldie\s/g));
	if(!oldieCheck) {
	document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"><\/script>');
	} else {
	document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"><\/script>');
	}
	</script>
	<script>
	if(!window.jQuery) {
	if(!oldieCheck) {
	  document.write('<script src="/js/libs/jquery-2.0.2.min.js"><\/script>');
	} else {
	  document.write('<script src="/js/libs/jquery-1.10.1.min.js"><\/script>');
	}
	}
	</script>

	<!--
	Include gumby.js followed by UI modules.
	Or concatenate and minify into a single file
	<script src="js/libs/gumby.js"></script>
	<script src="js/libs/ui/gumby.retina.js"></script>
	<script src="js/libs/ui/gumby.fixed.js"></script>
	<script src="js/libs/ui/gumby.skiplink.js"></script>
	<script src="js/libs/ui/gumby.toggleswitch.js"></script>
	<script src="js/libs/ui/gumby.checkbox.js"></script>
	<script src="js/libs/ui/gumby.radiobtn.js"></script>
	<script src="js/libs/ui/gumby.tabs.js"></script>
	<script src="js/libs/ui/gumby.navbar.js"></script>
	<script src="js/libs/ui/gumby.fittext.js"></script>
	<script src="js/libs/ui/jquery.validation.js"></script>
	<script src="js/libs/gumby.init.js"></script>-->

	<script src="/js/libs/gumby.min.js"></script>
	<script src="/js/plugins.js"></script>
	<script src="/js/main.js"></script>
	<script src="/libs/jQuery-Autocomplete/src/jquery.autocomplete.js"></script>
	<script src="/libs/jQuery-form/jquery.form.min.js"></script>
	<script src="/libs/jQuery-taconite/jquery.taconite.js"></script>
	<script src="/libs/responsive-placeholder-images/responsive-placeholder-images.js"></script>
	<script src="/libs/jQuery-readmore/readmore.js" type="text/javascript"></script>
	<script src="/libs/jQuery-dotdotdot/src/js/jquery.dotdotdot.js" type="text/javascript"></script>
	<script>
	/*
    params: 'l=jfdksl',
	https://github.com/devbridge/jQuery-Autocomplete
	*/
	$('#autocomplete-ajax').autocomplete({
	/**/
	//	serviceUrl: '/<?php echo $str_page_type_search; ?>/<?php echo $str_page_type_suggest; ?>/', SEE THE SOURCE OF AUTOCOMPLETE
	//params: {"s": "", "t": "<?php echo $str_page_type_default; ?>"},
		paramName: 'q',
    preventBadQueries: false,
    tabDisabled: true,
    autoSelectFirst: false,
    deferRequestBy: 800,
    noCache: true,
    triggerSelectOnValidInput: false,
    onSearchStart: function (query) {
    	$("#autocomplete-ajax").css({"background": "url(/img/searchip.gif) no-repeat right center"});
		 	$( "#str_status_msg" ).html($( "#str_status_msg_onSearchStart" ).html());
		 	$( "#str_status_msg_right" ).html($( "#str_status_msg_onSearchStart_R" ).html());

		//$('#autocomplete-ajax').autocomplete().setOptions({	deferRequestBy: 400	});
    },
    onSearchComplete: function (query, suggestions) {
    	$("#autocomplete-ajax").css({"background": "url(/img/searchoff.gif) no-repeat right center"});
		 	$( "#str_status_msg" ).html($( "#str_status_msg_onSearchComplete" ).html());
		 	$( "#str_status_msg_right" ).html($( "#str_status_msg_onSearchComplete_R" ).html());
    	if($("#str_return_type").html()=="P") {
//    		$( "#str_status_msg" ).html('<?php echo $str_status_msg_select_keyword; ?>');
    		return;
    	}
    	if($("#str_return_type").html()=="BP") {
//    		$( "#str_status_msg" ).html('<?php echo $str_status_msg_select_item; ?>');
    		return;
    	}
//		$( "#str_status_msg" ).html('<?php echo $str_status_msg_default; ?>');
    },
    onSelect: function (suggestion) {
//    	document.getElementById('autocomplete-ajax').focus();
   		$("#autocomplete-ajax").autocomplete().hide();
    	$("#autocomplete-ajax").css({"background": "url(/img/searchoff.gif) no-repeat right center"});
		 	$("#str_status_msg" ).html($( "#str_status_msg_onSelect" ).html());
    	$("#str_status_msg_right" ).html($( "#str_status_msg_onSelect_R" ).html());
    	$("#autocomplete-suggestions" ).hide();
			$("#autocomplete-ajax").focus();
			return suggestion.value ;

//    	$( "#str_status_msg" ).html($( "#str_status_msg_expand" ).html());
    },
    populateTextField: false,
		transformResult: function(response_raw, originalQuery) {
    	response = typeof response_raw === 'string' ? $.parseJSON(response_raw) : response_raw;
			var suggestions = response.suggestions;
			if ( ! suggestions )return response;
	    if ( ! suggestions.length ) return response;
			response.suggestions.forEach(function(value, index, theArray) {
		    theArray[index] = str_replace('&quot;','"',value);
			});
    	var message = decodeURIComponent(suggestions.pop());
	    message = str_replace(" ","",message);
			if ( message.substring(0,10) != "<taconite>" ) return response;
			$.taconite(message);
    	//$("#str_status_msg").html(message);
    	if( suggestions.length == 1){
    		$('#autocomplete-ajax').autocomplete().hide();
			//$('#autocomplete-ajax').autocomplete().setOptions({	deferRequestBy: 400000	});


    		//$('#autocomplete-ajax').autocomplete().disable();
    	}
   		response["suggestions"] = suggestions;
	 		return response;
	 	},
	});

  function searchSubmit(){
   	$( "#autocomplete-ajax").css({"background": "url(/img/searchip.gif) no-repeat right center"});
	 	$( "#str_status_msg" ).html($( "#str_status_msg_searchSubmit" ).html());
	 	$( "#str_status_msg_right" ).html($( "#str_status_msg_searchSubmit_R" ).html());

  	$.taconite.debug = true;
  	var queryvalue = get_clean_value('autocomplete-ajax');
  	var url = '/' + '<?php echo $str_page_type_search; ?>' + '/' + '<?php echo $str_page_type_submit; ?>' + '/' + queryvalue;
 		//history.pushState({}, '', url);
	// history.pushState({id: 'SOMEID'}, '', url);
  	$.get(url);
  	return false;
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
   	$( "#autocomplete-ajax").css({"background": "url(/img/searchoff.gif) no-repeat right center"});
		$( "#str_status_msg_right" ).html('');
	 	$( "#str_status_msg" ).html('<?php echo $str_status_msg_default; ?>');
	 	$( "#str_status_msg_onSearchStart" ).html('<?php echo $str_status_msg_onSearchStart; ?>');
	 	$( "#str_status_msg_onSearchComplete" ).html('<?php echo $str_status_msg_onSearchComplete; ?>');
	 	$( "#str_status_msg_onSelect" ).html('<?php echo $str_status_msg_onSelect; ?>');
	 	$( "#str_status_msg_searchSubmit" ).html('<?php echo $str_status_msg_searchSubmit; ?>');
	 	$( "#searchvalue" ).html('');
	 	$( "#str_message" ).html( '' );
	 	$( "#str_message" ).hide();
	 	$( "#main-tab-title").click();
	 	$( "#str_prime_definition" ).html( '' );
	 	$( "#str_prime_definition_tab" ).hide();
	 	$( "#str_related_items" ).html( '' );
	 	$( "#str_related_items_tab" ).hide();
	 	$( "#str_linked_items" ).html( '' );
	 	$( "#str_linked_items_tab" ).hide();
	 	$( "#str_collective_items" ).html( '' );
	 	$( "#str_collective_items_tab" ).hide();
	 	$( "#str_nicknames" ).html( '' );
	 	$( "#str_nicknames_tab" ).hide();
	 	$( "#autocomplete-ajax" ).val('');
 		$( "#tabbed_content" ).hide();

 		position_str_status_msg();
 		autocomplete_extra_param_update();
  	return false;
  }

  function autocomplete_extra_param_update(){
	  return;
  	var str_page_type = get_clean_innerHTML('str_page_type');
  	var searchvalue 	= get_clean_innerHTML('searchvalue');
	//$('#autocomplete-ajax').autocomplete().setOptions({	params: { "s": searchvalue,	"t": str_page_type,	}, });

  	var url = '/search/' + '<?php echo $str_page_type_search; ?>' + '/' + '<?php echo $str_page_type_submit; ?>' + '/' + queryvalue;

  	if(str_page_type) url = '/' + str_page_type;
  	if(searchvalue) url = url + '/' + searchvalue;
 		//history.pushState({}, '', url);
  }

  function position_str_status_msg(){
  	var pos_field = $("#autocomplete-ajax").position();
  	var width_field = $("#autocomplete-ajax").width();
  	$("#str_status_msg").css({
      position: "absolute",
      top: (pos_field.top - 24) + "px",
      left: (pos_field.left + 11) + "px",
      display: "block",
      width: width_field +"px",
  	}).show();
  	$("#str_status_msg_right").css({
      position: "absolute",
      top: (pos_field.top - 22) + "px",
      left: ((pos_field.left + 7)+(width_field/2)) + "px",
      display: "block",
      width: (width_field/2) +"px",
  	}).show();
  	$('#autocomplete-ajax').focus();
  }

	function convert_links_to_ajax() {
		var menu = "<?php echo $str_page_type_menu; ?>";
		var menulength = menu.length;
		$("a, area").click(function() {
			var href = $(this).attr("href");
			if (href == "#") return true;
//			alert(href.substr(1, menulength) + "=" + "<?php echo $str_page_type_menu; ?>");
			if(href.substr(1, menulength) == "<?php echo $str_page_type_menu; ?>") return true;
			if (href.indexOf(document.domain) > -1 || href.indexOf(':') === -1) {
      	history.pushState({}, '', href);
	    	$.get(href);
				return false;
    	}
    });
  }
    function readmore_init() {
        console.log("readmore_init inits");
        $('.wrapper').each(function() {
       	try {
            if($(this).innerHeight() > 0){
                console.log("readmore_init " + $(this).attr("Class"));
                $(this).readmore({
                  moreLink: '<a href="#" class="read-more-link">[+]</a>',
                  lessLink: '<a href="#" class="read-less-link">[&#8211;]</a>',
                  maxHeight: 50,
                  speed: 200,
                });
            }
        }
		catch(err) {
             console.log("readmore_init error:" + err.message);
		}
        });
    };

    function dotdotdot_init() {
        console.log("dotdotdot_init inits");
        $('.wrapper').each(function() {
            console.log("dotdotdot_init inits");
            $(this).dotdotdot({
                ellipsis     : '...',
                watch        : true,
                wrap         : 'word',
                fallbackToLetter: true,

                height       : parseInt( $('.wrapper').css('line-height'), 10) * 2, // this is the number of lines
            });

        });
    };

	function str_replace(search,replace,subject){
		return subject.split(search).join(replace);
	}

	$( document ).ready(function() {
    	if (!window.console) console = {};
        console.log = console.log || function(){};
        console.warn = console.warn || function(){};
        console.error = console.error || function(){};
        console.info = console.info || function(){};

		position_str_status_msg();
		convert_links_to_ajax();
	   	$.taconite.debug = true;

	 	$( window ).on("popstate", function(e) {
    	    if (e.originalEvent.state !== null) {
              	window.location.href = location.href;
    		    // window.location.replace(location.href);
        	}
  	    });
    	autocomplete_extra_param_update();
	});

	$(document).on("keypress", "#autocomplete-ajax", function(e) {
        if (e.which == 13) {
        	$( ".autocomplete-suggestions" ).hide();
		    	searchSubmit();
			    return false;
        }
	});


/*
	3085d6 blue color of buttons
    $(document).ready(function() {
        // bind 'myForm' and provide a simple callback function
        $('#okticksearch').ajaxForm(function() {
	        alert("Thank you for your comment!");
        });
    });
*/
	</script>

	<!-- Change UA-XXXXX-X to be your site's ID -->
	<!--<script>
	window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
	Modernizr.load({
	  load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
	});
	</script>-->

	<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
	   chromium.org/developers/how-tos/chrome-frame-getting-started -->
	<!--[if lt IE 7 ]>
	<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
	<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->
	</div>
  </body>
</html>
