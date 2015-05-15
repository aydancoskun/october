<?php
// Create
$theme = \Cms\Classes\Theme::getEditTheme();
$template = new \Cms\Classes\Content($theme); 
$template->fill([
	'fileName' => 'ProfileUpdateSample.htm',
	'content' => 'my content block text',
]);
$template->save();



// Delete
$theme = \Cms\Classes\Theme::getEditTheme();
$template = call_user_func(array('\Cms\Classes\Content', 'load'), $theme, 'ProfileUpdateSample.htm');
$template->delete();
