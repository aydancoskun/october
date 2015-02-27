<?php echo $this->render('header.htm',$this->mime,get_defined_vars()); ?>
<body style="background-color:#fcfcfc !important;">
<div class="row" id="container1" >
<div class="navbar row" id="nav1" >
		<ul class="twelve columns">
			<?php echo $str_navigation; ?>
		</ul>
</div>
<?php if ($git_message != ''): ?>
	
		<h6><?php echo $git_message; ?></h6>
	
<?php endif; ?>

<?php echo $this->render('logo.htm',$this->mime,get_defined_vars()); ?>
		<div class="row">
			<div class="centered twelve columns text-center">
				<h4 id = "str_title"><?php echo $str_title; ?></h4>
			</div>
		</div>
<div class="row" >&nbsp;</div>
<div class="row" >
	<div class="centered twelve columns text-center" id="outer_common">
		<div id="str_status_msg" style="display:none; text-align:left; font-weight: 600; color: #3085d6"><?php echo $str_status_msg; ?></div>
		<div id="str_status_msg_right" style="display:none; text-align:right;"></div>
		<form id="okticksearch" action="/<?php echo $str_page_type_search; ?>/<?php echo $str_page_type_submit; ?>/<?php echo $searchvalue; ?>" method="GET">
			<ul>
				<li class="prepend append field">
		    	<div class="medium primary pill-left btn" >
		    		<a href="#" onclick="search_reset();return false;">&nbsp;&nbsp;Clear&nbsp;&nbsp;</a>
     			</div>
		    	<!--div class="medium primary btn" -->
						<!--a id="go_submit" href="/<?php echo $str_page_type_search; ?>" onclick="search_reset();return false;">&nbsp;</a-->
						<!--input id="go_back_submit" type="submit" name="go" value="Back" /-->
     			<!--/div-->
     			<input class="wide text input" type="text" name="q" id="autocomplete-ajax" placeholder="<?php echo $str_instruction_in_field; ?>" />
     			<!--style="position: absolute; z-index: 2; background: transparent;"/-->
     			<!--input type="text" name="q" id="autocomplete-ajax-x" disabled="disabled" style="color: #CCC; position: absolute; background: transparent; z-index: 1;"/-->
					<!--div class="medium primary btn" -->
						<!--a id="go_submit" href="/<?php echo $str_page_type; ?>/<?php echo $str_page_type_submit; ?>/<?php echo $searchvalue; ?>" onclick="searchSubmit();return false;">&nbsp;</a-->
						<!--input id="go_submit" class="medium primary btn" type="submit" name="action" value="Search" onclick="searchSubmit();return false;" /-->
					<!--/div-->
		    	<div class="medium primary pill-right btn" >
		    		<a href="#" onclick="searchSubmit();return false;">Search</a>
     			</div>
				</li>
			</ul>
		</form>
	</div>
</div>
<!--div class="row" >
	<div class="centered twelve columns text-center">
		"The easy way to find products and services for home and industry"
    </div>
</div-->
<div class="row" >
	<div class="centered twelve columns text-center">
		&nbsp;
    </div>
</div>
<div class="row" id="tabbed_content" style="display:none;">
	<div class="centered twelve columns text-left">
		<section class="tabs centered">
			<ul class="tab-nav">
				<li id="str_suppliers_tab" style="display:none;" class="active"><a href="#" id="main-tab-title">Suppliers</a></li>
				<li id="str_prime_definition_tab" style="display:none;"><a href="#">Definition</a></li>
				<li id="str_related_items_tab" style="display:none;"><a href="#">Related</a></li>
				<li id="str_linked_items_tab" style="display:none;"><a href="#">Links</a></li>
				<li id="str_collective_items_tab" style="display:none;"><a href="#">Types</a></li>
				<li id="str_nicknames_tab" style="display:none;"><a href="#">Nicknames</a></li>

				<!--li id="str_suppliers_tab" class="active"><a href="#" id="main-tab-title">Suppliers</a></li>
				<li id="str_prime_definition_tab" ><a href="#">Definition</a></li>
				<li id="str_related_items_tab" ><a href="#">Related</a></li>
				<li id="str_linked_items_tab" ><a href="#">Links</a></li>
				<li id="str_collective_items_tab" ><a href="#">Types</a></li>
				<li id="str_nicknames_tab" ><a href="#">Nicknames</a></li-->
			</ul>
    	   	<div class="tab-content active">
	       	    <div class='row'>
	   	            <div class='nine columns'>
                	   	    <table class='rounded striped'>
                	   	        <thead style='background-color:#f2f2f2; color:#555555'>
                	   	            <tr>
                	   	                <th>
                        	   	            <?php echo $str_suppliers_head; ?>
                	   	                 </th>
                	   	             </tr>
                	   	        </thead>
                	   	        <tbody id="str_suppliers">
                	   	            <?php echo $str_suppliers; ?>
                	   	        </tbody>
                	   	     </table>
	           	    </div>
    	           	<div class='three columns'>
        	           	<table class='rounded'>
		                    <thead style='background-color:#f2f2f2; color: #3085d6;'>
		                        <tr>
		                            <th style='font-weight: 600;'>Adverts</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                        <tr>
		                            <td>
		                                <p><a href="#">Adverts 1</a></p>
		                                <p>Longer and explanatory advertising text and description for advert # 1</a></p>
		                            </td>
		                        </tr>
                                <tr>
		                            <td>
		                                <p><a href="#">Adverts 2</a></p>
		                                <p>Longer and explanatory advertising text and description for advert # 2</a></p>
		                            </td>
		                        </tr>
                                <tr>
		                            <td>
		                                <p><a href="#">Adverts 3</a></p>
		                                <p>Longer and explanatory advertising text and description for advert # 3</a></p>
		                            </td>
		                        </tr>
                                <tr>
		                            <td>
		                                <p><a href="#">Adverts 4</a></p>
		                                <p>Longer and explanatory advertising text and description for advert # 4</a></p>
		                            </td>
		                        </tr>
                                <tr>
		                            <td>
		                                <p><a href="#">Adverts 5</a></p>
		                                <p>Longer and explanatory advertising text and description for advert # 5</a></p>
		                            </td>
		                        </tr>
		                    </tbody>
        	           	</table>
	                </div>
        	    </div>
        	</div>
    	   	<div class="tab-content" id="str_prime_definition"><p><?php echo $str_prime_definition; ?><?php echo $str_prime_examples; ?></p></div>
			<div class="tab-content" id="str_related_items"><p><?php echo $str_related_items; ?></p></div>
			<div class="tab-content" id="str_linked_items"><p><?php echo $str_linked_items; ?></p></div>
			<div class="tab-content" id="str_collective_items"><p><?php echo $str_collective_items; ?></p></div>
			<div class="tab-content" id="str_nicknames"><p><?php echo $str_nicknames; ?></p></div>
		</section>
	</div>
</div>
<?php echo $this->render('footer.htm',$this->mime,get_defined_vars()); ?>
