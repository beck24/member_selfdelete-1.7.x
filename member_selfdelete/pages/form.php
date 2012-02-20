<?php

gatekeeper();

$content = "<div style=\"padding: 25px;\">";
$content .= elgg_echo('member_selfdelete:disclaimer') . "<br><br>";
	$form = "<label>" . elgg_echo('member_selfdelete:label:reason') . "</label><br>";
	$form .= elgg_view('input/longtext', array('internalname' => 'reason', 'value' => $_SESSION['selfdelete']['reason'])) . "<br><br>";
	
	$form .= "<label>" . sprintf(elgg_echo('member_selfdelete:label:confirmation'), elgg_echo('member_selfdelete:DELETE')) . "<br>";
	$form .= elgg_view('input/text', array('internalname' => 'confirmation', 'value' => $_SESSION['selfdelete']['confirmation'])) . "<br><br>";
	
	$form .= elgg_view('input/submit', array('value' => elgg_echo('member_selfdelete:submit'))) . " ";

// create the form
// parameters for form generation - enctype must be 'multipart/form-data' for file uploads 
$form_vars = array();
$form_vars['body'] = $form;
$form_vars['name'] = 'selfdelete';
$form_vars['action'] = $CONFIG->url."action/selfdelete";
$content .=  elgg_view('input/form', $form_vars);

$content .= "</div>";

// place the form into the elgg layout
$body = elgg_view_layout('one_column', $content);


// display the page
page_draw('', $body);