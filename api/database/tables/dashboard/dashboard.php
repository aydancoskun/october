<?php
class tables_dashboard {
	function block__search_form(){ // This removes the search above
		return false;
	}
	
	function block__left_column(){ // This removes the left column
		return false;
	}
}
