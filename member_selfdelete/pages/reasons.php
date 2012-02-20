<?php

admin_gatekeeper();

$offset = get_input('offset', 0);
if($offset < 0){ $offset = 0; }
$limit = get_input('limit', 10);
$total = count_annotations(get_loggedin_user()->site_guid, "", "", "selfdeletefeedback", "", "");

$content = "<br>";

$content .= elgg_view('navigation/pagination',array(
		'baseurl' => $CONFIG->url . "pg/selfdelete/reasons" . $user->username,
		'offset' => $offset,
		'count' => $total,
		'limit' => $limit,
	));

$site = get_entity(get_loggedin_user()->site_guid);

$oldaccess = elgg_set_ignore_access(TRUE);
$annotations = get_annotations(get_loggedin_user()->site_guid, "", "", "selfdeletefeedback", "", 0, $limit, $offset, 'desc', 0, 0, 0);
elgg_set_ignore_access($oldaccess);


if(count($annotations) > 0){
  foreach($annotations as $annotation){
    $content .= "<div style=\"margin: 10px; border: 2px solid black; padding: 10px;\">";
    $content .= "<b>" . date("F j, Y", $annotation->time_created) . "</b><br><br>";
    $content .= $annotation->value;
    $content .= "</div>";
  }
}
else{
   $content .= "No users have deleted their acccounts";  
}

// place the form into the elgg layout
$body = elgg_view_layout('one_column', $content);

// display the page
page_draw('', $body);